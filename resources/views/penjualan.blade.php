<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Penjualan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } } } }
    </script>
    <style>
        /* Custom scrollbar untuk tabel */
        ::-webkit-scrollbar { height: 8px; width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
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

            <a href="{{ route('pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
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
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <div class="mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark">Penjualan Hasil Panen</h2>
        </div>

        {{-- SUMMARY CARDS (3 Kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Card 1: Pendapatan --}}
            <div class="bg-white p-6 rounded-[24px] shadow-sm flex flex-col justify-center border border-gray-100">
                <i class="ph ph-trend-up text-[32px] text-primary-dark mb-3"></i>
                <h3 class="text-[24px] font-bold text-gray-900">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-gray-500 font-medium">Total Pendapatan</p>
            </div>
            {{-- Card 2: Transaksi --}}
            <div class="bg-white p-6 rounded-[24px] shadow-sm flex flex-col justify-center border border-gray-100">
                <i class="ph ph-shopping-cart text-[32px] text-primary-dark mb-3"></i>
                <h3 class="text-[24px] font-bold text-gray-900">{{ $totalTransaksi }}</h3>
                <p class="text-[14px] text-gray-500 font-medium">Total Transaksi</p>
            </div>
            {{-- Card 3: Terlaris --}}
            <div class="bg-white p-6 rounded-[24px] shadow-sm flex flex-col justify-center border border-gray-100">
                <i class="ph ph-plant text-[32px] text-primary-dark mb-3"></i>
                <h3 class="text-[24px] font-bold text-gray-900">{{ $komoditasTerlaris }}</h3>
                <p class="text-[14px] text-gray-500 font-medium">Komoditas Terlaris</p>
            </div>
        </div>

        {{-- AREA TABEL & PENCARIAN --}}
        <div class="flex items-center justify-between mb-4">
            <div class="relative w-[300px]">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                <input type="text" placeholder="Cari nama lahan..." class="w-full border border-gray-200 rounded-[8px] pl-10 pr-3 py-2.5 text-[14px] focus:outline-none focus:ring-1 focus:ring-primary-mid shadow-sm">
            </div>
            <button onclick="bukaModal()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-bold text-[14px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus font-bold"></i> Catat Penjualan
            </button>
        </div>

        {{-- DATA TABLE --}}
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 mb-6 overflow-hidden">
            <div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
                    <thead class="bg-primary-dark text-white text-[13px] font-semibold">
                        <tr>
                            <th class="px-6 py-5 rounded-tl-[24px]">No</th>
                            <th class="px-6 py-5">Tanggal</th>
                            <th class="px-6 py-5">Batch / Komoditas</th>
                            <th class="px-6 py-5">Pembeli / Distributor</th>
                            <th class="px-6 py-5 text-right">Jumlah (kg)</th>
                            <th class="px-6 py-5 text-right">Harga/kg</th>
                            <th class="px-6 py-5 text-right">Total Penjualan</th>
                            <th class="px-6 py-5 text-center rounded-tr-[24px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[14px] text-gray-700 divide-y divide-gray-100">
                        @forelse($riwayats as $index => $rw)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-5 font-medium text-gray-400">{{ $riwayats->firstItem() + $index }}</td>
                                <td class="px-6 py-5 text-gray-600">{{ \Carbon\Carbon::parse($rw->tanggal)->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-primary-dark">{{ $rw->hasilPanen->batchTanam->komoditas ?? '-' }} — {{ \Carbon\Carbon::parse($rw->hasilPanen->tanggal_panen ?? now())->translatedFormat('M y') }}</div>
                                    <div class="text-[11px] font-semibold text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded mt-1">{{ $rw->hasilPanen->komoditas ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $initials = strtoupper(substr($rw->nama_pembeli, 0, 2));
                                            if (str_word_count($rw->nama_pembeli) > 1) {
                                                preg_match_all('#\b\w#', $rw->nama_pembeli, $matches);
                                                $initials = strtoupper(implode('', $matches[0]));
                                                $initials = substr($initials, 0, 2);
                                            }
                                        @endphp
                                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-[12px] font-bold border border-blue-100 shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <span class="font-bold text-gray-800">{{ $rw->nama_pembeli }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right font-bold text-gray-900">{{ number_format($rw->jumlah_kg, 0, ',', '.') }}</td>
                                <td class="px-6 py-5 text-right text-gray-400">Rp {{ number_format($rw->harga_per_kg, 0, ',', '.') }}</td>
                                <td class="px-6 py-5 text-right font-bold text-primary-mid">Rp {{ number_format($rw->total_harga, 0, ',', '.') }}</td>
                                
                                {{-- INI TOMBOL CETAK INVOICE-NYA --}}
                                <td class="px-6 py-5 text-center">
                                    <a href="{{ route('penjualan.invoice', $rw->id) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-white border border-gray-200 text-gray-600 hover:text-primary-dark hover:border-primary-mid px-3 py-1.5 rounded-lg text-[11px] font-bold transition shadow-sm">
                                        <i class="ph ph-printer text-[14px]"></i> Cetak
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="px-6 py-10 text-center text-gray-400 font-medium">Belum ada transaksi penjualan.</td></tr>
                        @endforelse
                    </tbody>
                    
                    {{-- Row Footer / Subtotal --}}
                    @if(count($riwayats) > 0)
                        <tfoot class="bg-gray-50 border-t-2 border-gray-100 text-[14px]">
                            <tr>
                                <td colspan="4" class="px-6 py-5 text-right font-bold text-gray-900">Total Periode Ini</td>
                                <td class="px-6 py-5 text-right font-bold text-gray-900">{{ number_format($subtotalKg, 0, ',', '.') }}</td>
                                <td></td>
                                <td class="px-6 py-5 text-right font-bold text-primary-mid">Rp {{ number_format($subtotalRp, 0, ',', '.') }}</td>
                                <td></td> {{-- Sel kosong untuk meratakan kolom aksi --}}
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- PAGINATION CUSTOM --}}
        <div class="flex items-center justify-between px-2 pb-10">
            <span class="text-[13px] text-gray-500 font-medium">
                Menampilkan {{ $riwayats->firstItem() ?? 0 }}-{{ $riwayats->lastItem() ?? 0 }} dari {{ $riwayats->total() }} transaksi
            </span>
            <div>
                {{ $riwayats->links('pagination::tailwind') }}
            </div>
        </div>
    </main>

    {{-- MODAL FORM PENJUALAN --}}
    <div id="modalTransaksi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-lg rounded-[20px] shadow-2xl overflow-hidden">
            <div class="bg-primary-dark px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-shopping-cart"></i> Catat Transaksi Penjualan</h3>
                <button onclick="tutupModal()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>
            
            <form action="{{ route('penjualan.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Pilih Stok Panen <span class="text-red-500">*</span></label>
                    <select name="hasil_panen_id" id="panen-select" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                        <option value="">-- Pilih Stok Tersedia --</option>
                        @foreach($panens as $p)
                            @if($p->sisa_stok > 0)
                                <option value="{{ $p->id }}" data-sisa="{{ $p->sisa_stok }}">
                                    {{ $p->komoditas }} ({{ $p->kualitas }}) - Sisa Stok: {{ $p->sisa_stok }} kg
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Tanggal Jual <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Nama Pembeli <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pembeli" placeholder="UD Sumber Tani..." required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                    </div>
                </div>

                <div class="bg-green-50 p-4 rounded-[12px] border border-green-100 mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-primary-dark mb-1">Jumlah Jual (Kg) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.1" id="inp-kg" name="jumlah_kg" placeholder="0" onkeyup="hitung()" onchange="hitung()" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                        <p id="alert-stok" class="text-[10px] text-red-500 mt-1 hidden font-bold">Stok tidak mencukupi!</p>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-primary-dark mb-1">Harga per Kg (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="inp-harga" name="harga_per_kg" placeholder="0" onkeyup="hitung()" onchange="hitung()" required class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                    </div>
                    
                    <div class="col-span-2 text-right pt-2 border-t border-green-200">
                        <span class="text-[11px] font-bold text-primary-dark">Total Harga: </span>
                        <span class="text-[18px] font-bold text-primary-dark">Rp <span id="out-total">0</span></span>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-2">
                    <button type="button" onclick="tutupModal()" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-gray-500 bg-gray-100 hover:bg-gray-200">Batal</button>
                    <button type="submit" id="btn-submit" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-white bg-primary-dark hover:bg-opacity-90 shadow-md">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Tambahkan script ini di dalam tag <script> paling bawah file penjualan.blade.php
        window.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const panenId = urlParams.get('panen_id');
            
            // Jika ada parameter panen_id di URL, otomatis buka modal dan pilih stoknya
            if (panenId) {
                bukaModal();
                panenSelect.value = panenId;
                hitung(); // Jalankan kalkulator cek stoknya
            }
        });
        
        const modal = document.getElementById('modalTransaksi');
        function bukaModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        function tutupModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }

        const panenSelect = document.getElementById('panen-select');
        const inpKg = document.getElementById('inp-kg');
        const alertStok = document.getElementById('alert-stok');
        const btnSubmit = document.getElementById('btn-submit');

        function hitung() {
            let kg = parseFloat(inpKg.value) || 0;
            let harga = parseFloat(document.getElementById('inp-harga').value) || 0;
            document.getElementById('out-total').innerText = (kg * harga).toLocaleString('id-ID');

            let selectedOption = panenSelect.options[panenSelect.selectedIndex];
            let maxStok = selectedOption ? parseFloat(selectedOption.getAttribute('data-sisa')) : 0;
            
            if(kg > maxStok) {
                alertStok.classList.remove('hidden');
                btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
                btnSubmit.disabled = true;
            } else {
                alertStok.classList.add('hidden');
                btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
                btnSubmit.disabled = false;
            }
        }

        panenSelect.addEventListener('change', hitung);

        @if(session('error')) Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}" }); @endif
        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}" }); @endif
    </script>
</body>
</html>