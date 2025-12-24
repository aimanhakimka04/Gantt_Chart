<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Masjid MMU Melaka</title>
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
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-home w-6 text-center mr-2"></i> Dashboard
                        </a>
                        
                        <a href="<?php echo e(route('Participant.profile.show')); ?>" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-blue-50 text-blue-700">
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

                <?php if(session('success')): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm mb-4 flex justify-between items-center" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p><?php echo e(session('success')); ?></p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <?php endif; ?>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                    <div class="flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::guard('participant')->user()->name)); ?>&background=1e40af&color=fff&size=128&bold=true" 
                             class="w-24 h-24 rounded-full border-4 border-blue-50 shadow-md" 
                             alt="Profile Picture">
                    </div>
                    <div class="text-center md:text-left flex-1">
                        <h2 class="text-2xl font-bold text-gray-800"><?php echo e(Auth::guard('participant')->user()->name); ?></h2>
                        <div class="mt-1 flex flex-col md:flex-row md:items-center text-gray-500 text-sm space-y-1 md:space-y-0 md:space-x-4">
                            <span class="flex items-center justify-center md:justify-start">
                                <i class="fas fa-envelope mr-2 text-gray-400"></i><?php echo e(Auth::guard('participant')->user()->email); ?>

                            </span>
                            <span class="flex items-center justify-center md:justify-start">
                                <i class="fas fa-phone mr-2 text-gray-400"></i><?php echo e(Auth::guard('participant')->user()->phone ?? 'Tiada No. Telefon'); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-user-edit mr-2 text-blue-600"></i> Kemaskini Maklumat
                        </h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penuh</label>
                                    <input type="text" name="name" id="name" value="<?php echo e(old('name', Auth::guard('participant')->user()->name)); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Emel</label>
                                    <input type="email" name="email" id="email" value="<?php echo e(old('email', Auth::guard('participant')->user()->email)); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No. Telefon</label>
                                    <input type="tel" name="phone" id="phone" value="<?php echo e(old('phone', Auth::guard('participant')->user()->phone)); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <input type="text" name="address" id="address" value="<?php echo e(old('address', Auth::guard('participant')->user()->address)); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors shadow-sm flex items-center">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i class="fas fa-lock mr-2 text-yellow-600"></i> Tukar Kata Laluan
                        </h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="<?php echo e(route('password.update')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="space-y-4 max-w-lg">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Kata Laluan Semasa</label>
                                    <input type="password" name="current_password" id="current_password" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Laluan Baru</label>
                                    <input type="password" name="password" id="password" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Sahkan Kata Laluan Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-lg transition-colors shadow-sm flex items-center">
                                    <i class="fas fa-key mr-2"></i> Kemaskini Kata Laluan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-red-100 overflow-hidden">
                    <div class="bg-red-50 px-6 py-4 border-b border-red-100">
                        <h3 class="font-bold text-red-700 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Zon Bahaya
                        </h3>
                    </div>
                    <div class="p-6 flex flex-col md:flex-row items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <h4 class="font-bold text-gray-800">Padam Akaun</h4>
                            <p class="text-sm text-gray-500">Tindakan ini akan memadam semua data anda secara kekal.</p>
                        </div>
                        <button onclick="openDeleteModal()" class="bg-white border border-red-300 text-red-600 hover:bg-red-50 font-medium py-2 px-6 rounded-lg transition-colors">
                            <i class="fas fa-trash mr-2"></i> Padam Akaun Saya
                        </button>
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

    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full animate-[bounce_0.5s_ease-in-out]">
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Adakah anda pasti?</h3>
                    <p class="text-gray-500 text-sm mt-2">
                        Akaun anda akan dipadam secara kekal. Sila masukkan kata laluan untuk pengesahan.
                    </p>
                </div>

                <form method="POST" action="<?php echo e(route('profile.destroy')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Masukkan kata laluan anda" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" onclick="closeDeleteModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 rounded-lg transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-2 rounded-lg transition-colors">
                            Ya, Padam
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>

</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/Participant/profile/show.blade.php ENDPATH**/ ?>