<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - Masjid MMU Melaka</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body { font-family: "Inter", sans-serif; }
    
    .sidebar-item { transition: all 0.3s ease; }
    .sidebar-item:hover { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; }
    .sidebar-item.active { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; color: #3b82f6; }
    
    .card-hover { transition: all 0.3s ease; }
    .card-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
    
    .fade-in { animation: fadeIn 0.6s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* Custom style for filter buttons */
    .filter-btn.active { background-color: white; color: #2563eb; box-shadow: 0 1px 2px rgba(0,0,0,0.1); }
    .filter-btn { color: #6b7280; }
    .filter-btn:hover { color: #374151; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="flex h-screen overflow-hidden">
    
    <div class="w-64 bg-white shadow-xl z-20 hidden md:block flex-shrink-0">
      <div class="p-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
          <div class="p-2 bg-blue-600 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
          </div>
          <div>
            <h1 class="text-lg font-bold text-gray-900 tracking-tight">Admin Panel</h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Masjid MMU</p>
          </div>
        </div>
      </div>

      <nav class="mt-6 px-4 space-y-2 overflow-y-auto h-[calc(100vh-180px)]">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item active w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"></path></svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.donations.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Pengurusan Derma</span>
        </a>
        <a href="{{ route('admin.donation_programs.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Program Sumbangan</span>
        </a>

        <a href="{{ route('admin.events.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Pengurusan Acara</span>
        </a>

        <a href="{{ route('admin.registrations.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span>Pendaftaran Peserta</span>
        </a>

        <a href="{{ route('admin.service_requests.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            <span>Permintaan Servis</span>
        </a>

        <a href="{{ route('admin.notifications.send') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span>Hantar Notifikasi</span>
        </a>
      </nav>

      <div class="p-4 border-t border-gray-100 bg-white">
        <form method="POST" action="{{ route('committee.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span>Log Keluar</span>
            </button>
        </form>
      </div>
    </div>

    <div class="flex-1 overflow-y-auto bg-gray-50 h-full">
      
      <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
        <div class="flex items-center justify-between px-8 py-4">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            <p class="text-sm text-gray-500">Selamat datang ke panel pentadbir masjid</p>
          </div>
          <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
              <p class="text-sm font-bold text-gray-900">{{ Auth::guard('committee')->user()->name ?? 'Admin' }}</p>
              <p class="text-xs text-gray-500">{{ Auth::guard('committee')->user()->email ?? '' }}</p>
            </div>
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg text-white font-bold">
                {{ substr(Auth::guard('committee')->user()->name ?? 'A', 0, 1) }}
            </div>
          </div>
        </div>
      </header>

      <main class="p-8">
        <div class="fade-in">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
              
              <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center">
                  <div class="p-3 bg-green-100 rounded-full text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm text-gray-500 font-medium">Derma Terkumpul</p>
                    <p class="text-2xl font-bold text-gray-900">RM {{ number_format($totalDonations, 2) }}</p>
                  </div>
                </div>
              </div>

              <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center">
                  <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm text-gray-500 font-medium">Jumlah Acara</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $events->count() }}</p>
                  </div>
                </div>
              </div>

              <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center">
                  <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm text-gray-500 font-medium">Jemaah Berdaftar</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Participant::count() }}</p>
                  </div>
                </div>
              </div>

              <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover">
                <div class="flex items-center">
                  <div class="p-3 bg-orange-100 rounded-full text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm text-gray-500 font-medium">Status Admin</p>
                    <p class="text-xl font-bold text-gray-900 text-green-600">Aktif</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
              
              <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                    <div class="flex items-center">
                        <h3 class="text-lg font-bold text-gray-800 mr-3">Statistik Kunjungan</h3>
                        <span class="flex items-center text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-full border border-red-100">
                            <span class="w-2 h-2 bg-red-600 rounded-full mr-1 animate-pulse"></span>
                            LIVE
                        </span>
                    </div>
                    
                    <div class="flex bg-gray-100 p-1 rounded-lg">
                        <button onclick="changeRange('second')" id="btn-second" class="filter-btn px-3 py-1 text-xs font-medium rounded-md transition-all">Live</button>
                        <button onclick="changeRange('minute')" id="btn-minute" class="filter-btn px-3 py-1 text-xs font-medium rounded-md transition-all">Minit</button>
                        <button onclick="changeRange('hour')" id="btn-hour" class="filter-btn px-3 py-1 text-xs font-medium rounded-md transition-all">Jam</button>
                        <button onclick="changeRange('day')" id="btn-day" class="filter-btn active px-3 py-1 text-xs font-medium rounded-md transition-all">Hari</button>
                        <button onclick="changeRange('month')" id="btn-month" class="filter-btn px-3 py-1 text-xs font-medium rounded-md transition-all">Bulan</button>
                    </div>
                </div>
                <div class="h-64 w-full relative">
                  <canvas id="visitChart"></canvas>
                </div>
              </div>

              <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Trend Sumbangan (Tahun Ini)</h3>
                <div class="h-64 w-full">
                  <canvas id="donationChart"></canvas>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Senarai Acara Akan Datang</h3>
                    <a href="{{ route('admin.events.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">Nama Acara</th>
                                <th class="px-6 py-3">Tarikh</th>
                                <th class="px-6 py-3">Kapasiti</th>
                                <th class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($events->take(5) as $event)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $event->title }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4">{{ $event->capacity ?? 'Unlimited' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Dibuka</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Tiada acara akan datang. <a href="{{ route('admin.events.create') }}" class="text-blue-600 hover:underline">Cipta acara baru.</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
      </main>
    </div>
  </div>

 <script>
    // Global variables
    let visitChartInstance = null;
    let autoRefreshInterval = null; // Variable untuk timer

    let currentRange = 'second'; 

    document.addEventListener("DOMContentLoaded", function () {
        fetchVisitData();
        startLiveUpdate();
        initDonationChart();
        
        // Update UI butang default
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('btn-second').classList.add('active');
    });

    // Fungsi untuk tukar butang (Jam/Hari/Bulan)
    function changeRange(range) {
        currentRange = range;
        
        // Update UI butang
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('btn-' + range).classList.add('active');

        // Panggil data serta-merta
        fetchVisitData();
        
        // Restart timer supaya kiraan 5 saat mula balik
        startLiveUpdate(); 
    }

    function startLiveUpdate() {
        if (autoRefreshInterval) clearInterval(autoRefreshInterval);
        
        // Update setiap 5 saat
        autoRefreshInterval = setInterval(() => {
            fetchVisitData();
        }, 5000); 
    }

    // Fungsi ambil data dari Laravel -> InfluxDB
    async function fetchVisitData() {
        try {
            const response = await fetch(`{{ route('admin.api.visit_stats') }}?range=${currentRange}`);
            const result = await response.json();

            if (result.error) {
                console.error("InfluxDB Error:", result.error);
                return;
            }

            renderVisitChart(result.labels, result.data);

        } catch (error) {
            console.error("Gagal memuatkan data:", error);
        }
    }

    // Fungsi Lukis/Update Chart
    function renderVisitChart(labels, data) {
        const ctx = document.getElementById("visitChart").getContext("2d");

        // Jika chart sudah wujud, kita UPDATE sahaja (supaya tak berkelip)
        if (visitChartInstance) {
            visitChartInstance.data.labels = labels;
            visitChartInstance.data.datasets[0].data = data;
            visitChartInstance.update('none'); // 'none' bermaksud tiada animasi kasar
        } else {
            // Jika chart belum wujud, kita CIPTA baru
            visitChartInstance = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels, 
                    datasets: [{
                        label: "Jumlah Pengunjung",
                        data: data,
                        borderColor: "rgb(59, 130, 246)",
                        backgroundColor: "rgba(59, 130, 246, 0.1)",
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: false, // Kurangkan animasi berat untuk live data
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: { legend: { display: false } },
                    scales: { 
                        y: { 
                            beginAtZero: true,
                            ticks: { stepSize: 1 } 
                        } 
                    }
                }
            });
        }
    }

    // --- DONATION CHART (Kekal Sama) ---
    function initDonationChart() {
        const donationCtx = document.getElementById("donationChart").getContext("2d");
        const chartDataFromBackend = @json($chartData); 

        new Chart(donationCtx, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mac", "Apr", "Mei", "Jun", "Jul", "Ogos", "Sep", "Okt", "Nov", "Dis"],
                datasets: [{
                    label: "Jumlah (RM)",
                    data: chartDataFromBackend,
                    backgroundColor: "rgba(16, 185, 129, 0.8)",
                    borderRadius: 4,
                    hoverBackgroundColor: "rgba(16, 185, 129, 1)"
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { 
                        beginAtZero: true,
                        ticks: { callback: function(value) { return 'RM ' + value; } }
                    } 
                }
            }
        });
    }
</script>
</body>
</html>