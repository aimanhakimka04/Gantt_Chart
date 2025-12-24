import cv2
import torch
import numpy as np
import json
import time
import csv
import os
import threading
from datetime import datetime
from collections import defaultdict
from flask import Flask, render_template, Response, request, jsonify
from norfair import Detection, Tracker
import requests
app = Flask(__name__)

# =====================
# Config
# =====================
RTSP_URL = "rtsp://aiman1:12345678@192.168.0.191:554/stream2" 

FRAME_W, FRAME_H = 640, 360
YOLO_SIZE = 640
CONF_THRES = 0.4
SKIP_FRAMES = 3
EVENT_COOLDOWN_FRAMES = 10
GLOBAL_COUNT_INTERVAL = 3.0  # seconds

EVENTS_CSV = "events_log.csv"
GLOBAL_COUNT_CSV = "global_count_log.csv"
INFLUX_HOST = "192.168.0.123"
INFLUX_PORT = 8086
INFLUX_DB = "people_counter"
BOX_COLORS = [
    (0, 255, 0), (255, 0, 0), (0, 255, 255),
    (255, 0, 255), (0, 128, 255), (255, 165, 0), (128, 0, 128)
]

# =====================
# RTSP Stream Class
# =====================
class RTSPStream:
    def __init__(self, url):
        self.url = url
        self.cap = cv2.VideoCapture(url)
        self.lock = threading.Lock()
        self.frame = None
        self.running = True
        self.last_ok = time.time()
        self.thread = threading.Thread(target=self.update, daemon=True)
        self.thread.start()

    def update(self):
        while self.running:
            ret, f = self.cap.read()
            if not ret:
                if time.time() - self.last_ok > 5:
                    print("[WARNING] Reconnecting RTSP...")
                    try:
                        self.cap.release()
                    except Exception:
                        pass
                    time.sleep(1)
                    self.cap = cv2.VideoCapture(self.url)
                continue
            self.last_ok = time.time()
            f = cv2.resize(f, (FRAME_W, FRAME_H))
            with self.lock:
                self.frame = f

    def read(self):
        with self.lock:
            return self.frame.copy() if self.frame is not None else None

    def stop(self):
        self.running = False
        self.thread.join()
        try:
            self.cap.release()
        except Exception:
            pass

# =====================
# Video Processor
# =====================
class VideoProcessor:
    def __init__(self):
        self.device = "cuda" if torch.cuda.is_available() else "cpu"
        print(f"[INFO] Using device: {self.device}")
        self.model = torch.hub.load("ultralytics/yolov5", "yolov5n", pretrained=True)
        self.model.conf = CONF_THRES
        self.model.classes = [0]
        self.model.to(self.device).eval()

        self.tracker = Tracker(
            distance_function="euclidean", 
            distance_threshold=40,
            initialization_delay=2, 
            hit_counter_max=15
        )

        self.zones = []
        self.next_zone_id = 1
        self.track_zone_members = {}
        self.track_zone_last_event = {}
        self.frame_count = 0
        
        self.show_boxes = True
        self.fps_est = 0
        self.prev_time = time.time()

        self.last_global_update = 0.0
        self.global_detected_count = 0
        self.global_last_update_time = "-"
        
        # Buffer untuk live chart (realtime)
        self.history_buffer = [] 
        self.MAX_BUFFER = 60 

        print(f"[INFO] Connecting to RTSP: {RTSP_URL}")
        self.stream = RTSPStream(RTSP_URL)
        self.load_zones()

    # --- CSV Logging (Updated to include Zone Data) ---
    def append_global_count_csv(self, count, timestamp, zone_data):
        # Format: Timestamp, GlobalCount, ZoneDataJSON12345678
        
        header = ["Timestamp", "Global Count", "Zone Data"]
        write_header = not os.path.exists(GLOBAL_COUNT_CSV)
        try:
            with open(GLOBAL_COUNT_CSV, mode="a", newline="") as f:
                writer = csv.writer(f)
                if write_header: writer.writerow(header)
                # Simpan zone_data sebagai JSON string supaya mudah diparse nanti
                writer.writerow([timestamp, count, json.dumps(zone_data)])
        except Exception as e:
            print(f"[ERROR] CSV Global: {e}")
    
    def send_to_influx(self, global_count): # Added 'self'
        try:
            # Format yang sah untuk Influx line protocol
            data = f"people_flow global_count={int(global_count)}"
            url = f"http://{INFLUX_HOST}:{INFLUX_PORT}/write?db={INFLUX_DB}"
            r = requests.post(url, data=data.encode("utf-8"), timeout=1)
            if r.status_code == 204:
                print(f"[OK] Sent to InfluxDB (global_count={global_count})")
            else:
                print(f"[ERROR] {r.status_code} -> {r.text}")
        except Exception as e:
            print(f"[WARN] Failed to send to InfluxDB: {e}")

    def append_event_csv(self, zone_id, label, event_type, track_id):
        header = ["Timestamp", "Zone ID", "Label", "Event", "Track ID"]
        row = [datetime.now().strftime("%Y-%m-%d %H:%M:%S"), zone_id, label, event_type, track_id]
        write_header = not os.path.exists(EVENTS_CSV)
        try:
            with open(EVENTS_CSV, mode="a", newline="") as f:
                writer = csv.writer(f)
                if write_header: writer.writerow(header)
                writer.writerow(row)
        except Exception as e:
            print(f"[ERROR] CSV Event: {e}")

    # --- Zone Management ---
    def load_zones(self, path="roi_zones.json"):
        if not os.path.exists(path): return
        try:
            with open(path, "r") as f:
                data = json.load(f)
            self.zones = []
            for item in data:
                self.zones.append({
                    "id": item.get("id"),
                    "coords": tuple(item["coords"]),
                    "label": item.get("label"),
                    "in_count": item.get("in_count", 0),
                    "out_count": item.get("out_count", 0),
                    "color": tuple(item.get("color"))
                })
            if self.zones:
                self.next_zone_id = max(z["id"] for z in self.zones) + 1
        except Exception as e:
            print("[ERROR] Loading zones:", e)

    def save_zones(self, path="roi_zones.json"):
        tosave = []
        for z in self.zones:
            tosave.append({
                "id": z["id"],
                "coords": z["coords"],
                "label": z["label"],
                "in_count": z["in_count"],
                "out_count": z["out_count"],
                "color": z["color"]
            })
        with open(path, "w") as f:
            json.dump(tosave, f, indent=2)
        return True

    def export_csv_snapshot(self):
        ts = datetime.now().strftime("%Y%m%d_%H%M%S")
        path = f"snapshot_count_{ts}.csv"
        with open(path, mode="w", newline="") as csvfile:
            writer = csv.writer(csvfile)
            writer.writerow(["Timestamp", "Zone ID", "Label", "IN Count", "OUT Count"])
            for z in self.zones:
                writer.writerow([
                    datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
                    z["id"], z["label"], z["in_count"], z["out_count"]
                ])
        return path

    def add_zone(self, x1, y1, x2, y2):
        xa, xb = sorted([int(x1), int(x2)])
        ya, yb = sorted([int(y1), int(y2)])
        if abs(xb-xa) < 10 or abs(yb-ya) < 10: return False
        z = {
            "id": self.next_zone_id,
            "coords": (xa, ya, xb, yb),
            "label": f"Door {self.next_zone_id}",
            "in_count": 0,
            "out_count": 0,
            "color": BOX_COLORS[(self.next_zone_id-1) % len(BOX_COLORS)]
        }
        self.zones.append(z)
        self.next_zone_id += 1
        return True

    def delete_nearest_zone(self, mx, my):
        if not self.zones: return False
        best_i, best_d = None, None
        for i, z in enumerate(self.zones):
            x1, y1, x2, y2 = z["coords"]
            cx, cy = (x1+x2)//2, (y1+y2)//2
            d = (mx-cx)**2 + (my-cy)**2
            if best_d is None or d < best_d:
                best_d = d; best_i = i
        if best_i is not None:
            self.zones.pop(best_i)
            return True
        return False

    def point_in_rect(self, px, py, rect):
        x1, y1, x2, y2 = rect
        return (x1 <= px <= x2) and (y1 <= py <= y2)

    # --- Main Processing Loop ---
    def get_frame(self):
        frame = self.stream.read()
        if frame is None:
            time.sleep(0.01)
            blank = np.zeros((FRAME_H, FRAME_W, 3), dtype=np.uint8)
            cv2.putText(blank, "Connecting...", (50, 180), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 0, 255), 2)
            ret, buffer = cv2.imencode('.jpg', blank)
            return buffer.tobytes()
        
        # FPS
        curr_time = time.time()
        delta = curr_time - self.prev_time
        if delta > 0: self.fps_est = 0.9 * self.fps_est + 0.1 * (1.0 / delta)
        self.prev_time = curr_time
        self.frame_count += 1
        detections = []

        # YOLO
        if self.frame_count % SKIP_FRAMES == 0:
            with torch.no_grad():
                results = self.model(frame, size=YOLO_SIZE)
            self.last_results = results.xyxy[0].cpu().numpy()
        else:
            if not hasattr(self, 'last_results'): self.last_results = []

        # Detections
        current_detection_count = 0
        for *xyxy, conf, cls in self.last_results:
            if conf >= CONF_THRES:
                current_detection_count += 1
                if self.show_boxes:
                    x1, y1, x2, y2 = map(int, xyxy)
                    cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 0), 2)
                cx, cy = (int(xyxy[0]) + int(xyxy[2]))//2, (int(xyxy[1]) + int(xyxy[3]))//2
                detections.append(Detection(points=np.array([[cx, cy]]), scores=np.array([conf])))
        
        # Update Stats & CSV
        now_t = time.time()
        if now_t - self.last_global_update >= GLOBAL_COUNT_INTERVAL:
            self.global_detected_count = current_detection_count
            timestamp_str = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            self.global_last_update_time = datetime.now().strftime("%H:%M:%S")
            self.last_global_update = now_t
            
            # Data snapshot for history/CSV
            zone_data = {z["label"]: (z["in_count"] - z["out_count"]) for z in self.zones}
            
            # Save to CSV (Persistent History)
            self.append_global_count_csv(self.global_detected_count, timestamp_str, zone_data)
            self.send_to_influx(self.global_detected_count)
            
            # Save to Live Buffer (Realtime View)
            snapshot = {
                "time": self.global_last_update_time,
                "global": self.global_detected_count,
                "zones": zone_data
            }
            self.history_buffer.append(snapshot)
            if len(self.history_buffer) > self.MAX_BUFFER:
                self.history_buffer.pop(0)

        # Tracking & Logic
        tracked_objects = self.tracker.update(detections=detections)
        current_membership = {}
        active_zone_ids = set()

        for tobj in tracked_objects:
            tid = tobj.id
            cx, cy = tobj.estimate[0].astype(int)
            if self.show_boxes: cv2.circle(frame, (cx, cy), 3, (0, 0, 255), -1)
            inside = set()
            for z in self.zones:
                if self.point_in_rect(cx, cy, z["coords"]): inside.add(z["id"])
            current_membership[tid] = inside

        # Events
        for tid, now_set in current_membership.items():
            prev_set = self.track_zone_members.get(tid, set())
            entered = now_set - prev_set
            exited = prev_set - now_set

            for zid in entered:
                lastf = self.track_zone_last_event.get((tid, zid), -9999)
                if self.frame_count - lastf >= EVENT_COOLDOWN_FRAMES:
                    for z in self.zones:
                        if z["id"] == zid:
                            z["in_count"] += 1
                            active_zone_ids.add(zid)
                            self.track_zone_last_event[(tid, zid)] = self.frame_count
                            self.append_event_csv(zid, z["label"], "ENTER", tid)

            for zid in exited:
                lastf = self.track_zone_last_event.get((tid, zid), -9999)
                if self.frame_count - lastf >= EVENT_COOLDOWN_FRAMES:
                    for z in self.zones:
                        if z["id"] == zid:
                            z["out_count"] += 1
                            active_zone_ids.add(zid)
                            self.track_zone_last_event[(tid, zid)] = self.frame_count
                            self.append_event_csv(zid, z["label"], "EXIT", tid)
            
            self.track_zone_members[tid] = now_set

        # Cleanup
        active_ids = set(t.id for t in tracked_objects)
        for tid in list(self.track_zone_members.keys()):
            if tid not in active_ids: del self.track_zone_members[tid]
        for k, lastf in list(self.track_zone_last_event.items()):
            if self.frame_count - lastf > 1000: del self.track_zone_last_event[k]

        # Draw
        for z in self.zones:
            x1, y1, x2, y2 = z["coords"]
            color = z["color"]
            thick = 3 if z["id"] in active_zone_ids else 2
            cv2.rectangle(frame, (x1, y1), (x2, y2), color, thick)
            cv2.putText(frame, z["label"], (x1, y1-5), cv2.FONT_HERSHEY_SIMPLEX, 0.5, color, 2)
        
        cv2.putText(frame, f"FPS: {int(self.fps_est)}", (FRAME_W - 120, 30), 
                    cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 255, 255), 2)
        
        ret, buffer = cv2.imencode('.jpg', frame)
        return buffer.tobytes()

processor = VideoProcessor()

# =====================
# Flask Routes
# =====================
@app.route('/')
def index():
    return render_template('index.html')

def gen_frames():
    while True:
        frame_bytes = processor.get_frame()
        yield (b'--frame\r\n' b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

@app.route('/video_feed')
def video_feed():
    return Response(gen_frames(), mimetype='multipart/x-mixed-replace; boundary=frame')

@app.route('/api/stats')
def get_stats():
    data = {
        "zones": processor.zones,
        "global": {
            "count": processor.global_detected_count,
            "last_update": processor.global_last_update_time
        }
    }
    return jsonify(data)

# --- NEW: Historical Data Endpoint ---
@app.route('/api/trend')
def get_trend():
    interval = request.args.get('interval', 'realtime')
    
    # Jika Realtime, pulangkan buffer RAM
    if interval == 'realtime':
        return jsonify(processor.history_buffer)
    
    # Jika tidak, baca CSV dan buat pengiraan
    if not os.path.exists(GLOBAL_COUNT_CSV):
        return jsonify([])

    aggregated_data = {} # Key: TimeBucket, Value: {sum_global, count, sum_zones}

    try:
        with open(GLOBAL_COUNT_CSV, 'r') as f:
            reader = csv.reader(f)
            header = next(reader, None)
            
            for row in reader:
                if len(row) < 3: continue
                ts_str, g_count, z_data_str = row[0], int(row[1]), row[2]
                
                try:
                    dt = datetime.strptime(ts_str, "%Y-%m-%d %H:%M:%S")
                    z_data = json.loads(z_data_str)
                except:
                    continue

                # Tentukan format kunci masa berdasarkan interval
                if interval == 'minute':
                    key = dt.strftime("%Y-%m-%d %H:%M")
                elif interval == 'hour':
                    key = dt.strftime("%Y-%m-%d %H:00")
                elif interval == 'day':
                    key = dt.strftime("%Y-%m-%d")
                elif interval == 'month':
                    key = dt.strftime("%Y-%m")
                else:
                    key = ts_str # default

                if key not in aggregated_data:
                    aggregated_data[key] = {'total_global': 0, 'samples': 0, 'total_zones': defaultdict(int)}
                
                # Tambah data untuk purata
                aggregated_data[key]['total_global'] += g_count
                aggregated_data[key]['samples'] += 1
                for z_label, z_val in z_data.items():
                    aggregated_data[key]['total_zones'][z_label] += z_val

    except Exception as e:
        print(f"[ERROR] Reading CSV History: {e}")
        return jsonify([])

    # Format output akhir
    result = []
    # Sort keys untuk pastikan urutan masa betul
    for key in sorted(aggregated_data.keys()):
        item = aggregated_data[key]
        n = item['samples']
        # Kira purata
        avg_global = round(item['total_global'] / n, 1)
        avg_zones = {k: round(v / n, 1) for k, v in item['total_zones'].items()}
        
        result.append({
            "time": key,
            "global": avg_global,
            "zones": avg_zones
        })

    return jsonify(result)

@app.route('/api/toggle_boxes', methods=['POST'])
def toggle_boxes():
    processor.show_boxes = not processor.show_boxes
    state = "ON" if processor.show_boxes else "OFF"
    return jsonify({"status": "success", "message": f"Boxes turned {state}"})

@app.route('/api/add_zone', methods=['POST'])
def add_zone():
    data = request.json
    x1, y1, x2, y2 = data['coords']
    processor.add_zone(x1, y1, x2, y2)
    return jsonify({"status": "success"})

@app.route('/api/delete_zone', methods=['POST'])
def delete_zone():
    data = request.json
    mx, my = data['coords']
    processor.delete_nearest_zone(mx, my)
    return jsonify({"status": "success"})

@app.route('/api/action/<action_type>')
def action(action_type):
    msg = ""
    if action_type == "save":
        processor.save_zones()
        msg = "Zones saved."
    elif action_type == "load":
        processor.load_zones()
        msg = "Zones loaded."
    elif action_type == "reset":
        for z in processor.zones:
            z["in_count"] = 0; z["out_count"] = 0
        processor.history_buffer = []
        msg = "Counts reset."
    elif action_type == "export":
        path = processor.export_csv_snapshot()
        msg = f"Snapshot: {path}"
    return jsonify({"status": "success", "message": msg})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True, threaded=True)