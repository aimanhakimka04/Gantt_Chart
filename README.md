# 🕌 Gantt Chart & Mosque Management System

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" />
</p>

<p align="center">
  <b>A PHP-based project management and mosque management system featuring Gantt chart visualisation for task scheduling and a dedicated web/mobile app for mosque activity management.</b>
</p>

---

## 📋 Table of Contents
- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Screenshots](#screenshots)
- [Future Work](#future-work)

---

## 🔍 Overview

This repository contains two integrated components:

1. **Gantt Chart System** — A visual project planning tool built in PHP.
2. **Mosque Management System** (`masjid_app` / `mosque_web`) — A web and mobile application for managing mosque activities, events, prayer times, and announcements.

---

## ✨ Features

### 📊 Gantt Chart Module
| Feature | Description |
|--------|-------------|
| 📋 **Task Management** | Create, assign, update, and delete project tasks |
| 📅 **Timeline Visualisation** | Interactive Gantt chart with drag-and-drop scheduling |
| 👥 **Team Assignment** | Assign tasks to team members with role tracking |
| 📊 **Progress Tracking** | Visual progress bars per task and overall project |
| 🔔 **Deadline Alerts** | Flag overdue and upcoming tasks |

### 🕌 Mosque Management Module
| Feature | Description |
|--------|-------------|
| 🔐 **Prayer Time Management** | Schedule and display daily prayer times |
| 📢 **Announcements** | Publish and manage mosque announcements |
| 📅 **Event Calendar** | Manage Islamic events, programmes, and classes |
| 📱 **Mobile App** | Native mobile app via `masjid_app` |
| 🌐 **Web Portal** | Public-facing mosque website via `mosque_web` |

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|----------|
| **Backend** | PHP 8.x |
| **Database** | MySQL |
| **Frontend** | HTML5, CSS3, JavaScript |
| **Server** | Apache (XAMPP/WAMP) |

---

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/aimanhakimka04/Gantt_Chart.git
   ```

2. **Move to your web server directory**
   ```bash
   cp -r . C:\xampp\htdocs\gantt_chart
   ```

3. **Set up the database** via phpMyAdmin and import the SQL schema.

4. **Configure** `config.php` with your DB credentials.

5. **Access the application** at `http://localhost/gantt_chart`

---

## 🎯 Usage

### Project Management
1. Log in as admin or project manager.
2. Create a new project and add team members.
3. Add tasks with start/end dates.
4. View the Gantt chart timeline.

### Mosque Management
- Navigate to `mosque_web/` for the public portal.
- Launch `masjid_app/` for the mobile application.

---

## ⚙️ Configuration

| Setting | File | Description |
|---------|------|-------------|
| `DB_HOST` | `config.php` | Database server hostname |
| `DB_NAME` | `config.php` | Database name |
| `PRAYER_API` | `mosque_web/config.php` | Prayer times API endpoint |
| `TIMEZONE` | `config.php` | Application timezone |

---

## 📸 Screenshots

> _Screenshots will be added in a future update._

| Gantt Chart View | Mosque Portal | Mobile App |
|---|---|---|
| ![Gantt](docs/screenshots/gantt.png) | ![Portal](docs/screenshots/mosque_portal.png) | ![Mobile](docs/screenshots/mobile.png) |

---

## 🔮 Future Work

- [ ] **Real-Time Collaboration** — WebSocket-based live Gantt chart updates
- [ ] **Prayer Time API** — Auto-fetch from Aladhan API
- [ ] **Push Notifications** — Notify before prayer times and events
- [ ] **Donation Module** — Online zakat/sadaqah collection
- [ ] **Multi-Mosque Support** — Multi-tenant architecture
- [ ] **Report Generation** — Export project and activity reports to PDF
- [ ] **Calendar Integration** — Sync with Google Calendar / iCal

---

## 🤝 Contributing

Pull requests are welcome!

---

## 👤 Author

**Aiman Hakim** — [@aimanhakimka04](https://github.com/aimanhakimka04)
