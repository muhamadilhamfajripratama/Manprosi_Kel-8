<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Notifikasi Panen</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } }
            }
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
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-sprout text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            
            {{-- Menu-menu lainnya ... --}}
            
            {{-- INI MENU NOTIFIKASI DENGAN RED BADGE DINAMIS --}}
            <a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition shadow-md mt-4">
                <i class="ph ph-bell-ringing text-[20px]"></i>
                <span class="text-[15px] flex-1">Notifikasi Panen</span>
                @if(\App\Models\BatchTanam::countNotifikasiPanen() > 0)
                    <span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">
                        {{ \App\Models\BatchTanam::countNotifikasiPanen() }}
                    </span>
                @endif
            </a>
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark flex items-center gap-3">
                <i class="ph ph-bell-ringing text-yellow-500"></i> Pemberitahuan Sistem
            </h2>
        </div>

        <div class="max-w-4xl">
            @forelse($notifikasi as $notif)
                <div class="bg-white rounded-2xl p-6 shadow-sm border-l-[6px] {{ $notif->tipe == 'urgent' ? 'border-red-600' : 'border-yellow-400' }} mb-4 flex items-start gap-5 transition hover:shadow-md">
                    
                    <div class="w-12 h-12 shrink-0 rounded-full flex items-center justify-center {{ $notif->tipe == 'urgent' ? 'bg-red-50 text-red-600' : 'bg-yellow-50 text-yellow-600' }}">
                        <i class="ph {{ $notif->tipe == 'urgent' ? 'ph-warning-circle' : 'ph-clock-countdown' }} text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-[16px] font-bold text-gray-900">{{ $notif->pesan }}</h3>
                                <p class="text-[13px] text-gray-500 mt-1">Komoditas <span class="font-bold text-primary-dark">{{ $notif->komoditas }}</span> di <span class="font-semibold">{{ $notif->lahan }}</span>.</p>
                            </div>
                            <span class="text-[12px] font-bold {{ $notif->tipe == 'urgent' ? 'text-red-500 bg-red-50' : 'text-yellow-600 bg-yellow-50' }} px-3 py-1.5 rounded-md">
                                Est. Panen: {{ $notif->tgl_panen }}
                            </span>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-3">
                            <a href="#" class="bg-primary-dark text-white px-4 py-2 rounded-lg text-[12px] font-bold hover:bg-opacity-90 transition">Proses Panen Sekarang</a>
                            <button class="bg-white border border-gray-200 text-gray-500 px-4 py-2 rounded-lg text-[12px] font-bold hover:bg-gray-50 transition">Lihat Detail Lahan</button>
                        </div>
                    </div>

                </div>
            @empty
                <div class="bg-white rounded-2xl p-10 shadow-sm border border-gray-100 text-center">
                    <i class="ph ph-check-circle text-5xl text-green-400 mb-3"></i>
                    <h3 class="text-[18px] font-bold text-gray-900">Belum ada jadwal panen terdekat</h3>
                    <p class="text-[13px] text-gray-500 mt-1">Tanaman di lahan Anda masih dalam masa pertumbuhan normal.</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>