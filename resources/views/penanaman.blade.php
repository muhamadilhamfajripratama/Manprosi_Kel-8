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

    {{-- SIDEBAR NAVBAR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1.5">
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span></a>
            
            {{-- Menu Aktif --}}
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition"><i class="ph ph-sprout text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span></a>
        </nav>
        
        <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-primary-mid text-white flex items-center justify-center font-semibold text-[14px]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                    <span class="text-[11px] text-white/60 capitalize">{{ Auth::user()->role ?? 'Petani' }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto p-10">
        
        <div class="mb-2">
            <h2 class="text-[28px] font-bold text-primary-dark">Batch Tanam</h2>
        </div>

        {{-- SEARCH & ACTION BAR --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="relative w-full md:w-80">
                <i class="ph ph-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                <input type="text" placeholder="Cari nama lahan..." class="w-full border border-gray-300 rounded-full pl-11 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid shadow-sm">
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

                <div class="bg-white rounded-2xl shadow-sm border-t-[6px] {{ $batch->status == 'aktif' ? 'border-primary-dark' : 'border-primary-dark' }} p-6 flex flex-col justify-between">
                    
                    {{-- Header Card --}}
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-[18px] font-bold text-gray-900 leading-tight">{{ $namaBatch }}</h3>
                            @if($batch->status == 'aktif')
                                <span class="bg-primary-light text-primary-dark px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">Aktif</span>
                            @else
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">Selesai</span>
                            @endif
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
                            <button class="w-full border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-xl py-2.5 text-[13px] font-bold transition">
                                Detail
                            </button>
                            @if($batch->status == 'aktif')
                                <button class="w-full bg-primary-dark text-white rounded-xl py-2.5 text-[13px] font-bold hover:bg-opacity-90 shadow-sm transition">
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

            <form action="{{ route('penanaman.store') }}" method="POST" class="p-6 max-h-[85vh] overflow-y-auto">
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

    <script>
        const modalTanam = document.getElementById('modalTanam');
        function bukaModalTanam() {
            modalTanam.classList.remove('hidden');
            modalTanam.classList.add('flex');
        }
        function tutupModalTanam() {
            modalTanam.classList.add('hidden');
            modalTanam.classList.remove('flex');
        }
    </script>
</body>
</html>