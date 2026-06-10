<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Laporan Pendapatan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span></a>
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-potted-plant text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            <a href="{{ route('jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-calendar-blank text-[20px]"></i><span class="text-[15px]">Kalender Jadwal</span></a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
            <a href="{{ route('penjualan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span></a>
            
            <a href="{{ route('laporan') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition-colors">
                <i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span>
            </a>

            <div class="h-px bg-white/10 my-2 mx-3"></div>

            <a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors">
                <i class="ph ph-bell-ringing text-[20px]"></i><span class="text-[15px] flex-1">Notifikasi</span>
                @php $notifCount = \App\Models\BatchTanam::countNotifikasiPanen(); @endphp
                @if($notifCount > 0) <span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full">{{ $notifCount }}</span> @endif
            </a>
            <a href="{{ route('pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-gear text-[20px]"></i><span class="text-[16px]">Pengaturan</span></a>
        </nav>

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
                <button type="submit" title="Keluar" class="flex items-center justify-center"><i class="ph ph-sign-out text-white/50 hover:text-red-400 transition text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        {{-- HEADER & FILTER TAHUN --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-[28px] font-bold text-primary-dark">Laporan Pendapatan</h2>
            
            <form action="{{ route('laporan') }}" method="GET" class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200">
                <i class="ph ph-calendar-blank text-primary-mid text-lg"></i>
                <label for="tahun" class="text-[13px] font-bold text-gray-600">Filter Tahun:</label>
                <select name="tahun" id="tahun" onchange="this.form.submit()" class="bg-transparent border-none text-[13px] font-bold text-primary-dark focus:outline-none cursor-pointer">
                    <option value="semua" {{ $tahunDipilih == 'semua' ? 'selected' : '' }}>Semua Waktu</option>
                    @foreach($daftarTahun as $thn)
                        <option value="{{ $thn }}" {{ $tahunDipilih == $thn ? 'selected' : '' }}>Tahun {{ $thn }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- KPI CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-5"><i class="ph ph-trend-up text-9xl text-primary-dark"></i></div>
                <h3 class="text-[24px] font-bold text-gray-900 relative z-10">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-gray-500 font-medium relative z-10">Total Pendapatan</p>
            </div>
            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-5"><i class="ph ph-trend-down text-9xl text-red-500"></i></div>
                <h3 class="text-[24px] font-bold text-gray-900 relative z-10">Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-gray-500 font-medium relative z-10">Total Biaya Operasional</p>
            </div>
            <div class="bg-gradient-to-br from-primary-dark to-primary-mid text-white p-6 rounded-[24px] shadow-md flex flex-col justify-center relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-10"><i class="ph ph-arrows-out-line-up text-9xl text-white"></i></div>
                <h3 class="text-[24px] font-bold relative z-10">Rp. {{ number_format($labaBersih, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-white/80 font-medium relative z-10">Laba Bersih Keseluruhan</p>
            </div>
        </div>

        {{-- MAIN CHART: PENDAPATAN VS BIAYA --}}
        <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 mb-6">
            <div class="flex items-center gap-6 mb-6 border-b border-gray-100 pb-2">
                <h3 class="text-[15px] font-bold text-primary-dark border-b-2 border-primary-dark pb-2">Pendapatan vs Biaya</h3>
                <h3 class="text-[15px] font-medium text-gray-400 pb-2">Tren Bulanan Terakhir</h3>
            </div>
            <div class="relative h-[300px] w-full">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        {{-- GRAFIK REVISI DOSEN: PERBANDINGAN PREDIKSI VS HASIL PANEN SEBENARNYA --}}
        <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 mb-6">
            <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-2">
                <h3 class="text-[16px] font-bold text-primary-dark">Evaluasi Akurasi: Prediksi vs Hasil Panen Aktual</h3>
                <span class="text-[12px] bg-purple-100 text-purple-700 px-3 py-1 rounded-full font-semibold">Satuan: Kilogram (Kg)</span>
            </div>
            <div class="relative h-[300px] w-full">
                <canvas id="compareHarvestChart"></canvas>
            </div>
        </div>

        {{-- TABEL REVISI DOSEN: ANALISIS KEUANGAN PER BATCH --}}
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden mb-10">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="text-[18px] font-bold text-gray-900">Analisis Keuangan per Lahan/Batch</h3>
                    <p class="text-[13px] text-gray-500 mt-1">Rincian pendapatan dan biaya untuk memantau lahan mana yang paling menguntungkan.</p>
                </div>
                <button onclick="window.print()" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-[8px] font-bold text-[12px] hover:bg-gray-200 transition flex items-center gap-2">
                    <i class="ph ph-printer font-bold"></i> Cetak Tabel
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-[12px] font-semibold text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 border-b border-gray-100">Batch & Lahan</th>
                            <th class="px-6 py-4 border-b border-gray-100">Tgl Tanam</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-right">Total Biaya</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-right">Pendapatan</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-right">Laba / Rugi</th>
                            <th class="px-6 py-4 border-b border-gray-100 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13px] font-medium text-gray-700 divide-y divide-gray-50">
                        @forelse($analisisBatch as $ab)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $ab->komoditas }}</div>
                                    <div class="text-[11px] text-gray-500 mt-0.5 flex items-center gap-1"><i class="ph ph-map-pin"></i> {{ $ab->lahan }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($ab->tanggal)->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4 text-right text-red-500 font-semibold">- Rp {{ number_format($ab->biaya, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right text-green-600 font-semibold">+ Rp {{ number_format($ab->pendapatan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right font-bold {{ $ab->laba > 0 ? 'text-primary-dark' : ($ab->laba < 0 ? 'text-red-600' : 'text-gray-500') }}">
                                    Rp {{ number_format($ab->laba, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($ab->status == 'Untung')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[11px] font-bold uppercase tracking-wider">Untung</span>
                                    @elseif($ab->status == 'Rugi')
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-[11px] font-bold uppercase tracking-wider">Rugi</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-[11px] font-bold uppercase tracking-wider">Proses</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400 font-medium">Belum ada data batch untuk dianalisis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- BOTTOM GRID: DOUGHNUT & TOP BATCH --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-10">
            
            <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-[16px] font-bold text-gray-900 mb-6">Komposisi Biaya Operasional</h3>
                <div class="flex items-center justify-center gap-8 flex-1">
                    <div class="relative w-[180px] h-[180px]">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                    <div class="flex flex-col gap-3 w-1/2">
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600">
                            <span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#9333EA]"></div> Pembibitan</span> 
                            <span>{{ $komposisiBiaya['Pembibitan'] ?? 0 }}%</span>
                        </div>
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600">
                            <span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#004F3B]"></div> Pemupukan</span> 
                            <span>{{ $komposisiBiaya['Pemupukan'] ?? 0 }}%</span>
                        </div>
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600">
                            <span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#43B75D]"></div> Pengendalian Hama</span> 
                            <span>{{ $komposisiBiaya['Pengendalian Hama'] ?? 0 }}%</span>
                        </div>
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600">
                            <span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#F59E0B]"></div> Perawatan Lain</span> 
                            <span>{{ $komposisiBiaya['Perawatan Lain'] ?? 0 }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100">
                <h3 class="text-[16px] font-bold text-gray-900 mb-6">Top 3 Batch Terprofitabel</h3>
                <div class="space-y-5">
                    @forelse($topBatches as $index => $tb)
                        @php $margin = [65, 55, 60][$index] ?? 50; @endphp
                        <div class="flex gap-4 items-start">
                            <div class="w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center font-bold text-[13px] shrink-0 mt-1">{{ $index + 1 }}</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-end mb-1">
                                    <div class="font-bold text-gray-900 text-[14px]">
                                        {{ $tb->komoditas }} — {{ \Carbon\Carbon::parse($tb->tanggal_tanam)->translatedFormat('M y') }}
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[13px] font-bold text-primary-mid">Rp {{ number_format($tb->total_revenue, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-[6px]">
                                    <div class="bg-primary-mid h-[6px] rounded-full" style="width: {{ $margin }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-[13px] text-gray-400 text-center py-4">Belum ada data pendapatan panen.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    {{-- SCRIPT CHART.JS --}}
    <script>
        Chart.defaults.font.family = "'Montserrat', sans-serif";
        Chart.defaults.color = '#9CA3AF'; 
        
        // 1. BAR CHART (Pendapatan vs Biaya vs Laba)
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: @json($labelBulan),
                datasets: [
                    { label: 'Pendapatan', data: @json($dataPendapatanBulan), backgroundColor: '#004F3B', borderRadius: 4, barPercentage: 0.8 },
                    { label: 'Biaya', data: @json($dataBiayaBulan), backgroundColor: '#EF4444', borderRadius: 4, barPercentage: 0.8 }, // Merah untuk biaya
                    { label: 'Laba', data: @json($dataLabaBulan), backgroundColor: '#43B75D', borderRadius: 4, barPercentage: 0.8 } // Hijau untuk laba
                ]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, padding: 20, font: { weight: 'bold' } } } },
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        grid: { borderDash: [4, 4], color: '#f3f4f6' },
                        ticks: { callback: function(value) { if(value >= 1000000) return (value / 1000000) + 'M'; if(value >= 1000) return (value / 1000) + 'K'; return value; } }
                    }
                }
            }
        });

        // 2. BAR CHART (Prediksi vs Aktual Hasil Panen)
        new Chart(document.getElementById('compareHarvestChart'), {
            type: 'bar',
            data: {
                labels: @json($labelCompareBatch ?? []),
                datasets: [
                    { label: 'Prediksi Produksi (Sistem)', data: @json($dataPrediksiKg ?? []), backgroundColor: '#9CA3AF', borderRadius: 6, barPercentage: 0.6, categoryPercentage: 0.7 },
                    { label: 'Hasil Panen Sebenarnya', data: @json($dataAktualKg ?? []), backgroundColor: '#F59E0B', borderRadius: 6, barPercentage: 0.6, categoryPercentage: 0.7 } // Warna oranye keemasan
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 10, font: { weight: 'bold' } } } },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        grid: { borderDash: [4, 4], color: '#f3f4f6' },
                        ticks: { callback: function(value) { return value.toLocaleString('id-ID') + ' Kg'; } }
                    }
                }
            }
        });

        // 3. DOUGHNUT CHART (Komposisi Biaya)
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pembibitan', 'Pemupukan', 'Pengendalian Hama', 'Perawatan Lain', 'Pengairan'],
                datasets: [{
                    data: [
                        {{ $komposisiBiaya['Pembibitan'] ?? 0 }}, {{ $komposisiBiaya['Pemupukan'] ?? 0 }}, 
                        {{ $komposisiBiaya['Pengendalian Hama'] ?? 0 }}, {{ $komposisiBiaya['Perawatan Lain'] ?? 0 }}, 
                        {{ $komposisiBiaya['Pengairan'] ?? 0 }}
                    ],
                    backgroundColor: ['#9333EA', '#004F3B', '#43B75D', '#F59E0B', '#3B82F6'],
                    borderWidth: 0, hoverOffset: 5
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
        });
    </script>
</body>
</html>