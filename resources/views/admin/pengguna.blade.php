@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-primary-dark">Manajemen Pengguna</h1>
            <p class="text-gray-500">Kelola semua akun pengguna di Sistem Tani.</p>
        </div>
        <button class="bg-primary-dark text-white px-4 py-2 rounded-[8px] hover:bg-primary-mid transition-colors flex items-center gap-2">
            <i class="ph ph-user-plus font-bold"></i> Tambah Pengguna
        </button>
    </div>

    <!-- 4 Mini Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-[12px] p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="bg-gray-100 text-gray-600 w-10 h-10 rounded-full flex items-center justify-center">
                <i class="ph ph-users text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Total Pengguna</p>
                <h3 class="text-xl font-bold text-gray-800">458</h3>
            </div>
        </div>
        <div class="bg-white rounded-[12px] p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="bg-[#D1FAE5] text-[#065F46] w-10 h-10 rounded-full flex items-center justify-center">
                <i class="ph ph-plant text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Petani</p>
                <h3 class="text-xl font-bold text-gray-800">312</h3>
            </div>
        </div>
        <div class="bg-white rounded-[12px] p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="bg-blue-100 text-blue-700 w-10 h-10 rounded-full flex items-center justify-center">
                <i class="ph ph-truck text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Distributor</p>
                <h3 class="text-xl font-bold text-gray-800">142</h3>
            </div>
        </div>
        <div class="bg-white rounded-[12px] p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="bg-purple-100 text-purple-700 w-10 h-10 rounded-full flex items-center justify-center">
                <i class="ph ph-shield-star text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium">Admin</p>
                <h3 class="text-xl font-bold text-gray-800">4</h3>
            </div>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="bg-white rounded-[16px] shadow-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex gap-2 w-full md:w-auto">
                <div class="relative flex-1 md:w-64">
                    <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama atau email..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-[8px] focus:outline-none focus:border-primary-mid text-sm">
                </div>
                <select class="border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid bg-white">
                    <option>Semua Role</option>
                    <option>Petani</option>
                    <option>Distributor</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 font-semibold text-[13px] uppercase tracking-wider border-b border-gray-200">
                        <th class="p-4">Pengguna</th>
                        <th class="p-4">No. Telepon</th>
                        <th class="p-4">Role</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-dark text-white flex items-center justify-center font-bold text-sm">
                                    MR
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">M. Reyhan Armadani</p>
                                    <p class="text-xs text-gray-500">reyhan@sistemtani.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">0812-3456-7890</td>
                        <td class="p-4">
                            <span class="bg-[#D1FAE5] text-[#065F46] rounded-full px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase">Petani</span>
                        </td>
                        <td class="p-4 text-center">
                            <!-- Toggle Switch UI -->
                            <div class="relative inline-block w-10 h-5 align-middle select-none transition duration-200 ease-in cursor-pointer">
                                <input type="checkbox" name="toggle" id="toggle1" checked class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-[#43B75D] right-0 z-10 transition-transform duration-200 ease-in-out"/>
                                <label for="toggle1" class="toggle-label block overflow-hidden h-5 rounded-full bg-[#43B75D] cursor-pointer"></label>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center gap-2">
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600 flex items-center justify-center transition-colors" title="Lihat">
                                    <i class="ph ph-eye"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-600 flex items-center justify-center transition-colors" title="Edit">
                                    <i class="ph ph-pencil-simple"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-colors" title="Hapus">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="bg-gray-50 border-b border-gray-100 hover:bg-gray-100">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">
                                    PT
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">PT. Agro Maju</p>
                                    <p class="text-xs text-gray-500">contact@agromaju.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">021-9876-5432</td>
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-700 rounded-full px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase">Distributor</span>
                        </td>
                        <td class="p-4 text-center">
                            <!-- Toggle Switch UI (Active) -->
                            <div class="relative inline-block w-10 h-5 align-middle select-none transition duration-200 ease-in cursor-pointer">
                                <input type="checkbox" name="toggle" id="toggle2" checked class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-[#43B75D] right-0 z-10 transition-transform duration-200 ease-in-out"/>
                                <label for="toggle2" class="toggle-label block overflow-hidden h-5 rounded-full bg-[#43B75D] cursor-pointer"></label>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center gap-2">
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600 flex items-center justify-center transition-colors">
                                    <i class="ph ph-eye"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-600 flex items-center justify-center transition-colors">
                                    <i class="ph ph-pencil-simple"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-colors">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 3 (Inactive) -->
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4">
                            <div class="flex items-center gap-3 opacity-60">
                                <div class="w-10 h-10 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold text-sm">
                                    SP
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Slamet Purnomo</p>
                                    <p class="text-xs text-gray-500">slamet@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-500">0856-1122-3344</td>
                        <td class="p-4">
                            <span class="bg-[#D1FAE5] text-[#065F46] rounded-full px-2.5 py-1 text-[11px] font-bold tracking-wide uppercase opacity-70">Petani</span>
                        </td>
                        <td class="p-4 text-center">
                            <!-- Toggle Switch UI (Inactive) -->
                            <div class="relative inline-block w-10 h-5 align-middle select-none transition duration-200 ease-in cursor-pointer">
                                <input type="checkbox" name="toggle" id="toggle3" class="toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-300 left-0 z-10 transition-transform duration-200 ease-in-out"/>
                                <label for="toggle3" class="toggle-label block overflow-hidden h-5 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center gap-2">
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600 flex items-center justify-center transition-colors">
                                    <i class="ph ph-eye"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-600 flex items-center justify-center transition-colors">
                                    <i class="ph ph-pencil-simple"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-colors">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination Dummy -->
        <div class="p-4 border-t border-gray-100 flex justify-between items-center text-sm text-gray-600">
            <span>Menampilkan 1-10 dari 458 data</span>
            <div class="flex gap-1">
                <button class="px-3 py-1 border border-gray-200 rounded-[6px] hover:bg-gray-50 disabled:opacity-50">Sebelumnnya</button>
                <button class="px-3 py-1 bg-primary-dark text-white rounded-[6px]">1</button>
                <button class="px-3 py-1 border border-gray-200 rounded-[6px] hover:bg-gray-50">2</button>
                <button class="px-3 py-1 border border-gray-200 rounded-[6px] hover:bg-gray-50">3</button>
                <button class="px-3 py-1 border border-gray-200 rounded-[6px] hover:bg-gray-50">Selanjutnya</button>
            </div>
        </div>
    </div>
</main>
<style>
    /* Custom style for the toggle switch if tailwind peer doesn't work perfectly */
    .toggle-checkbox:checked {
        right: 0;
        border-color: #43B75D;
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #43B75D;
    }
    .toggle-checkbox:not(:checked) {
        left: 0;
        right: auto;
        border-color: #D1D5DB; /* gray-300 */
    }
    .toggle-checkbox:not(:checked) + .toggle-label {
        background-color: #D1D5DB; /* gray-300 */
    }
</style>
@endsection
