<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Disertai - Masjid MMU Melaka</title>
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
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:text-blue-200 transition">
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
                        Selamat Datang, <span class="font-bold">{{ Auth::guard('participant')->user()->name }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
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
                            {{ substr(Auth::guard('participant')->user()->name, 0, 1) }}
                        </div>
                        <h3 class="font-bold text-gray-800 truncate">{{ Auth::guard('participant')->user()->name }}</h3>
                        <p class="text-xs text-gray-500">{{ Auth::guard('participant')->user()->email }}</p>
                    </div>
                    
                    <nav class="p-2 space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-home w-6 text-center mr-2"></i> Dashboard
                        </a>
                        
                        <a href="{{ route('Participant.profile.show') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-user w-6 text-center mr-2"></i> Profil Saya
                        </a>

                        <a href="{{ route('participant.registrations') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-blue-50 text-blue-700">
                            <i class="fas fa-calendar-check w-6 text-center mr-2"></i> Program Disertai
                        </a>

                        <a href="{{ route('user.history') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition-colors">
                            <i class="fas fa-hand-holding-heart w-6 text-center mr-2"></i> Sejarah Derma
                        </a>
                    </nav>
                </div>
            </div>

            <div class="lg:col-span-3">
                
                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 mb-6 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Program Disertai</h2>
                        <p class="text-gray-500 text-sm mt-1">Senarai aktiviti masjid yang anda telah daftar.</p>
                    </div>
                    <a href="{{ route('home') }}#kegiatan" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition-colors shadow-sm flex items-center">
                        <i class="fas fa-plus mr-2"></i> Daftar Program Baru
                    </a>
                </div>

                @if($registrations->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($registrations as $registration)
                            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                                <div class="h-2 w-full 
                                    @if($registration->status === 'approved') bg-green-500
                                    @elseif($registration->status === 'rejected') bg-red-500
                                    @else bg-yellow-500 @endif">
                                </div>

                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="bg-blue-50 p-3 rounded-lg text-blue-600">
                                            <i class="fas fa-mosque text-xl"></i>
                                        </div>
                                        
                                        @if($registration->status === 'approved')
                                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full flex items-center">
                                                <i class="fas fa-check-circle mr-1"></i> Diluluskan
                                            </span>
                                        @elseif($registration->status === 'rejected')
                                            <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full flex items-center">
                                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full flex items-center">
                                                <i class="fas fa-clock mr-1"></i> Menunggu
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1">
                                        {{ $registration->event->title ?? 'Nama Program Tidak Dijumpai' }}
                                    </h3>

                                    <div class="space-y-3 text-sm text-gray-600 mb-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                            <span>{{ \Carbon\Carbon::parse($registration->event->event_date)->format('d F Y') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt w-5 text-gray-400"></i>
                                            <span>{{ $registration->event->venue ?? 'Lokasi: Dewan Utama Masjid' }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock w-5 text-gray-400"></i>
                                            <span>Didaftar pada: {{ \Carbon\Carbon::parse($registration->created_at)->format('d M Y, h:i A') }}</span>
                                        </div>
                                    </div>

                                    @if($registration->status === 'approved')
                                    <div class="pt-4 border-t border-gray-100">
                                        <button class="w-full text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center justify-center">
                                            <i class="fas fa-ticket-alt mr-2"></i> Lihat Tiket / Pas
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                            <i class="fas fa-calendar-times text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tiada Program Disertai</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum mendaftar untuk mana-mana aktiviti masjid. Jom sertai program imarah masjid kami!</p>
                        <a href="{{ route('home') }}#kegiatan" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors shadow-sm">
                            <i class="fas fa-search mr-2"></i> Cari Program Menarik
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Masjid MMU Melaka. Semua hak cipta terpelihara.
        </div>
    </footer>

</body>
</html>