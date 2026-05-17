@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-primary-dark">Dashboard Distributor</h1>
            <p class="text-gray-500">Pantau ketersediaan komoditas dan petani mitra Anda.</p>
        </div>
        <div class="text-sm text-gray-500">
            <i class="ph ph-clock"></i> Terakhir diperbarui: Hari ini, 09:00 WIB
        </div>
    </div>

    <!-- 3 KPI Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-[16px] shadow-card p-6 flex items-center gap-4 border-l-4 border-blue-500">
            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                <i class="ph ph-users text-2xl font-bold"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Petani Terdaftar</p>
                <h3 class="text-2xl font-bold text-gray-800">124 <span class="text-sm font-normal text-gray-500">Mitra</span></h3>
            </div>
        </div>
        <div class="bg-white rounded-[16px] shadow-card p-6 flex items-center gap-4 border-l-4 border-primary-mid">
            <div class="w-14 h-14 rounded-full bg-[#D1FAE5] flex items-center justify-center text-[#065F46]">
                <i class="ph ph-wheat text-2xl font-bold"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Panen Bulan Ini</p>
                <h3 class="text-2xl font-bold text-gray-800">45.2 <span class="text-sm font-normal text-gray-500">Ton</span></h3>
            </div>
        </div>
        <div class="bg-white rounded-[16px] shadow-card p-6 flex items-center gap-4 border-l-4 border-yellow-500">
            <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                <i class="ph ph-package text-2xl font-bold"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Estimasi Stok Depan</p>
                <h3 class="text-2xl font-bold text-gray-800">18.5 <span class="text-sm font-normal text-gray-500">Ton</span></h3>
            </div>
        </div>
    </div>

    <!-- Peta Lebar -->
    <div class="bg-white rounded-[16px] shadow-card p-6 mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Peta Persebaran Komoditas Mitra</h3>
            <button class="text-primary-mid text-sm font-medium hover:underline">Lihat Detail Peta</button>
        </div>
        <div class="w-full h-[300px] bg-gray-200 rounded-[12px] flex flex-col items-center justify-center border border-dashed border-gray-400">
            <i class="ph ph-map-pin text-4xl text-gray-400 mb-2"></i>
            <span class="text-gray-500 font-medium text-lg">[Peta Persebaran Komoditas]</span>
        </div>
    </div>

    <!-- 2 Kolom Bawah -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kiri Tabel (2/3) -->
        <div class="lg:col-span-2 bg-white rounded-[16px] shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Tabel Kesiapan Panen</h3>
                <span class="bg-[#E0F2FE] text-[#0369A1] rounded-full px-3 py-1 text-xs font-semibold">7 Hari Kedepan</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-primary-dark text-white font-semibold text-[14px]">
                            <th class="p-4">Petani</th>
                            <th class="p-4">Komoditas</th>
                            <th class="p-4">Estimasi Hasil</th>
                            <th class="p-4">Status Panen</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-xs">A</div>
                                    <span class="text-sm font-medium text-gray-700">Ahmad Subagyo</span>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-600">Padi Sawah</td>
                            <td class="p-4 text-sm font-medium text-gray-700">~ 2.5 Ton</td>
                            <td class="p-4">
                                <span class="bg-[#D1FAE5] text-[#065F46] rounded-full px-2 py-0.5 text-[12px] font-semibold">Siap Panen (Besok)</span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="bg-primary-mid text-white px-3 py-1.5 rounded-[6px] text-xs font-semibold hover:bg-primary-dark transition-colors">Booking</button>
                            </td>
                        </tr>
                        <tr class="bg-gray-50 border-b border-gray-100 hover:bg-gray-100">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-xs">B</div>
                                    <span class="text-sm font-medium text-gray-700">Budi Santoso</span>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-600">Jagung Manis</td>
                            <td class="p-4 text-sm font-medium text-gray-700">~ 1.2 Ton</td>
                            <td class="p-4">
                                <span class="bg-[#FEF3C7] text-[#92400E] rounded-full px-2 py-0.5 text-[12px] font-semibold">3 Hari Lagi</span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="bg-primary-mid text-white px-3 py-1.5 rounded-[6px] text-xs font-semibold hover:bg-primary-dark transition-colors">Booking</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kanan Notifikasi (1/3) -->
        <div class="bg-white rounded-[16px] shadow-card flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Notifikasi Terbaru</h3>
                <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">2</span>
            </div>
            <div class="flex-1 p-4 space-y-3 overflow-y-auto max-h-[350px]">
                <!-- Item Notif -->
                <div class="p-3 bg-[#F0FDF4] rounded-[8px] border-l-4 border-primary-mid">
                    <h4 class="text-sm font-bold text-gray-800">Tawaran Baru</h4>
                    <p class="text-xs text-gray-600 mt-1">Siti Aminah menawarkan 500kg Bawang Merah.</p>
                    <p class="text-[10px] text-gray-400 mt-2">10 menit yang lalu</p>
                </div>
                <!-- Item Notif -->
                <div class="p-3 bg-white border border-gray-100 rounded-[8px] border-l-4 border-blue-400 hover:bg-gray-50 cursor-pointer">
                    <h4 class="text-sm font-bold text-gray-800">Status Pengiriman</h4>
                    <p class="text-xs text-gray-600 mt-1">Batch #001 dari Ahmad Subagyo sedang di jalan.</p>
                    <p class="text-[10px] text-gray-400 mt-2">2 jam yang lalu</p>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100 text-center">
                <button class="text-primary-mid hover:text-primary-dark font-medium text-sm">Lihat Semua</button>
            </div>
        </div>
    </div>
</main>
@endsection
