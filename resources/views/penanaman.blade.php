<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Penanaman</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D', light: '#E8F5E9' }, cream: '#EEEEEE' }
                }
            }
        }
    </script>
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

            <a href="{{ route('pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
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
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <div class="mb-2">
            <h2 class="text-[28px] font-bold text-primary-dark">Batch Tanam</h2>
        </div>

        {{-- SEARCH & ACTION BAR --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="relative w-full md:w-80">
                <i class="ph ph-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                {{-- FIXED: Tambahkan ID dan fungsi onkeyup --}}
                <input type="text" id="cariPenanaman" onkeyup="filterPenanaman()" placeholder="Cari komoditas atau nama lahan..." class="w-full border border-gray-300 rounded-full pl-11 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid shadow-sm">
            </div>
            <button onclick="bukaModalTanam()" class="bg-primary-dark text-white px-6 py-2.5 rounded-full font-semibold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-md">
                <i class="ph ph-plus font-bold"></i> Tambah Batch
            </button>
        </div>

        {{-- CARD GRID LAYOUT --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
            
            @forelse($batches as $batch)
                @php
                    // KALKULASI TANGGAL & PROGRESS
                    $tglTanam = \Carbon\Carbon::parse($batch->tanggal_tanam);
                    $estPanen = $tglTanam->copy()->addDays($batch->durasi_standar_hari);
                    $hariIni = \Carbon\Carbon::now();
                    
                    $totalHari = $batch->durasi_standar_hari;
                    $hariBerjalan = $tglTanam->diffInDays($hariIni, false); 
                    
                    if($hariBerjalan < 0) { $progress = 0; }
                    elseif($hariBerjalan > $totalHari) { $progress = 100; }
                    else { $progress = round(($hariBerjalan / $totalHari) * 100); }

                    // Dinamis Nama Batch
                    $namaBatch = $batch->komoditas . ' — ' . $tglTanam->translatedFormat('F Y');
                @endphp

                {{-- FIXED: Tambahkan class 'batch-card' dan attribut data-search --}}
                <div class="batch-card bg-white rounded-2xl shadow-sm border-t-[6px] {{ $batch->status == 'aktif' ? 'border-primary-dark' : 'border-gray-400' }} p-6 flex flex-col justify-between"
                     data-search="{{ strtolower(($batch->komoditas ?? '') . ' ' . ($batch->lahan->nama_lahan ?? '')) }}">
                    
                    {{-- Header Card --}}
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-[18px] font-bold text-gray-900 leading-tight">{{ $namaBatch }}</h3>
                            
                            {{-- BUNGKUSAN BARU UNTUK BADGE & TOMBOL EDIT/DELETE --}}
                            <div class="flex items-center gap-3">
                                @if($batch->status == 'aktif')
                                    <span class="bg-primary-light text-primary-dark px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">Aktif</span>
                                @else
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">Selesai</span>
                                @endif

                                <div class="flex gap-2 text-gray-400">
                                    <button type="button" 
                                        class="hover:text-blue-500 transition btn-edit-penanaman"
                                        data-id="{{ $batch->id }}"
                                        data-lahan="{{ $batch->lahan_id }}"
                                        data-komoditas="{{ $batch->komoditas }}"
                                        data-tanggal="{{ $batch->tanggal_tanam }}"
                                        data-asal="{{ $batch->asal_bibit }}"
                                        data-jumlah="{{ $batch->jumlah_bibit }}"
                                        data-satuan="{{ $batch->satuan_bibit }}"
                                        data-jarak="{{ $batch->jarak_tanam_cm }}"
                                        data-metode="{{ $batch->metode_tanam }}"
                                        data-durasi="{{ $batch->durasi_standar_hari }}"
                                        data-catatan="{{ $batch->catatan }}">
                                        <i class="ph ph-pencil-simple text-lg"></i>
                                    </button>

                                    <form action="{{ route('penanaman.destroy', $batch->id) }}" method="POST" class="inline form-delete-penanaman">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="hover:text-red-500 transition btn-hapus-penanaman">
                                            <i class="ph ph-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="bg-primary-light text-primary-dark px-2.5 py-1 rounded-md text-[11px] font-semibold flex items-center gap-1.5">
                                <i class="ph ph-plant"></i> {{ $batch->komoditas }}
                            </span>
                            <span class="bg-blue-50 text-blue-600 px-2.5 py-1 rounded-md text-[11px] font-semibold flex items-center gap-1.5">
                                <i class="ph ph-map-pin"></i> {{ $batch->lahan ? $batch->lahan->nama_lahan : 'Lahan Dihapus' }}
                            </span>
                        </div>

                        {{-- Grid Data 2x2 --}}
                        <div class="grid grid-cols-2 gap-y-4 gap-x-2 mb-6">
                            <div>
                                <p class="text-[11px] text-gray-400 mb-0.5">Tgl Tanam</p>
                                <p class="text-[13px] font-semibold text-gray-800">{{ $tglTanam->translatedFormat('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-400 mb-0.5">Asal Bibit</p>
                                <p class="text-[13px] font-semibold text-gray-800">{{ $batch->asal_bibit }} ({{ $batch->jumlah_bibit }} {{ $batch->satuan_bibit }})</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-400 mb-0.5">Jarak Tanam</p>
                                <p class="text-[13px] font-semibold text-gray-800">{{ $batch->jarak_tanam_cm }} cm</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-400 mb-0.5">Metode Tanam</p>
                                <p class="text-[13px] font-semibold text-gray-800">{{ $batch->metode_tanam }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Progress & Footer Action --}}
                    <div>
                        <div class="mb-4">
                            <div class="flex justify-between items-end mb-1.5">
                                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Progress Pertumbuhan</span>
                                <span class="text-[12px] font-bold text-primary-mid">{{ $progress }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-primary-mid h-full rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <p class="text-[12px] font-semibold text-gray-600 mt-2 flex items-center gap-1.5">
                                <i class="ph ph-calendar-blank text-gray-400"></i> Est. Panen: <span class="text-gray-900">{{ $estPanen->translatedFormat('d M Y') }}</span>
                            </p>
                        </div>

                            <div class="grid grid-cols-2 gap-3 mt-5">
                            {{-- Ubah jadi tag <a> agar bisa pindah halaman --}}
                            <a href="{{ url('/penanaman/detail/' . $batch->id) }}" class="w-full flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-xl py-2.5 text-[13px] font-bold transition">
                                Detail
                            </a>
                            @if($batch->status == 'aktif')
                                {{-- Tambahkan onclick untuk memanggil modal --}}
                                <button onclick="bukaModalKegiatan('{{ $batch->id }}', '{{ $batch->komoditas }}')" class="w-full bg-primary-dark text-white rounded-xl py-2.5 text-[13px] font-bold hover:bg-opacity-90 shadow-sm transition">
                                    Catat Kegiatan
                                </button>
                            @else
                                <button disabled class="w-full bg-gray-200 text-gray-400 rounded-xl py-2.5 text-[13px] font-bold cursor-not-allowed">
                                    Selesai
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-1 md:col-span-2 text-center py-16 bg-white rounded-2xl border border-dashed border-gray-300">
                    <i class="ph ph-plant text-5xl text-gray-300 mb-3"></i>
                    <h3 class="text-lg font-bold text-gray-700">Belum ada Batch Tanam</h3>
                    <p class="text-sm text-gray-500 mt-1">Klik tombol 'Tambah Batch' di pojok kanan atas untuk memulai.</p>
                </div>
            @endforelse

        </div>

        {{-- Pagination (Statis Mockup) --}}
        @if(count($batches) > 0)
        <div class="flex justify-center mt-10">
            <div class="flex items-center gap-2">
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-400 hover:bg-white"><i class="ph ph-caret-left"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded bg-primary-dark text-white font-bold text-sm shadow">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white text-gray-600 font-bold text-sm hover:bg-gray-50">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 bg-white text-gray-600 font-bold text-sm hover:bg-gray-50">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-200 text-gray-600 bg-white hover:bg-gray-50"><i class="ph ph-caret-right"></i></button>
            </div>
        </div>
        @endif
    </main>

    {{-- MODAL TAMBAH BATCH BARU --}}
    <div id="modalTanam" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-2xl rounded-[20px] shadow-2xl overflow-hidden transform scale-100">
            
            <div class="bg-primary-dark px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-sprout"></i> Tambah Batch Baru</h3>
                <button onclick="tutupModalTanam()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>

            <form action="{{ route('penanaman.store') }}" method="POST" id="formPenanaman" class="p-6 max-h-[85vh] overflow-y-auto">
                @csrf
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Pilih Lahan <span class="text-red-500">*</span></label>
                        <select name="lahan_id" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2.5 text-sm focus:outline-none focus:border-primary-mid">
                            <option value="">-- Pilih Lahan --</option>
                            @foreach($lahans as $lahan)
                                <option value="{{ $lahan->id }}">{{ $lahan->nama_lahan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Komoditas <span class="text-red-500">*</span></label>
                        <input type="text" name="komoditas" required placeholder="Misal: Padi Sawah" class="w-full border border-gray-200 rounded-[8px] px-3 py-2.5 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Tanggal Tanam <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_tanam" required value="{{ date('Y-m-d') }}" class="w-full border border-gray-200 rounded-[8px] px-3 py-2.5 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Durasi Standar (Hari) <span class="text-red-500">*</span></label>
                        <input type="number" name="durasi_standar_hari" required placeholder="Misal: 110" class="w-full border border-gray-200 rounded-[8px] px-3 py-2.5 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-[12px] p-4 mb-4">
                    <h4 class="text-[13px] font-bold text-gray-800 mb-3 border-b pb-2">Detail Pembibitan</h4>
                    
                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Asal Bibit</label>
                            <input type="text" name="asal_bibit" required placeholder="Toko Tani" class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Metode Tanam</label>
                            <select name="metode_tanam" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                                <option value="Bibit">Biji Langsung</option>
                                <option value="Semai">Semai Dulu</option>
                                <option value="Pindah Tanam">Pindah Tanam</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Jumlah</label>
                            <input type="number" step="0.01" name="jumlah_bibit" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Satuan</label>
                            <input type="text" name="satuan_bibit" required placeholder="Kg" class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Jarak Tanam</label>
                            <input type="text" name="jarak_tanam_cm" required placeholder="25x25" class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" rows="2" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid"></textarea>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-2">
                    <button type="button" onclick="tutupModalTanam()" class="px-6 py-2.5 rounded-full text-[13px] font-bold text-gray-500 bg-gray-200 hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-full text-[13px] font-bold text-white bg-primary-dark hover:bg-opacity-90 transition shadow-md">Simpan Batch</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL PILIH KEGIATAN (Opsi Jalan Pintas) --}}
    <div id="modalKegiatan" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-sm rounded-[20px] shadow-2xl overflow-hidden transform scale-100 p-6">
            <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-3">
                <h3 class="font-bold text-[16px] text-gray-800 flex items-center gap-2"><i class="ph ph-squares-four text-primary-mid"></i> Catat Kegiatan</h3>
                <button onclick="tutupModalKegiatan()" class="text-gray-400 hover:text-red-500 transition"><i class="ph ph-x text-xl"></i></button>
            </div>
            
            <p class="text-[12px] text-gray-500 mb-5">Pilih kegiatan apa yang ingin dicatat untuk batch <strong id="nama-batch-kegiatan" class="text-primary-dark"></strong> ini:</p>
            
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('irigasi') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-blue-100 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:shadow-sm transition">
                    <i class="ph ph-drop text-2xl mb-1"></i>
                    <span class="text-[11px] font-bold">Irigasi Air</span>
                </a>
                <a href="{{ route('pemupukan') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-green-100 bg-green-50 text-green-600 hover:bg-green-100 hover:shadow-sm transition">
                    <i class="ph ph-flask text-2xl mb-1"></i>
                    <span class="text-[11px] font-bold">Pemupukan</span>
                </a>
                <a href="{{ route('hama') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-red-100 bg-red-50 text-red-500 hover:bg-red-100 hover:shadow-sm transition">
                    <i class="ph ph-bug text-2xl mb-1"></i>
                    <span class="text-[11px] font-bold">Cek Hama</span>
                </a>
                <a href="{{ route('perawatan') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border border-amber-100 bg-amber-50 text-amber-600 hover:bg-amber-100 hover:shadow-sm transition">
                    <i class="ph ph-wrench text-2xl mb-1"></i>
                    <span class="text-[11px] font-bold">Perawatan</span>
                </a>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ==========================================
        // FIXED: FUNGSI PENCARIAN PENANAMAN (REAL-TIME)
        // ==========================================
        function filterPenanaman() {
            let input = document.getElementById('cariPenanaman').value.toLowerCase().trim();
            let cards = document.querySelectorAll('.batch-card');

            cards.forEach(card => {
                let textData = card.getAttribute('data-search') || '';
                if (textData.includes(input)) {
                    card.style.display = ""; 
                } else {
                    card.style.display = "none"; 
                }
            });
        }

        // ==========================================
        // LOGIKA MODAL CATAT KEGIATAN (JALAN PINTAS)
        // ==========================================
        const modalKegiatan = document.getElementById('modalKegiatan');
        
        function bukaModalKegiatan(idBatch, namaKomoditas) {
            document.getElementById('nama-batch-kegiatan').innerText = namaKomoditas;
            modalKegiatan.classList.remove('hidden');
            modalKegiatan.classList.add('flex');
        }

        function tutupModalKegiatan() {
            modalKegiatan.classList.add('hidden');
            modalKegiatan.classList.remove('flex');
        }

        // ==========================================
        // LOGIKA MODAL TAMBAH & EDIT PENANAMAN
        // ==========================================
        function dapatkanModalPenanaman() {
            return document.getElementById('modalTanam') || document.querySelector('[id*="modal"]');
        }

        function bukaModalTanam() {
            const modal = dapatkanModalPenanaman();
            if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        }

        function tutupModalTanam() {
            const modal = dapatkanModalPenanaman();
            if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
            
            const form = document.getElementById('formPenanaman');
            if (form) {
                form.action = "{{ route('penanaman.store') }}";
                form.reset();
                const methodInput = document.getElementById('method-put-penanaman');
                if (methodInput) methodInput.remove();
            }
        }

        // LOGIKA EDIT: Tangkap data kartu ke dalam modal
        document.querySelectorAll('.btn-edit-penanaman').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                bukaModalTanam();
                
                const id = this.dataset.id;
                const form = document.getElementById('formPenanaman');
                
                if (form) {
                    form.action = `/penanaman/${id}`;
                    let methodInput = document.getElementById('method-put-penanaman');
                    if(!methodInput) {
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT" id="method-put-penanaman">');
                    }
                }

                if(document.querySelector('[name="lahan_id"]'))            document.querySelector('[name="lahan_id"]').value = this.dataset.lahan;
                if(document.querySelector('[name="komoditas"]'))           document.querySelector('[name="komoditas"]').value = this.dataset.komoditas;
                if(document.querySelector('[name="tanggal_tanam"]'))       document.querySelector('[name="tanggal_tanam"]').value = this.dataset.tanggal;
                if(document.querySelector('[name="asal_bibit"]'))          document.querySelector('[name="asal_bibit"]').value = this.dataset.asal;
                if(document.querySelector('[name="jumlah_bibit"]'))        document.querySelector('[name="jumlah_bibit"]').value = this.dataset.jumlah;
                if(document.querySelector('[name="satuan_bibit"]'))        document.querySelector('[name="satuan_bibit"]').value = this.dataset.satuan;
                if(document.querySelector('[name="jarak_tanam_cm"]'))      document.querySelector('[name="jarak_tanam_cm"]').value = this.dataset.jarak;
                if(document.querySelector('[name="metode_tanam"]'))        document.querySelector('[name="metode_tanam"]').value = this.dataset.metode;
                if(document.querySelector('[name="durasi_standar_hari"]')) document.querySelector('[name="durasi_standar_hari"]').value = this.dataset.durasi;
                if(document.querySelector('[name="catatan"]'))             document.querySelector('[name="catatan"]').value = this.dataset.catatan;
            });
        });

        // LOGIKA DELETE
        document.querySelectorAll('.btn-hapus-penanaman').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.form-delete-penanaman');
                Swal.fire({
                    title: 'Hapus Batch Tanam?',
                    text: "Data akan dihapus permanen! Pastikan tidak ada data terkait.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#9CA3AF',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed && form) form.submit();
                });
            });
        });

        // ALERT NOTIFIKASI
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{!! session('success') !!}", timer: 3000, showConfirmButton: false });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Gagal!', text: "{!! session('error') !!}" });
            @endif
        });
    </script>
</body>
</html>