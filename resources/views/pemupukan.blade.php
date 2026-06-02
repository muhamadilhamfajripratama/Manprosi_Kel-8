<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Pemupukan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { 
                        primary: { dark: '#004F3B', mid: '#43B75D', light: '#E8F5E9' },
                        cream: '#F4F7F6' 
                    }
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
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-8">
        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-[28px] font-bold text-primary-dark">Pemupukan</h2>
            <button onclick="bukaModalCatat()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[14px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus"></i> Catat Pemupukan
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            {{-- BAGIAN KIRI: PILIH BATCH --}}
            <div class="col-span-1 lg:col-span-4 bg-white rounded-[16px] p-5 shadow-sm border border-gray-100">
                <h3 class="font-bold text-[14px] text-gray-900 mb-3">Pilih Batch</h3>
                <div class="relative mb-4">
                    <input type="text" placeholder="Cari Batch..." class="w-full border border-gray-200 rounded-[8px] pl-3 pr-3 py-2 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid">
                </div>

                <div class="space-y-2">
                    @forelse($batches as $batch)
                        <div class="flex items-center justify-between p-3 rounded-[10px] cursor-pointer transition hover:bg-gray-50 border border-gray-100">
                            <div>
                                {{-- PERBAIKAN: Menampilkan komoditas dan nama lahan dengan benar --}}
                                <h4 class="font-bold text-[14px] text-gray-900">{{ $batch->komoditas }}</h4>
                                <p class="text-[12px] text-gray-500 mt-0.5">
                                    <i class="ph ph-map-pin"></i> {{ $batch->lahan ? $batch->lahan->nama_lahan : 'Lahan tidak diketahui' }}
                                </p>
                            </div>
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-bold uppercase">Aktif</span>
                        </div>
                    @empty
                        <p class="text-[12px] text-gray-400 text-center py-4">Belum ada batch tanam aktif.</p>
                    @endforelse
                </div>
            </div>

            {{-- BAGIAN KANAN: DETAIL PEMUPUKAN --}}
            <div class="col-span-1 lg:col-span-8 space-y-6">
                
                {{-- SUMMARY CARDS STATISTIK (Dinamis dari Controller) --}}
                <div class="flex gap-4">
                    <div class="bg-white px-6 py-4 rounded-[16px] shadow-sm border border-gray-100 min-w-[200px]">
                        <p class="text-[11px] font-bold text-orange-500 uppercase">Total Biaya Pupuk</p>
                        <h3 class="text-[20px] font-bold text-gray-900 mt-1">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-primary-light px-6 py-4 rounded-[16px] shadow-sm border border-green-100 min-w-[200px]">
                        <p class="text-[11px] font-bold text-primary-dark uppercase">Jumlah Pemupukan</p>
                        <h3 class="text-[20px] font-bold text-gray-900 mt-1">{{ $totalPemupukan }} Kali</h3>
                    </div>
                </div>

                {{-- TABEL RIWAYAT --}}
                <div class="bg-white rounded-[16px] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-primary-dark text-white text-[12px] font-semibold uppercase tracking-wider">
                        <tr>
                            <th class="px-5 py-4 rounded-tl-lg">Tanggal</th>
                            <th class="px-5 py-4">Jenis Pupuk</th>
                            <th class="px-5 py-4 text-center">Dosis</th>
                            <th class="px-5 py-4">Harga Beli</th>
                            <th class="px-5 py-4">Total Biaya</th>
                            <th class="px-5 py-4 text-center rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13px] text-gray-700 divide-y divide-gray-100 bg-white">
                        @forelse($riwayats as $rw)
                            <tr class="hover:bg-gray-50 transition-colors">
                                {{-- 1. Kolom Tanggal --}}
                                <td class="px-5 py-4 font-medium">
                                    {{ \Carbon\Carbon::parse($rw->tanggal)->translatedFormat('d M Y') }}
                                </td>
                                
                                {{-- 2. Kolom Jenis Pupuk --}}
                                <td class="px-5 py-4">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold bg-green-50 text-green-600 border border-green-100">
                                        {{ $rw->jenis_pupuk }}
                                    </span>
                                </td>
                                
                                {{-- 3. Kolom Dosis --}}
                                <td class="px-5 py-4 text-center text-gray-600 font-semibold">
                                    {{ $rw->dosis }} {{ $rw->satuan }}
                                </td>
                                
                                {{-- 4. Kolom Harga Beli --}}
                                <td class="px-5 py-4 text-gray-500">
                                    Rp {{ number_format($rw->harga_beli, 0, ',', '.') }} / {{ $rw->satuan }}
                                </td>
                                
                                {{-- 5. Kolom Total Biaya --}}
                                <td class="px-5 py-4 font-bold text-gray-900">
                                    Rp {{ number_format($rw->total_biaya, 0, ',', '.') }}
                                </td>
                                
                                {{-- 6. Kolom Aksi (Tombol Edit & Delete Berada di Sini) --}}
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        {{-- Tombol Edit --}}
                                        <button type="button" 
                                            onclick="editPemupukan(
                                                {{ $rw->id }}, 
                                                {{ $rw->batch_id }}, 
                                                '{{ $rw->tanggal }}', 
                                                '{{ addslashes($rw->jenis_pupuk) }}', 
                                                '{{ $rw->dosis }}', 
                                                '{{ addslashes($rw->satuan) }}', 
                                                '{{ $rw->harga_beli }}', 
                                                '{{ addslashes($rw->nomide) }}', 
                                                '{{ addslashes($rw->catatan) }}'
                                            )" 
                                            class="text-amber-500 hover:bg-amber-50 p-1.5 rounded-md transition" title="Edit">
                                            <i class="ph ph-pencil-simple text-lg"></i>
                                        </button>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('pemupukan.destroy', $rw->id) }}" method="POST" class="inline-block form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-500 hover:bg-red-50 p-1.5 rounded-md transition btn-hapus" title="Hapus">
                                                <i class="ph ph-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-gray-400 font-medium">Belum ada riwayat pemupukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </main>

    {{-- ========================================= --}}
    {{-- MODAL POP-UP CATAT PEMUPUKAN --}}
    {{-- ========================================= --}}
    <div id="modalCatat" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-xl rounded-[20px] shadow-2xl overflow-hidden transform scale-100">
            
            {{-- Header Modal --}}
            <div class="bg-primary-dark px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-flask"></i> Catat Pemupukan Baru</h3>
                <button onclick="tutupModalCatat()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>

            {{-- Body Modal --}}
<form action="{{ route('pemupukan.store') }}" method="POST" id="formPemupukan" class="p-6 max-h-[85vh] overflow-y-auto">
                @csrf

                {{-- 1. Pilih Batch --}}
                <div class="mb-4">
                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Pilih Batch Tanam <span class="text-red-500">*</span></label>
                    <select name="batch_id" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                        <option value="">-- Pilih Batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->nama_batch ?? $batch->komoditas }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Tanggal Pemupukan</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Jenis Pupuk</label>
                        <input type="text" name="jenis_pupuk" placeholder="Misal: Urea" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>

                {{-- 2. Detail Pupuk (Kalkulasi) --}}
                <div class="bg-green-50 p-4 rounded-[12px] border border-green-100 mb-4">
                    <h4 class="text-[12px] font-bold text-primary-dark mb-3">Detail & Biaya Pupuk</h4>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Dosis / Kuantitas</label>
                            <input type="number" step="0.01" id="inp-dosis" name="dosis" onkeyup="hitungTotal()" onchange="hitungTotal()" value="0" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Satuan</label>
                            <input type="text" name="satuan" placeholder="Misal: Kg / Liter" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-1">Harga Beli (Rp)</label>
                            <input type="number" id="inp-harga" name="harga_beli" onkeyup="hitungTotal()" onchange="hitungTotal()" value="0" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between border-t border-green-200 pt-3 mt-3">
                        <span class="text-[12px] font-bold text-gray-500 uppercase tracking-wider">Total Biaya Pupuk</span>
                        <span class="text-[20px] font-bold text-primary-dark">Rp <span id="out-total">0</span></span>
                    </div>
                </div>

                {{-- 3. Info Tambahan (Nomide & Catatan) --}}
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Nomide (Opsional)</label>
                        <input type="text" name="nomide" placeholder="Masukkan Nomide jika ada" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 mb-1">Catatan</label>
                        <textarea name="catatan" rows="2" placeholder="Tambahkan catatan pemupukan..." class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-2">
                    <button type="button" onclick="tutupModalCatat()" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-white bg-primary-dark hover:bg-opacity-90 transition shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT UNTUK MODAL & KALKULASI --}}
    <script>
        const modal = document.getElementById('modalCatat');
        
        function bukaModalCatat() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupModalCatat() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Logic Hitung Otomatis Real-time (Hanya Pupuk)
        function hitungTotal() {
            let dosis = parseFloat(document.getElementById('inp-dosis').value) || 0;
            let harga = parseFloat(document.getElementById('inp-harga').value) || 0;
            let totalBiaya = dosis * harga;

            // Update UI dengan format mata uang
            document.getElementById('out-total').innerText = totalBiaya.toLocaleString('id-ID');
        }
    </script>

    {{-- Script SweetAlert & Edit Modal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // 1. Logika Konfirmasi Hapus
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.form-delete');
                Swal.fire({
                    title: 'Hapus Catatan?',
                    text: "Data pemupukan ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#9CA3AF',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });

        // 2. Logika Buka Modal Edit
        function editPemupukan(id, batchId, tanggal, jenis, dosis, satuan, harga, nomide, catatan) {
            // 1. Buka modal pengisian
            if (typeof bukaModalCatat === "function") {
                bukaModalCatat();
            }
            
            // 2. Ubah rute action Form ke rute Update/Edit
            const form = document.getElementById('formFormPemupukan') || document.getElementById('formPemupukan');
            if (form) {
                form.action = `/pemupukan/${id}`;
                
                // Sisipkan method PUT agar Laravel tahu ini proses UPDATE data
                let methodInput = document.getElementById('method-put');
                if(!methodInput) {
                    form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT" id="method-put">');
                }
            }

            // 3. Cari semua elemen input di dalam modal berdasarkan atribut 'name'
            const inputBatch   = document.querySelector('[name="batch_id"]');
            const inputTanggal = document.querySelector('[name="tanggal"]');
            const inputJenis   = document.querySelector('[name="jenis_pupuk"]');
            const inputDosis   = document.querySelector('[name="dosis"]');
            const inputSatuan  = document.querySelector('[name="satuan"]');
            const inputHarga   = document.querySelector('[name="harga_beli"]');
            const inputNomide  = document.querySelector('[name="nomide"]');
            const inputCatatan = document.querySelector('[name="catatan"]');

            // 4. Isi otomatis tiap kolom input dengan data lamanya
            if (inputBatch)   inputBatch.value = batchId;
            if (inputTanggal) inputTanggal.value = tanggal;
            if (inputJenis)   inputJenis.value = jenis;
            if (inputDosis)   inputDosis.value = dosis;
            if (inputSatuan)  inputSatuan.value = satuan;
            if (inputHarga)   inputHarga.value = harga;
            if (inputNomide)  inputNomide.value = nomide;
            if (inputCatatan) inputCatatan.value = catatan;

            // 5. Trik Otomatis: Hitung perkalian Dosis x Harga agar teks hijau "TOTAL BIAYA" langsung terisi otomatis
            setTimeout(() => {
                // Jika kamu punya fungsi hitung biaya bawaan di form, kita pancing panggil di sini
                if (typeof hitungTotalBiaya === "function") {
                    hitungTotalBiaya();
                } else {
                    // Kalkulasi manual cadangan untuk teks hijau di modal kamu
                    let vDosis = parseFloat(dosis) || 0;
                    let vHarga = parseFloat(harga) || 0;
                    let totalVal = vDosis * vHarga;
                    
                    // Mencari elemen teks hijau tempat "TOTAL BIAYA PUPUK" berada
                    let textTotal = document.body.innerHTML.match(/TOTAL BIAYA PUPUK/i);
                    if(textTotal) {
                        // Jika kamu memberikan ID/Class pada teks Rp di modal, isi valuenya di sini
                        // Contoh fungsional jika dipasangkan selector pendukung:
                        let displayTotal = document.getElementById('total-biaya-display') || inputHarga.closest('div').querySelector('.text-primary-mid');
                        if(displayTotal) displayTotal.innerText = 'Rp ' + totalVal.toLocaleString('id-ID');
                    }
                }
            }, 100);
        }
        // 3. Tangkap Notifikasi
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}" });
        @endif
    </script>
</body>
</html>