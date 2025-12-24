<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Permintaan - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body { font-family: "Inter", sans-serif; }
    
    .sidebar-item { transition: all 0.3s ease; }
    .sidebar-item:hover { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; }
    .sidebar-item.active { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; color: #3b82f6; }
    .fade-in { animation: fadeIn 0.4s ease-in; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
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
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span>Dashboard</span>
        </a>
        <a href="<?php echo e(route('admin.donations.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Pengurusan Derma</span>
        </a>
        <a href="<?php echo e(route('admin.events.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Pengurusan Acara</span>
        </a>
        <a href="<?php echo e(route('admin.registrations.index')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span>Pendaftaran Peserta</span>
        </a>
        
        <a href="<?php echo e(route('admin.service_requests.index')); ?>" class="sidebar-item active w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            <span>Permintaan Servis</span>
        </a>

        <a href="<?php echo e(route('admin.notifications.send')); ?>" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span>Hantar Notifikasi</span>
        </a>
      </nav>

      <div class="p-4 border-t border-gray-100 bg-white">
        <form method="POST" action="<?php echo e(route('committee.logout')); ?>">
            <?php echo csrf_field(); ?>
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
            <h2 class="text-2xl font-bold text-gray-800">Daftar Permintaan Baru</h2>
            <p class="text-sm text-gray-500">Hantar permohonan logistik atau bantuan untuk acara</p>
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
        <div class="fade-in max-w-3xl mx-auto">
            
            <form method="POST" action="<?php echo e(route('admin.service_requests.store')); ?>" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <?php echo csrf_field(); ?>
                
                <div class="p-8 space-y-6">
                    <div>
                        <label for="event_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Acara Berkaitan</label>
                        <select name="event_id" id="event_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors <?php $__errorArgs = ['event_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">-- Sila Pilih Acara --</option>
                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($event->id); ?>" <?php echo e(old('event_id') == $event->id ? 'selected' : ''); ?>>
                                    <?php echo e($event->title); ?> - <?php echo e(\Carbon\Carbon::parse($event->event_date)->format('d M Y')); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['event_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Butiran Permintaan</label>
                        <textarea name="description" id="description" rows="5" required 
                                  placeholder="Contoh: Memerlukan 50 kerusi tambahan, sistem PA, dan 2 orang sukarelawan untuk pendaftaran."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-gray-500 text-xs mt-2">Sila nyatakan dengan jelas peralatan atau bantuan yang diperlukan.</p>
                    </div>
                </div>

                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                    <a href="<?php echo e(route('admin.service_requests.index')); ?>" class="px-6 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Hantar Permintaan
                        </span>
                    </button>
                </div>
            </form>

        </div>
      </main>
    </div>
  </div>
</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/admin/service_requests/create.blade.php ENDPATH**/ ?>