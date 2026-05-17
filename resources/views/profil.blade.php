<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#FFF5E4' }
                }
            }
        }
    </script>
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>
<body class="bg-cream font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-20">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>
        <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
            <div class="text-[10px] font-semibold text-white/50 tracking-wider uppercase mb-2 px-3">Menu Petani</div>
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-house text-[20px]"></i><span class="text-[16px]">Dashboard</span>
            </a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-plant text-[20px]"></i><span class="text-[16px]">Data Lahan</span>
            </a>
            {{-- Menu lainnya bisa kamu tambahkan di sini --}}
            
            <div class="h-px bg-white/10 my-4 mx-3"></div>
            
            <a href="/profil" class="flex items-center gap-3 px-3 py-2.5 bg-white/10 border-l-[3px] border-primary-mid text-white font-semibold rounded-r-lg transition-colors">
                <i class="ph ph-user text-[20px]"></i><span class="text-[16px]">Profil Saya</span>
            </a>
        </nav>
        
        {{-- PROFIL KIRI BAWAH --}}
        <div class="p-4 border-t border-white/10 shrink-0 hover:bg-white/5 transition flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                    <span class="text-[11px] text-white/60 capitalize">{{ Auth::user()->role }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="Keluar" class="flex items-center justify-center">
                    <i class="ph ph-sign-out text-white/50 hover:text-red-400 transition text-[20px]"></i>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0 bg-cream">
        {{-- HEADER --}}
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0 z-10">
            <div class="flex items-center gap-2">
                <span class="text-[12px] text-gray-400">Pages</span>
                <i class="ph ph-caret-right text-[10px] text-gray-400"></i>
                <span class="text-[20px] font-semibold text-gray-900 leading-none mt-0.5">Profil Saya</span>
            </div>
            <div class="flex items-center gap-5">
                <button class="flex items-center gap-2 hover:opacity-80 transition">
                    <div class="w-8 h-8 rounded-full bg-primary-dark text-white flex items-center justify-center font-semibold text-[12px]">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-3xl">
                <h2 class="text-[32px] font-semibold text-primary-dark leading-tight mb-6">Pengaturan Profil</h2>

                <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm p-8">
                    <div class="flex items-center gap-6 mb-8 border-b border-gray-100 pb-8">
                        <div class="w-24 h-24 rounded-full bg-primary-mid text-white flex items-center justify-center font-semibold text-[32px] shadow-inner">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-[20px] font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-[14px] text-gray-500 mb-2">{{ Auth::user()->email }}</p>
                            <span class="px-3 py-1 bg-green-50 text-green-700 text-[12px] font-semibold rounded-full capitalize">
                                Role: {{ Auth::user()->role }}
                            </span>
                        </div>
                    </div>

                    <form action="#" method="POST" class="space-y-5">
                        @csrf
                        {{-- Catatan: Action form bisa diisi nanti kalau mau buat fitur update data ke database --}}
                        
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] focus:ring-1 focus:ring-primary-mid focus:outline-none" readonly>
                            <p class="text-[11px] text-gray-400 mt-1">*Untuk saat ini data profil bersifat read-only (hanya lihat).</p>
                        </div>

                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                        </div>
                        
                        <div>
                            <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Tanggal Bergabung</label>
                            <input type="text" value="{{ Auth::user()->created_at->format('d F Y') }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2.5 text-[14px] bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>