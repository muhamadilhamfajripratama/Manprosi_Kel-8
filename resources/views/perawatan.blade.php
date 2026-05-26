<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Perawatan Lain</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } } }
        }
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
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span></a>
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-sprout text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            
            {{-- Menu Aktif --}}
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition shadow-md"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
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
            <h2 class="text-[28px] font-bold text-primary-dark">Perawatan Lain</h2>
            <button onclick="bukaModal()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-plus font-bold"></i> Catat Perawatan
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
                        @php 
                            // Hitung total biaya perawatan spesifik untuk batch ini
                            $biayaBatch = \App\Models\KegiatanPerawatan::where('batch_id', $batch->id)->sum('biaya'); 
                        @endphp
                        
                        <div class="flex items-center justify-between p-4 rounded-xl cursor-pointer transition {{ $index == 0 ? 'bg-green-50 border-l-[3px] border-primary-mid' : 'hover:bg-gray-50 border border-transparent' }}">
                            <div>
                                <h4 class="font-bold text-[14px] text-gray-900">{{ $batch->komoditas }}</h4>
                                <p class="text-[11px] text-gray-400 mt-1">{{ $batch->lahan->nama_lahan ?? 'Lahan Unknown' }}</p>
                            </div>
                            <span class="text-[12px] font-bold {{ $biayaBatch > 0 ? 'text-red-500' : 'text-gray-400' }}">
                                Rp {{ number_format($biayaBatch, 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-[12px] text-gray-400 text-center py-4">Belum ada batch tanam aktif.</p>
                    @endforelse
                </div>
            </div>

            {{-- BAGIAN KANAN: TABEL RIWAYAT --}}
            <div class="col-span-1 lg:col-span-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                
                {{-- Filter Chips --}}
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <button class="bg-primary-dark text-white px-5 py-2 rounded-full text-[13px] font-semibold shadow-sm">Semua</button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-[13px] font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                        <i class="ph ph-leaf text-green-500"></i> Penyiangan
                    </button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-[13px] font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                        <i class="ph ph-scissors text-red-400"></i> Pemangkasan
                    </button>
                    <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-[13px] font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                        <i class="ph ph-tree-palm text-amber-600"></i> Penopang
                    </button>
                </div>

                {{-- TABEL --}}
                <div class="overflow-x-auto rounded-lg border border-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-primary-dark text-white text-[12px] font-semibold tracking-wide">
                            <tr>
                                <th class="px-5 py-4 whitespace-nowrap">Tanggal</th>
                                <th class="px-5 py-4 whitespace-nowrap">Jenis Kegiatan</th>
                                <th class="px-5 py-4">Deskripsi</th>
                                <th class="px-5 py-4 whitespace-nowrap text-center">Jam Kerja</th>
                                <th class="px-5 py-4 whitespace-nowrap">Total Biaya</th>
                                <th class="px-5 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[13px] text-gray-700 divide-y divide-gray-100">
                            @forelse($riwayats as $rw)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($rw->tanggal)->translatedFormat('d M Y') }}</td>
                                    
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @php
                                            $bg = 'bg-gray-100'; $text = 'text-gray-700';
                                            if($rw->jenis == 'Penyiangan') { $bg = 'bg-green-100'; $text = 'text-green-700'; }
                                            if($rw->jenis == 'Pemangkasan') { $bg = 'bg-orange-100'; $text = 'text-orange-700'; }
                                            if($rw->jenis == 'Penopang') { $bg = 'bg-amber-100'; $text = 'text-amber-800'; }
                                        @endphp
                                        <span class="{{ $bg }} {{ $text }} px-3 py-1 rounded-full text-[11px] font-bold flex items-center gap-1.5 w-max">
                                            @if($rw->jenis == 'Penyiangan') <i class="ph ph-leaf"></i>
                                            @elseif($rw->jenis == 'Pemangkasan') <i class="ph ph-scissors"></i>
                                            @elseif($rw->jenis == 'Penopang') <i class="ph ph-tree-palm"></i>
                                            @else <i class="ph ph-wrench"></i> @endif
                                            {{ $rw->jenis }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-5 py-4 text-gray-500">{{ $rw->deskripsi ?? '-' }}</td>
                                    <td class="px-5 py-4 text-center">{{ $rw->jumlah_jam }} jam</td>
                                    <td class="px-5 py-4 font-bold text-primary-dark whitespace-nowrap">Rp {{ number_format($rw->biaya, 0, ',', '.') }}</td>
                                    <td class="px-5 py-4 text-center text-gray-400 whitespace-nowrap">
                                        <button class="hover:text-blue-500 transition mr-2"><i class="ph ph-pencil-simple text-lg"></i></button>
                                        <button class="hover:text-red-500 transition"><i class="ph ph-trash text-lg"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-10 text-center text-gray-400">Belum ada catatan kegiatan perawatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        {{-- Row Total Keseluruhan --}}
                        <tfoot class="bg-orange-50 border-t-2 border-orange-100">
                            <tr>
                                <td colspan="4" class="px-5 py-4 text-right font-bold text-orange-900 text-[13px]">Total Keseluruhan</td>
                                <td colspan="2" class="px-5 py-4 font-bold text-orange-700 text-[14px]">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </main>

    {{-- MODAL CATAT PERAWATAN --}}
    <div id="modalPerawatan" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-lg rounded-[20px] shadow-2xl overflow-hidden transform scale-100">
            <div class="bg-primary-dark px-6 py-4 flex justify-between items-center text-white">
                <h3 class="font-bold text-[16px] flex items-center gap-2"><i class="ph ph-wrench"></i> Catat Perawatan Lain</h3>
                <button onclick="tutupModal()" class="text-white/70 hover:text-white"><i class="ph ph-x text-xl"></i></button>
            </div>
            
            <form action="{{ route('perawatan.store') }}" method="POST" class="p-6 max-h-[85vh] overflow-y-auto">
                @csrf
                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Batch Tanam <span class="text-red-500">*</span></label>
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
                        <label class="block text-[12px] font-bold text-gray-500 mb-1">Jenis Kegiatan <span class="text-red-500">*</span></label>
                        <select name="jenis" required class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                            <option value="Penyiangan">Penyiangan</option>
                            <option value="Pemangkasan">Pemangkasan</option>
                            <option value="Penopang">Pemasangan Penopang</option>
                            <option value="Penyulaman">Penyulaman</option>
                            <option value="Pembersihan Lahan">Pembersihan Lahan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Deskripsi Singkat</label>
                    <input type="text" name="deskripsi" placeholder="Mencabut rumput liar di sekitar bedengan..." class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid">
                </div>

                <div class="bg-gray-50 p-4 rounded-[12px] border border-gray-200 mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 mb-1">Jumlah Jam</label>
                        <input type="number" step="0.5" id="inp-jam" name="jumlah_jam" placeholder="Misal: 4.5" onkeyup="hitung()" onchange="hitung()" class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 mb-1">Harga/Upah per Jam (Rp)</label>
                        <input type="number" id="inp-price" name="price" placeholder="Misal: 15000" onkeyup="hitung()" onchange="hitung()" class="w-full border border-white rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary-mid">
                    </div>
                    
                    <input type="hidden" id="inp-biaya" name="biaya" value="0">

                    <div class="col-span-2 text-right pt-2 border-t border-gray-200">
                        <span class="text-[11px] font-bold text-gray-500">Total Biaya: </span>
                        <span class="text-[16px] font-bold text-primary-dark">Rp <span id="out-total">0</span></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-[12px] font-bold text-gray-500 mb-1">Catatan Tambahan</label>
                    <textarea name="catatan" rows="2" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid" placeholder="Opsional..."></textarea>
                </div>

                <div class="mt-6 flex justify-end gap-3 pt-2">
                    <button type="button" onclick="tutupModal()" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-gray-500 bg-gray-100 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-[8px] text-[13px] font-bold text-white bg-primary-dark hover:bg-opacity-90 shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        const modal = document.getElementById('modalPerawatan');
        function bukaModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        function tutupModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }
        
        function hitung() {
            let jam = parseFloat(document.getElementById('inp-jam').value) || 0;
            let price = parseFloat(document.getElementById('inp-price').value) || 0;
            let total = jam * price;
            document.getElementById('out-total').innerText = total.toLocaleString('id-ID');
            document.getElementById('inp-biaya').value = total;
        }
    </script>
</body>
</html>