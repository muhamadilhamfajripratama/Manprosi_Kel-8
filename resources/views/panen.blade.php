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
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3"><i class="ph ph-leaf text-white text-xl"></i></div>
            <h1 class="text-[20px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1.5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span></a>
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-sprout text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            
            {{-- Menu Aktif --}}
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition shadow-md"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
            
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span></a>
            <a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition mt-4">
                <i class="ph ph-bell-ringing text-[20px]"></i><span class="text-[15px] flex-1">Notifikasi</span>
                @if(\App\Models\BatchTanam::countNotifikasiPanen() > 0)
                    <span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">{{ \App\Models\BatchTanam::countNotifikasiPanen() }}</span>
                @endif
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-primary-mid text-white flex items-center justify-center font-semibold text-[14px]">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
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
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark">Hasil Panen</h2>
        </div>

        <div class="flex items-center justify-between mb-6">
            <div class="relative w-[300px]">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari nama lahan..." class="w-full border border-gray-200 rounded-[8px] pl-10 pr-3 py-2.5 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid shadow-sm">
            </div>
            <button onclick="bukaModal()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus font-bold"></i> Catat Panen
            </button>
        </div>

        {{-- LIST KARTU PANEN --}}
        <div class="space-y-5">
            @forelse($riwayats as $rw)
                @php
                    // Kalkulasi stok terjual dan persentase progress bar
                    $terjual = $rw->jumlah_kg - $rw->sisa_stok;
                    $persenTerjual = $rw->jumlah_kg > 0 ? ($terjual / $rw->jumlah_kg) * 100 : 0;
                    
                    // Styling dinamis berdasarkan Grade Kualitas
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

                <div class="bg-white border-l-[6px] {{ $borderColor }} rounded-[16px] p-6 shadow-sm flex flex-col gap-5">
                    
                    {{-- Header Kartu --}}
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <h3 class="text-[18px] font-bold text-gray-900">{{ $rw->batchTanam->komoditas ?? 'Unknown' }} — {{ \Carbon\Carbon::parse($rw->tanggal_panen)->translatedFormat('M Y') }}</h3>
                            <span class="border border-gray-200 text-gray-600 px-2 py-0.5 rounded-[4px] text-[11px] font-bold">{{ $rw->komoditas }}</span>
                            <span class="{{ $badgeBg }} px-2 py-0.5 rounded-[4px] text-[11px] font-bold">{{ $stars }} {{ $rw->kualitas }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-[13px] text-gray-500 font-semibold">{{ \Carbon\Carbon::parse($rw->tanggal_panen)->translatedFormat('d M Y') }}</span>
                            <div class="flex gap-2">
                                <button class="text-gray-400 hover:text-blue-500 transition"><i class="ph ph-pencil-simple text-lg"></i></button>
                                <button class="text-gray-400 hover:text-red-500 transition"><i class="ph ph-trash text-lg"></i></button>
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
                            <a href="#" class="text-[13px] font-bold text-primary-mid hover:underline">Lihat Batch &rarr;</a>
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
                        
                        {{-- Logika Redirect Otomatis + Lempar ID Panen --}}
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
                                <option value="{{ $batch->id }}">{{ $batch->komoditas }} ({{ $batch->lahan->nama_lahan ?? '-' }})</option>
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
        const modal = document.getElementById('modalPanen');
        function bukaModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        function tutupModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }

        const batches = @json($batches);
        const batchSelect = document.getElementById('batch-select');
        const tglPanenInput = document.getElementById('tanggal_panen');
        const infoStatus = document.getElementById('info-status');
        const btnSubmit = document.getElementById('btn-submit');

        function cekUmur() {
            const batchId = batchSelect.value;
            const tglPanen = new Date(tglPanenInput.value);
            
            if(!batchId) {
                infoStatus.innerHTML = `<i class="ph ph-magnifying-glass text-5xl text-gray-300 mb-3"></i><h4 class="text-[14px] font-bold text-gray-700">Pengecekan Umur</h4><p class="text-[11px] text-gray-500 mt-1">Pilih batch untuk melihat status kelayakan panen.</p>`;
                btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
                return;
            }

            const batch = batches.find(b => b.id == batchId);
            const tglTanam = new Date(batch.tanggal_tanam);
            const selisihWaktu = tglPanen.getTime() - tglTanam.getTime();
            const umurAktual = Math.floor(selisihWaktu / (1000 * 3600 * 24));
            const standar = batch.durasi_standar_hari;

            if (umurAktual < standar) {
                const kurang = standar - umurAktual;
                infoStatus.innerHTML = `
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3 text-red-500 border-4 border-white shadow-sm"><i class="ph ph-warning-circle text-3xl"></i></div>
                    <h4 class="text-[15px] font-bold text-red-600 mb-1">Belum Waktunya!</h4>
                    <p class="text-[12px] text-gray-600">Umur: <span class="font-bold text-gray-900">${umurAktual} Hari</span> / ${standar} Hari</p>
                    <p class="text-[11px] text-red-500 mt-2 font-semibold bg-red-50 p-2 rounded">Masih kurang ${kurang} hari lagi.</p>
                `;
                btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
                btnSubmit.onclick = function(e) { e.preventDefault(); Swal.fire('Ditolak!', 'Tanaman belum cukup umur untuk dipanen.', 'error'); }
            } else {
                infoStatus.innerHTML = `
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 text-green-500 border-4 border-white shadow-sm"><i class="ph ph-check-circle text-3xl"></i></div>
                    <h4 class="text-[15px] font-bold text-green-600 mb-1">Siap Panen!</h4>
                    <p class="text-[12px] text-gray-600">Umur: <span class="font-bold text-gray-900">${umurAktual} Hari</span> / ${standar} Hari</p>
                    <p class="text-[11px] text-green-600 mt-2 font-semibold bg-green-50 p-2 rounded">Kriteria umur sudah terpenuhi.</p>
                `;
                btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
                btnSubmit.onclick = null;
            }
        }

        batchSelect.addEventListener('change', cekUmur);
        tglPanenInput.addEventListener('change', cekUmur);

        @if(session('error')) Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}" }); @endif
        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}" }); @endif
    </script>
</body>
</html>