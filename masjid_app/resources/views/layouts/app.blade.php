@vite(['resources/css/app.css', 'resources/js/app.js'])
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
            <a class="navbar-brand" href="{{ url('/') }}">Masjid Al-Irsyad</a>

            <!-- Navigation Links -->
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="{{ route('calendar') }}">
                    <i class="fas fa-calendar-alt"></i> Kalender
                </a>
                @auth
                    @if(Auth::user()->is_admin)
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    @endif
                @endauth
            </div>

            @guest
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </div>
            @endguest

            @auth
                <div class="navbar-nav ms-auto">
                    @if(Auth::guard('committee')->check())
                        <a class="btn btn-white btn-sm me-3" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-user"></i> Welcome, {{ Auth::guard('committee')->user()->name }}
                        </a>
                    @else
                        <a class="btn btn-white btn-sm me-3" href="{{ route('Participant.profile.show') }}">
                            <i class="fas fa-user"></i> Welcome, {{ Auth::user()->name }}
                        </a>
                    @endif
                    <form method="POST" action="{{ Auth::guard('committee')->check() ? route('committee.logout') : route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Page content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center mt-5 mb-3">
        <p>&copy; 2025 Masjid Al-Irsyad</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>