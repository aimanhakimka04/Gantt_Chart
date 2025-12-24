@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar" style="min-height: 100vh;">
            <div class="sidebar-sticky h-100 d-flex flex-column">
                <h5 class="text-white p-3 mb-0">Participant Menu</h5>
                <ul class="nav flex-column flex-grow-1">
                    <li class="nav-item">
                        <a href="{{ route('Participant.profile.show') }}" class="nav-link text-white {{ request()->routeIs('Participant.profile.show') ? 'active' : '' }}">
                            <i class="fas fa-user me-2"></i> My Profile
                        </a>
                    </li>   
                    <li class="nav-item">
                        <a href="{{ route('event.registration') }}" class="nav-link text-white {{ request()->routeIs('event.registration') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt me-2"></i> Event Registration
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('participant.registrations') }}" class="nav-link text-white {{ request()->routeIs('participant.registrations') ? 'active' : '' }}">
                            <i class="fas fa-list me-2"></i> My Registrations
                        </a>
                    </li>
                </ul>
                <div class="mt-auto p-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link text-white bg-transparent border-0 w-100 text-start">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 p-4">
            @if(session('registration_success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('registration_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-calendar-plus me-2"></i>Event Registration
                    </h2>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="text-primary fw-bold">Welcome, {{ Auth::user()->name ?? 'Participant' }}!</h4>
                        <p class="text-muted">Register for upcoming mosque events</p>
                    </div>
                    <form method="POST" action="{{ route('event.register') }}" class="needs-validation" novalidate>
                                @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label for="event_id" class="form-label fw-semibold text-white">
                                        <i class="fas fa-calendar me-1 text-muted"></i>Select Event
                                    </label>
                                    <select name="event_id" id="event_id" class="form-control form-control-lg border-2 bg-dark text-white" style="border-radius: 10px;" required>
                                        <option value="">Choose an event...</option>
                                        @if(isset($events) && $events->isNotEmpty())
                                            @foreach($events as $event)
                                                <option value="{{ $event->id }}">{{ $event->title }} ({{ \Carbon\Carbon::parse($event->event_date)->format('j F, Y') }})</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No events available</option>
                                        @endif
                                    </select>
                                    @if(!isset($events) || $events->isEmpty())
                                        <div class="text-center mt-3">
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>No events available. Please contact an admin to add events.
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-light btn-lg px-5 rounded-pill" {{ !isset($events) || $events->isEmpty() ? 'disabled' : '' }}>
                                        <i class="fas fa-plus me-2"></i>Register for Event
                                </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection