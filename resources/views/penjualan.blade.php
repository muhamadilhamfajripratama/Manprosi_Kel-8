@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-primary-dark">Penjualan</h1>
        <button class="bg-primary-mid text-white px-4 py-2 rounded-[8px] hover:bg-primary-dark transition-colors flex items-center gap-2">
            <i class="ph ph-export"></i> Ekspor Data
        </button>
    </div>

    <!-- Banner Summary -->
    <div class="bg-primary-dark text-white rounded-[16px] p-8 mb-8 shadow-card flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex-1 text-center md:text-left">
            <p class="text-primary-mid font-medium mb-1">Total Pendapatan</p>
            <h2 class="text-3xl font-bold">Rp 45.800.000</h2>
        </div>
        <div class="hidden md:block w-px h-12 bg-white/20"></div>
        <div class="flex-1 text-center">
            <p class="text-white/70 font-medium mb-1">Transaksi</p>
            <h3 class="text-2xl font-bold">24 <span class="text-sm font-normal">Kali</span></h3>
        </div>
        <div class="hidden md:block w-px h-12 bg-white/20"></div>
        <div class="flex-1 text-center">
            <p class="text-white/70 font-medium mb-1">Terlaris</p>
            <h3 class="text-xl font-bold">Padi Sawah</h3>
        </div>
        <div class="hidden md:block w-px h-12 bg-white/20"></div>
        <div class="flex-1 text-center md:text-right">
            <p class="text-white/70 font-medium mb-1">Pembeli Aktif</p>
            <h3 class="text-2xl font-bold">5 <span class="text-sm font-normal">Mitra</span></h3>
        </div>
    </div>

    <!-- Tabel Penjualan -->
    <div class="bg-white rounded-[16px] shadow-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Riwayat Transaksi</h3>
            <div class="relative">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Cari transaksi..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-[8px] focus:outline-none focus:border-primary-mid text-sm">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary-dark text-white font-semibold text-[14px]">
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Batch</th>
                        <th class="p-4">Distributor</th>
                        <th class="p-4 text-right">Jumlah (kg)</th>
                        <th class="p-4 text-right">Harga/kg</th>
                        <th class="p-4 text-right">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4 text-sm text-gray-600">12 Ags 2026</td>
                        <td class="p-4 text-sm font-medium">Batch #001 - Padi</td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs">
                                    PT
                                </div>
                                <span class="text-sm font-medium text-gray-700">PT. Agro Maju</span>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-right">2.450</td>
                        <td class="p-4 text-sm text-right">Rp 6.000</td>
                        <td class="p-4 text-sm text-right font-bold text-primary-dark">Rp 14.700.000</td>
                    </tr>
                    <tr class="bg-gray-50 border-b border-gray-100 hover:bg-gray-100">
                        <td class="p-4 text-sm text-gray-600">28 Jul 2026</td>
                        <td class="p-4 text-sm font-medium">Batch #002 - Padi</td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-xs">
                                    CV
                                </div>
                                <span class="text-sm font-medium text-gray-700">CV. Tani Sejahtera</span>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-right">1.800</td>
                        <td class="p-4 text-sm text-right">Rp 5.800</td>
                        <td class="p-4 text-sm text-right font-bold text-primary-dark">Rp 10.440.000</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-4 text-sm text-gray-600">18 Jun 2026</td>
                        <td class="p-4 text-sm font-medium">Batch #003 - Jagung</td>
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-700 font-bold text-xs">
                                    UD
                                </div>
                                <span class="text-sm font-medium text-gray-700">UD. Pangan Lestari</span>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-right">850</td>
                        <td class="p-4 text-sm text-right">Rp 4.000</td>
                        <td class="p-4 text-sm text-right font-bold text-primary-dark">Rp 3.400.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 text-center">
            <button class="text-primary-mid hover:text-primary-dark font-medium text-sm">Lihat Semua Transaksi</button>
        </div>
    </div>
</main>
@endsection
