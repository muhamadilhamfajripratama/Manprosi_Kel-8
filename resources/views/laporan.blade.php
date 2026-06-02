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
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <h2 class="text-[28px] font-bold text-primary-dark mb-6">Laporan Pendapatan</h2>

        {{-- KPI CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-center">
                <i class="ph ph-trend-up text-[28px] text-primary-dark mb-2"></i>
                <h3 class="text-[24px] font-bold text-gray-900">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-gray-500 font-medium">Total Pendapatan</p>
            </div>
            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-center">
                <i class="ph ph-trend-down text-[28px] text-primary-dark mb-2"></i>
                <h3 class="text-[24px] font-bold text-gray-900">Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-gray-500 font-medium">Total Biaya</p>
            </div>
            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex flex-col justify-center">
                <i class="ph ph-arrows-out-line-up text-[28px] text-primary-dark mb-2"></i>
                <h3 class="text-[24px] font-bold text-gray-900">Rp. {{ number_format($labaBersih, 0, ',', '.') }}</h3>
                <p class="text-[14px] text-gray-500 font-medium">Laba Bersih</p>
            </div>
        </div>

        {{-- PENCARIAN & EXPORT --}}
        <div class="flex items-center justify-between mb-6">
            <div class="relative w-[300px]">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari nama lahan..." class="w-full border border-gray-200 rounded-[8px] pl-10 pr-3 py-2.5 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid shadow-sm">
            </div>
            <button onclick="window.print()" class="bg-primary-dark text-white px-5 py-2.5 rounded-[8px] font-bold text-[13px] hover:bg-opacity-90 transition flex items-center gap-2 shadow-sm">
                <i class="ph ph-download-simple font-bold"></i> Export
            </button>
        </div>

        {{-- MAIN CHART: PENDAPATAN VS BIAYA --}}
        <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 mb-6">
            <div class="flex items-center gap-6 mb-6 border-b border-gray-100 pb-2">
                <h3 class="text-[15px] font-bold text-primary-dark border-b-2 border-primary-dark pb-2">Pendapatan vs Biaya</h3>
                <h3 class="text-[15px] font-medium text-gray-400 pb-2 cursor-pointer hover:text-gray-600">Tren Bulanan</h3>
            </div>
            <div class="relative h-[300px] w-full">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        {{-- BOTTOM GRID: DOUGHNUT & TOP BATCH --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-10">
            
            {{-- Komposisi Biaya --}}
            <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-[16px] font-bold text-gray-900 mb-6">Komposisi Biaya</h3>
                <div class="flex items-center justify-center gap-8 flex-1">
                    <div class="relative w-[180px] h-[180px]">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                    <div class="flex flex-col gap-3 w-1/2">
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#004F3B]"></div> Pemupukan</span> <span>{{ $komposisiBiaya['Pemupukan'] }}%</span></div>
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#43B75D]"></div> Pengendalian Hama</span> <span>{{ $komposisiBiaya['Pengendalian Hama'] }}%</span></div>
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#F59E0B]"></div> Perawatan Lain</span> <span>{{ $komposisiBiaya['Perawatan Lain'] }}%</span></div>
                        <div class="flex justify-between items-center text-[13px] font-semibold text-gray-600"><span class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-[#3B82F6]"></div> Pengairan</span> <span>{{ $komposisiBiaya['Pengairan'] }}%</span></div>
                    </div>
                </div>
            </div>

            {{-- Top Batch Terprofitabel --}}
            <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100">
                <h3 class="text-[16px] font-bold text-gray-900 mb-6">Top Batch Terprofitabel</h3>
                <div class="space-y-5">
                    @forelse($topBatches as $index => $tb)
                        @php 
                            // Simulasi persentase margin acak untuk visualisasi bar hijau
                            $margin = [65, 55, 60][$index] ?? 50; 
                        @endphp
                        <div class="flex gap-4 items-start">
                            <div class="w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center font-bold text-[13px] shrink-0 mt-1">{{ $index + 1 }}</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-end mb-1">
                                    <div class="font-bold text-gray-900 text-[14px]">
                                        {{ $tb->komoditas }} — {{ \Carbon\Carbon::parse($tb->tanggal_tanam)->translatedFormat('M y') }}
                                        <span class="text-[9px] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded ml-1">{{ $tb->komoditas }}</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[13px] font-bold text-primary-mid">Rp {{ number_format($tb->total_revenue, 0, ',', '.') }}</div>
                                        <div class="text-[11px] text-gray-500">{{ $margin }}%</div>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-[6px]">
                                    <div class="bg-primary-mid h-[6px] rounded-full" style="width: {{ $margin }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-[13px] text-gray-400 text-center py-4">Belum ada data batch yang cukup.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    {{-- SCRIPT CHART.JS CUSTOMIZATION --}}
    <script>
        Chart.defaults.font.family = "'Montserrat', sans-serif";
        Chart.defaults.color = '#9CA3AF'; // Gray-400
        
        // 1. BAR CHART (Pendapatan vs Biaya vs Laba)
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: @json($labelBulan),
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: @json($dataPendapatanBulan),
                        backgroundColor: '#004F3B', // Dark Green
                        barPercentage: 0.8,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Biaya',
                        data: @json($dataBiayaBulan),
                        backgroundColor: '#43B75D', // Light Green
                        barPercentage: 0.8,
                        categoryPercentage: 0.8
                    },
                    {
                        label: 'Laba',
                        data: @json($dataLabaBulan),
                        backgroundColor: '#FEF08A', // Yellow/Cream
                        barPercentage: 0.8,
                        categoryPercentage: 0.8
                    }
                ]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: { usePointStyle: true, boxWidth: 8, padding: 20, font: { weight: 'bold' } }
                    } 
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        grid: { borderDash: [4, 4], color: '#f3f4f6' },
                        ticks: {
                            callback: function(value) {
                                if(value >= 1000000) return (value / 1000000) + 'M';
                                if(value >= 1000) return (value / 1000) + 'K';
                                return value;
                            }
                        }
                    }
                }
            }
        });

        // 2. DOUGHNUT CHART (Komposisi Biaya)
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pemupukan', 'Pengendalian Hama', 'Perawatan Lain', 'Pengairan'],
                datasets: [{
                    data: [
                        {{ $komposisiBiaya['Pemupukan'] }}, 
                        {{ $komposisiBiaya['Pengendalian Hama'] }}, 
                        {{ $komposisiBiaya['Perawatan Lain'] }}, 
                        {{ $komposisiBiaya['Pengairan'] }}
                    ],
                    backgroundColor: ['#004F3B', '#43B75D', '#F59E0B', '#3B82F6'],
                    borderWidth: 0,
                    hoverOffset: 5
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                cutout: '75%', // Ketebalan donat
                plugins: { legend: { display: false } } // Legend dibuat manual di HTML
            }
        });
    </script>
</body>
</html>