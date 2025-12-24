<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengurusan Acara - Admin Panel</title>
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="<?php echo e(route('admin.donations.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Pengurusan Derma</span>
        </a>
        <a href="<?php echo e(route('admin.donation_programs.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Program Sumbangan</span>
        </a>
        <a href="<?php echo e(route('admin.events.index')); ?>" class="sidebar-item active w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium">
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
            <h2 class="text-2xl font-bold text-gray-800">Pengurusan Acara</h2>
            <p class="text-sm text-gray-500">Tambah, sunting dan uruskan acara masjid</p>
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
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Senarai Acara</h3>
                    <p class="text-sm text-gray-500"><?php echo e($events->count()); ?> acara dijumpai</p>
                </div>
                
                <?php if(Auth::guard('committee')->check()): ?>
                <a href="<?php echo e(route('admin.events.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Cipta Acara Baru
                </a>
                <?php endif; ?>
            </div>

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
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 font-semibold tracking-wider">Nama Acara</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Tarikh</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Lokasi</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Penerangan</th>
                                <th class="px-6 py-4 font-semibold tracking-wider text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($event->title); ?></td>
                                <td class="px-6 py-4 text-gray-600">
                                    <?php echo e(\Carbon\Carbon::parse($event->event_date)->format('d M Y')); ?>

                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <?php echo e($event->venue ?? 'Tidak dinyatakan'); ?>

                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate" title="<?php echo e($event->description); ?>">
                                    <?php echo e(Str::limit($event->description, 50)); ?>

                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php if(Auth::guard('committee')->check()): ?>
                                    <div class="flex justify-center space-x-2">
                                        <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <button onclick="openDeleteModal(<?php echo e($event->id); ?>, '<?php echo e(addslashes($event->title)); ?>')" class="text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors">
                                            <i class="fas fa-trash mr-1"></i> Padam
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-lg font-medium text-gray-500">Tiada acara dijumpai</p>
                                        <p class="text-sm text-gray-400 mb-4">Sila cipta acara baru untuk memulakan.</p>
                                        <?php if(Auth::guard('committee')->check()): ?>
                                        <a href="<?php echo e(route('admin.events.create')); ?>" class="text-blue-600 hover:underline text-sm font-medium">Cipta Acara Pertama</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
      </main>
    </div>
  </div>

  <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all scale-95 opacity-0" id="modalContent">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Adakah anda pasti?</h3>
            <p class="text-gray-500 text-sm mb-6">
                Anda akan memadam acara "<span id="modalEventTitle" class="font-bold text-gray-800"></span>". <br>Tindakan ini tidak boleh dipulihkan.
            </p>
            
            <div class="flex space-x-3 justify-center">
                <button onclick="closeDeleteModal()" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline-block">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm">
                        Ya, Padam
                    </button>
                </form>
            </div>
        </div>
    </div>
  </div>

  <script>
    function openDeleteModal(id, title) {
        const modal = document.getElementById('deleteModal');
        const content = document.getElementById('modalContent');
        const titleSpan = document.getElementById('modalEventTitle');
        const form = document.getElementById('deleteForm');

        titleSpan.textContent = title;
        form.action = `/admin/events/${id}`;

        modal.classList.remove('hidden');
        // Animation
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const content = document.getElementById('modalContent');

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // Close on click outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
  </script>
</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/admin/events/index.blade.php ENDPATH**/ ?>