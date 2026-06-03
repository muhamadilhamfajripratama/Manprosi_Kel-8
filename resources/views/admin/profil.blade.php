<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Pengaturan Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' }, boxShadow: { 'card': '0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.06)' } }
            }
        }
    </script>
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- ========================================================== --}}
    {{-- SIDEBAR DINAMIS BERDASARKAN ROLE USER YANG SEDANG LOGIN    --}}
    {{-- ========================================================== --}}
    
    @if(auth()->user()->role === 'admin')
        {{-- SIDEBAR ADMIN --}}
        <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
            <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
                <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center mr-3 text-white"><i class="ph ph-shield-check text-xl"></i></div>
                <h1 class="text-[20px] font-semibold tracking-wide">Administrator</h1>
            </div>
            <nav class="flex-1 py-6 px-4 flex flex-col gap-1.5 sidebar-scroll">
                <div class="text-[10px] font-semibold text-white/50 tracking-wider uppercase mb-2 px-3">Master Data</div>
                <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-users-three text-[20px]"></i><span class="text-[15px]">Kelola Pengguna</span></a>
                <a href="{{ route('admin.backup') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-database text-[20px]"></i><span class="text-[15px]">Backup Data</span></a>
            </nav>
            <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">AD</div>
                    <div class="flex flex-col"><span class="text-[12px] font-semibold text-white leading-tight">Super Admin</span><span class="text-[11px] text-gray-300">Sistem Control</span></div>
                </div>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button></form>
            </div>
        </aside>

    @elseif(auth()->user()->role === 'distributor')
        {{-- SIDEBAR DISTRIBUTOR --}}
        <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
            <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
                <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3"><i class="ph ph-truck text-white text-xl"></i></div>
                <h1 class="text-[20px] font-semibold tracking-wide">Distributor</h1>
            </div>
            <nav class="flex-1 py-6 px-4 flex flex-col gap-1.5 sidebar-scroll">
                <a href="{{ route('distributor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta Komoditas</span></a>
                <a href="{{ route('distributor.pembelian') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-shopping-cart text-[20px]"></i><span class="text-[15px]">Pembelian Panen</span></a>
                <a href="{{ route('distributor.mitra') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition"><i class="ph ph-users text-[20px]"></i><span class="text-[15px]">Daftar Mitra Petani</span></a>
            </nav>
            <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                    <div class="flex flex-col"><span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::user()->name }}</span><span class="text-[11px] text-white/60 capitalize">Mitra Bisnis</span></div>
                </div>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button></form>
            </div>
        </aside>

    @else
        {{-- SIDEBAR PETANI --}}
        <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-20">
            <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
                <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3"><i class="ph ph-leaf text-white text-xl"></i></div>
                <h1 class="text-[20px] font-semibold tracking-wide">Sistem Tani</h1>
            </div>
            <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
                <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
                <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
                <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span></a>
                <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-potted-plant text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
                <a href="{{ route('jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-calendar-blank text-[20px]"></i><span class="text-[15px]">Kalender Jadwal</span></a>
            </nav>
            <div class="p-4 border-t border-white/10 shrink-0 hover:bg-white/5 transition flex items-center justify-between">
                <div class="flex items-center gap-3 cursor-pointer group hover:opacity-80 transition">
                    <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                    <div class="flex flex-col"><span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::user()->name }}</span><span class="text-[11px] text-white/60 capitalize">Petani</span></div>
                </div>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 transition text-[20px]"></i></button></form>
            </div>
        </aside>
    @endif

    {{-- ========================================================== --}}
    {{-- MAIN CONTENT PROFIL                                        --}}
    {{-- ========================================================== --}}
    <div class="flex-1 h-full bg-cream flex flex-col min-w-0">
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center px-8 shrink-0 z-10 justify-between">
            <div class="flex items-center gap-2">
                <span class="text-[12px] text-gray-400">Pages</span><i class="ph ph-caret-right text-[10px] text-gray-400"></i><span class="text-[20px] font-semibold text-gray-900 leading-none mt-0.5">Profil Saya</span>
            </div>
            
            {{-- Tombol Kembali yang menyesuaikan role --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.pengguna') }}" class="text-[13px] font-bold text-gray-500 hover:text-primary-dark transition"><i class="ph ph-arrow-left"></i> Kembali ke Dashboard</a>
            @elseif(auth()->user()->role === 'distributor')
                <a href="{{ route('distributor.dashboard') }}" class="text-[13px] font-bold text-gray-500 hover:text-primary-dark transition"><i class="ph ph-arrow-left"></i> Kembali ke Dashboard</a>
            @else
                <a href="/" class="text-[13px] font-bold text-gray-500 hover:text-primary-dark transition"><i class="ph ph-arrow-left"></i> Kembali ke Dashboard</a>
            @endif
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <h2 class="text-[28px] font-bold text-primary-dark mb-6">Pengaturan Profil</h2>

            <div class="max-w-3xl bg-white rounded-[16px] shadow-card p-8 border border-gray-100">
                <div class="flex items-center gap-5 mb-8 pb-8 border-b border-gray-100">
                    <div class="w-20 h-20 rounded-full bg-primary-mid text-white flex items-center justify-center font-bold text-3xl shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ Auth::user()->email }}</p>
                        <span class="px-3 py-1 bg-green-50 text-green-700 font-bold text-[11px] rounded-md uppercase tracking-wider">Role: {{ Auth::user()->role }}</span>
                    </div>
                </div>

                <form action="{{ route('profil.update') }}" method="POST" class="space-y-5">
                    @csrf @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[12px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full border border-gray-300 rounded-[8px] px-4 py-2.5 text-[14px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid" required>
                        </div>
                        <div>
                            <label class="block text-[12px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Alamat Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full border border-gray-300 rounded-[8px] px-4 py-2.5 text-[14px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[12px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Tanggal Bergabung</label>
                        <input type="text" value="{{ auth()->user()->created_at->translatedFormat('d F Y') }}" class="w-full border border-gray-200 bg-gray-50 text-gray-500 rounded-[8px] px-4 py-2.5 text-[14px]" disabled>
                        <p class="text-[10px] text-gray-400 mt-1"><i class="ph ph-info"></i> Tanggal bergabung tidak dapat diubah.</p>
                    </div>

                    <div class="pt-6 mt-6 border-t border-gray-100">
                        <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2"><i class="ph ph-lock-key text-primary-mid"></i> Keamanan & Kata Sandi</h4>
                        <p class="text-xs text-gray-400 mb-4">Biarkan kosong jika Anda tidak ingin mengubah kata sandi saat ini.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[12px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Kata Sandi Baru</label>
                                <input type="password" name="password" class="w-full border border-gray-300 rounded-[8px] px-4 py-2.5 text-[14px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-[8px] px-4 py-2.5 text-[14px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right pt-4">
                        <button type="submit" class="bg-primary-dark text-white font-bold py-3 px-8 rounded-lg text-[13px] hover:bg-primary-teal transition shadow-sm flex items-center gap-2 inline-flex">
                            <i class="ph ph-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false }); @endif
        @if($errors->any()) Swal.fire({ icon: 'error', title: 'Gagal Menyimpan!', text: "{{ $errors->first() }}" }); @endif
    </script>
</body>
</html>