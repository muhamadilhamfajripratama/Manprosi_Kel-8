<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Batch - {{ $batch->komoditas }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D', light: '#E8F5E9' }, cream: '#EEEEEE' } } }
        }
    </script>
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
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-10">
        
        {{-- TOMBOL KEMBALI & HEADER --}}
        <div class="mb-8">
            <a href="{{ route('penanaman') }}" class="inline-flex items-center gap-2 text-[13px] font-semibold text-gray-500 hover:text-primary-dark transition mb-4">
                <i class="ph ph-arrow-left text-lg"></i> Kembali ke Penanaman
            </a>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-[28px] font-bold text-primary-dark flex items-center gap-3">
                        Detail {{ $batch->komoditas }}
                        <span class="text-[12px] font-bold px-3 py-1 rounded-full {{ $batch->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }} tracking-wide uppercase align-middle">
                            {{ $batch->status }}
                        </span>
                    </h2>
                    <p class="text-[14px] text-gray-500 mt-1">Lahan: <strong class="text-gray-700">{{ $batch->lahan->nama_lahan ?? 'Lahan Tidak Diketahui' }}</strong> | Ditanam pada: {{ \Carbon\Carbon::parse($batch->tanggal_tanam)->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- WIDGET WAKTU & PERTUMBUHAN (GRID 3 KOLOM) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shrink-0"><i class="ph ph-calendar-check"></i></div>
                <div>
                    <p class="text-[12px] font-semibold text-gray-400 uppercase">Est. Panen</p>
                    <p class="text-[18px] font-bold text-gray-800">{{ \Carbon\Carbon::parse($batch->tanggal_tanam)->addDays($batch->durasi_standar_hari)->translatedFormat('d M Y') }}</p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center text-2xl shrink-0"><i class="ph ph-clock-countdown"></i></div>
                <div>
                    <p class="text-[12px] font-semibold text-gray-400 uppercase">Umur Saat Ini</p>
                    @php
                        $tglTanam = \Carbon\Carbon::parse($batch->tanggal_tanam)->startOfDay();
                        $hariIni = \Carbon\Carbon::now()->startOfDay();
                        $hariBerjalan = $tglTanam->diffInDays($hariIni, false);
                        $umur = $hariBerjalan < 0 ? 0 : (int)$hariBerjalan;
                    @endphp
                    <p class="text-[18px] font-bold text-gray-800">{{ $umur }} <span class="text-[14px] text-gray-500 font-medium">dari {{ $batch->durasi_standar_hari }} Hari</span></p>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-2xl shrink-0"><i class="ph ph-plant"></i></div>
                <div>
                    <p class="text-[12px] font-semibold text-gray-400 uppercase">Jumlah Bibit</p>
                    <p class="text-[18px] font-bold text-gray-800">{{ $batch->jumlah_bibit }} <span class="text-[14px] text-gray-500 font-medium">{{ $batch->satuan_bibit }}</span></p>
                </div>
            </div>
        </div>

        {{-- RINCIAN BIAYA & TIMELINE (GRID 2 KOLOM) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- KOTAK KIRI: BIAYA --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
                <h3 class="font-bold text-[16px] text-gray-800 mb-6 border-b border-gray-100 pb-3 flex items-center gap-2"><i class="ph ph-wallet text-primary-mid text-xl"></i> Rincian Biaya Modal</h3>
                
                <div class="space-y-3 flex-1">
                    
                    {{-- 1. BIAYA PERAWATAN --}}
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center"><i class="ph ph-wrench"></i></div>
                            <span class="text-[13px] font-bold text-gray-700">Biaya Perawatan Lain</span>
                        </div>
                        <span class="text-[14px] font-bold text-gray-900">Rp {{ number_format($totalBiayaPerawatan ?? 0, 0, ',', '.') }}</span>
                    </div>
                    
                    {{-- 2. BIAYA PUPUK --}}
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center"><i class="ph ph-flask"></i></div>
                            <span class="text-[13px] font-bold text-gray-700">Biaya Pemupukan</span>
                        </div>
                        <span class="text-[14px] font-bold text-gray-900">Rp {{ number_format($totalBiayaPupuk ?? 0, 0, ',', '.') }}</span>
                    </div>

                    {{-- 3. BIAYA HAMA --}}
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center"><i class="ph ph-bug"></i></div>
                            <span class="text-[13px] font-bold text-gray-700">Biaya Pengendalian Hama</span>
                        </div>
                        <span class="text-[14px] font-bold text-gray-900">Rp {{ number_format($totalBiayaHama ?? 0, 0, ',', '.') }}</span>
                    </div>

                </div>

                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-[13px] font-bold text-gray-500">Total Keseluruhan</span>
                    <span class="text-[20px] font-bold text-red-500">Rp {{ number_format($totalBiayaKeseluruhan ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- KOTAK KANAN: TIMELINE --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 h-full">
                <h3 class="font-bold text-[16px] text-gray-800 mb-6 border-b border-gray-100 pb-3 flex items-center gap-2"><i class="ph ph-clock-counter-clockwise text-primary-mid text-xl"></i> Timeline Kegiatan Terbaru</h3>
                
                <div class="space-y-6 max-h-[300px] overflow-y-auto pr-2">
                    @forelse($timeline as $item)
                        <div class="flex gap-4 relative">
                            @if(!$loop->last) <div class="absolute left-5 top-10 bottom-[-24px] w-0.5 bg-gray-100"></div> @endif
                            
                            <div class="w-10 h-10 shrink-0 rounded-full {{ $item['bg'] }} flex items-center justify-center z-10 border-4 border-white">
                                <i class="ph {{ $item['ikon'] }} text-lg"></i>
                            </div>
                            <div class="pt-1.5 pb-2">
                                <h4 class="text-[13px] font-bold text-gray-800">{{ $item['tipe'] }}</h4>
                                <p class="text-[11px] font-semibold text-primary-mid mb-1">{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d M Y') }}</p>
                                <p class="text-[12px] text-gray-600 leading-relaxed">{{ $item['deskripsi'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-6 text-gray-300">
                            <i class="ph ph-file-dashed text-5xl mb-2"></i>
                            <p class="text-[12px] text-gray-400 font-medium">Belum ada riwayat kegiatan untuk batch ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
        </div>
    </main>
</body>
</html>