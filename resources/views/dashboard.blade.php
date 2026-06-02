<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: {
                        primary: {
                            dark: '#004F3B',
                            mid: '#43B75D',
                            teal: '#003C3C',
                            light: '#E8F5E9'
                        },
                        cream: '#FFF5E4',
                    },
                    boxShadow: {
                        'card': '0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.06)',
                        'floating': '0 4px 18px rgba(0,0,0,0.12)'
                    }
                }
            }
        }
    </script>
    
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>
<body class="bg-cream font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR NAVBAR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-20">
        
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] leading-[28px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
            
            {{-- Menu Dashboard (Aktif) --}}
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 bg-white/10 border-l-[3px] border-primary-mid text-white font-semibold rounded-r-lg transition-colors">
                <i class="ph ph-house text-[20px]"></i>
                <span class="text-[15px]">Dashboard</span>
            </a>

            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-map-trifold text-[20px]"></i>
                <span class="text-[15px]">Peta GIS</span>
            </a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-plant text-[20px]"></i>
                <span class="text-[15px]">Data Lahan</span>
            </a>
            
            {{-- LINK PENANAMAN (Ikon sudah dipastikan muncul) --}}
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-potted-plant text-[20px]"></i>
                <span class="text-[15px]">Penanaman</span>
            </a>

            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-drop text-[20px]"></i>
                <span class="text-[15px]">Pengairan & Irigasi</span>
            </a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-flask text-[20px]"></i>
                <span class="text-[15px]">Pemupukan</span>
            </a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-bug text-[20px]"></i>
                <span class="text-[15px]">Pengendalian Hama</span>
            </a>
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-wrench text-[20px]"></i>
                <span class="text-[15px]">Perawatan Lain</span>
            </a>
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-package text-[20px]"></i>
                <span class="text-[15px]">Hasil Panen</span>
            </a>
            <a href="{{ route('penjualan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-money text-[20px]"></i>
                <span class="text-[15px]">Penjualan</span>
            </a>
            <a href="{{ route('laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-chart-bar text-[20px]"></i>
                <span class="text-[15px]">Laporan</span>
            </a>

            <div class="h-px bg-white/10 my-2 mx-3"></div>

<a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('notifikasi*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-bell-ringing text-[20px]"></i>
                <span class="text-[15px] flex-1">Notifikasi</span>
                
                {{-- Hitung langsung dari Model agar selalu muncul --}}
                @php
                    $notifCount = \App\Models\BatchTanam::countNotifikasiPanen();
                @endphp
                
                @if($notifCount > 0)
                    <span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">{{ $notifCount }}</span>
                @endif
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-gear text-[20px]"></i>
                <span class="text-[16px]">Pengaturan</span>
            </a>
        </nav>

{{-- PROFIL SIDEBAR BAWAH --}}
        <div class="p-4 border-t border-white/10 shrink-0 hover:bg-white/5 transition flex items-center justify-between">
            
            {{-- Bagian ini dibungkus tag <a> agar bisa diklik menuju profil --}}
            <a href="{{ route('profil') }}" class="flex items-center gap-3 cursor-pointer group hover:opacity-80 transition">
                <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">
                    {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'FA' }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::check() ? Auth::user()->name : 'Fajri' }}</span>
                    <span class="text-[11px] text-white/60 capitalize">{{ Auth::check() ? Auth::user()->role : 'Petani' }}</span>
                </div>
            </a>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="Keluar" class="flex items-center justify-center">
                    <i class="ph ph-sign-out text-white/50 hover:text-red-400 transition text-[20px]"></i>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0 bg-cream">
        
        {{-- HEADER ATAS --}}
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0 z-10">
            <div class="flex items-center gap-2">
                <span class="text-[12px] text-gray-400">Pages</span>
                <i class="ph ph-caret-right text-[10px] text-gray-400"></i>
                <span class="text-[20px] font-semibold text-gray-900 leading-none mt-0.5">Dashboard Utama</span>
            </div>

            <div class="flex items-center gap-5">
                <button class="text-gray-400 hover:text-primary-dark transition"><i class="ph ph-magnifying-glass text-[24px]"></i></button>
    
                <a href="{{ route('notifikasi') }}" class="text-gray-400 hover:text-primary-dark transition relative cursor-pointer">
                    <i class="ph ph-bell text-[24px]"></i>
                    @php $notifCount = \App\Models\BatchTanam::countNotifikasiPanen(); @endphp
                    @if($notifCount > 0)
                        <span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm absolute -top-1 -right-2">
                            {{ $notifCount }}
                        </span>
                    @endif
                </a>
                
                {{-- PROFIL KANAN ATAS (SUDAH JADI LINK MURNI) --}}
                <a href="{{ route('profil') }}" class="flex items-center gap-2 hover:opacity-80 transition cursor-pointer">
                    <div class="w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center font-semibold text-[12px] shadow-sm">
                        {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'FA' }}
                    </div>
                    <i class="ph ph-caret-down text-[12px] text-gray-400"></i>
                </a>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 space-y-6">
            
            {{-- HEADER HALAMAN & SAPAAN --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-[32px] font-semibold text-primary-dark leading-tight">
                        Selamat pagi, {{ explode(' ', Auth::user()->name)[0] }} 👋
                    </h2>
                    <p class="text-[14px] text-gray-400 mt-1">
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                </div>
                
                <a href="{{ route('lahan.create') }}" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-primary-teal transition flex items-center gap-2 shadow-sm">
                    <i class="ph ph-plus-circle text-lg"></i> Tambah Lahan Baru
                </a>
            </div>

            {{-- STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-[16px] shadow-card border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[12px] bg-blue-50 text-blue-600 flex items-center justify-center text-[24px]"><i class="ph ph-map-pin"></i></div>
                    <div><p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total Lahan</p><h3 class="text-[20px] font-bold text-gray-900">{{ $totalLahan ?? 0 }} Ha</h3></div>
                </div>
                <div class="bg-white p-5 rounded-[16px] shadow-card border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[12px] bg-orange-50 text-orange-600 flex items-center justify-center text-[24px]"><i class="ph ph-package"></i></div>
                    <div><p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Batch Aktif</p><h3 class="text-[20px] font-bold text-gray-900">{{ $totalBatch ?? 0 }} Batch</h3></div>
                </div>
                {{-- CARD 3: EST. PANEN --}}
                <div class="bg-white rounded-[16px] p-5 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-500 flex items-center justify-center text-[28px] shrink-0">
                        <i class="ph ph-calendar-check"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Est. Panen</p>
                        @if($totalBatch == 0)
                            <h3 class="text-[22px] font-bold text-gray-900">-</h3>
                        @elseif($estimasiPanen == 0)
                            <h3 class="text-[20px] font-bold text-red-500">Hari Ini!</h3>
                        @else
                            <h3 class="text-[22px] font-bold text-gray-900">{{ $estimasiPanen }} Hari Lagi</h3>
                        @endif
                    </div>
                </div>
                <div class="bg-white p-5 rounded-[16px] shadow-card border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[12px] bg-emerald-50 text-emerald-600 flex items-center justify-center text-[24px]"><i class="ph ph-currency-circle-dollar"></i></div>
                    <div><p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Pendapatan</p><h3 class="text-[20px] font-bold text-gray-900">Rp {{ $pendapatan ?? '0' }}</h3></div>
                </div>
            </div>

            {{-- PETA & JADWAL GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- MAP KONTEN UTAMA --}}
                <div class="lg:col-span-2 bg-white rounded-[16px] shadow-card p-6 border border-gray-100 flex flex-col min-h-[450px]">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-[18px] font-semibold text-primary-dark flex items-center gap-2">
                            <i class="ph ph-map-trifold"></i> Peta Persebaran Lahan
                        </h3>
                        <a href="{{ route('peta.gis') }}" class="text-[12px] font-semibold text-primary-mid hover:underline">Lihat Peta Lengkap &rsaquo;</a>
                    </div>
                    
                    {{-- Kontainer Peta Relatif --}}
                    <div class="w-full flex-1 relative rounded-[12px] overflow-hidden border border-gray-200">
                        <div id="dashboard-map" class="w-full h-full min-h-[350px] z-10"></div>
                        
                        {{-- FLOATING COMPONENT: Panel Filter Melayang --}}
                        <div class="absolute top-3 right-3 z-[1000] flex flex-col items-end">
                            <button id="btn-toggle-filter" class="w-10 h-10 bg-white rounded-lg shadow-md border border-gray-200 flex items-center justify-center text-gray-700 hover:text-primary-dark hover:bg-gray-50 transition">
                                <i class="ph ph-funnel text-xl"></i>
                            </button>
                            
                            <div id="panel-filter-dashboard" class="hidden mt-2 w-[240px] bg-white rounded-xl shadow-floating border border-gray-100 p-4 space-y-3 text-left">
                                <div class="flex items-center justify-between border-b pb-2">
                                    <h4 class="font-bold text-xs text-gray-900">Filter Lahan</h4>
                                    <button onclick="resetFilterDashboard()" class="text-[10px] text-primary-mid font-semibold hover:underline">Reset</button>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Komoditas</label>
                                    <input type="text" id="dash-filter-komoditas" onkeyup="eksekusiFilterDashboard()" placeholder="Ketik komoditas (bawang, padi...)" class="w-full border border-gray-200 rounded-md px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-primary-mid">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Jenis Tanah</label>
                                    <input type="text" id="dash-filter-tanah" onkeyup="eksekusiFilterDashboard()" placeholder="Misal: Latosol" class="w-full border border-gray-200 rounded-md px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-primary-mid">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-gray-400 mb-1">Luas Minimum (Ha)</label>
                                    <input type="number" id="dash-filter-luas" onchange="eksekusiFilterDashboard()" onkeyup="eksekusiFilterDashboard()" placeholder="0" class="w-full border border-gray-200 rounded-md px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- JADWAL AKTIVITAS --}}
                <div class="bg-white rounded-[16px] shadow-card border border-gray-100 p-6 flex flex-col">
                    <h3 class="text-[18px] font-semibold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="ph ph-calendar-text text-orange-500"></i> Jadwal Aktivitas
                    </h3>
                    
                    <div class="space-y-6 flex-1">
                        <div class="flex gap-4 relative">
                            <div class="flex flex-col items-center">
                                <div class="w-3.5 h-3.5 rounded-full bg-green-500 z-10 ring-4 ring-green-50"></div>
                                <div class="w-0.5 h-full bg-gray-100 absolute top-4"></div>
                            </div>
                            <div class="pb-2">
                                <p class="text-[11px] font-bold text-green-600 uppercase tracking-wider">Hari Ini</p>
                                <h4 class="text-[14px] font-semibold text-gray-800 mt-0.5">Pemupukan Urea</h4>
                                <p class="text-[12px] text-gray-500 mt-1">Lahan Bawang Putih — Blok A</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 relative">
                            <div class="flex flex-col items-center">
                                <div class="w-3.5 h-3.5 rounded-full bg-blue-500 z-10 ring-4 ring-blue-50"></div>
                                <div class="w-0.5 h-full bg-gray-100 absolute top-4"></div>
                            </div>
                            <div class="pb-2">
                                <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wider">Besok</p>
                                <h4 class="text-[14px] font-semibold text-gray-800 mt-0.5">Pengecekan Hama</h4>
                                <p class="text-[12px] text-gray-500 mt-1">Lahan Bawang Putih — Blok B</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3.5 h-3.5 rounded-full bg-orange-400 z-10 ring-4 ring-orange-50"></div>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-orange-500 uppercase tracking-wider">20 Mei 2026</p>
                                <h4 class="text-[14px] font-semibold text-gray-800 mt-0.5">Estimasi Panen</h4>
                                <p class="text-[12px] text-gray-500 mt-1">Lahan Bawang Putih — Blok A</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- DIUBAH MENJADI LINK --}}
                    <a href="{{ route('jadwal') }}" class="block text-center w-full mt-4 py-2.5 text-[13px] font-semibold text-primary-dark bg-primary-light rounded-[8px] hover:bg-green-100 transition">
                        Lihat Semua Jadwal
                    </a>
                </div>

            </div>

            {{-- TABEL BATCH AKTIF --}}
            <div class="bg-white rounded-[16px] shadow-card border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-[18px] font-semibold text-gray-900 flex items-center gap-2">
                        <i class="ph ph-stack text-blue-500"></i> Batch Tanaman Aktif
                    </h3>
                    <a href="{{ route('penanaman') }}" class="px-4 py-2 bg-primary-dark text-white text-[13px] font-semibold rounded-[8px] flex items-center gap-2 hover:bg-opacity-90 transition">
                        <i class="ph ph-plus-circle text-lg"></i> Tambah Batch
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-[12px] font-semibold text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4 border-b border-gray-100">Nama Batch</th>
                                <th class="px-6 py-4 border-b border-gray-100">Komoditas</th>
                                <th class="px-6 py-4 border-b border-gray-100">Lahan</th>
                                <th class="px-6 py-4 border-b border-gray-100">Est. Panen</th>
                                <th class="px-6 py-4 border-b border-gray-100">Progress</th>
                                <th class="px-6 py-4 border-b border-gray-100">Status</th>
                                <th class="px-6 py-4 border-b border-gray-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[13px] font-medium text-gray-700 divide-y divide-gray-50">
                            @forelse($batchesAktif ?? [] as $batch)
                                @php
                                    // LOGIKA PERHITUNGAN PROGRESS BAR
                                    $tglTanam = \Carbon\Carbon::parse($batch->tanggal_tanam)->startOfDay();
                                    $durasiStandar = $batch->durasi_standar_hari ?: 1; 
                                    $tglPanen = $tglTanam->copy()->addDays($durasiStandar);
                                    
                                    $hariBerjalan = $tglTanam->diffInDays(\Carbon\Carbon::now()->startOfDay(), false);
                                    $persen = max(0, min(100, round(($hariBerjalan / $durasiStandar) * 100)));
                                    
                                    $barColor = 'bg-primary-mid'; 
                                    if ($persen < 30) $barColor = 'bg-blue-400'; 
                                    if ($persen > 90) $barColor = 'bg-amber-500'; 
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $batch->komoditas }} — {{ $tglTanam->translatedFormat('M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 bg-purple-50 text-purple-700 rounded-md text-[11px] font-bold uppercase">{{ $batch->komoditas }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $batch->lahan->nama_lahan ?? 'Belum ada lahan' }}</td>
                                    <td class="px-6 py-4 font-semibold">{{ $tglPanen->translatedFormat('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                                <div class="{{ $barColor }} h-1.5 rounded-full transition-all duration-500" style="width: {{ $persen }}%"></div>
                                            </div>
                                            <span class="text-[11px] font-bold text-gray-500 w-8">{{ $persen }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($persen >= 100)
                                            <span class="px-2.5 py-1 bg-amber-100 text-amber-700 rounded-md text-[11px] font-bold uppercase">Siap Panen</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-green-100 text-green-700 rounded-md text-[11px] font-bold uppercase">Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{-- DIUBAH MENJADI LINK KE HALAMAN DETAIL --}}
                                        <a href="{{ url('/penanaman/detail/' . $batch->id) }}" class="text-primary-mid hover:text-primary-dark hover:underline font-semibold text-[13px] transition">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-400 font-medium">Belum ada batch tanaman yang aktif saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- DIUBAH MENJADI LINK KE HALAMAN PENANAMAN --}}
                <div class="p-4 bg-gray-50 text-center border-t border-gray-100">
                    <a href="{{ route('penanaman') }}" class="text-[13px] font-semibold text-gray-500 hover:text-primary-dark transition">Lihat semua data batch &rsaquo;</a>
                </div>
            </div>

        </main>
    </div>

    {{-- Script JavaScript untuk Peta Dashboard & Filter Interaktif --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // 1. Inisialisasi Peta (Fokus & Kunci di Area Ciwidey)
        const ciwideyBounds = [
            [-7.2000, 107.3000], 
            [-7.0000, 107.5000]  
        ];

        const map = L.map('dashboard-map', {
            maxBounds: ciwideyBounds,
            maxBoundsViscosity: 1.0,
            minZoom: 12
        }).setView([-7.1044, 107.3914], 13);

        // 2. Tambahkan Layer Satelit Esri
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
        }).addTo(map);

        const polygonLayerGroup = L.layerGroup().addTo(map);
        const lahans = @json($lahans ?? []);
        const localItems = []; 

        if(lahans && lahans.length > 0) {
            lahans.forEach(lahan => {
                if (lahan.titik_batas) {
                    try {
                        let geoData = (typeof lahan.titik_batas === 'string') 
                                      ? JSON.parse(lahan.titik_batas) 
                                      : lahan.titik_batas;

                        const layer = L.geoJSON(geoData, {
                            style: { color: '#43B75D', fillColor: '#43B75D', fillOpacity: 0.6, weight: 2 }
                        });

                        layer.bindTooltip(`
                            <div style="font-family: Montserrat, sans-serif; min-width: 120px;">
                                <strong style="color: #004F3B; font-size: 13px; display: block; border-bottom: 1px solid #eee; padding-bottom: 4px; margin-bottom: 4px;">
                                    ${lahan.nama_lahan}
                                </strong>
                                <div style="font-size: 11px; color: #555; line-height: 1.5;">
                                    Petani: <b>${lahan.petani ? lahan.petani.name : '-'}</b><br>
                                    Luas: <b>${lahan.luas_ha} Ha</b><br>
                                    Tanah: <b>${lahan.jenis_tanah}</b>
                                </div>
                            </div>
                        `, { sticky: true, direction: 'top', opacity: 0.95 });

                        layer.on('mouseover', function () { this.setStyle({ fillOpacity: 0.8, color: '#004F3B' }); });
                        layer.on('mouseout', function () { this.setStyle({ fillOpacity: 0.6, color: '#43B75D' }); });

                        localItems.push({
                            rawData: lahan,
                            leafletLayer: layer
                        });

                    } catch (error) {
                        console.error("Gagal mendecode poligon: ", error);
                    }
                }
            });
        }

        // TOGGLE LOGIC: Menampilkan & menyembunyikan panel filter
        const btnToggle = document.getElementById('btn-toggle-filter');
        const panelFilter = document.getElementById('panel-filter-dashboard');
        
        btnToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            panelFilter.classList.toggle('hidden');
        });

        panelFilter.addEventListener('click', (e) => { e.stopPropagation(); });
        map.on('click', () => { panelFilter.classList.add('hidden'); });

        // LOGIKA MULTI-FILTER INTERAKTIF BERBASIS TEKS KETIKAN
        function eksekusiFilterDashboard() {
            polygonLayerGroup.clearLayers();
            
            const komoditasVal = document.getElementById('dash-filter-komoditas').value.toLowerCase().trim();
            const tanahVal = document.getElementById('dash-filter-tanah').value.toLowerCase().trim();
            const luasVal = parseFloat(document.getElementById('dash-filter-luas').value) || 0;

            const bounds = new L.LatLngBounds();
            let countVisible = 0;

            localItems.forEach(item => {
                let lolosSeleksi = true;
                
                const namaLahan = item.rawData.nama_lahan.toLowerCase();
                const jenisTanah = item.rawData.jenis_tanah ? item.rawData.jenis_tanah.toLowerCase() : '';
                const luasHa = parseFloat(item.rawData.luas_ha) || 0;

                if (komoditasVal && !namaLahan.includes(komoditasVal)) lolosSeleksi = false;
                if (tanahVal && !jenisTanah.includes(tanahVal)) lolosSeleksi = false;
                if (luasHa < luasVal) lolosSeleksi = false;

                if (lolosSeleksi) {
                    polygonLayerGroup.addLayer(item.leafletLayer);
                    bounds.extend(item.leafletLayer.getBounds());
                    countVisible++;
                }
            });

            if (countVisible > 0 && bounds.isValid()) {
                map.fitBounds(bounds, { padding: [40, 40] });
            }
        }

        function resetFilterDashboard() {
            document.getElementById('dash-filter-komoditas').value = '';
            document.getElementById('dash-filter-tanah').value = '';
            document.getElementById('dash-filter-luas').value = '';
            eksekusiFilterDashboard();
        }

        eksekusiFilterDashboard();
    </script>
</body>
</html>