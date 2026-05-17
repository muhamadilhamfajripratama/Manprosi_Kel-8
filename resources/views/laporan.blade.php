@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-primary-dark">Laporan Pendapatan</h1>
        <div class="flex gap-2">
            <select class="border border-gray-200 rounded-[8px] px-3 py-2 text-sm focus:outline-none focus:border-primary-mid bg-white">
                <option>Tahun 2026</option>
                <option>Tahun 2025</option>
            </select>
            <button class="bg-primary-mid text-white px-4 py-2 rounded-[8px] hover:bg-primary-dark transition-colors flex items-center gap-2">
                <i class="ph ph-printer"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <!-- Baris 1: 4 KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-[16px] shadow-card p-6 border-b-4 border-blue-500">
            <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
            <h3 class="text-2xl font-bold text-gray-800">Rp 45.8M</h3>
        </div>
        <div class="bg-white rounded-[16px] shadow-card p-6 border-b-4 border-red-500">
            <p class="text-sm text-gray-500 mb-1">Total Biaya Operasional</p>
            <h3 class="text-2xl font-bold text-gray-800">Rp 12.3M</h3>
        </div>
        <div class="bg-white rounded-[16px] shadow-card p-6 border-b-4 border-[#43B75D]">
            <p class="text-sm text-gray-500 mb-1">Laba Bersih</p>
            <h3 class="text-2xl font-bold text-[#065F46]">Rp 33.5M</h3>
        </div>
        <div class="bg-white rounded-[16px] shadow-card p-6 border-b-4 border-yellow-500">
            <p class="text-sm text-gray-500 mb-1">Batch Terprofitabel</p>
            <h3 class="text-xl font-bold text-gray-800">Batch #001 (Padi)</h3>
        </div>
    </div>

    <!-- Baris 2: Area Chart -->
    <div class="bg-white rounded-[16px] shadow-card p-6 mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Pendapatan vs Biaya</h3>
        <div class="w-full h-64 bg-gray-100 rounded-[8px] flex items-center justify-center border border-dashed border-gray-300">
            <span class="text-gray-400 font-medium">[Area Chart: Pendapatan vs Biaya]</span>
        </div>
    </div>

    <!-- Baris 3: Donut Chart & Top 5 Batch -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Kiri: Donut Chart -->
        <div class="bg-white rounded-[16px] shadow-card p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Komposisi Biaya</h3>
            <div class="w-full h-48 bg-gray-100 rounded-[8px] flex items-center justify-center border border-dashed border-gray-300">
                <span class="text-gray-400 font-medium">[Donut Chart: Pupuk, Tenaga Kerja, Bibit, Dll]</span>
            </div>
        </div>
        <!-- Kanan: Top 5 Batch -->
        <div class="bg-white rounded-[16px] shadow-card p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Top Batch Keuntungan</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                    <div>
                        <p class="font-bold text-gray-800">1. Batch #001 (Padi Sawah)</p>
                        <p class="text-xs text-gray-500">Selesai: 12 Ags 2026</p>
                    </div>
                    <span class="text-[#065F46] font-bold">+ Rp 10.500.000</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                    <div>
                        <p class="font-bold text-gray-800">2. Batch #002 (Padi Sawah)</p>
                        <p class="text-xs text-gray-500">Selesai: 28 Jul 2026</p>
                    </div>
                    <span class="text-[#065F46] font-bold">+ Rp 7.200.000</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                    <div>
                        <p class="font-bold text-gray-800">3. Batch #005 (Bawang Merah)</p>
                        <p class="text-xs text-gray-500">Selesai: 10 Mei 2026</p>
                    </div>
                    <span class="text-[#065F46] font-bold">+ Rp 6.800.000</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris 4: Tabel Rekap Per Batch -->
    <div class="bg-white rounded-[16px] shadow-card overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Rekapitulasi Per Batch</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary-dark text-white font-semibold text-[14px]">
                        <th class="p-4">ID Batch</th>
                        <th class="p-4">Komoditas</th>
                        <th class="p-4 text-right">Total Pendapatan</th>
                        <th class="p-4 text-right">Total Biaya</th>
                        <th class="p-4 text-right">Laba/Rugi</th>
                        <th class="p-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4 text-sm font-bold text-primary-dark">#001</td>
                        <td class="p-4 text-sm text-gray-700">Padi Sawah</td>
                        <td class="p-4 text-sm text-right">Rp 14.700.000</td>
                        <td class="p-4 text-sm text-right">Rp 4.200.000</td>
                        <td class="p-4 text-sm text-right font-bold text-[#065F46]">+ Rp 10.500.000</td>
                        <td class="p-4 text-center">
                            <span class="bg-[#E0F2FE] text-[#0369A1] rounded-full px-2 py-0.5 text-[12px] font-semibold">Selesai</span>
                        </td>
                    </tr>
                    <tr class="bg-gray-50 border-b border-gray-100 hover:bg-gray-100">
                        <td class="p-4 text-sm font-bold text-primary-dark">#002</td>
                        <td class="p-4 text-sm text-gray-700">Padi Sawah</td>
                        <td class="p-4 text-sm text-right">Rp 10.440.000</td>
                        <td class="p-4 text-sm text-right">Rp 3.240.000</td>
                        <td class="p-4 text-sm text-right font-bold text-[#065F46]">+ Rp 7.200.000</td>
                        <td class="p-4 text-center">
                            <span class="bg-[#E0F2FE] text-[#0369A1] rounded-full px-2 py-0.5 text-[12px] font-semibold">Selesai</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4 text-sm font-bold text-primary-dark">#003</td>
                        <td class="p-4 text-sm text-gray-700">Jagung Manis</td>
                        <td class="p-4 text-sm text-right">Rp 3.400.000</td>
                        <td class="p-4 text-sm text-right">Rp 4.500.000</td>
                        <td class="p-4 text-sm text-right font-bold text-[#991B1B]">- Rp 1.100.000</td>
                        <td class="p-4 text-center">
                            <span class="bg-[#FEE2E2] text-[#991B1B] rounded-full px-2 py-0.5 text-[12px] font-semibold">Rugi</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
