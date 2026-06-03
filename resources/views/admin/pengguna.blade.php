<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Manajemen Pengguna</title>
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
</head>
<body class="bg-gray-100 font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR ADMIN --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center mr-3 text-white">
                <i class="ph ph-shield-check text-xl"></i>
            </div>
            <h1 class="text-[20px] font-semibold tracking-wide">Administrator</h1>
        </div>

        <nav class="flex-1 py-6 px-4 flex flex-col gap-1.5">
            <div class="text-[10px] font-semibold text-white/50 tracking-wider uppercase mb-2 px-3">Master Data</div>
            
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition">
                <i class="ph ph-users-three text-[20px]"></i><span class="text-[15px]">Kelola Pengguna</span>
            </a>
            
            {{-- FIXED: Link Backup Data --}}
            <a href="{{ route('admin.backup') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition">
                <i class="ph ph-database text-[20px]"></i><span class="text-[15px]">Backup Data</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
            {{-- FIXED: Membuat profil menjadi link yang bisa diklik --}}
            <a href="{{ route('profil') }}" class="flex items-center gap-3 hover:opacity-80 transition cursor-pointer">
                <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">
                    AD
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight">Super Admin</span>
                    <span class="text-[11px] text-gray-300">Sistem Control</span>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 h-full bg-cream flex flex-col min-w-0">
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center px-8 shrink-0 z-10 justify-between">
            <span class="text-[20px] font-semibold text-gray-900">Manajemen Pengguna Sistem</span>
            
            {{-- FIXED: Tombol Pengaturan Profil di Header --}}
            <a href="{{ route('profil') }}" class="text-[13px] font-bold text-primary-dark hover:underline flex items-center gap-2">
                <i class="ph ph-user-gear"></i> Pengaturan Profil
            </a>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="bg-white rounded-[16px] shadow-card border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="text-[18px] font-semibold text-gray-900 flex items-center gap-2">
                        <i class="ph ph-users text-primary-mid"></i> Daftar Akun Terdaftar
                    </h3>
                    <button onclick="bukaModal('modalTambah')" class="px-5 py-2.5 bg-primary-dark text-white text-[13px] font-semibold rounded-[8px] flex items-center gap-2 hover:bg-primary-teal transition shadow-sm">
                        <i class="ph ph-user-plus text-lg"></i> Tambah Pengguna
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-[12px] font-semibold text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4 border-b border-gray-100">Nama Lengkap</th>
                                <th class="px-6 py-4 border-b border-gray-100">Email Login</th>
                                <th class="px-6 py-4 border-b border-gray-100">Hak Akses (Role)</th>
                                <th class="px-6 py-4 border-b border-gray-100">Tgl. Terdaftar</th>
                                <th class="px-6 py-4 border-b border-gray-100 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[13px] font-medium text-gray-700 divide-y divide-gray-50">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-900 font-bold">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $roleColors = [
                                                'admin' => 'bg-red-100 text-red-700',
                                                'petani' => 'bg-green-100 text-green-700',
                                                'distributor' => 'bg-amber-100 text-amber-700',
                                                'konsumen' => 'bg-blue-100 text-blue-700'
                                            ];
                                            $color = $roleColors[$user->role] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-md text-[11px] font-bold uppercase {{ $color }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="editData({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" class="w-8 h-8 rounded bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition"><i class="ph ph-pencil-simple"></i></button>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" class="form-delete">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="w-8 h-8 rounded bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition btn-hapus"><i class="ph ph-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">Tidak ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modalTambah" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[2000] backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-900">Tambah Pengguna Baru</h3>
                <button onclick="tutupModal('modalTambah')" class="text-gray-400 hover:text-red-500"><i class="ph ph-x text-lg"></i></button>
            </div>
            <form action="{{ route('admin.pengguna.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div><label class="block text-[12px] font-bold text-gray-700 mb-1">Nama Lengkap</label><input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid"></div>
                <div><label class="block text-[12px] font-bold text-gray-700 mb-1">Email</label><input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid"></div>
                <div><label class="block text-[12px] font-bold text-gray-700 mb-1">Password</label><input type="password" name="password" required minlength="6" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid"></div>
                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1">Hak Akses (Role)</label>
                    <select name="role" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid">
                        <option value="petani">Petani</option>
                        <option value="distributor">Distributor</option>
                        <option value="konsumen">Konsumen</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
                <div class="pt-2"><button type="submit" class="w-full bg-primary-dark text-white font-bold py-2.5 rounded-lg text-[13px] hover:bg-primary-teal transition">Simpan Pengguna</button></div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[2000] backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-900">Edit Pengguna</h3>
                <button onclick="tutupModal('modalEdit')" class="text-gray-400 hover:text-red-500"><i class="ph ph-x text-lg"></i></button>
            </div>
            <form id="formEdit" method="POST" class="p-6 space-y-4">
                @csrf @method('PUT')
                <div><label class="block text-[12px] font-bold text-gray-700 mb-1">Nama Lengkap</label><input type="text" name="name" id="edit_name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid"></div>
                <div><label class="block text-[12px] font-bold text-gray-700 mb-1">Email</label><input type="email" name="email" id="edit_email" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid"></div>
                <div><label class="block text-[12px] font-bold text-gray-700 mb-1">Password Baru <span class="text-gray-400 font-normal">(Kosongkan jika tidak diganti)</span></label><input type="password" name="password" minlength="6" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid"></div>
                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1">Hak Akses (Role)</label>
                    <select name="role" id="edit_role" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-[13px] focus:outline-none focus:border-primary-mid">
                        <option value="petani">Petani</option>
                        <option value="distributor">Distributor</option>
                        <option value="konsumen">Konsumen</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
                <div class="pt-2"><button type="submit" class="w-full bg-blue-600 text-white font-bold py-2.5 rounded-lg text-[13px] hover:bg-blue-700 transition">Update Data</button></div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Modal Logic
        function bukaModal(id) { document.getElementById(id).classList.replace('hidden', 'flex'); }
        function tutupModal(id) { document.getElementById(id).classList.replace('flex', 'hidden'); }
        
        function editData(id, name, email, role) {
            document.getElementById('formEdit').action = `/admin/pengguna/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            bukaModal('modalEdit');
        }

        // SweetAlert Delete & Flash Messages
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', function() {
                Swal.fire({ title: 'Hapus Akses?', text: "Pengguna ini tidak akan bisa login lagi!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#9CA3AF', confirmButtonText: 'Hapus!', cancelButtonText: 'Batal' }).then((res) => { if(res.isConfirmed) this.closest('.form-delete').submit(); });
            });
        });

        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false }); @endif
        @if(session('error')) Swal.fire({ icon: 'error', title: 'Ditolak!', text: "{{ session('error') }}" }); @endif
        @if($errors->any()) Swal.fire({ icon: 'error', title: 'Validasi Gagal!', text: "{{ $errors->first() }}" }); @endif
    </script>
</body>
</html>