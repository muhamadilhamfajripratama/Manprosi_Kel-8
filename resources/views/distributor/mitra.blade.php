<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Daftar Mitra Petani</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } } }
        }
    </script>
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR DISTRIBUTOR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-truck text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] font-semibold tracking-wide">Distributor</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1.5 sidebar-scroll">
            <div class="text-[10px] font-semibold text-white/50 tracking-wider uppercase mb-2 px-3">Menu Utama</div>
            <a href="{{ route('distributor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('distributor.dashboard') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition">
                <i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta Komoditas</span>
            </a>
            <a href="{{ route('distributor.pembelian') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('distributor.pembelian') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition">
                <i class="ph ph-shopping-cart text-[20px]"></i><span class="text-[15px]">Pembelian Panen</span>
            </a>
            <a href="{{ route('distributor.mitra') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('distributor.mitra') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition">
                <i class="ph ph-users text-[20px]"></i><span class="text-[15px]">Daftar Mitra Petani</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">
                    {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'DS' }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::check() ? Auth::user()->name : 'Distributor' }}</span>
                    <span class="text-[11px] text-white/60 capitalize">{{ Auth::check() ? Auth::user()->role : 'Mitra Bisnis' }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto">
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center px-8 shrink-0 z-10">
            <h2 class="text-[20px] font-semibold text-gray-900">Daftar Mitra Petani</h2>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- KARTU MITRA 1 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition cursor-pointer">
                    <div class="w-20 h-20 rounded-full bg-primary-mid text-white flex items-center justify-center text-2xl font-bold mb-4">FA</div>
                    <h3 class="text-[16px] font-bold text-gray-900">Fajri</h3>
                    <p class="text-[12px] text-gray-500 mb-4">Ciwidey, Jawa Barat</p>
                    <div class="w-full bg-gray-50 rounded-lg p-3 text-left space-y-2">
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Total Lahan</span><span class="font-bold">12 Ha</span></div>
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Fokus Komoditas</span><span class="font-bold text-primary-dark">Bawang Putih Bonggol</span></div>
                    </div>
                </div>

                {{-- KARTU MITRA 2 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition cursor-pointer">
                    <div class="w-20 h-20 rounded-full bg-primary-dark text-white flex items-center justify-center text-2xl font-bold mb-4">RE</div>
                    <h3 class="text-[16px] font-bold text-gray-900">Reyhan</h3>
                    <p class="text-[12px] text-gray-500 mb-4">Ciwidey, Jawa Barat</p>
                    <div class="w-full bg-gray-50 rounded-lg p-3 text-left space-y-2">
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Total Lahan</span><span class="font-bold">8.5 Ha</span></div>
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Fokus Komoditas</span><span class="font-bold text-primary-dark">Bawang Putih Bonggol</span></div>
                    </div>
                </div>

                {{-- KARTU MITRA 3 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition cursor-pointer">
                    <div class="w-20 h-20 rounded-full bg-orange-400 text-white flex items-center justify-center text-2xl font-bold mb-4">FZ</div>
                    <h3 class="text-[16px] font-bold text-gray-900">Faiza</h3>
                    <p class="text-[12px] text-gray-500 mb-4">Lembang, Jawa Barat</p>
                    <div class="w-full bg-gray-50 rounded-lg p-3 text-left space-y-2">
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Total Lahan</span><span class="font-bold">10 Ha</span></div>
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Fokus Komoditas</span><span class="font-bold text-primary-dark">Bawang Putih Bonggol</span></div>
                    </div>
                </div>

                {{-- KARTU MITRA 4 --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition cursor-pointer">
                    <div class="w-20 h-20 rounded-full bg-blue-500 text-white flex items-center justify-center text-2xl font-bold mb-4">AL</div>
                    <h3 class="text-[16px] font-bold text-gray-900">Alya</h3>
                    <p class="text-[12px] text-gray-500 mb-4">Pangalengan, Jawa Barat</p>
                    <div class="w-full bg-gray-50 rounded-lg p-3 text-left space-y-2">
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Total Lahan</span><span class="font-bold">6 Ha</span></div>
                        <div class="flex justify-between text-[11px]"><span class="text-gray-500">Fokus Komoditas</span><span class="font-bold text-primary-dark">Bawang Putih Bonggol</span></div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>