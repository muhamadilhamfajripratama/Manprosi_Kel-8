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
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-sprout text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            
            {{-- Menu Aktif --}}
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition shadow-md"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            
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
                    @forelse($batches as $index => $batch)
                        @php
                            // Menghitung jumlah irigasi spesifik untuk batch ini secara langsung
                            $jmlIrigasiBatch = \App\Models\KegiatanIrigasi::where('batch_id', $batch->id)->count();
                            $tglTanam = \Carbon\Carbon::parse($batch->tanggal_tanam)->translatedFormat('d M');
                        @endphp
                        
                        {{-- Efek aktif otomatis pada batch pertama --}}
                        <div class="flex items-center justify-between p-4 rounded-xl cursor-pointer transition {{ $index == 0 ? 'bg-green-50 border-l-4 border-primary-mid' : 'hover:bg-gray-50 border border-gray-100' }}">
                            <div>
                                <h4 class="font-bold text-[14px] text-gray-900">{{ $batch->komoditas }}</h4>
                                <p class="text-[11px] text-gray-500 mt-1">{{ $batch->lahan->nama_lahan ?? 'Lahan Unknown' }} - Tanam: {{ $tglTanam }}</p>
                            </div>
                            <span class="bg-green-100 text-primary-dark px-2.5 py-1 rounded text-[11px] font-bold">
                                {{ $jmlIrigasiBatch }}x Irigasi
                            </span>
                        </div>
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
                    <p class="text-[12px] text-gray-400 mt-1">Total seluruh air yang telah disalurkan</p>
                    
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
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-drop"></i> Catat Pengairan Baru</h3>
                <button onclick="tutupModalIrigasi()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>

            <form action="{{ route('irigasi.store') }}" method="POST" id="formIrigasi" class="p-6">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Pilih Batch Tanam <span class="text-red-500">*</span></label>
                    <select name="batch_id" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                        <option value="">-- Pilih Batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->komoditas }} ({{ $batch->lahan->nama_lahan ?? '-' }})</option>
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

                // PERBAIKAN: Menyesuaikan atribut name dengan form HTML kamu
                if(document.querySelector('[name="batch_id"]'))         document.querySelector('[name="batch_id"]').value = this.dataset.batch;
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