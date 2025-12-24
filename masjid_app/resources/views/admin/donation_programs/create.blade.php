<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cipta Program - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
    body { font-family: "Inter", sans-serif; }
    
    .sidebar-item { transition: all 0.3s ease; }
    .sidebar-item:hover { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; }
    
    /* Active State styling */
    .sidebar-item.active { background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; color: #3b82f6; }
    
    .card-hover { transition: all 0.3s ease; }
    .card-hover:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
    
    .fade-in { animation: fadeIn 0.6s ease-in; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
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
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.donations.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Transaksi Derma</span>
        </a>

        <a href="{{ route('admin.donation_programs.index') }}" class="sidebar-item active w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <span>Program Sumbangan</span>
        </a>

        <a href="{{ route('admin.events.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Pengurusan Acara</span>
        </a>

        <a href="{{ route('admin.registrations.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <span>Pendaftaran Peserta</span>
        </a>

        <a href="{{ route('admin.service_requests.index') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <span>Permintaan Servis</span>
        </a>

        <a href="{{ route('admin.notifications.send') }}" class="sidebar-item w-full flex items-center px-4 py-3 text-left rounded-lg text-sm font-medium text-gray-600 hover:text-blue-600">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span>Hantar Notifikasi</span>
        </a>

        <div class="pt-8 mt-8 border-t border-gray-100 pb-6">
            <form method="POST" action="{{ route('committee.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Log Keluar</span>
                </button>
            </form>
        </div>
      </nav>
    </div>

    <div class="flex-1 overflow-y-auto bg-gray-50 h-full">
      
      <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
        <div class="flex items-center justify-between px-8 py-4">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Cipta Program Baru</h2>
            <p class="text-sm text-gray-500">Tambah program sumbangan baru untuk masjid</p>
          </div>
          <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
              <p class="text-sm font-bold text-gray-900">{{ Auth::guard('committee')->user()->name ?? 'Admin' }}</p>
              <p class="text-xs text-gray-500">{{ Auth::guard('committee')->user()->email ?? '' }}</p>
            </div>
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg text-white font-bold">
                {{ substr(Auth::guard('committee')->user()->name ?? 'A', 0, 1) }}
            </div>
          </div>
        </div>
      </header>

      <main class="p-8">
        <div class="fade-in max-w-3xl mx-auto">
            
            <div class="flex items-center mb-6">
                <a href="{{ route('admin.donation_programs.index') }}" class="mr-4 p-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:text-blue-600 hover:border-blue-300 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Butiran Program</h3>
                    <p class="text-sm text-gray-500">Isi maklumat di bawah untuk mewujudkan tabung baru</p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 card-hover">
                <form action="{{ route('admin.donation_programs.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                            <input type="text" name="title" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                placeholder="Contoh: Tabung Pembesaran Dewan Solat">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sasaran Jumlah (RM)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">RM</span>
                                <input type="number" name="target_amount" required 
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                    placeholder="10000">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Program</label>
                            <div class="relative">
                                <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white appearance-none cursor-pointer">
                                    <option value="active">🟢 Aktif (Dipaparkan di Laman Utama)</option>
                                    <option value="inactive">🔴 Tidak Aktif (Disembunyikan)</option>
                                    <option value="completed">🔵 Selesai (Tutup Kutipan)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Penerangan (Pilihan)</label>
                            <textarea name="description" rows="4" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                placeholder="Masukkan butiran lanjut mengenai program ini, tujuan kutipan, dan sebagainya..."></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.donation_programs.index') }}" class="px-6 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Program
                        </button>
                    </div>
                </form>
            </div>

        </div>
      </main>
    </div>
  </div>
</body>
</html>