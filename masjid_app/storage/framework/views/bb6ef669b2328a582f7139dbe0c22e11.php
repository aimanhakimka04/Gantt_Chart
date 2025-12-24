<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid MMU Melaka - Rumah Ibadah Umat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .prayer-time-card {
            transition: all 0.3s ease;
        }

        .prayer-time-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mosque-icon {
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <nav class="bg-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <svg class="mosque-icon text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L8 6v2H6v12h12V8h-2V6l-4-4zm0 2.83L14 7v1h-4V7l2-2.17zM8 10h8v8H8v-8z" />
                        <circle cx="12" cy="14" r="2" />
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold">Masjid MMU Melaka</h1>
                        <p class="text-xs text-blue-200">Multimedia University Melaka</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="#beranda" class="hover:text-blue-200 transition-colors" data-key="nav-home">Laman Utama</a>
                    <a href="#jadwal" class="hover:text-blue-200 transition-colors" data-key="nav-schedule">Waktu Solat</a>
                    <a href="#kegiatan" class="hover:text-blue-200 transition-colors" data-key="nav-activities">Aktiviti</a>
                    <a href="#donasi" class="hover:text-blue-200 transition-colors" data-key="nav-donation">Sumbangan</a>
                    <a href="#kontak" class="hover:text-blue-200 transition-colors" data-key="nav-contact">Hubungi</a>

                    <div class="relative">
                        <button id="lang-btn" class="flex items-center space-x-1 bg-blue-700 px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z" />
                            </svg>
                            <span id="current-lang">MS</span>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 12 12">
                                <path d="M6 8L2 4h8L6 8z" />
                            </svg>
                        </button>
                        <div id="lang-menu" class="hidden absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg border border-gray-200 z-50 text-gray-800">
                            <button onclick="switchLanguage('en')" class="w-full text-left px-4 py-2 hover:bg-blue-50 rounded-t-lg">🇬🇧 English</button>
                            <button onclick="switchLanguage('ms')" class="w-full text-left px-4 py-2 hover:bg-blue-50 rounded-b-lg">🇲🇾 Melayu</button>
                        </div>
                    </div>

                    <div class="relative ml-2 pl-4 border-l border-blue-400">
                        
                        <?php if(Auth::guard('participant')->check()): ?>
                            <button id="user-menu-btn" onclick="toggleUserMenu()" class="flex items-center space-x-2 bg-blue-900 bg-opacity-40 hover:bg-opacity-60 border border-blue-400 text-white px-3 py-2 rounded-lg transition-all">
                                <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-xs font-bold uppercase">
                                    
                                    <?php echo e(substr(Auth::guard('participant')->user()->name, 0, 1)); ?>

                                </div>
                                <span class="font-medium text-sm hidden lg:inline-block max-w-[100px] truncate">
                                    <?php echo e(Auth::guard('participant')->user()->name); ?>

                                </span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            
                            <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden text-gray-800">
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                    <p class="text-xs text-gray-500">Log masuk sebagai (Awam)</p>
                                    <p class="text-sm font-bold truncate"><?php echo e(Auth::guard('participant')->user()->email); ?></p>
                                </div>
                                
                                
                                <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-blue-700">
                                    <i class="fas fa-home mr-2"></i> Dashboard Saya
                                </a>

                                
                                <a href="<?php echo e(route('user.history')); ?>" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-blue-700">
                                    <i class="fas fa-history mr-2"></i> Sejarah Derma
                                </a>

                                <div class="border-t border-gray-100 my-1"></div>

                                
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Log Keluar
                                    </button>
                                </form>
                            </div>

                        
                        <?php elseif(Auth::guard('committee')->check()): ?>
                            <button id="admin-menu-btn" onclick="toggleUserMenu()" class="flex items-center space-x-2 bg-purple-900 bg-opacity-40 hover:bg-opacity-60 border border-purple-400 text-white px-3 py-2 rounded-lg transition-all">
                                <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center text-xs font-bold uppercase">A</div>
                                <span class="font-medium text-sm hidden lg:inline-block">Admin</span>
                            </button>
                            
                            <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden text-gray-800">
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 text-sm hover:bg-purple-50 hover:text-purple-700">
                                    Dashboard Admin
                                </a>
                                <form method="POST" action="<?php echo e(route('committee.logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Keluar</button>
                                </form>
                            </div>

                        
                        <?php else: ?>
                            <div class="flex space-x-2">
                                <a href="<?php echo e(route('login')); ?>" class="flex items-center space-x-1 bg-white text-blue-800 px-4 py-2 rounded-lg font-bold hover:bg-blue-50 transition-colors shadow-sm text-sm">
                                    <span>Log Masuk</span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                
                <button id="mobile-menu-btn" class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-blue-900">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#beranda" class="block px-3 py-2 hover:bg-blue-700 rounded" data-key="nav-home">Laman Utama</a>
                <a href="#jadwal" class="block px-3 py-2 hover:bg-blue-700 rounded" data-key="nav-schedule">Waktu Solat</a>
                <a href="#kegiatan" class="block px-3 py-2 hover:bg-blue-700 rounded" data-key="nav-activities">Aktiviti</a>
                <a href="#donasi" class="block px-3 py-2 hover:bg-blue-700 rounded" data-key="nav-donation">Sumbangan</a>
                <a href="#kontak" class="block px-3 py-2 hover:bg-blue-700 rounded" data-key="nav-contact">Hubungi</a>

                <div class="px-3 py-2">
                    <div class="flex space-x-2">
                        <button onclick="switchLanguage('en')" class="flex-1 text-center py-2 bg-blue-700 rounded text-sm hover:bg-blue-600">🇬🇧 EN</button>
                        <button onclick="switchLanguage('ms')" class="flex-1 text-center py-2 bg-blue-700 rounded text-sm hover:bg-blue-600">🇲🇾 MS</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="bg-gradient-to-br from-blue-600 to-blue-800 hero-pattern text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="fade-in">
                <h2 class="text-4xl md:text-6xl font-bold mb-6" data-key="hero-title">Selamat Datang ke Masjid MMU Melaka</h2>
                <p class="text-xl md:text-2xl mb-8 text-blue-100" data-key="hero-subtitle">Tempat ibadah, pembelajaran, dan persaudaraan warga akademik</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="scrollToSection('jadwal')" class="bg-white text-blue-800 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors" data-key="btn-schedule">
                        Lihat Jadual Solat
                    </button>
                    <button onclick="scrollToSection('donasi')" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-800 transition-colors" data-key="btn-donate">
                        Derma Sekarang
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-8 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center space-x-4 bg-blue-50 px-6 py-4 rounded-lg">
                    <div class="text-blue-800">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-blue-800 font-semibold" data-key="current-prayer-label">Waktu Solat Sekarang</p>
                        <p id="current-prayer" class="text-2xl font-bold text-blue-900">Zohor - 13:15</p>
                    </div>
                    <div class="text-blue-600">
                        <p class="text-sm" data-key="remaining-time">Masa berbaki:</p>
                        <p id="countdown" class="text-lg font-bold">2:45:30</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="jadwal" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4" data-key="schedule-title">Jadual Solat Hari Ini</h3>
                <p class="text-gray-600"><span data-key="location">Melaka, Malaysia</span> • <span id="current-date"></span></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="prayer-time-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-orange-500 mb-3">
                        <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.79 1.42-1.41zM4 10.5H1v2h3v-2zm9-9.95h-2V3.5h2V.55zm7.45 3.91l-1.41-1.41-1.79 1.79 1.41 1.41 1.79-1.79zm-3.21 13.7l1.79 1.8 1.41-1.41-1.8-1.79-1.4 1.4zM20 10.5v2h3v-2h-3zm-8-5c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm-1 16.95h2V19.5h-2v2.95zm-7.45-3.91l1.41 1.41 1.79-1.8-1.41-1.41-1.79 1.8z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Subuh</h4>
                    <p id="subuh" class="text-2xl font-bold text-orange-600">05:45</p>
                </div>

                <div class="prayer-time-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-yellow-500 mb-3">
                        <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Zohor</h4>
                    <p id="dzuhur" class="text-2xl font-bold text-yellow-600">13:15</p>
                </div>

                <div class="prayer-time-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-amber-500 mb-3">
                        <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Asar</h4>
                    <p id="ashar" class="text-2xl font-bold text-amber-600">16:30</p>
                </div>

                <div class="prayer-time-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-red-500 mb-3">
                        <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Maghrib</h4>
                    <p id="maghrib" class="text-2xl font-bold text-red-600">19:20</p>
                </div>

                <div class="prayer-time-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-indigo-500 mb-3">
                        <svg class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Isyak</h4>
                    <p id="isya" class="text-2xl font-bold text-indigo-600">20:30</p>
                </div>
            </div>
        </div>
    </section>

    <section id="kegiatan" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4" data-key="activities-title">Aktiviti Masjid</h3>
                <p class="text-gray-600" data-key="activities-subtitle">Program terkini dan akan datang untuk komuniti</p>
            </div>

            <?php if(isset($events) && $events->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow border border-gray-100 flex flex-col h-full">
                            <div class="flex items-start justify-between mb-4">
                                <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                                    
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <?php if($event->capacity): ?>
                                    <span class="text-xs font-semibold px-2 py-1 bg-green-100 text-green-700 rounded-full">
                                        Terhad: <?php echo e($event->capacity); ?> Orang
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="flex-grow">
                                <h4 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2"><?php echo e($event->title); ?></h4>
                                <p class="text-gray-600 mb-4 text-sm line-clamp-3">
                                    <?php echo e($event->description); ?>

                                </p>
                                
                                <div class="space-y-2 text-sm text-gray-500 mb-6">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span><?php echo e(\Carbon\Carbon::parse($event->event_date)->format('d F Y')); ?></span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="truncate"><?php echo e($event->venue ?? 'Masjid MMU'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-t border-gray-200">
                                <?php if(Auth::guard('participant')->check()): ?>
                                    <?php
                                        // Semak status pendaftaran user semasa untuk event ini
                                        $isRegistered = \App\Models\Registration::where('participant_id', Auth::guard('participant')->user()->id)
                                                        ->where('event_id', $event->id)
                                                        ->first();
                                    ?>

                                    <?php if($isRegistered): ?>
                                        <button disabled class="w-full py-2 px-4 bg-gray-100 text-gray-500 font-semibold rounded-lg cursor-not-allowed flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <?php if($isRegistered->status == 'pending'): ?>
                                                Menunggu Kelulusan
                                            <?php elseif($isRegistered->status == 'approved'): ?>
                                                Sudah Didaftar
                                            <?php else: ?>
                                                Permohonan Ditolak
                                            <?php endif; ?>
                                        </button>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('event.join', $event->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" onclick="return confirm('Adakah anda pasti ingin menyertai program ini?')" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-sm hover:shadow-md">
                                                Sertai Program
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                <?php elseif(Auth::guard('committee')->check()): ?>
                                    <a href="<?php echo e(route('admin.events.index')); ?>" class="block w-full py-2 px-4 bg-purple-600 hover:bg-purple-700 text-white text-center font-semibold rounded-lg transition-colors">
                                        Urus Acara (Admin)
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" class="block w-full py-2 px-4 bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 text-center font-semibold rounded-lg transition-colors">
                                        Log Masuk untuk Sertai
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Tiada Aktiviti Terkini</h3>
                    <p class="text-gray-500 mt-1">Sila semak semula kemudian untuk program akan datang.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if(session('success') || session('error')): ?>
        <div class="fixed top-20 right-5 z-50 animate-bounce">
            <div class="<?php echo e(session('success') ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700'); ?> border-l-4 p-4 rounded shadow-lg flex items-center" role="alert">
                <p class="font-bold mr-2"><?php echo e(session('success') ? 'Berjaya!' : 'Ralat!'); ?></p>
                <p><?php echo e(session('success') ?? session('error')); ?></p>
                <button onclick="this.parentElement.style.display='none';" class="ml-4 font-bold">x</button>
            </div>
        </div>
        <?php endif; ?>
    </section>

    <section id="donasi" class="py-16 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4" data-key="donation-title">Derma & Infaq</h3>
                <p class="text-gray-600" data-key="donation-subtitle">Sertai pembangunan dan operasi masjid kampus</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h4 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </span>
                        Program Sumbangan Aktif
                    </h4>
                    
                    <div class="space-y-6">
                        <?php if(isset($donationPrograms) && $donationPrograms->count() > 0): ?>
                            <?php $__currentLoopData = $donationPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center mb-3">
                                    <h5 class="text-lg font-bold text-gray-800"><?php echo e($program->title); ?></h5>
                                    <span class="text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded text-sm"><?php echo e($program->percentage); ?>%</span>
                                </div>
                                
                                <div class="w-full bg-gray-100 rounded-full h-3 mb-3 overflow-hidden">
                                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-1000 ease-out" style="width: <?php echo e($program->percentage); ?>%"></div>
                                </div>
                                
                                <div class="flex justify-between text-sm text-gray-600 font-medium">
                                    <span class="flex items-center text-green-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        RM <?php echo e(number_format($program->current_amount, 2)); ?>

                                    </span>
                                    <span class="text-gray-400">Sasaran: RM <?php echo e(number_format($program->target_amount, 0)); ?></span>
                                </div>

                                <?php if($program->description): ?>
                                    <p class="text-sm text-gray-500 mt-3 pt-3 border-t border-gray-50">
                                        <?php echo e($program->description); ?>

                                    </p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </div>
                                <h5 class="text-lg font-medium text-gray-900">Tiada Program Khusus</h5>
                                <p class="text-gray-500 mt-1">Buat masa ini tiada program sumbangan khusus yang aktif. Anda masih boleh menyumbang ke Tabung Umum.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 sticky top-24">
                        <h4 class="text-2xl font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                            Borang Sumbangan
                        </h4>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penuh</label>
                                <input type="text" id="donor-name" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                    placeholder="Masukkan nama penuh"
                                    value="<?php echo e(Auth::guard('participant')->check() ? Auth::guard('participant')->user()->name : ''); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Emel</label>
                                <input type="email" id="donor-email" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                    placeholder="email@contoh.com"
                                    value="<?php echo e(Auth::guard('participant')->check() ? Auth::guard('participant')->user()->email : ''); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon</label>
                                <input type="tel" id="donor-phone" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                    placeholder="+60 123 456 789"
                                    value="<?php echo e(Auth::guard('participant')->check() ? Auth::guard('participant')->user()->phone : ''); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Program Sumbangan</label>
                                <div class="relative">
                                    <select id="donation-program" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none bg-white">
                                        <option value="">-- Sila Pilih Program --</option>
                                        
                                        <?php if(isset($donationPrograms)): ?>
                                            <?php $__currentLoopData = $donationPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <option value="<?php echo e($program->id); ?>"><?php echo e($program->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        
                                        
                                        <option value="umum" class="font-semibold text-gray-900">✨ Infaq Umum (Dana Am)</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <button onclick="processDonation()" class="w-full bg-blue-600 text-white py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 mt-2 flex justify-center items-center">
                                <span>Teruskan ke Pembayaran</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                            
                            <p class="text-xs text-center text-gray-500 mt-4">
                                <i class="fas fa-lock mr-1"></i> Pembayaran selamat & dilindungi. Resit akan dihantar ke emel anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="donation-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-t-xl">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold">💰 Sumbangan Masjid</h3>
                        <p class="text-blue-100 text-sm mt-1">Mudah & Selamat</p>
                    </div>
                    <button onclick="closeDonationModal()" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="text-center mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Imbas Kod QR untuk Menyumbang</h4>

                    <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300 mb-4">
                        <div class="w-48 h-48 mx-auto bg-white p-4 rounded-lg shadow-md">
                            <div class="w-full h-full relative bg-white">
                                <svg viewBox="0 0 200 200" class="w-full h-full">
                                    <rect x="0" y="0" width="30" height="30" fill="black" />
                                    <rect x="35" y="0" width="5" height="5" fill="black" />
                                    <rect x="45" y="0" width="10" height="5" fill="black" />
                                    <rect x="60" y="0" width="5" height="10" fill="black" />
                                    <rect x="170" y="0" width="30" height="30" fill="black" />
                                    <rect x="0" y="35" width="5" height="5" fill="black" />
                                    <rect x="10" y="35" width="15" height="5" fill="black" />
                                    <rect x="30" y="35" width="10" height="10" fill="black" />
                                    <rect x="50" y="35" width="5" height="15" fill="black" />
                                    <rect x="170" y="35" width="5" height="5" fill="black" />
                                    <rect x="180" y="35" width="15" height="5" fill="black" />
                                    <rect x="0" y="170" width="30" height="30" fill="black" />
                                    <rect x="35" y="170" width="10" height="5" fill="black" />
                                    <rect x="50" y="175" width="15" height="10" fill="black" />
                                    <rect x="170" y="170" width="15" height="15" fill="black" />
                                    <rect x="85" y="85" width="30" height="30" fill="black" />
                                    <rect x="95" y="95" width="10" height="10" fill="white" />
                                    <rect x="70" y="50" width="5" height="5" fill="black" />
                                    <rect x="80" y="60" width="10" height="5" fill="black" />
                                    <rect x="120" y="70" width="5" height="10" fill="black" />
                                    <rect x="140" y="50" width="15" height="5" fill="black" />
                                    <rect x="60" y="120" width="10" height="10" fill="black" />
                                    <rect x="130" y="130" width="5" height="15" fill="black" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mt-3">Imbas dengan aplikasi perbankan atau e-wallet anda</p>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg mb-4">
                        <h5 class="font-semibold text-blue-800 mb-2">📱 Maklumat Bank</h5>
                        <div class="text-sm text-blue-700 space-y-1">
                            <p><strong>Bank:</strong> Maybank</p>
                            <p><strong>No. Akaun:</strong> 1234567890123</p>
                            <p><strong>Nama:</strong> Masjid MMU Melaka</p>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">📝 Maklumat Sumbangan</h4>

                    <form id="donation-form" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Sumbangan</label>
                            <div class="grid grid-cols-3 gap-2 mb-3">
                                <button type="button" onclick="selectAmount(50)" class="amount-btn px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-blue-50 hover:border-blue-300 transition-colors">
                                    RM 50
                                </button>
                                <button type="button" onclick="selectAmount(100)" class="amount-btn px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-blue-50 hover:border-blue-300 transition-colors">
                                    RM 100
                                </button>
                                <button type="button" onclick="selectAmount(200)" class="amount-btn px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-blue-50 hover:border-blue-300 transition-colors">
                                    RM 200
                                </button>
                            </div>
                            <input type="number" id="custom-amount" placeholder="Atau masukkan jumlah lain..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="transaction-id" class="block text-sm font-medium text-gray-700 mb-2">
                                ID Transaksi / No. Rujukan
                            </label>
                            <input type="text" id="transaction-id" name="transaction-id" required
                                placeholder="Contoh: TXN123456789"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Masukkan ID Transaksi dari resit pembayaran anda</p>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                </svg>
                                <span>Hantar Maklumat Sumbangan</span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-6 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <h5 class="font-semibold text-yellow-800 mb-2">📋 Langkah-langkah:</h5>
                    <ol class="text-sm text-yellow-700 space-y-1 list-decimal list-inside">
                        <li>Imbas kod QR atau pindah ke akaun bank</li>
                        <li>Simpan ID Transaksi daripada resit</li>
                        <li>Isi borang di atas dengan maklumat lengkap</li>
                        <li>Klik "Hantar" untuk rekod sumbangan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section id="kontak" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-900 mb-4" data-key="contact-title">Hubungi Kami</h3>
                <p class="text-gray-600" data-key="contact-subtitle">Maklumat perhubungan dan lokasi masjid</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h4 class="text-2xl font-semibold text-gray-900 mb-6">Informasi</h4>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="text-emerald-600 mt-1">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900">Alamat</h5>
                                <p class="text-gray-600">MMU Multimedia University<br>Jalan Bukit Beruang, Bukit Beruang<br>Melaka</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="text-emerald-600 mt-1">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900">Telefon</h5>
                                <p class="text-gray-600">06-252 3411</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="text-emerald-600 mt-1">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900">Emel</h5>
                                <p class="text-gray-600">email1@mmu.edu.my<br>email2@mmu.edu.my</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="text-emerald-600 mt-1">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-900">Jam Operasi</h5>
                                <p class="text-gray-600">Tiada<br>Tiada</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="rounded-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.7426773058974!2d102.27602492062378!3d2.2498674758646766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1eff54cafdfbf%3A0x8b8f2e49de4d4dba!2sMasjid%20MMU!5e0!3m2!1sen!2smy!4v1754245637866!5m2!1sen!2smy"
                            width="100%"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="chatbot-button" class="fixed bottom-6 right-6 z-50">
        <button onclick="toggleChatbot()" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <svg id="chat-icon" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z" />
            </svg>
            <svg id="close-icon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
            </svg>
        </button>
        <div class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center">
            <span class="text-white text-xs font-bold">4</span>
        </div>
    </div>

    <div id="chatbot-modal" class="fixed bottom-24 right-6 w-80 bg-white rounded-lg shadow-2xl border border-gray-200 z-40 hidden transform transition-all duration-300 scale-95 opacity-0">
        <div class="bg-blue-600 text-white p-4 rounded-t-lg">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Pembantu Masjid</h3>
                    <p class="text-xs text-blue-100">Dalam talian</p>
                </div>
            </div>
        </div>

        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-3">
            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-gray-800">Assalamualaikum! Saya Pembantu Masjid MMU. Ada yang boleh saya bantu?</p>
                    <span class="text-xs text-gray-500">Baru sahaja</span>
                </div>
            </div>

            <div class="flex items-start space-x-2 justify-end">
                <div class="bg-blue-600 text-white rounded-lg p-3 max-w-xs">
                    <p class="text-sm">Bila waktu Maghrib hari ini?</p>
                    <span class="text-xs text-blue-100">2 minit lalu</span>
                </div>
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-green-600 text-sm font-semibold">A</span>
                </div>
            </div>

            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-gray-800">Waktu Maghrib hari ini untuk zon Melaka adalah pada <strong>19:20</strong>. Jangan lupa untuk bersiap sedia! 🕌</p>
                    <span class="text-xs text-gray-500">1 minit lalu</span>
                </div>
            </div>

            <div class="flex items-start space-x-2 justify-end">
                <div class="bg-blue-600 text-white rounded-lg p-3 max-w-xs">
                    <p class="text-sm">Ada aktiviti apa minggu ini?</p>
                    <span class="text-xs text-blue-100">30 saat lalu</span>
                </div>
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-green-600 text-sm font-semibold">A</span>
                </div>
            </div>

            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-gray-800">Minggu ini ada beberapa aktiviti:</p>
                    <ul class="text-sm text-gray-800 mt-2 space-y-1">
                        <li>📚 <strong>Kuliah Maghrib</strong> - Jumaat 7:30 PM</li>
                        <li>🎯 <strong>Kelas Al-Quran</strong> - Setiap hari 4:00 PM</li>
                        <li>🏃 <strong>Riadah Sihat</strong> - Ahad 7:00 AM</li>
                    </ul>
                    <span class="text-xs text-gray-500">Baru sahaja</span>
                </div>
            </div>
        </div>

        <div class="p-3 border-t border-gray-200">
            <div class="flex flex-wrap gap-2 mb-3">
                <button onclick="sendQuickMessage('Waktu solat hari ini')" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs hover:bg-blue-200 transition-colors">
                    ⏰ Waktu Solat
                </button>
                <button onclick="sendQuickMessage('Aktiviti minggu ini')" class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs hover:bg-green-200 transition-colors">
                    📅 Aktiviti
                </button>
                <button onclick="sendQuickMessage('Cara derma')" class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs hover:bg-purple-200 transition-colors">
                    💰 Derma
                </button>
            </div>
        </div>

        <div class="p-4 border-t border-gray-200">
            <div class="flex space-x-2">
                <input type="text" id="chat-input" placeholder="Tulis mesej anda..." class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                <button onclick="sendMessage()" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <footer class="bg-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <svg class="mosque-icon text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L8 6v2H6v12h12V8h-2V6l-4-4zm0 2.83L14 7v1h-4V7l2-2.17zM8 10h8v8H8v-8z" />
                            <circle cx="12" cy="14" r="2" />
                        </svg>
                        <div>
                            <h4 class="text-xl font-bold">Masjid MMU Melaka</h4>
                            <p class="text-blue-200 text-sm">Multimedia University Melaka</p>
                        </div>
                    </div>
                    <p class="text-blue-100 text-sm">Masjid yang memberi perkhidmatan kepada warga akademik dengan pelbagai program keagamaan dan sosial demi kemajuan komuniti kampus.</p>
                </div>

                <div>
                    <h5 class="font-semibold mb-4">Menu Utama</h5>
                    <ul class="space-y-2 text-blue-100">
                        <li><a href="#beranda" class="hover:text-white transition-colors">Laman Utama</a></li>
                        <li><a href="#jadwal" class="hover:text-white transition-colors">Waktu Solat</a></li>
                        <li><a href="#kegiatan" class="hover:text-white transition-colors">Aktiviti</a></li>
                        <li><a href="#donasi" class="hover:text-white transition-colors">Sumbangan</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-semibold mb-4">Aktiviti</h5>
                    <ul class="space-y-2 text-blue-100">
                        <li>Kuliah Maghrib</li>
                        <li>Kelas Al-Quran</li>
                        <li>Riadah Sihat</li>
                        <li>Khidmat Masyarakat</li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-semibold mb-4">Hubungi</h5>
                    <div class="space-y-2 text-blue-100 text-sm">
                        <p>Multimedia University<br>Kampus Melaka, Malaysia</p>
                        <p>Telefon: +60 6-252 3000</p>
                        <p>Emel: masjid@mmu.edu.my</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-blue-700 mt-8 pt-8 text-center text-blue-200">
                <p>© 2025 Masjid MMU Melaka. Semua hak cipta terpelihara.</p>
            </div>
        </div>
    </footer>

    <script>
        // Language translations
        const translations = {
            en: {
                'nav-home': 'Home',
                'nav-schedule': 'Prayer Times',
                'nav-activities': 'Activities',
                'nav-donation': 'Donation',
                'nav-contact': 'Contact',
                'hero-title': 'Welcome to MMU Melaka Mosque',
                'hero-subtitle': 'A place of worship, learning, and fellowship for the academic community',
                'btn-schedule': 'View Prayer Schedule',
                'btn-donate': 'Donate Now',
                'current-prayer-label': 'Current Prayer Time',
                'remaining-time': 'Time remaining:',
                'schedule-title': 'Today\'s Prayer Schedule',
                'location': 'Melaka, Malaysia',
                'activities-title': 'Mosque Activities',
                'activities-subtitle': 'Various programs and activities for the community',
                'donation-title': 'Donation & Infaq',
                'donation-subtitle': 'Participate in the development and operations of the campus mosque',
                'contact-title': 'Contact Us',
                'contact-subtitle': 'Contact information and mosque location'
            },
            ms: {
                'nav-home': 'Laman Utama',
                'nav-schedule': 'Waktu Solat',
                'nav-activities': 'Aktiviti',
                'nav-donation': 'Derma',
                'nav-contact': 'Hubungi',
                'hero-title': 'Selamat Datang ke Masjid MMU Melaka',
                'hero-subtitle': 'Tempat ibadat, pembelajaran, dan persaudaraan komuniti akademik',
                'btn-schedule': 'Lihat Jadual Solat',
                'btn-donate': 'Derma Sekarang',
                'current-prayer-label': 'Waktu Solat Sekarang',
                'remaining-time': 'Masa berbaki:',
                'schedule-title': 'Jadual Solat Hari Ini',
                'location': 'Melaka, Malaysia',
                'activities-title': 'Aktiviti Masjid',
                'activities-subtitle': 'Pelbagai program dan aktiviti untuk umat',
                'donation-title': 'Derma & Infaq',
                'donation-subtitle': 'Sertai pembangunan dan operasi masjid kampus',
                'contact-title': 'Hubungi Kami',
                'contact-subtitle': 'Maklumat hubungan dan lokasi masjid'
            }
        };

        let currentLanguage = 'ms';

        // Language switcher functions
        function switchLanguage(lang) {
            currentLanguage = lang;
            document.getElementById('current-lang').textContent = lang.toUpperCase();
            document.getElementById('lang-menu').classList.add('hidden');

            // Update all elements with data-key attributes
            document.querySelectorAll('[data-key]').forEach(element => {
                const key = element.getAttribute('data-key');
                if (translations[lang] && translations[lang][key]) {
                    element.textContent = translations[lang][key];
                }
            });

            // Save language preference
            localStorage.setItem('preferred-language', lang);
        }

        // Load saved language preference
        function loadLanguagePreference() {
            // Default is now 'ms' instead of 'id'
            const savedLang = localStorage.getItem('preferred-language') || 'ms';
            switchLanguage(savedLang);
        }

        // Language menu toggle
        document.getElementById('lang-btn').addEventListener('click', function() {
            document.getElementById('lang-menu').classList.toggle('hidden');
        });

        // Close language menu when clicking outside
        document.addEventListener('click', function(event) {
            const langBtn = document.getElementById('lang-btn');
            const langMenu = document.getElementById('lang-menu');
            if (!langBtn.contains(event.target) && !langMenu.contains(event.target)) {
                langMenu.classList.add('hidden');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling function
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Set current date
        function setCurrentDate() {
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const today = new Date();
            // Changed locale to ms-MY
            document.getElementById('current-date').textContent = today.toLocaleDateString('ms-MY', options);
        }
        var subuhtime = document.getElementById("subuh").innerHTML.trim();
        var dzuhurtime = document.getElementById("dzuhur").innerHTML.trim();
        var ashartime = document.getElementById("ashar").innerHTML.trim();
        var magribtime = document.getElementById("maghrib").innerHTML.trim();
        var isyatime = document.getElementById("isya").innerHTML.trim();

        function timeToMinutes(timeStr) {
            let [h, m] = timeStr.split(":").map(Number);
            return h * 60 + m;
        }

        function GetNextPrayerTime() {
            let now = new Date();
            let currentMinutes = now.getHours() * 60 + now.getMinutes();

            let times = [{
                    name: 'Subuh',
                    time: timeToMinutes(subuhtime)
                },
                {
                    name: 'Zohor', // Changed from Dzohor
                    time: timeToMinutes(dzuhurtime)
                },
                {
                    name: 'Asar',
                    time: timeToMinutes(ashartime)
                },
                {
                    name: 'Maghrib',
                    time: timeToMinutes(magribtime)
                },
                {
                    name: 'Isyak', // Changed from Isya
                    time: timeToMinutes(isyatime)
                }
            ];

            // Tambah Subuh hari esok untuk wrap-around
            times.push({
                name: 'Subuh',
                time: timeToMinutes(subuhtime) + 24 * 60
            });

            for (let i = 0; i < times.length - 1; i++) {
                if (currentMinutes >= times[i].time && currentMinutes < times[i + 1].time) {
                    return {
                        current: times[i].name,
                        currentTime: `${String(Math.floor(times[i].time / 60)).padStart(2, '0')}:${String(times[i].time % 60).padStart(2, '0')}`,
                        next: times[i + 1].name,
                        nextTime: `${String(Math.floor(times[i + 1].time % (24 * 60) / 60)).padStart(2, '0')}:${String(times[i + 1].time % 60).padStart(2, '0')}`
                    };
                }
            }

            // Kalau sebelum Subuh (lewat malam)
            return {
                current: 'Isyak',
                next: 'Subuh',
                currentTime: `${String(Math.floor(timeToMinutes(isyatime) / 60)).padStart(2, '0')}:${String(timeToMinutes(isyatime) % 60).padStart(2, '0')}`,
                nextTime: subuhtime
            };
        }




        // Prayer time countdown
        function updateCountdown() {
            const nextPrayerReturn = GetNextPrayerTime();

            const now = new Date();
            const nextPrayer = new Date();

            // Pecahkan jam dan minit dari nextTime
            let [hoursN, minutesN] = nextPrayerReturn.nextTime.split(':').map(Number);
            document.getElementById('current-prayer').innerHTML = nextPrayerReturn.current + " - " + nextPrayerReturn.currentTime;
            nextPrayer.setHours(hoursN, minutesN, 0, 0);

            // Kalau dah lepas waktu, ambil untuk esok
            if (now > nextPrayer) {
                nextPrayer.setDate(nextPrayer.getDate() + 1);
            }

            const diff = nextPrayer - now;
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('countdown').textContent =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // Panggil setiap saat supaya bergerak
        setInterval(updateCountdown, 1000);

        // Donation amount setter
        function setDonationAmount(amount) {
            document.getElementById('donation-amount').value = amount;
        }

        // Process donation (demo function)
        function processDonation() {
            const name = document.getElementById('donor-name').value;
            const email = document.getElementById('donor-email').value;
            const program = document.getElementById('donation-program').value;
            const amount = document.getElementById('donation-amount').value;

            if (!name || !email || !program || !amount) {
                alert('Sila lengkapkan semua ruangan yang wajib diisi.');
                return;
            }

            // Demo alert - in real implementation, this would process the donation
            // Changed formatting from ID to MY style (though similar)
            alert(`Terima kasih ${name}! Sumbangan anda sebanyak RM ${parseInt(amount).toLocaleString('ms-MY')} untuk program ${program} sedang diproses. Maklumat lanjut akan dihantar ke ${email}.`);

            // Reset form
            document.getElementById('donor-name').value = '';
            document.getElementById('donor-email').value = '';
            document.getElementById('donation-program').value = '';
            document.getElementById('donation-amount').value = '';
        }

        // Chatbot functionality
        let isChatbotOpen = false;

        function toggleChatbot() {
            const modal = document.getElementById('chatbot-modal');
            const chatIcon = document.getElementById('chat-icon');
            const closeIcon = document.getElementById('close-icon');

            if (isChatbotOpen) {
                // Close chatbot
                modal.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
                chatIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                isChatbotOpen = false;
            } else {
                // Open chatbot
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('scale-95', 'opacity-0');
                    modal.classList.add('scale-100', 'opacity-100');
                }, 10);
                chatIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                isChatbotOpen = true;

                // Auto scroll to bottom
                scrollToBottom();
            }
        }

        function sendMessage() {
            console.log(GetNextPrayerTime());
            const input = document.getElementById('chat-input');
            const message = input.value.trim();

            if (message) {
                addUserMessage(message);
                input.value = '';

                // Simulate bot response
                setTimeout(() => {
                    addBotResponse(message);
                }, 1000);
            }
        }

        function sendQuickMessage(message) {
            addUserMessage(message);

            // Simulate bot response
            setTimeout(() => {
                addBotResponse(message);
            }, 1000);
        }

        function addUserMessage(message) {
            const chatMessages = document.getElementById('chat-messages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex items-start space-x-2 justify-end';
            messageDiv.innerHTML = `
                <div class="bg-blue-600 text-white rounded-lg p-3 max-w-xs">
                    <p class="text-sm">${message}</p>
                    <span class="text-xs text-blue-100">Baru sahaja</span>
                </div>
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-green-600 text-sm font-semibold">A</span>
                </div>
            `;
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
        }

        function addBotResponse(userMessage) {
            const chatMessages = document.getElementById('chat-messages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex items-start space-x-2';

            let response = getBotResponse(userMessage);

            messageDiv.innerHTML = `
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-gray-800">${response}</p>
                    <span class="text-xs text-gray-500">Baru sahaja</span>
                </div>
            `;
            chatMessages.appendChild(messageDiv);
            scrollToBottom();
        }

        function getBotResponse(message) {
            const lowerMessage = message.toLowerCase();

            // Updated keywords to Malay
            if (lowerMessage.includes('waktu') || lowerMessage.includes('solat')) {
                const currentZoneData = prayerTimesData[currentZone]; // This assumes prayerTimesData exists or simplified response
                // Simplified response for demo since data object wasn't fully defined in original script
                return `Waktu solat hari ini:<br>
                        🌅 Subuh: ${document.getElementById("subuh").innerHTML}<br>
                        ☀️ Zohor: ${document.getElementById("dzuhur").innerHTML}<br>
                        🌤️ Asar: ${document.getElementById("ashar").innerHTML}<br>
                        🌅 Maghrib: ${document.getElementById("maghrib").innerHTML}<br>
                        🌙 Isyak: ${document.getElementById("isya").innerHTML}`;
            } else if (lowerMessage.includes('kegiatan') || lowerMessage.includes('aktiviti')) {
                return `Aktiviti minggu ini di Masjid MMU:<br>
                        📚 <strong>Kuliah Maghrib</strong> - Jumaat 7:30 PM<br>
                        🎯 <strong>Kelas Al-Quran</strong> - Setiap hari 4:00 PM<br>
                        🏃 <strong>Riadah Sihat</strong> - Ahad 7:00 AM<br>
                        📖 <strong>Kelas Mengaji</strong> - Selasa & Khamis 8:00 PM`;
            } else if (lowerMessage.includes('donasi') || lowerMessage.includes('sumbangan') || lowerMessage.includes('derma')) {
                return `Cara untuk menderma ke Masjid MMU:<br>
                        💳 <strong>Perbankan Atas Talian</strong><br>
                        Bank: Maybank<br>
                        Akaun: 1234567890<br>
                        Nama: Masjid MMU Melaka<br><br>
                        💰 <strong>QR Pay</strong> - Sila tanya di kaunter masjid<br>
                        🏦 <strong>Tunai</strong> - Boleh masukkan di tabung masjid`;
            } else if (lowerMessage.includes('lokasi') || lowerMessage.includes('alamat')) {
                return `📍 <strong>Alamat Masjid MMU:</strong><br>
                        Multimedia University<br>
                        Jalan Ayer Keroh Lama<br>
                        75450 Melaka<br><br>
                        📞 <strong>Telefon:</strong> +60 6-252 3000<br>
                        ✉️ <strong>Emel:</strong> masjid@mmu.edu.my`;
            } else {
                return `Terima kasih atas soalan anda! Saya boleh membantu dengan:<br>
                        ⏰ Waktu solat<br>
                        📅 Aktiviti masjid<br>
                        💰 Maklumat sumbangan<br>
                        📍 Lokasi & hubungi<br><br>
                        Sila pilih topik yang anda ingin tahu! 😊`;
            }
        }

        function scrollToBottom() {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Handle Enter key in chat input
        document.addEventListener('DOMContentLoaded', function() {
            const chatInput = document.getElementById('chat-input');
            if (chatInput) {
                chatInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
            }
        });


        // Donation Modal Functions
        function processDonation() {
            const modal = document.getElementById('donation-modal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeDonationModal() {
            const modal = document.getElementById('donation-modal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore scrolling

            // Reset form
            document.getElementById('donation-form').reset();
            clearAmountSelection();
        }

        function selectAmount(amount) {
            // Clear previous selections
            clearAmountSelection();

            // Set the custom amount input
            document.getElementById('custom-amount').value = amount;

            // Highlight selected button
            event.target.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
            event.target.classList.remove('hover:bg-blue-50', 'hover:border-blue-300');
        }

        function clearAmountSelection() {
            const amountButtons = document.querySelectorAll('.amount-btn');
            amountButtons.forEach(btn => {
                btn.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
                btn.classList.add('hover:bg-blue-50', 'hover:border-blue-300');
            });
        }

        // Handle donation form submission
        // Handle donation form submission
        document.addEventListener('DOMContentLoaded', function() {
            const donationForm = document.getElementById('donation-form');
            if (donationForm) {
                donationForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // 1. Get form data
                    const amount = document.getElementById('custom-amount').value;
                    const transactionId = document.getElementById('transaction-id').value;
                    // Get selected program
                    const programSelect = document.getElementById('donation-program') || document.querySelector('#donasi select'); // Fallback selector
                    const program = programSelect ? programSelect.value : 'umum';

                    // 2. Validate required fields
                    if (!amount || !transactionId) {
                        alert('Sila lengkapkan jumlah dan ID transaksi.');
                        return;
                    }

                    // 3. Prepare data for backend
                    const payload = {
                        amount: amount,
                        transaction_id: transactionId,
                        type: program,
                        _token: '<?php echo e(csrf_token()); ?>' // Important for Laravel security
                    };

                    // 4. Send AJAX request to Laravel
                    fetch("<?php echo e(route('donation.store')); ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        // 5. If success, show the success modal
                        showDonationSuccess({
                            amount: amount,
                            transactionId: transactionId,
                            donorName: "<?php echo e(Auth::guard('participant')->check() ? Auth::guard('participant')->user()->name : 'Hamba Allah'); ?>"
                        });
                        
                        // Clear form
                        document.getElementById('donation-form').reset();
                        clearAmountSelection();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        let msg = 'Ralat berlaku. Sila cuba lagi.';
                        if (error.message) msg = error.message;
                        if (error.errors) {
                            msg = Object.values(error.errors).flat().join('\n');
                        }
                        alert(msg);
                    });
                });
            }
        });

        function showDonationSuccess(donationData) {
            // Close the donation modal
            closeDonationModal();

            // Create and show beautiful success modal
            const successModal = document.createElement('div');
            successModal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
            successModal.innerHTML = `
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-[bounce_1s_ease-in-out_1]">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-t-2xl text-center">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold">Alhamdulillah!</h3>
                        <p class="text-green-100 mt-2">Sumbangan Berjaya Dihantar</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">
                                Terima kasih ${donationData.donorName || 'Hamba Allah'}! 🤲
                            </h4>
                            <p class="text-gray-600">Maklumat sumbangan anda telah diterima dengan jayanya</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-4 mb-6 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">💰 Jumlah:</span>
                                <span class="text-green-600 font-bold text-lg">RM ${donationData.amount}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">🔢 ID Transaksi:</span>
                                <span class="text-gray-800 font-mono text-sm">${donationData.transactionId}</span>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-xl p-4 mb-6">
                            <h5 class="font-semibold text-blue-800 mb-2">📋 Langkah Seterusnya:</h5>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li>✅ Maklumat anda telah direkodkan</li>
                                <li>⏰ Pengesahan dalam masa 24 jam</li>
                                <li>📧 Resit akan dihantar (jika emel disediakan)</li>
                                <li>🤲 Doa kami sentiasa bersama anda</li>
                            </ul>
                        </div>
                        
                        <div class="text-center bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-4 mb-6">
                            <p class="text-purple-800 font-semibold mb-2">جَزَاكَ اللَّهُ خَيْرًا</p>
                            <p class="text-purple-700 text-sm">
                                "Barangsiapa yang membangun masjid kerana Allah, 
                                maka Allah akan membangunkan untuknya rumah di syurga"
                            </p>
                            <p class="text-purple-600 text-xs mt-2">- Hadis Riwayat Bukhari & Muslim</p>
                        </div>
                        
                        <button onclick="closeSuccessModal()" 
                                class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105">
                            <span class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                                <span>Alhamdulillah, Tutup</span>
                            </span>
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(successModal);
            document.body.style.overflow = 'hidden';

            // Add to chatbot context
            setTimeout(() => {
                if (document.getElementById('chat-messages')) {
                    addBotResponse(`Sumbangan sebanyak RM ${donationData.amount} telah diterima. Jazakallahu khairan! 🙏`);
                }
            }, 3000);
        }

        function closeSuccessModal() {
            const successModal = document.querySelector('.fixed.inset-0.bg-black.bg-opacity-50');
            if (successModal) {
                successModal.remove();
                document.body.style.overflow = 'auto';
            }
        }

        function unixToTimeString(unix) {
            const date = new Date(unix * 1000);
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");
            return `${hours}:${minutes}`;
        }

        function loadTodayPrayerTimes() {
            const zone = "MLK01";
            const apiUrl = `https://api.waktusolat.app/v2/solat/${zone}`;

            fetch(apiUrl)
                .then((response) => response.json())
                .then((data) => {
                    const today = new Date().getDate(); // Hari ini (1–31)
                    const todayData = data.prayers.find((p) => p.day === today);

                    if (!todayData) {
                        alert("Waktu solat untuk hari ini tidak dijumpai.");
                        return;
                    }

                    document.getElementById("subuh").innerHTML = unixToTimeString(
                        todayData.fajr
                    );
                    document.getElementById("dzuhur").innerHTML = unixToTimeString(
                        todayData.dhuhr
                    );
                    document.getElementById("ashar").innerHTML = unixToTimeString(
                        todayData.asr
                    );
                    document.getElementById("maghrib").innerHTML = unixToTimeString(
                        todayData.maghrib
                    );
                    document.getElementById("isya").innerHTML = unixToTimeString(
                        todayData.isha
                    );

                    subuhtime = document.getElementById("subuh").innerHTML.trim();
                    dzuhurtime = document.getElementById("dzuhur").innerHTML.trim();
                    ashartime = document.getElementById("ashar").innerHTML.trim();
                    magribtime = document.getElementById("maghrib").innerHTML.trim();
                    isyatime = document.getElementById("isya").innerHTML.trim();
                })
                .catch((error) => {
                    console.error("Ralat ambil waktu solat:", error);
                    alert("Tidak dapat ambil waktu solat dari API.");
                });
        }

s
        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            loadTodayPrayerTimes();
            setCurrentDate(); // Using updated locale
            // Update date every minute
            setInterval(setCurrentDate, 60000); // this will update the date every minute
        });


        // Initialize functions
        loadLanguagePreference();
        setCurrentDate();
        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });

        // Fungsi Toggle Menu User
    function toggleUserMenu() {
        const menu = document.getElementById('user-menu-dropdown');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }

    // Tutup dropdown bila klik di luar
    window.addEventListener('click', function(e) {
        const btn = document.getElementById('user-menu-btn');
        const menu = document.getElementById('user-menu-dropdown');
        
        if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
    </script>
</body>

</html><?php /**PATH /var/www/masjid_app/resources/views/welcome.blade.php ENDPATH**/ ?>