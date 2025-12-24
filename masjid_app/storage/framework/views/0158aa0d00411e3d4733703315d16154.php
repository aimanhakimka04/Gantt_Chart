<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al-Irsyad Islamic Centre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .admin-badge {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">Masjid Al-Irsyad</a>

            <!-- Navigation Links -->
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="<?php echo e(route('calendar')); ?>">
                    <i class="fas fa-calendar-alt"></i> Kalender
                </a>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->is_admin): ?>
                        <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <?php if(auth()->guard()->guest()): ?>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a>
                    <a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a>
                </div>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <div class="navbar-nav ms-auto">
                    <?php if(Auth::guard('committee')->check()): ?>
                        <a class="btn btn-white btn-sm me-3" href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="fas fa-user"></i> Welcome, <?php echo e(Auth::guard('committee')->user()->name); ?>

                        </a>
                    <?php else: ?>
                        <a class="btn btn-white btn-sm me-3" href="<?php echo e(route('Participant.profile.show')); ?>">
                            <i class="fas fa-user"></i> Welcome, <?php echo e(Auth::user()->name); ?>

                        </a>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(Auth::guard('committee')->check() ? route('committee.logout') : route('logout')); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Page content -->
    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="text-center mt-5 mb-3">
        <p>&copy; 2025 Masjid Al-Irsyad</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH /var/www/masjid_app/resources/views/layouts/app.blade.php ENDPATH**/ ?>