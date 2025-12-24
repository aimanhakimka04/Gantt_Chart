<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Derma - Masjid MMU Melaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(url('/')); ?>" class="flex items-center space-x-2 hover:text-blue-200">
                        <i class="fas fa-arrow-left"></i>
                        <span class="font-semibold">Kembali ke Laman Utama</span>
                    </a>
                </div>
                <div class="font-bold text-lg">Sejarah Sumbangan Saya</div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Rekod Transaksi</h2>
                    <p class="text-sm text-gray-500">Senarai semua sumbangan yang telah anda lakukan.</p>
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold">
                    Total: RM <?php echo e(number_format($donations->sum('amount'), 2)); ?>

                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4">ID Transaksi</th>
                            <th class="px-6 py-4">Tarikh</th>
                            <th class="px-6 py-4">Program</th>
                            <th class="px-6 py-4">Jumlah (RM)</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Resit</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-mono font-medium text-gray-900">
                                #<?php echo e($donation->transaction_id ?? $donation->id); ?>

                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <div><?php echo e(\Carbon\Carbon::parse($donation->created_at)->format('d M Y')); ?></div>
                                <div class="text-xs text-gray-400"><?php echo e(\Carbon\Carbon::parse($donation->created_at)->format('h:i A')); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                
                                <?php
                                    $programName = $donation->type; // Default ambil apa yang ada (contoh: "Infaq Umum")
                                    
                                    // Jika nilai adalah nombor (ID), cari nama program dalam database
                                    if (is_numeric($donation->type)) {
                                        $program = \App\Models\DonationProgram::find($donation->type);
                                        if ($program) {
                                            $programName = $program->title;
                                        } else {
                                            $programName = 'Program Tamat / Tidak Dijumpai';
                                        }
                                    }
                                ?>

                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-200">
                                    <?php echo e($programName); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">
                                RM <?php echo e(number_format($donation->amount, 2)); ?>

                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($donation->status == 'success' || $donation->status == 'berjaya'): ?>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Berjaya</span>
                                <?php elseif($donation->status == 'pending'): ?>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">Proses</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full">Gagal</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-gray-400 hover:text-blue-600 transition-colors" title="Muat Turun Resit">
                                    <i class="fas fa-file-pdf text-lg"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-hand-holding-heart text-4xl mb-3 text-gray-300"></i>
                                <p>Tiada rekod derma ditemui.</p>
                                <a href="<?php echo e(url('/')); ?>#donasi" class="text-blue-600 hover:underline mt-2 inline-block">Mula menderma sekarang</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(method_exists($donations, 'links')): ?>
            <div class="p-4 border-t border-gray-100">
                <?php echo e($donations->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
        <div class="text-center text-gray-500 text-sm">
            &copy; <?php echo e(date('Y')); ?> Masjid MMU Melaka.
        </div>
    </footer>

</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/user/history.blade.php ENDPATH**/ ?>