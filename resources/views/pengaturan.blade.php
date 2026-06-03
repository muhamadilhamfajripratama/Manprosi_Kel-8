<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Pengaturan</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D', light: '#E8F5E9' }, cream: '#EEEEEE' }
                }
            }
        }
    </script>
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-cream font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR NAVBAR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] leading-[28px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span></a>
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-potted-plant text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            <a href="{{ route('jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-calendar-blank text-[20px]"></i><span class="text-[15px]">Kalender Jadwal</span></a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
            <a href="{{ route('penjualan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span></a>
            <a href="{{ route('laporan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors"><i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span></a>

            <div class="h-px bg-white/10 my-2 mx-3"></div>

            <a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-bell-ringing text-[20px]"></i>
                <span class="text-[15px] flex-1">Notifikasi</span>
                @php $notifCount = \App\Models\BatchTanam::countNotifikasiPanen(); @endphp
                @if($notifCount > 0)<span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">{{ $notifCount }}</span>@endif
            </a>
            
            {{-- AKTIFKAN MENU PENGATURAN --}}
            <a href="{{ route('pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition-colors">
                <i class="ph ph-gear text-[20px]"></i>
                <span class="text-[16px]">Pengaturan</span>
            </a>
        </nav>

        {{-- PROFIL SIDEBAR BAWAH --}}
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
                <button type="submit" title="Keluar" class="flex items-center justify-center">
                    <i class="ph ph-sign-out text-white/50 hover:text-red-400 transition text-[20px]"></i>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto p-10">
        
        <div class="mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark">Pengaturan Sistem</h2>
            <p class="text-[13px] text-gray-500 mt-1">Kelola informasi profil, keamanan, dan preferensi akun Anda.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- BAGIAN KIRI: MENU NAVIGASI PENGATURAN --}}
            <div class="col-span-1 lg:col-span-3 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary-light text-primary-dark flex items-center justify-center font-bold text-[18px]">
                        {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'US' }}
                    </div>
                    <div>
                        <h4 class="font-bold text-[14px] text-gray-900">{{ Auth::check() ? Auth::user()->name : 'Nama Pengguna' }}</h4>
                        <p class="text-[11px] text-gray-400 capitalize">{{ Auth::check() ? Auth::user()->role : 'Petani' }}</p>
                    </div>
                </div>

                <div class="p-3 space-y-1">
                    <button onclick="switchTab('profil')" id="tab-profil" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-[13px] font-semibold bg-primary-light text-primary-dark transition">
                        <i class="ph ph-user text-lg"></i> Profil Akun
                    </button>
                    <button onclick="switchTab('keamanan')" id="tab-keamanan" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-[13px] font-semibold text-gray-500 hover:bg-gray-50 transition">
                        <i class="ph ph-lock-key text-lg"></i> Keamanan Password
                    </button>
                    <button onclick="switchTab('notifikasi')" id="tab-notifikasi" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-[13px] font-semibold text-gray-500 hover:bg-gray-50 transition">
                        <i class="ph ph-bell text-lg"></i> Preferensi Notifikasi
                    </button>
                </div>
            </div>

            {{-- BAGIAN KANAN: KONTEN PENGATURAN --}}
            <div class="col-span-1 lg:col-span-9 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                
                {{-- TAB 1: PROFIL AKUN --}}
                <div id="content-profil" class="tab-content active">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-[18px] font-bold text-gray-900">Profil Akun</h3>
                        <p class="text-[12px] text-gray-500 mt-1">Perbarui detail informasi akun Anda di sini.</p>
                    </div>

                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <i class="ph ph-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required class="w-full border border-gray-200 rounded-[8px] pl-10 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Alamat Email</label>
                                <div class="relative">
                                    <i class="ph ph-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required class="w-full border border-gray-200 rounded-[8px] pl-10 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Nomor HP / WhatsApp (Opsional)</label>
                                <div class="relative">
                                    <i class="ph ph-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="phone" placeholder="0812xxxxxx" class="w-full border border-gray-200 rounded-[8px] pl-10 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Role Akun</label>
                                <input type="text" disabled value="{{ Auth::check() ? strtoupper(Auth::user()->role) : 'PETANI' }}" class="w-full border border-gray-100 bg-gray-50 text-gray-400 rounded-[8px] px-4 py-2.5 text-[13px] cursor-not-allowed">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-primary-dark text-white px-6 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition shadow-sm">
                                Simpan Perubahan Profil
                            </button>
                        </div>
                    </form>
                </div>

                {{-- TAB 2: KEAMANAN (GANTI PASSWORD) --}}
                <div id="content-keamanan" class="tab-content">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-[18px] font-bold text-gray-900">Keamanan & Kata Sandi</h3>
                        <p class="text-[12px] text-gray-500 mt-1">Pastikan akun Anda tetap aman dengan menggunakan kata sandi yang kuat.</p>
                    </div>

                    <form action="#" method="POST" id="form-password">
                        @csrf
                        {{-- Ini hanya mockup UI form. Sesuaikan route() nya dengan route ganti password mu nanti --}}
                        <div class="max-w-md space-y-5 mb-6">
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Kata Sandi Saat Ini</label>
                                <div class="relative">
                                    <i class="ph ph-lock-key absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" name="current_password" required placeholder="Masukkan kata sandi lama" class="w-full border border-gray-200 rounded-[8px] pl-10 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                            <hr class="border-gray-100">
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Kata Sandi Baru</label>
                                <div class="relative">
                                    <i class="ph ph-lock-key-open absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full border border-gray-200 rounded-[8px] pl-10 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-500 mb-2">Konfirmasi Kata Sandi Baru</label>
                                <div class="relative">
                                    <i class="ph ph-check-circle absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full border border-gray-200 rounded-[8px] pl-10 pr-4 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start">
                            <button type="button" onclick="alertPalsu()" class="bg-primary-dark text-white px-6 py-2.5 rounded-[8px] font-semibold text-[13px] hover:bg-opacity-90 transition shadow-sm">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>

                {{-- TAB 3: PREFERENSI NOTIFIKASI --}}
                <div id="content-notifikasi" class="tab-content">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-[18px] font-bold text-gray-900">Preferensi Notifikasi</h3>
                        <p class="text-[12px] text-gray-500 mt-1">Pilih notifikasi apa saja yang ingin Anda terima.</p>
                    </div>

                    <div class="space-y-4">
                        {{-- Toggle 1 --}}
                        <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                    <i class="ph ph-package text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[13px] text-gray-800">Pengingat Panen</h4>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Dapatkan notifikasi ketika batch tanam sudah memasuki masa panen.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-mid"></div>
                            </label>
                        </div>

                        {{-- Toggle 2 --}}
                        <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <i class="ph ph-drop text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[13px] text-gray-800">Peringatan Kekeringan Lahan</h4>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Beritahu saya jika sebuah lahan belum diirigasi lebih dari 7 hari.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-mid"></div>
                            </label>
                        </div>

                        {{-- Toggle 3 --}}
                        <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                                    <i class="ph ph-envelope-simple text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[13px] text-gray-800">Laporan Mingguan (Email)</h4>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Kirimkan ringkasan pengeluaran dan kegiatan via Email setiap hari Minggu.</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-mid"></div>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- SCRIPT JAVASCRIPT UNTUK TAB PENGATURAN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function switchTab(tabId) {
            // 1. Sembunyikan semua konten tab
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // 2. Reset style semua tombol tab (buat jadi warna abu-abu / tidak aktif)
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-primary-light', 'text-primary-dark');
                btn.classList.add('text-gray-500', 'hover:bg-gray-50');
            });

            // 3. Tampilkan tab yang diklik dan ubah warnanya jadi hijau (aktif)
            document.getElementById('content-' + tabId).classList.add('active');
            const activeBtn = document.getElementById('tab-' + tabId);
            activeBtn.classList.remove('text-gray-500', 'hover:bg-gray-50');
            activeBtn.classList.add('bg-primary-light', 'text-primary-dark');
        }

        // Mockup fungsi untuk form ganti password (karena belum ada routenya di backend)
        function alertPalsu() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Kata sandi Anda berhasil diperbarui (Hanya Mockup).',
                timer: 3000,
                showConfirmButton: false
            });
            document.getElementById('form-password').reset();
        }

        // Alert Notifikasi dari Backend (Untuk update Profil)
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{!! session('success') !!}", timer: 3000, showConfirmButton: false });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Gagal!', text: "{!! session('error') !!}" });
            @endif
        });
    </script>
</body>
</html>