<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - Masjid MMU Melaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2 hover:text-blue-200 transition">
                        <svg class="w-8 h-8 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L8 6v2H6v12h12V8h-2V6l-4-4zm0 2.83L14 7v1h-4V7l2-2.17zM8 10h8v8H8v-8z" />
                            <circle cx="12" cy="14" r="2" />
                        </svg>
                        <div>
                            <h1 class="text-lg font-bold leading-tight">Masjid MMU</h1>
                            <p class="text-[10px] text-blue-200 uppercase tracking-wider">Portal Ahli Kariah</p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm hidden md:inline-block">
                        Selamat Datang, <span class="font-bold"><?php echo e(Auth::guard('participant')->user()->name); ?></span>
                    </span>
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Log Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 sticky top-24">
                    <div class="p-6 bg-blue-50 border-b border-blue-100 text-center">
                        <div class="w-20 h-20 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-3 text-blue-700 text-2xl font-bold uppercase border-4 border-white shadow-sm">
                            <?php echo e(substr(Auth::guard('participant')->user()->name, 0, 1)); ?>

                        </div>
                        <h3 class="font-bold text-gray-800 truncate"><?php echo e(Auth::guard('participant')->user()->name); ?></h3>
                        <p class="text-xs text-gray-500"><?php echo e(Auth::guard('participant')->user()->email); ?></p>
                    </div>
                    
                    <nav class="p-2 space-y-1">
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50'); ?>">
                            <i class="fas fa-home w-6 text-center mr-2"></i> Dashboard
                        </a>
                        
                        <a href="<?php echo e(route('Participant.profile.show')); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-user w-6 text-center mr-2"></i> Profil Saya
                        </a>

                        <a href="<?php echo e(route('participant.registrations')); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-calendar-check w-6 text-center mr-2"></i> Program Disertai
                        </a>

                        <a href="<?php echo e(route('user.history')); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-hand-holding-heart w-6 text-center mr-2"></i> Sejarah Derma
                        </a>
                    </nav>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-6">
                
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold mb-2">Ahlan Wa Sahlan!</h2>
                        <p class="text-blue-100 mb-6 max-w-xl">
                            Ini adalah papan pemuka (dashboard) anda. Di sini anda boleh menyemak status pendaftaran program, mengurus profil, dan melihat rekod sumbangan anda.
                        </p>
                        <div class="flex space-x-3">
                            <a href="<?php echo e(route('home')); ?>#kegiatan" class="bg-white text-blue-800 px-5 py-2 rounded-lg font-semibold text-sm hover:bg-blue-50 transition shadow-sm">
                                Cari Program Baru
                            </a>
                            <a href="<?php echo e(route('user.history')); ?>" class="bg-blue-700 border border-blue-500 text-white px-5 py-2 rounded-lg font-semibold text-sm hover:bg-blue-600 transition shadow-sm">
                                Semak Derma
                            </a>
                        </div>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute right-20 -top-10 w-20 h-20 bg-white opacity-10 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-gray-500 text-sm font-medium">Program Disertai</h4>
                            <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800">
                            
                            <?php echo e(Auth::guard('participant')->user()->registrations->count() ?? 0); ?>

                        </div>
                        <p class="text-xs text-gray-400 mt-1">Aktiviti masjid</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-gray-500 text-sm font-medium">Jumlah Derma</h4>
                            <div class="p-2 bg-green-50 rounded-lg text-green-600">
                                <i class="fas fa-donate"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800">
                            
                            RM <?php echo e(number_format(Auth::guard('participant')->user()->donations->sum('amount') ?? 0, 2)); ?>

                        </div>
                        <p class="text-xs text-gray-400 mt-1">Sumbangan terkumpul</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-gray-500 text-sm font-medium">Status Akaun</h4>
                            <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="text-lg font-bold text-green-600">
                            Aktif
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Ahli Kariah</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Aktiviti Terkini</h3>
                        <a href="<?php echo e(route('participant.registrations')); ?>" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Aktiviti / Program</th>
                                    <th class="px-6 py-3">Tarikh</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php $__empty_1 = true; $__currentLoopData = Auth::guard('participant')->user()->registrations()->latest()->take(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <?php echo e($reg->event->title ?? 'Program Tidak Dijumpai'); ?>

                                    </td>
                                    <td class="px-6 py-4 text-gray-500">
                                        <?php echo e(\Carbon\Carbon::parse($reg->created_at)->format('d M Y')); ?>

                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($reg->status == 'approved'): ?>
                                            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Lulus</span>
                                        <?php elseif($reg->status == 'pending'): ?>
                                            <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">Menunggu</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                        Tiada aktiviti terkini. Sila daftar program di laman utama.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; <?php echo e(date('Y')); ?> Masjid MMU Melaka. Semua hak cipta terpelihara.
        </div>
    </footer>

</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/dashboard.blade.php ENDPATH**/ ?>