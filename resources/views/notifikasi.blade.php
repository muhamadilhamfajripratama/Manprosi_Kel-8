@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-primary-dark">Notifikasi</h1>
            <button class="text-primary-mid hover:text-primary-dark font-medium text-sm flex items-center gap-1">
                <i class="ph ph-check-circle"></i> Tandai semua dibaca
            </button>
        </div>

        <!-- Tabs -->
        <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
            <button class="bg-primary-dark text-white px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap shadow-sm">Semua</button>
            <button class="bg-white text-gray-600 hover:bg-gray-50 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap shadow-sm border border-gray-200">Kesiapan Panen</button>
            <button class="bg-white text-gray-600 hover:bg-gray-50 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap shadow-sm border border-gray-200">Perawatan</button>
            <button class="bg-white text-gray-600 hover:bg-gray-50 px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap shadow-sm border border-gray-200">Sistem</button>
        </div>

        <!-- List Notifikasi -->
        <div class="space-y-4">
            <!-- Belum dibaca -->
            <div class="bg-[#F0FDF4] rounded-[12px] p-5 border-l-4 border-primary-mid shadow-sm flex gap-4 cursor-pointer hover:bg-[#DCFCE7] transition-colors relative">
                <div class="absolute top-5 right-5">
                    <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">BARU</span>
                </div>
                <div class="bg-[#D1FAE5] text-[#065F46] w-12 h-12 rounded-full flex items-center justify-center shrink-0">
                    <i class="ph ph-wheat text-xl font-bold"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-gray-800 mb-1">Batch #002 Siap Panen!</h4>
                    <p class="text-sm text-gray-600 mb-2">Estimasi umur panen sudah mencapai 88 hari. Persiapkan tenaga kerja untuk panen.</p>
                    <span class="text-xs text-gray-500 font-medium">Hari ini, 08:30 WIB</span>
                </div>
            </div>

            <!-- Belum dibaca -->
            <div class="bg-[#F0FDF4] rounded-[12px] p-5 border-l-4 border-blue-500 shadow-sm flex gap-4 cursor-pointer hover:bg-[#DCFCE7] transition-colors relative">
                <div class="absolute top-5 right-5">
                    <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">BARU</span>
                </div>
                <div class="bg-blue-100 text-blue-700 w-12 h-12 rounded-full flex items-center justify-center shrink-0">
                    <i class="ph ph-drop text-xl font-bold"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-gray-800 mb-1">Jadwal Pengairan Batch #004</h4>
                    <p class="text-sm text-gray-600 mb-2">Waktunya melakukan pengairan untuk blok B (Bawang Merah).</p>
                    <span class="text-xs text-gray-500 font-medium">Kemarin, 15:45 WIB</span>
                </div>
            </div>

            <!-- Sudah dibaca -->
            <div class="bg-white rounded-[12px] p-5 border-l-4 border-gray-300 shadow-sm flex gap-4 cursor-pointer hover:bg-gray-50 transition-colors">
                <div class="bg-gray-100 text-gray-500 w-12 h-12 rounded-full flex items-center justify-center shrink-0">
                    <i class="ph ph-money text-xl font-bold"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-gray-700 mb-1">Penjualan Berhasil Disimpan</h4>
                    <p class="text-sm text-gray-500 mb-2">Data penjualan Batch #001 ke PT. Agro Maju telah tercatat di sistem.</p>
                    <span class="text-xs text-gray-400 font-medium">12 Ags 2026, 14:00 WIB</span>
                </div>
            </div>

            <!-- Sudah dibaca -->
            <div class="bg-white rounded-[12px] p-5 border-l-4 border-gray-300 shadow-sm flex gap-4 cursor-pointer hover:bg-gray-50 transition-colors">
                <div class="bg-gray-100 text-gray-500 w-12 h-12 rounded-full flex items-center justify-center shrink-0">
                    <i class="ph ph-warning-circle text-xl font-bold"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-gray-700 mb-1">Peringatan Cuaca Ekstrem</h4>
                    <p class="text-sm text-gray-500 mb-2">Sistem mendeteksi potensi curah hujan tinggi minggu ini. Amankan saluran irigasi.</p>
                    <span class="text-xs text-gray-400 font-medium">10 Ags 2026, 09:15 WIB</span>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <button class="bg-white border border-gray-200 text-gray-600 px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
                Muat Lebih Banyak
            </button>
        </div>
    </div>
</main>
@endsection
