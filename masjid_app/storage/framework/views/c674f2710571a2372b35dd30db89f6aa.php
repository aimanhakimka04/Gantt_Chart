<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengurusan Derma - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body { font-family: "Inter", sans-serif; }
    
    .sidebar-item { transition: all 0.3s ease; }
    .sidebar-item:hover { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; }
    
    .sidebar-item.active { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; color: #3b82f6; }
    
    .fade-in { animation: fadeIn 0.4s ease-in; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="flex h-screen overflow-hidden">
    
    <div class="w-64 bg-white shadow-xl z-20 hidden md:block flex-shrink-0">
      <div class="p-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
          <div class="p-2 bg-blue-600 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
          <div>
            <h1 class="text-lg font-bold text-gray-900 tracking-tight">Admin Panel</h1>
            <p class="text-[10px] text-gray-500 uppercase tracking-wider">Masjid MMU</p>
          </div>
        </div>
      </div>

      <nav class="mt-6 px-4 space-y-2 overflow-y-auto h-[calc(100vh-180px)]">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="<?php echo e(route('admin.donations.index')); ?>" class="sidebar-item active w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Pengurusan Derma</span>
        </a>
        <a href="<?php echo e(route('admin.donation_programs.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span>Program Sumbangan</span>
        </a>
        <a href="<?php echo e(route('admin.events.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Pengurusan Acara</span>
        </a>

        <a href="<?php echo e(route('admin.registrations.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>Pendaftaran Peserta</span>
        </a>

        <a href="<?php echo e(route('admin.service_requests.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span>Permintaan Servis</span>
        </a>

        <a href="<?php echo e(route('admin.notifications.send')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span>Hantar Notifikasi</span>
        </a>
      </nav>

      <div class="p-4 border-t border-gray-100 bg-white">
        <form method="POST" action="<?php echo e(route('committee.logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Log Keluar</span>
            </button>
        </form>
      </div>
    </div>

    <div class="flex-1 overflow-y-auto bg-gray-50 h-full">
      
      <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
        <div class="flex items-center justify-between px-8 py-4">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengurusan Derma</h2>
            <p class="text-sm text-gray-500">Sahkan sumbangan dan pantau transaksi</p>
          </div>
          <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
              <p class="text-sm font-bold text-gray-900"><?php echo e(Auth::guard('committee')->user()->name ?? 'Admin'); ?></p>
              <p class="text-xs text-gray-500"><?php echo e(Auth::guard('committee')->user()->email ?? ''); ?></p>
            </div>
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg text-white font-bold">
                <?php echo e(substr(Auth::guard('committee')->user()->name ?? 'A', 0, 1)); ?>

            </div>
          </div>
        </div>
      </header>

      <main class="p-8">
        <div class="fade-in">
            
            <?php if(session('success')): ?>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r shadow-sm flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="text-sm text-green-700 font-medium"><?php echo e(session('success')); ?></p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 sm:mb-0">Senarai Transaksi</h3>
                    <div class="text-xs text-gray-500 bg-white px-3 py-1 rounded border border-gray-200 shadow-sm">
                        Total Rekod: <strong><?php echo e($donations->total()); ?></strong>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-semibold tracking-wider">Tarikh</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">ID Transaksi</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Penderma</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Jenis</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Jumlah (RM)</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Status</th>
                                <th class="px-6 py-4 font-semibold tracking-wider text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    <?php echo e($donation->created_at->format('d M Y')); ?>

                                    <div class="text-xs text-gray-400"><?php echo e($donation->created_at->format('h:i A')); ?></div>
                                </td>
                                <td class="px-6 py-4 font-mono text-gray-600 bg-gray-50 rounded-lg mx-2 w-fit text-xs">
                                    <?php echo e($donation->transaction_id); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800"><?php echo e($donation->donor->name ?? 'Hamba Allah'); ?></div>
                                    <div class="text-xs text-gray-500 italic">
                                        <?php echo e(str_contains($donation->donor_type, 'Participant') ? 'Ahli Kariah' : 'AJK/Admin'); ?>

                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    
                                    <?php
                                        $programName = $donation->type; 
                                        if (is_numeric($donation->type)) {
                                            $program = \App\Models\DonationProgram::find($donation->type);
                                            $programName = $program ? $program->title : 'Program Tamat/Padam';
                                        }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 capitalize">
                                        <?php echo e($programName); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-800">
                                    RM <?php echo e(number_format($donation->amount, 2)); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php if($donation->status == 'pending'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <span class="w-2 h-2 mr-1 bg-yellow-400 rounded-full"></span> Menunggu
                                        </span>
                                    <?php elseif($donation->status == 'success'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 mr-1 bg-green-400 rounded-full"></span> Berjaya
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="w-2 h-2 mr-1 bg-red-400 rounded-full"></span> Gagal
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php if($donation->status == 'pending'): ?>
                                    <div class="flex justify-center space-x-2">
                                        <form action="<?php echo e(route('admin.donations.verify', $donation->id)); ?>" method="POST" onsubmit="return confirm('Sahkan penerimaan derma ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="bg-white border border-green-500 text-green-600 hover:bg-green-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-all shadow-sm flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Sahkan
                                            </button>
                                        </form>
                                        
                                        <form action="<?php echo e(route('admin.donations.reject', $donation->id)); ?>" method="POST" onsubmit="return confirm('Tolak/Batalkan derma ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="bg-white border border-red-500 text-red-600 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-all shadow-sm flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-xs italic">- Selesai -</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p class="text-sm">Tiada rekod derma dijumpai buat masa ini.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-6 flex justify-center">
                <?php echo e($donations->links()); ?>

            </div>

        </div>
      </main>
    </div>
  </div>
</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/admin/donations/index.blade.php ENDPATH**/ ?>