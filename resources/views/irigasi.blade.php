<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Pengairan & Irigasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-700 h-screen flex overflow-hidden">

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
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark">Pengairan dan Irigasi</h2>
            <button onclick="bukaModalIrigasi()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus font-bold"></i> Catat Pengairan
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- BAGIAN KIRI: PILIH BATCH --}}
            <div class="col-span-1 lg:col-span-5 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-bold text-[14px] text-gray-900 mb-4">Pilih Batch Tanam</h3>
                <div class="relative mb-5">
                    <input type="text" placeholder="Cari Batch..." class="w-full border border-gray-200 rounded-[8px] pl-3 pr-3 py-2 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid">
                </div>

                <div class="space-y-3">
                    @forelse($batches as $batch)
                        @php
                            // Menghitung jumlah irigasi spesifik untuk batch ini secara langsung
                            $jmlIrigasiBatch = \App\Models\KegiatanIrigasi::where('batch_id', $batch->id)->count();
                            $tglTanam = \Carbon\Carbon::parse($batch->tanggal_tanam)->translatedFormat('d M');
                            
                            // Cek apakah batch ini sedang diklik (aktif)
                            $isActive = ($selectedBatchId == $batch->id);
                        @endphp
                        
                        {{-- MENGUBAH DIV MENJADI TAG LINK (A) AGAR BISA DIKLIK --}}
                        <a href="{{ route('irigasi', ['batch_id' => $batch->id]) }}" class="flex items-center justify-between p-4 rounded-xl cursor-pointer transition block {{ $isActive ? 'bg-green-50 border-l-4 border-primary-mid shadow-sm' : 'hover:bg-gray-50 border border-gray-100' }}">
                            <div>
                                <h4 class="font-bold text-[14px] text-gray-900">{{ $batch->komoditas }}</h4>
                                <p class="text-[11px] text-gray-500 mt-1">{{ $batch->lahan->nama_lahan ?? 'Lahan Unknown' }} - Tanam: {{ $tglTanam }}</p>
                            </div>
                            <span class="bg-green-100 text-primary-dark px-2.5 py-1 rounded text-[11px] font-bold">
                                {{ $jmlIrigasiBatch }}x Irigasi
                            </span>
                        </a>
                    @empty
                        <p class="text-[12px] text-gray-400 text-center py-4">Belum ada batch tanam aktif.</p>
                    @endforelse
                </div>
            </div>

            {{-- BAGIAN KANAN: DETAIL & RIWAYAT (CARD STYLE) --}}
            <div class="col-span-1 lg:col-span-7 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                
                {{-- Header Detail --}}
                <div class="mb-8">
                    <h3 class="text-[20px] font-bold text-gray-900">Rekapitulasi Pengairan</h3>
                    <p class="text-[12px] text-gray-400 mt-1">Total seluruh air yang disalurkan pada lahan ini</p>
                    
                    <div class="flex flex-wrap gap-3 mt-4">
                        <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-[13px] font-bold flex items-center gap-2 border border-blue-100">
                            <i class="ph ph-drop text-lg"></i> Total Air: {{ number_format($totalDebit, 0, ',', '.') }} L
                        </span>
                        <span class="bg-green-50 text-green-700 px-4 py-2 rounded-full text-[13px] font-bold flex items-center gap-2 border border-green-100">
                            Jumlah Irigasi: {{ $totalIrigasi }}x
                        </span>
                    </div>
                </div>

                {{-- Judul Riwayat --}}
                <div class="flex items-center gap-2 mb-4">
                    <i class="ph ph-calendar-blank text-gray-400"></i>
                    <span class="text-[13px] font-semibold text-gray-500">Riwayat Pengairan</span>
                </div>

                {{-- List Kartu Riwayat --}}
                <div class="space-y-4">
                    @forelse($riwayats as $rw)
                        <div class="border border-gray-100 rounded-[12px] p-5 hover:shadow-sm transition bg-white">
                            {{-- Header Kartu (Tanggal & Aksi) --}}
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="text-[13px] font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($rw->tanggal)->translatedFormat('l, d M Y') }}
                                </h4>
<div class="flex gap-2 text-gray-300">
    {{-- Tombol Edit Menggunakan Data Attributes (Aman & Rapih) --}}
    <button type="button" 
        class="hover:text-blue-500 transition btn-edit-irigasi"
        data-id="{{ $rw->id }}"
        data-batch="{{ $rw->batch_id }}"
        data-tanggal="{{ $rw->tanggal }}"
        data-volume="{{ $rw->debit_liter }}"
        data-sumber="{{ $rw->sumber_pengairan }}"
        data-catatan="{{ $rw->catatan }}">
        <i class="ph ph-pencil-simple text-lg"></i>
    </button>

    {{-- Tombol Delete Terproteksi --}}
    <form action="{{ route('irigasi.destroy', $rw->id) }}" method="POST" class="inline form-delete-irigasi">
        @csrf
        @method('DELETE')
        <button type="button" class="hover:text-red-500 transition btn-hapus-irigasi">
            <i class="ph ph-trash text-lg"></i>
        </button>
    </form>
</div>
                            </div>
                            
                            {{-- Body Kartu (Volume) --}}
                            <div class="flex items-center gap-2 mb-3">
                                <i class="ph ph-drop text-blue-500 text-[22px]"></i>
                                <span class="text-[20px] font-bold text-gray-900">{{ number_format($rw->debit_liter, 0, ',', '.') }} Liter</span>
                            </div>
                            
                            {{-- Footer Kartu (Sumber & Catatan) --}}
                            <div class="flex flex-col gap-2">
                                <span class="inline-block border border-gray-200 text-gray-500 text-[11px] font-semibold px-2.5 py-1 rounded w-max">
                                    {{ $rw->sumber_pengairan ?? 'Sumber Tidak Diketahui' }}
                                </span>
                                @if($rw->catatan)
                                    <p class="text-[12px] text-gray-400 italic mt-1">"{{ $rw->catatan }}"</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 border border-dashed border-gray-200 rounded-xl">
                            <i class="ph ph-drop text-4xl text-gray-300 mb-2"></i>
                            <p class="text-[13px] text-gray-400">Belum ada riwayat pengairan dicatat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    {{-- MODAL CATAT IRIGASI --}}
    <div id="modalIrigasi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-lg rounded-[20px] shadow-2xl overflow-hidden transform scale-100">
            
            <div class="bg-primary-dark px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-drop"></i> Catat Pengairan</h3>
                <button onclick="tutupModalIrigasi()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>

            <form action="{{ route('irigasi.store') }}" method="POST" id="formIrigasi" class="p-6">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Pilih Batch Tanam <span class="text-red-500">*</span></label>
                    <select name="batch_id" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                        <option value="">-- Pilih Batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ $selectedBatchId == $batch->id ? 'selected' : '' }}>
                                {{ $batch->komoditas }} ({{ $batch->lahan->nama_lahan ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Debit Air (Liter) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="debit_liter" placeholder="Misal: 150" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Sumber Pengairan</label>
                    <input type="text" name="sumber_pengairan" placeholder="Misal: Sumur / Sungai" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                </div>

                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Catatan Tambahan</label>
                    <textarea name="catatan" rows="2" placeholder="Cuaca sangat panas, volume ditambah..." class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid"></textarea>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-2">
                    <button type="button" onclick="tutupModalIrigasi()" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-white bg-primary-dark hover:bg-opacity-90 transition shadow-md">Simpan Pengairan</button>
                </div>
            </form>
        </div>
    </div>

{{-- Script Validasi & Interaksi Irigasi --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function dapatkanModalIrigasi() {
            return document.getElementById('modalIrigasi') || document.querySelector('[id*="modal"]');
        }

        // BUKA MODAL
        function bukaModalIrigasi() {
            const modal = dapatkanModalIrigasi();
            if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        }
        function bukaModal() { bukaModalIrigasi(); }

        // TUTUP MODAL & RESET
        function tutupModalIrigasi() {
            const modal = dapatkanModalIrigasi();
            if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); }
            
            const form = document.getElementById('formIrigasi');
            if (form) {
                form.action = "{{ route('irigasi.store') }}";
                form.reset();
                const methodInput = document.getElementById('method-put-irigasi');
                if (methodInput) methodInput.remove();
            }
        }
        function tutupModal() { tutupModalIrigasi(); }

        // LOGIKA EDIT: Tangkap Klik & Isi Modal
        document.querySelectorAll('.btn-edit-irigasi').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                bukaModalIrigasi();
                
                const id = this.dataset.id;
                const form = document.getElementById('formIrigasi');
                
                if (form) {
                    form.action = `/irigasi/${id}`;
                    let methodInput = document.getElementById('method-put-irigasi');
                    if(!methodInput) {
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT" id="method-put-irigasi">');
                    }
                }

                if(document.querySelector('[name="batch_id"]'))        document.querySelector('[name="batch_id"]').value = this.dataset.batch;
                if(document.querySelector('[name="tanggal"]'))          document.querySelector('[name="tanggal"]').value = this.dataset.tanggal;
                if(document.querySelector('[name="debit_liter"]'))      document.querySelector('[name="debit_liter"]').value = this.dataset.volume;
                if(document.querySelector('[name="sumber_pengairan"]')) document.querySelector('[name="sumber_pengairan"]').value = this.dataset.sumber;
                if(document.querySelector('[name="catatan"]'))          document.querySelector('[name="catatan"]').value = this.dataset.catatan;
            });
        });

        // LOGIKA DELETE: SweetAlert2
        document.querySelectorAll('.btn-hapus-irigasi').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('.form-delete-irigasi');
                Swal.fire({
                    title: 'Hapus Riwayat?',
                    text: "Data pengairan ini akan dihapus dari sistem!",
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
        
        // PERBAIKAN ALERT: Dibungkus DOMContentLoaded agar jalan sempurna saat halaman di-load
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({ 
                    icon: 'success', 
                    title: 'Berhasil!', 
                    text: "{!! session('success') !!}", 
                    timer: 3000, 
                    showConfirmButton: false 
                });
            @endif

            @if(session('error'))
                Swal.fire({ 
                    icon: 'error', 
                    title: 'Gagal!', 
                    text: "{!! session('error') !!}" 
                });
            @endif
        });
    </script>
</body>
</html>