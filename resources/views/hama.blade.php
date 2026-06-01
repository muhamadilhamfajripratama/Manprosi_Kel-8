<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Pengendalian Hama</title>
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
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-sprout text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            
            {{-- Menu Aktif Hama --}}
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition shadow-md"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span></a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span></a>
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
            <h2 class="text-[28px] font-bold text-primary-dark">Pengendalian Hama</h2>
            <button onclick="bukaModalHama()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus font-bold"></i> Catat Pengendalian
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- BAGIAN KIRI: PILIH BATCH --}}
            <div class="col-span-1 lg:col-span-4 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-bold text-[14px] text-gray-900 mb-4">Pilih Batch</h3>
                <div class="relative mb-5">
                    <input type="text" placeholder="Cari Batch..." class="w-full border border-gray-200 rounded-[8px] pl-3 pr-3 py-2 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid">
                </div>

                <div class="space-y-3">
                    @forelse($batches as $index => $batch)
                        @php $jmlTindakan = \App\Models\KegiatanHama::where('batch_id', $batch->id)->count(); @endphp
                        
                        <div class="flex items-center justify-between p-4 rounded-xl cursor-pointer transition {{ $index == 0 ? 'bg-green-50 border-l-[3px] border-primary-mid' : 'hover:bg-gray-50 border border-transparent' }}">
                            <div>
                                <h4 class="font-bold text-[14px] text-gray-900">{{ $batch->komoditas }}</h4>
                                <p class="text-[11px] text-gray-400 mt-1">{{ $batch->lahan->nama_lahan ?? 'Lahan Unknown' }}</p>
                            </div>
                            <span class="text-[12px] font-bold {{ $jmlTindakan > 0 ? 'text-primary-dark' : 'text-gray-400' }}">{{ $jmlTindakan }} Kejadian</span>
                        </div>
                    @empty
                        <p class="text-[12px] text-gray-400 text-center py-4">Belum ada batch tanam aktif.</p>
                    @endforelse
                </div>
            </div>

            {{-- BAGIAN KANAN: DETAIL & RIWAYAT (CARD STYLE) --}}
            <div class="col-span-1 lg:col-span-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                
                {{-- Filter Chips --}}
                <div class="flex flex-wrap items-center gap-3 mb-8">
                    <button class="bg-primary-dark text-white px-5 py-2 rounded-full text-[13px] font-semibold shadow-sm">Semua</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-[13px] font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                        <div class="w-2 h-2 rounded-full bg-red-500"></div> Berat
                    </button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-[13px] font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                        <div class="w-2 h-2 rounded-full bg-yellow-500"></div> Sedang
                    </button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-[13px] font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div> Ringan
                    </button>
                </div>

                {{-- List Kartu Riwayat --}}
                <div class="space-y-4">
                    @forelse($riwayats as $rw)
                        @php
                            // Pewarnaan dinamis berdasarkan tingkat keparahan
                            $borderColor = 'border-green-500'; $dotColor = 'bg-green-500'; $textColor = 'text-green-600';
                            if($rw->tingkat_keparahan == 'Sedang') { $borderColor = 'border-yellow-400'; $dotColor = 'bg-yellow-400'; $textColor = 'text-yellow-600'; }
                            if($rw->tingkat_keparahan == 'Berat') { $borderColor = 'border-red-500'; $dotColor = 'bg-red-500'; $textColor = 'text-red-600'; }
                        @endphp

                        <div class="border {{ $borderColor }} rounded-[12px] p-6 hover:shadow-sm transition bg-white relative">
                            
                            {{-- Header Kartu --}}
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2 text-[12px] font-bold text-gray-500">
                                    <div class="w-2 h-2 rounded-full {{ $dotColor }}"></div>
                                    <span class="{{ $textColor }}">{{ $rw->tingkat_keparahan }}</span>
                                    <span>&bull;</span>
                                    <span>{{ \Carbon\Carbon::parse($rw->tanggal)->translatedFormat('d M Y') }}</span>
                                </div>
<div class="flex gap-2 text-gray-300">
    {{-- Tombol Edit menggunakan Data Attributes (Aman dari sytax error JS) --}}
    <button type="button" 
        class="hover:text-blue-500 transition btn-edit-hama"
        data-id="{{ $rw->id }}"
        data-batch="{{ $rw->batch_id }}"
        data-tanggal="{{ $rw->tanggal }}"
        data-jenis="{{ $rw->jenis_hama }}"
        data-keparahan="{{ $rw->tingkat_keparahan }}"
        data-metode="{{ $rw->metode_pengendalian }}"
        data-bahan="{{ $rw->bahan_pengendalian }}"
        data-dosis="{{ $rw->dosis }}"
        data-satuan="{{ $rw->satuan }}"
        data-harga="{{ $rw->harga_beli }}"
        data-catatan="{{ $rw->catatan }}">
        <i class="ph ph-pencil-simple text-lg"></i>
    </button>

    {{-- Tombol Delete --}}
    <form action="{{ route('hama.destroy', $rw->id) }}" method="POST" class="inline form-delete-hama">
        @csrf
        @method('DELETE')
        <button type="button" class="hover:text-red-500 transition btn-hapus-hama">
            <i class="ph ph-trash text-lg"></i>
        </button>
    </form>
</div>
                            </div>
                            
                            {{-- Nama Hama --}}
                            <h3 class="text-[18px] font-bold text-gray-900 mb-6">{{ $rw->jenis_hama }}</h3>
                            
                            {{-- Grid Info --}}
                            <div class="grid grid-cols-2 md:grid-cols-2 gap-y-6 gap-x-4 mb-6">
                                <div>
                                    <p class="text-[11px] text-gray-400 mb-1 flex items-center gap-1.5"><i class="ph ph-flask"></i> Metode</p>
                                    <p class="text-[13px] font-bold text-gray-800">{{ $rw->metode_pengendalian }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-gray-400 mb-1 flex items-center gap-1.5"><i class="ph ph-test-tube"></i> Bahan</p>
                                    <p class="text-[13px] font-bold text-gray-800">{{ $rw->bahan_pengendalian }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-gray-400 mb-1 flex items-center gap-1.5"><i class="ph ph-drop"></i> Dosis</p>
                                    <p class="text-[13px] font-bold text-gray-800">{{ $rw->dosis }} {{ $rw->satuan }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-gray-400 mb-1 flex items-center gap-1.5"><i class="ph ph-money"></i> Harga Beli</p>
                                    <p class="text-[13px] font-bold text-gray-800">Rp {{ number_format($rw->harga_beli, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            {{-- Footer Kartu --}}
                            <div class="flex items-end justify-between mt-2">
                                <p class="text-[12px] text-gray-400 italic max-w-[70%]">
                                    {{ $rw->catatan ? '"'.$rw->catatan.'"' : '' }}
                                </p>
                                <span class="bg-orange-50 text-orange-600 px-3 py-1.5 rounded text-[12px] font-bold whitespace-nowrap">
                                    Total: Rp {{ number_format($rw->total_biaya, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <div class="text-center py-10 border border-dashed border-gray-200 rounded-xl">
                            <i class="ph ph-shield-check text-4xl text-gray-300 mb-2"></i>
                            <p class="text-[13px] text-gray-400">Belum ada riwayat pengendalian hama.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    {{-- MODAL CATAT HAMA --}}
    <div id="modalHama" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-xl rounded-[20px] shadow-2xl overflow-hidden transform scale-100">
            
            <div class="bg-primary-dark px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-bug"></i> Catat Tindakan Hama</h3>
                <button onclick="tutupModalHama()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>

            <form action="{{ route('hama.store') }}" method="POST" class="p-6 max-h-[85vh] overflow-y-auto">
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
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Jenis Hama/Penyakit <span class="text-red-500">*</span></label>
                        <input type="text" name="jenis_hama" placeholder="Misal: Wereng Coklat" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Tingkat Keparahan <span class="text-red-500">*</span></label>
                        <select name="tingkat_keparahan" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Metode Pengendalian <span class="text-red-500">*</span></label>
                        <input type="text" name="metode_pengendalian" placeholder="Pestisida Kimia / Mekanis" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-[12px] border border-gray-200 mb-4">
                    <h4 class="text-[12px] font-bold text-gray-800 mb-3 border-b border-gray-200 pb-2">Detail Bahan & Biaya</h4>
                    
                    <div class="mb-3">
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Bahan Pengendalian <span class="text-red-500">*</span></label>
                        <input type="text" name="bahan_pengendalian" placeholder="BVR 100 WP / Perangkap" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Dosis/Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" id="inp-dosis" name="dosis" placeholder="2" onkeyup="hitungTotalHama()" onchange="hitungTotalHama()" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Satuan <span class="text-red-500">*</span></label>
                            <input type="text" name="satuan" placeholder="kg / buah" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Harga Beli <span class="text-red-500">*</span></label>
                            <input type="number" id="inp-harga" name="harga_beli" placeholder="Rp" onkeyup="hitungTotalHama()" onchange="hitungTotalHama()" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                    </div>
                    <div class="text-right mt-3 pt-2 border-t border-gray-200">
                        <span class="text-[11px] font-bold text-gray-500">Estimasi Total Biaya: </span>
                        <span class="text-[16px] font-bold text-primary-dark">Rp <span id="out-total">0</span></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Catatan Tambahan</label>
                    <textarea name="catatan" rows="2" placeholder="Terlihat menyebar di pojok lahan..." class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid"></textarea>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-2">
                    <button type="button" onclick="tutupModalHama()" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-white bg-primary-dark hover:bg-opacity-90 transition shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const modal = document.getElementById('modalHama');
    
    function bukaModalHama() { 
        modal.classList.remove('hidden'); 
        modal.classList.add('flex'); 
    }
    
    function tutupModalHama() { 
        modal.classList.add('hidden'); 
        modal.classList.remove('flex'); 
        const form = document.getElementById('formHama');
        if(form) {
            form.action = "{{ route('hama.store') }}";
            form.reset();
            const methodInput = document.getElementById('method-put-hama');
            if(methodInput) methodInput.remove();
            document.getElementById('out-total').innerText = '0';
        }
    }

    // Kalkulator Biaya Otomatis
    function hitungTotalHama() {
        let dosis = parseFloat(document.getElementById('inp-dosis').value) || 0;
        let harga = parseFloat(document.getElementById('inp-harga').value) || 0;
        let totalBiaya = dosis * harga;
        document.getElementById('out-total').innerText = totalBiaya.toLocaleString('id-ID');
    }

    // LOGIKA EDIT: Menangkap Klik dari Atribut Data
    document.querySelectorAll('.btn-edit-hama').forEach(button => {
        button.addEventListener('click', function() {
            bukaModalHama();
            
            // Ambil semua data dari atribut tombol yang diklik
            const id = this.dataset.id;
            const form = document.getElementById('formHama');
            
            if (form) {
                form.action = `/hama/${id}`;
                let methodInput = document.getElementById('method-put-hama');
                if(!methodInput) {
                    form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT" id="method-put-hama">');
                }
            }

            // Isikan data ke input modal
            if(document.querySelector('[name="batch_id"]'))         document.querySelector('[name="batch_id"]').value = this.dataset.batch;
            if(document.querySelector('[name="tanggal"]'))          document.querySelector('[name="tanggal"]').value = this.dataset.tanggal;
            if(document.querySelector('[name="jenis_hama"]'))        document.querySelector('[name="jenis_hama"]').value = this.dataset.jenis;
            if(document.querySelector('[name="tingkat_keparahan"]')) document.querySelector('[name="tingkat_keparahan"]').value = this.dataset.keparahan;
            if(document.querySelector('[name="metode_pengendalian"]')) document.querySelector('[name="metode_pengendalian"]').value = this.dataset.metode;
            if(document.querySelector('[name="bahan_pengendalian"]'))  document.querySelector('[name="bahan_pengendalian"]').value = this.dataset.bahan;
            if(document.querySelector('[name="dosis"]'))            document.querySelector('[name="dosis"]').value = this.dataset.dosis;
            if(document.querySelector('[name="satuan"]'))           document.querySelector('[name="satuan"]').value = this.dataset.satuan;
            if(document.querySelector('[name="harga_beli"]'))       document.querySelector('[name="harga_beli"]').value = this.dataset.harga;
            if(document.querySelector('[name="catatan"]'))          document.querySelector('[name="catatan"]').value = this.dataset.catatan;

            // Hitung ulang total harga pupuk/pestisida di dalam modal
            hitungTotalHama();
        });
    });

    // LOGIKA SWEETALERT: Konfirmasi Hapus
    document.querySelectorAll('.btn-hapus-hama').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.form-delete-hama');
            Swal.fire({
                title: 'Hapus Catatan Hama?',
                text: "Data riwayat hama ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#9CA3AF',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });

    // Tampilkan Alert Flash Session jika ada
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
    @endif
    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}" });
    @endif
</script>
</body>
</html>