@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-primary-dark">Riwayat Batch</h1>
            <p class="text-gray-500">Telusuri kembali perjalanan setiap siklus tanam Anda.</p>
        </div>
        <div class="relative">
            <select class="border border-gray-200 rounded-[8px] px-4 py-2 pr-8 text-sm focus:outline-none focus:border-primary-mid bg-white appearance-none">
                <option>Batch #001 - Padi Sawah</option>
                <option>Batch #002 - Padi Sawah</option>
            </select>
            <i class="ph ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>
    </div>

    <!-- Header Besar Summary -->
    <div class="bg-primary-dark text-white rounded-[16px] p-8 mb-12 shadow-card flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h2 class="text-2xl font-bold mb-2">Batch #001 (Padi Sawah)</h2>
            <p class="text-primary-mid font-medium flex items-center gap-2">
                <i class="ph ph-calendar-check"></i> Selesai (10 Mei - 12 Ags 2026)
            </p>
        </div>
        <div class="text-center md:text-right bg-white/10 rounded-[12px] p-4 min-w-[200px]">
            <p class="text-sm text-white/80 mb-1">Laba Bersih Siklus Ini</p>
            <h3 class="text-3xl font-bold text-[#D1FAE5]">+ Rp 10.500.000</h3>
        </div>
    </div>

    <!-- Timeline Vertikal -->
    <div class="relative max-w-3xl mx-auto">
        <!-- Garis Vertikal Tengah -->
        <div class="absolute left-1/2 -translate-x-1/2 w-1 h-full bg-gray-200 rounded-full"></div>

        <!-- Item: Penanaman -->
        <div class="relative flex justify-between items-center mb-12 w-full">
            <div class="w-5/12"></div>
            <div class="z-10 bg-primary-dark w-10 h-10 rounded-full flex items-center justify-center border-4 border-cream text-white">
                <i class="ph ph-plant font-bold"></i>
            </div>
            <div class="w-5/12">
                <div class="bg-white rounded-[12px] shadow-sm p-5 border-l-4 border-primary-dark">
                    <span class="text-xs font-bold text-gray-500 mb-1 block">10 Mei 2026</span>
                    <h4 class="text-lg font-bold text-gray-800">Penanaman</h4>
                    <p class="text-sm text-gray-600 mt-2">Ditanam bibit IR64 area blok A seluas 2 Hektar.</p>
                </div>
            </div>
        </div>

        <!-- Item: Pemupukan -->
        <div class="relative flex justify-between items-center mb-12 w-full flex-row-reverse">
            <div class="w-5/12"></div>
            <div class="z-10 bg-[#43B75D] w-10 h-10 rounded-full flex items-center justify-center border-4 border-cream text-white">
                <i class="ph ph-flask font-bold"></i>
            </div>
            <div class="w-5/12 text-right">
                <div class="bg-white rounded-[12px] shadow-sm p-5 border-r-4 border-[#43B75D]">
                    <span class="text-xs font-bold text-gray-500 mb-1 block">25 Mei 2026</span>
                    <h4 class="text-lg font-bold text-gray-800">Pemupukan Tahap 1</h4>
                    <p class="text-sm text-gray-600 mt-2">Pemberian pupuk Urea 100kg.</p>
                    <p class="text-sm font-bold text-primary-dark mt-2">Biaya: Rp 800.000</p>
                </div>
            </div>
        </div>

        <!-- Item: Pengairan -->
        <div class="relative flex justify-between items-center mb-12 w-full">
            <div class="w-5/12"></div>
            <div class="z-10 bg-blue-500 w-10 h-10 rounded-full flex items-center justify-center border-4 border-cream text-white">
                <i class="ph ph-drop font-bold"></i>
            </div>
            <div class="w-5/12">
                <div class="bg-white rounded-[12px] shadow-sm p-5 border-l-4 border-blue-500">
                    <span class="text-xs font-bold text-gray-500 mb-1 block">10 Jun 2026</span>
                    <h4 class="text-lg font-bold text-gray-800">Pengairan Rutin</h4>
                    <p class="text-sm text-gray-600 mt-2">Pengecekan saluran irigasi dan pompa air.</p>
                </div>
            </div>
        </div>

        <!-- Item: Hama -->
        <div class="relative flex justify-between items-center mb-12 w-full flex-row-reverse">
            <div class="w-5/12"></div>
            <div class="z-10 bg-red-500 w-10 h-10 rounded-full flex items-center justify-center border-4 border-cream text-white">
                <i class="ph ph-bug font-bold"></i>
            </div>
            <div class="w-5/12 text-right">
                <div class="bg-white rounded-[12px] shadow-sm p-5 border-r-4 border-red-500">
                    <span class="text-xs font-bold text-gray-500 mb-1 block">05 Jul 2026</span>
                    <h4 class="text-lg font-bold text-gray-800">Penanganan Hama</h4>
                    <p class="text-sm text-gray-600 mt-2">Penyemprotan pestisida antisipasi wereng coklat.</p>
                    <p class="text-sm font-bold text-primary-dark mt-2">Biaya: Rp 450.000</p>
                </div>
            </div>
        </div>

        <!-- Item: Panen -->
        <div class="relative flex justify-between items-center mb-12 w-full">
            <div class="w-5/12"></div>
            <div class="z-10 bg-yellow-500 w-10 h-10 rounded-full flex items-center justify-center border-4 border-cream text-white">
                <i class="ph ph-wheat font-bold"></i>
            </div>
            <div class="w-5/12">
                <div class="bg-white rounded-[12px] shadow-sm p-5 border-l-4 border-yellow-500">
                    <span class="text-xs font-bold text-gray-500 mb-1 block">10 Ags 2026</span>
                    <h4 class="text-lg font-bold text-gray-800">Panen Raya</h4>
                    <p class="text-sm text-gray-600 mt-2">Hasil panen Grade A sebanyak 2.450 kg.</p>
                    <p class="text-sm font-bold text-primary-dark mt-2">Biaya Tukang: Rp 1.500.000</p>
                </div>
            </div>
        </div>

        <!-- Item: Penjualan -->
        <div class="relative flex justify-between items-center w-full flex-row-reverse">
            <div class="w-5/12"></div>
            <div class="z-10 bg-[#065F46] w-10 h-10 rounded-full flex items-center justify-center border-4 border-cream text-white">
                <i class="ph ph-money font-bold"></i>
            </div>
            <div class="w-5/12 text-right">
                <div class="bg-white rounded-[12px] shadow-sm p-5 border-r-4 border-[#065F46]">
                    <span class="text-xs font-bold text-gray-500 mb-1 block">12 Ags 2026</span>
                    <h4 class="text-lg font-bold text-gray-800">Penjualan</h4>
                    <p class="text-sm text-gray-600 mt-2">Dijual ke PT. Agro Maju seharga Rp 6.000/kg.</p>
                    <p class="text-sm font-bold text-[#065F46] mt-2">Pendapatan: Rp 14.700.000</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
