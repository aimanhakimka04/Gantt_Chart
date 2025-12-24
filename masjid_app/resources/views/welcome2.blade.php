@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 20px;">
        <h1 style="text-align: center;">Selamat Datang ke Masjid Al-Irsyad</h1>

        <hr>

        <section>
            <h2>Waktu Solat bagi {{$today}} (Melaka)</h2>
            <ul>
                <li><strong>Subuh:</strong> {{ $malayPrayerTimes['Subuh'] }}</li>
                <li><strong>Zohor:</strong> {{ $malayPrayerTimes['Zohor'] }}</li>
                <li><strong>Asar:</strong> {{ $malayPrayerTimes['Asar'] }}</li>
                <li><strong>Maghrib:</strong> {{ $malayPrayerTimes['Maghrib'] }}</li>
                <li><strong>Isyak:</strong> {{ $malayPrayerTimes['Isyak'] }}</li>
            </ul>
        </section>

        <hr>

        <section>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Kalender Aktiviti Masjid</h2>
                <a href="{{ route('calendar') }}" class="btn btn-primary">
                    <i class="fas fa-calendar-alt"></i> Lihat Kalender Penuh
                </a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5>Acara Terkini (7 Hari Akan Datang):</h5>
                    @if($upcomingEvents->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($upcomingEvents as $event)
                                <li class="list-group-item">
                                    <strong>{{ $event->title }}</strong><br>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> 
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('j F Y') }}
                                    </small>
                                    @if($event->description)
                                        <br><small>{{ $event->description }}</small>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Tiada acara dalam 7 hari akan datang.
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Mahu lihat semua acara?</h6>
                            <p class="card-text">Klik butang di atas untuk melihat kalender aktiviti penuh dengan tarikh dan masa yang tepat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection