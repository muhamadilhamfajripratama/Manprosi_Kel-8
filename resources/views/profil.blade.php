<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#FFF5E4' }
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

{{-- SIDEBAR NAVBAR UNIVERSAL (Otomatis Deteksi Menu Aktif) --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] leading-[28px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

<nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
            
            {{-- Dashboard --}}
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('/') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span>
            </a>

            {{-- Peta GIS --}}
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('peta-gis*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span>
            </a>
            
            {{-- Data Lahan --}}
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('lahan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span>
            </a>
            
            {{-- Penanaman --}}
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('penanaman*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-potted-plant text-[20px]"></i><span class="text-[15px]">Penanaman</span>
            </a>

            {{-- Kalender Jadwal --}}
            <a href="{{ route('jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('jadwal*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-calendar-blank text-[20px]"></i><span class="text-[15px]">Kalender Jadwal</span>
            </a>

            {{-- Pengairan & Irigasi --}}
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('irigasi*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span>
            </a>
            
            {{-- Pemupukan --}}
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('pemupukan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span>
            </a>
            
            {{-- Pengendalian Hama --}}
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('hama*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span>
            </a>
            
            {{-- Perawatan Lain --}}
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('perawatan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span>
            </a>
            
            {{-- Hasil Panen --}}
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('panen*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span>
            </a>
            
            {{-- Penjualan --}}
            <a href="{{ route('penjualan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('penjualan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span>
            </a>
            
            {{-- Laporan --}}
            <a href="{{ route('laporan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('laporan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span>
            </a>

            <div class="h-px bg-white/10 my-2 mx-3"></div>

            {{-- Notifikasi --}}
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
        {{-- HEADER --}}
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0 z-10">
            <div class="flex items-center gap-2">
                <span class="text-[12px] text-gray-400">Pages</span>
                <i class="ph ph-caret-right text-[10px] text-gray-400"></i>
                <span class="text-[20px] font-semibold text-gray-900 leading-none mt-0.5">Profil Saya</span>
            </div>
            <div class="flex items-center gap-5">
                <button class="flex items-center gap-2 hover:opacity-80 transition">
                    <div class="w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center font-semibold text-[12px]">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-3xl">
                <h2 class="text-[32px] font-semibold text-primary-dark leading-tight mb-6">Pengaturan Profil</h2>

                <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm p-8">
                    <div class="flex items-center gap-6 mb-8 border-b border-gray-100 pb-8">
                        <div class="w-24 h-24 rounded-full bg-primary-mid text-white flex items-center justify-center font-semibold text-[32px] shadow-inner">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-[20px] font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-[14px] text-gray-500 mb-2">{{ Auth::user()->email }}</p>
                            <span class="px-3 py-1 bg-green-50 text-green-700 text-[12px] font-semibold rounded-full capitalize">
                                Role: {{ Auth::user()->role }}
                            </span>
                        </div>
                    </div>

<form action="{{ route('profil.update') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')
                        
                        {{-- Notifikasi Sukses --}}
                        @if(session('success'))
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-[13px] font-semibold flex items-center gap-2">
                                <i class="ph ph-check-circle text-lg"></i> {{ session('success') }}
                            </div>
                        @endif

                        {{-- Pesan Error Validasi --}}
                        @if($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-[13px] font-semibold">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full border border-gray-300 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-2 focus:ring-primary-mid/20 focus:border-primary-mid focus:outline-none transition" required>
                        </div>

                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full border border-gray-300 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-2 focus:ring-primary-mid/20 focus:border-primary-mid focus:outline-none transition" required>
                        </div>
                        
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Tanggal Bergabung</label>
                            <input type="text" value="{{ Auth::user()->created_at->format('d F Y') }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] bg-gray-50 text-gray-400 cursor-not-allowed" readonly>
                            <p class="text-[11px] text-gray-400 mt-1.5"><i class="ph ph-info"></i> Tanggal bergabung tidak dapat diubah.</p>
                        </div>

                        <div class="pt-5 border-t border-gray-100 flex justify-end">
                            <button type="submit" class="bg-primary-dark text-white px-8 py-2.5 rounded-[8px] text-[13px] font-bold hover:bg-primary-mid transition shadow-sm flex items-center gap-2">
                                <i class="ph ph-floppy-disk text-lg"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>