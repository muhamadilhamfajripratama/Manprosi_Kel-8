@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-primary-dark">Perawatan Lain</h1>
            <p class="text-gray-500">Kelola jadwal dan riwayat perawatan tanaman Anda.</p>
        </div>
        <button class="bg-primary-dark text-white px-4 py-2 rounded-[8px] hover:bg-primary-mid transition-colors flex items-center gap-2">
            <i class="ph ph-plus font-bold"></i> Tambah Kegiatan
        </button>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Kiri 35% -->
        <div class="w-full lg:w-[35%] bg-white rounded-[16px] shadow-card p-6 h-fit">
            <h2 class="text-lg font-semibold text-primary-dark mb-4">Pilih Batch Tanam</h2>
            <div class="space-y-3">
                <!-- Batch Item -->
                <div class="p-4 border border-primary-mid rounded-[12px] bg-[#D1FAE5] cursor-pointer">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-primary-dark">Batch #001</span>
                        <span class="bg-[#D1FAE5] text-[#065F46] rounded-full px-2 py-0.5 text-[12px] font-semibold">Aktif</span>
                    </div>
                    <p class="text-sm text-gray-600">Padi Sawah - Varietas IR64</p>
                    <p class="text-xs text-gray-500 mt-1">Ditanam: 10 Mei 2026</p>
                </div>
                <!-- Batch Item Inactive -->
                <div class="p-4 border border-gray-200 rounded-[12px] hover:border-primary-mid cursor-pointer transition-colors">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-gray-700">Batch #002</span>
                        <span class="bg-[#E0F2FE] text-[#0369A1] rounded-full px-2 py-0.5 text-[12px] font-semibold">Persiapan</span>
                    </div>
                    <p class="text-sm text-gray-600">Padi Sawah - Varietas Ciherang</p>
                    <p class="text-xs text-gray-500 mt-1">Rencana: 20 Mei 2026</p>
                </div>
            </div>
        </div>

        <!-- Kanan 65% -->
        <div class="w-full lg:w-[65%] bg-white rounded-[16px] shadow-card p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-primary-dark">Kegiatan Batch #001</h2>
                <div class="flex gap-3">
                    <div class="bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200 text-sm flex items-center gap-2">
                        <i class="ph ph-list-check text-primary-dark"></i> 12 Kegiatan
                    </div>
                    <div class="bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200 text-sm flex items-center gap-2">
                        <i class="ph ph-clock text-primary-mid"></i> 48 Jam
                    </div>
                    <div class="bg-gray-50 px-3 py-1.5 rounded-full border border-gray-200 text-sm flex items-center gap-2 font-semibold">
                        <i class="ph ph-coins text-yellow-600"></i> Rp 1.200.000
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-primary-dark text-white font-semibold text-[14px]">
                            <th class="p-4 rounded-tl-[8px]">Tanggal</th>
                            <th class="p-4">Jenis</th>
                            <th class="p-4">Deskripsi</th>
                            <th class="p-4 text-center">Jam Kerja</th>
                            <th class="p-4 text-right">Total Biaya</th>
                            <th class="p-4 text-center rounded-tr-[8px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 text-sm">12 Mei 2026</td>
                            <td class="p-4">
                                <span class="bg-[#FEF3C7] text-[#92400E] rounded-full px-2 py-0.5 text-[12px] font-semibold">Penyiangan</span>
                            </td>
                            <td class="p-4 text-sm text-gray-600">Pembersihan gulma area utara</td>
                            <td class="p-4 text-sm text-center">4 Jam</td>
                            <td class="p-4 text-sm text-right font-bold text-primary-dark">Rp 200.000</td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-primary-mid transition-colors"><i class="ph ph-pencil-simple text-lg"></i></button>
                            </td>
                        </tr>
                        <tr class="bg-gray-50 border-b border-gray-100 hover:bg-gray-100">
                            <td class="p-4 text-sm">08 Mei 2026</td>
                            <td class="p-4">
                                <span class="bg-[#E0F2FE] text-[#0369A1] rounded-full px-2 py-0.5 text-[12px] font-semibold">Pemangkasan</span>
                            </td>
                            <td class="p-4 text-sm text-gray-600">Pemangkasan daun bawah</td>
                            <td class="p-4 text-sm text-center">3 Jam</td>
                            <td class="p-4 text-sm text-right font-bold text-primary-dark">Rp 150.000</td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-primary-mid transition-colors"><i class="ph ph-pencil-simple text-lg"></i></button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 text-sm">05 Mei 2026</td>
                            <td class="p-4">
                                <span class="bg-[#D1FAE5] text-[#065F46] rounded-full px-2 py-0.5 text-[12px] font-semibold">Pemupukan</span>
                            </td>
                            <td class="p-4 text-sm text-gray-600">Pemberian Pupuk Urea</td>
                            <td class="p-4 text-sm text-center">2 Jam</td>
                            <td class="p-4 text-sm text-right font-bold text-primary-dark">Rp 450.000</td>
                            <td class="p-4 text-center">
                                <button class="text-gray-400 hover:text-primary-mid transition-colors"><i class="ph ph-pencil-simple text-lg"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
