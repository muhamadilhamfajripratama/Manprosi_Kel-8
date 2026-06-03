<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Hasil Panen</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } } } }
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
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark">Hasil Panen</h2>
        </div>

        {{-- FIXED: Perbaikan tata letak kolom pencarian sejajar dengan tombol tambah --}}
        <div class="flex items-center justify-between mb-6">
            <div class="relative w-full max-w-md">
                <input type="text" id="cariPanen" onkeyup="filterPencarian()" placeholder="Cari komoditas atau nama lahan..." class="w-full border border-gray-300 rounded-[8px] pl-4 pr-10 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid bg-white shadow-sm">
                <div class="absolute right-3 top-2.5 text-gray-400">
                    <i class="ph ph-magnifying-glass text-lg"></i>
                </div>
            </div>
            <button onclick="bukaModal()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus font-bold"></i> Catat Panen
            </button>
        </div>

        {{-- LIST KARTU PANEN --}}
        <div class="space-y-5" id="riwayat-list">
            @forelse($riwayats as $rw)
                @php
                    $terjual = $rw->jumlah_kg - $rw->sisa_stok;
                    $persenTerjual = $rw->jumlah_kg > 0 ? ($terjual / $rw->jumlah_kg) * 100 : 0;
                    
                    $borderColor = 'border-green-500';
                    $badgeBg = 'bg-green-100 text-green-700';
                    $stars = '⭐⭐⭐';
                    
                    if($rw->kualitas == 'Grade B') {
                        $borderColor = 'border-amber-400';
                        $badgeBg = 'bg-amber-100 text-amber-700';
                        $stars = '⭐⭐';
                    } elseif($rw->kualitas == 'Grade C' || $rw->kualitas == 'Reject') {
                        $borderColor = 'border-red-500';
                        $badgeBg = 'bg-red-100 text-red-700';
                        $stars = '⭐';
                    }
                @endphp

                {{-- FIXED: Menyematkan class kartu-panen dan data-search untuk pencarian multispesifik --}}
                <div class="kartu-panen bg-white border-l-[6px] {{ $borderColor }} rounded-[16px] p-6 shadow-sm flex flex-col gap-5" 
                     data-search="{{ strtolower(($rw->komoditas ?? '') . ' ' . ($rw->batchTanam->komoditas ?? '') . ' ' . ($rw->batchTanam->lahan->nama_lahan ?? '')) }}">
                    
                    {{-- Header Kartu --}}
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <h3 class="text-[18px] font-bold text-gray-900">{{ $rw->batchTanam->komoditas ?? 'Unknown' }} — {{ \Carbon\Carbon::parse($rw->tanggal_panen)->translatedFormat('M Y') }}</h3>
                            <span class="border border-gray-200 text-gray-600 px-2 py-0.5 rounded-[4px] text-[11px] font-bold">{{ $rw->komoditas }}</span>
                            <span class="{{ $badgeBg }} px-2 py-0.5 rounded-[4px] text-[11px] font-bold">{{ $stars }} {{ $rw->kualitas }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-[13px] text-gray-500 font-semibold">{{ \Carbon\Carbon::parse($rw->tanggal_panen)->translatedFormat('d M Y') }}</span>
                            <div class="flex gap-2 text-gray-300">
                                <button type="button" 
                                    class="hover:text-blue-500 transition btn-edit-panen"
                                    data-id="{{ $rw->id }}"
                                    data-batch="{{ $rw->batch_id }}"
                                    data-tanggal="{{ $rw->tanggal_panen }}"
                                    data-jumlah="{{ $rw->jumlah_kg }}"
                                    data-grade="{{ $rw->kualitas }}"
                                    data-catatan="{{ $rw->catatan }}">
                                    <i class="ph ph-pencil-simple text-lg"></i>
                                </button>

                                <form action="{{ route('panen.destroy', $rw->id) }}" method="POST" class="inline form-delete-panen">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="hover:text-red-500 transition btn-hapus-panen">
                                        <i class="ph ph-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Grid Info --}}
                    <div class="grid grid-cols-4 gap-4">
                        <div>
                            <p class="text-[11px] font-semibold text-gray-400 flex items-center gap-1.5 mb-1"><i class="ph ph-package"></i> Jumlah Panen</p>
                            <p class="text-[15px] font-bold text-gray-900">{{ number_format($rw->jumlah_kg, 0, ',', '.') }} kg</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-gray-400 flex items-center gap-1.5 mb-1"><i class="ph ph-clock"></i> Umur Panen</p>
                            <p class="text-[13px] font-bold text-gray-700">{{ $rw->umur_panen_hari }} Hari</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-gray-400 flex items-center gap-1.5 mb-1"><i class="ph ph-plant"></i> Komoditas</p>
                            <p class="text-[13px] font-bold text-gray-700">{{ $rw->komoditas }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold text-gray-400 flex items-center gap-1.5 mb-1"><i class="ph ph-list-dashes"></i> Detail Batch</p>
                            {{-- FIXED: Redirect link menuju detail batch tanam menggunakan variable perulangan $rw --}}
                            <a href="{{ url('/penanaman/detail/' . $rw->batch_id) }}" class="text-[13px] font-bold text-primary-mid hover:underline">Lihat Batch &rarr;</a>
                        </div>
                    </div>
                    
                    @if($rw->catatan)
                        <p class="text-[12px] text-gray-500 italic mt-[-10px]">Catatan: "{{ $rw->catatan }}"</p>
                    @endif

                    {{-- Progress Bar & Action --}}
                    <div class="flex items-center gap-5 mt-2">
                        <div class="flex-1">
                            <div class="flex justify-between text-[11px] font-bold mb-1.5">
                                <span class="text-gray-500">Terjual: {{ number_format($terjual, 0, ',', '.') }} kg</span>
                                <span class="text-amber-600">Sisa: {{ number_format($rw->sisa_stok, 0, ',', '.') }} kg</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-[6px]">
                                <div class="bg-primary-mid h-[6px] rounded-full" style="width: {{ $persenTerjual }}%"></div>
                            </div>
                        </div>
                        
                        @if($rw->sisa_stok <= 0)
                            <button disabled class="bg-gray-200 text-gray-400 px-4 py-2.5 rounded-[8px] text-[12px] font-bold cursor-not-allowed">Input Penjualan &rarr;</button>
                        @else
                            <a href="{{ route('penjualan') }}?panen_id={{ $rw->id }}" class="bg-primary-dark text-white px-4 py-2.5 rounded-[8px] text-[12px] font-bold hover:bg-opacity-90 transition inline-block text-center whitespace-nowrap">Input Penjualan &rarr;</a>
                        @endif
                    </div>

                </div>
            @empty
                <div class="bg-white rounded-2xl p-10 text-center shadow-sm border border-gray-100">
                    <i class="ph ph-package text-5xl text-gray-300 mb-3"></i>
                    <p class="text-[14px] font-bold text-gray-600">Belum ada data panen yang dicatat.</p>
                </div>
            @endforelse
        </div>
    </main>

    {{-- MODAL PANEN DENGAN VALIDASI UI --}}
    <div id="modalPanen" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-2xl rounded-[20px] shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- Bagian Form (Kiri) --}}
            <div class="w-full md:w-3/5 p-6 border-r border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-[18px] text-primary-dark flex items-center gap-2"><i class="ph ph-package"></i> Form Panen</h3>
                    <button onclick="tutupModal()" class="text-gray-400 hover:text-red-500 md:hidden"><i class="ph ph-x text-xl"></i></button>
                </div>
                
                <form action="{{ route('panen.store') }}" method="POST" id="form-panen">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Pilih Batch Aktif <span class="text-red-500">*</span></label>
                        <select name="batch_id" id="batch-select" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                            <option value="">-- Pilih Batch Tanam --</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">
                                    {{ $batch->komoditas }} ({{ $batch->lahan->nama_lahan ?? '-' }}) 
                                    {{ $batch->status == 'selesai' ? '— [Sudah Panen]' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-[12px] font-bold text-gray-500 mb-1">Tgl Panen <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_panen" id="tanggal_panen" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[12px] font-bold text-gray-500 mb-1">Total Hasil (Kg) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.1" name="jumlah_kg" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Kualitas Panen <span class="text-red-500">*</span></label>
                        <select name="kualitas" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                            <option value="Grade A">Grade A (Premium)</option>
                            <option value="Grade B">Grade B (Standar)</option>
                            <option value="Grade C">Grade C (Kurang)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Catatan Tambahan</label>
                        <input type="text" name="catatan" placeholder="Sebagian buah terkena jamur..." class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                    
                    <div class="mt-6 flex justify-end gap-3 pt-2">
                        <button type="button" onclick="tutupModal()" class="px-5 py-2 rounded-[8px] text-[12px] font-bold text-gray-500 bg-gray-100 hover:bg-gray-200">Batal</button>
                        <button type="submit" id="btn-submit" class="px-5 py-2 rounded-[8px] text-[12px] font-bold text-white bg-primary-dark hover:bg-opacity-90 shadow-md">Proses Panen</button>
                    </div>
                </form>
            </div>

            {{-- Bagian Info Validasi (Kanan) --}}
            <div class="w-full md:w-2/5 bg-gray-50 p-6 flex flex-col items-center justify-center text-center relative">
                <button onclick="tutupModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 hidden md:block"><i class="ph ph-x text-xl"></i></button>
                
                <div id="info-status" class="w-full">
                    <i class="ph ph-magnifying-glass text-5xl text-gray-300 mb-3"></i>
                    <h4 class="text-[14px] font-bold text-gray-700">Pengecekan Umur</h4>
                    <p class="text-[11px] text-gray-500 mt-1">Pilih batch untuk melihat status kelayakan panen.</p>
                </div>
            </div>

        </div>
    </div>
    
    {{-- ALERT LOGIC & VALIDASI FRONTEND --}}
    <script>
        const daftarBatches = @json($batches);

        function dapatkanModalPanen() {
            return document.getElementById('modalPanen') 
                || document.getElementById('modalFormPanen') 
                || document.querySelector('[id*="modal"]');
        }

        function bukaModalPanen() {
            const modal = dapatkanModalPanen();
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }
        function bukaModal() { bukaModalPanen(); }

        function tutupModalPanen() {
            const modal = dapatkanModalPanen();
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            
            const form = document.getElementById('form-panen') || document.getElementById('formPanen');
            if (form) {
                form.action = "{{ route('panen.store') }}";
                form.reset();
                const methodInput = document.getElementById('method-put-panen');
                if (methodInput) methodInput.remove();
            }
            resetPanelUmur();
        }
        function tutupModal() { tutupModalPanen(); }

        // ==========================================
        // FIXED: LOGIKA FILTER PENCARIAN REAL-TIME
        // ==========================================
        function filterPencarian() {
            let input = document.getElementById('cariPanen').value.toLowerCase().trim();
            let kartuPanen = document.querySelectorAll('.kartu-panen');

            kartuPanen.forEach(kartu => {
                let textKombinasi = kartu.getAttribute('data-search') || '';
                
                if (textKombinasi.includes(input)) {
                    kartu.style.display = ""; 
                } else {
                    kartu.style.display = "none"; 
                }
            });
        }

        function hitungUmurAktual() {
            const batchId = document.getElementById('batch-select').value;
            const tglPanenVal = document.getElementById('tanggal_panen').value;
            const panelStatus = document.getElementById('info-status');

            if (!panelStatus) return;

            if (!batchId || !tglPanenVal) {
                resetPanelUmur();
                return;
            }

            const batch = daftarBatches.find(b => b.id == batchId);
            if (!batch) return;

            const tglTanam = new Date(batch.tanggal_tanam);
            const tglPanen = new Date(tglPanenVal);
            const diffTime = tglPanen.setHours(0,0,0,0) - tglTanam.setHours(0,0,0,0);
            const umurHari = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            const standar = parseInt(batch.durasi_standar_hari) || 0;

            let statusBadge = '';
            let iconClass = 'ph ph-check-circle text-green-500';
            let bgIcon = 'bg-green-50';

            if (umurHari < standar) {
                const kurang = standar - umurHari;
                iconClass = 'ph ph-clock-countdown text-red-500';
                bgIcon = 'bg-red-50';
                statusBadge = `<span class="px-3 py-1 bg-red-50 text-red-600 rounded-md text-[11px] font-bold uppercase border border-red-100">Belum Cukup Umur (Kurang ${kurang} Hari)</span>`;
            } else {
                statusBadge = `<span class="px-3 py-1 bg-green-50 text-green-600 rounded-md text-[11px] font-bold uppercase border border-green-100">Layak Panen</span>`;
            }

            panelStatus.innerHTML = `
                <div class="flex flex-col items-center justify-center space-y-4 w-full animate-fade-in">
                    <div class="w-14 h-14 rounded-full ${bgIcon} flex items-center justify-center text-2xl shadow-sm">
                        <i class="${iconClass}"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[15px] text-gray-800">${batch.komoditas}</h4>
                        <p class="text-[11px] text-gray-400 mt-0.5">Lahan: ${batch.lahan ? batch.lahan.nama_lahan : '-'}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full bg-white p-3 rounded-xl border border-gray-100 text-left shadow-sm">
                        <div>
                            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Umur Aktual</p>
                            <p class="text-[14px] font-bold text-gray-800">${umurHari} Hari</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">Standar Minimal</p>
                            <p class="text-[14px] font-bold text-gray-800">${standar} Hari</p>
                        </div>
                    </div>
                    <div class="pt-1">${statusBadge}</div>
                </div>
            `;
        }

        function resetPanelUmur() {
            const panelStatus = document.getElementById('info-status');
            if(panelStatus) {
                panelStatus.innerHTML = `
                    <i class="ph ph-magnifying-glass text-5xl text-gray-300 mb-3"></i>
                    <h4 class="text-[14px] font-bold text-gray-700">Pengecekan Umur</h4>
                    <p class="text-[11px] text-gray-500 mt-1">Pilih batch untuk melihat status kelayakan panen.</p>
                `;
            }
        }

        document.getElementById('batch-select').addEventListener('change', hitungUmurAktual);
        document.getElementById('tanggal_panen').addEventListener('change', hitungUmurAktual);

        // LOGIKA EDIT MODAL
        document.querySelectorAll('.btn-edit-panen').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                bukaModalPanen();
                
                const id = this.dataset.id;
                const form = document.getElementById('form-panen') || document.getElementById('formPanen');
                
                if (form) {
                    form.action = `/panen/${id}`;
                    let methodInput = document.getElementById('method-put-panen');
                    if(!methodInput) {
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT" id="method-put-panen">');
                    }
                }

                if(document.querySelector('[name="batch_id"]'))      document.querySelector('[name="batch_id"]').value = this.dataset.batch;
                if(document.querySelector('[name="tanggal_panen"]')) document.querySelector('[name="tanggal_panen"]').value = this.dataset.tanggal;
                if(document.querySelector('[name="jumlah_kg"]'))     document.querySelector('[name="jumlah_kg"]').value = this.dataset.jumlah;
                if(document.querySelector('[name="kualitas"]'))      document.querySelector('[name="kualitas"]').value = this.dataset.grade;
                if(document.querySelector('[name="catatan"]'))       document.querySelector('[name="catatan"]').value = this.dataset.catatan;
                
                hitungUmurAktual();
            });
        });

        // LOGIKA DELETE
        document.querySelectorAll('.btn-hapus-panen').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.form-delete-panen');
                Swal.fire({
                    title: 'Hapus Hasil Panen?',
                    text: "Data kuantitas panen ini akan terhapus permanen dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#9CA3AF',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed && form) {
                        form.submit();
                    }
                })
            });
        });

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
        @endif

        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Ditolak!', text: "{{ session('error') }}" });
        @endif
    </script>
</body>
</html>