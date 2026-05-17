@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8 bg-cream">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-primary-dark">Hasil Panen</h1>
            <p class="text-gray-500">Daftar panen yang telah selesai dan siap dijual.</p>
        </div>
        <button class="bg-primary-dark text-white px-4 py-2 rounded-[8px] hover:bg-primary-mid transition-colors flex items-center gap-2">
            <i class="ph ph-plus font-bold"></i> Catat Panen
        </button>
    </div>

    <div class="flex flex-col gap-4">
        <!-- Kartu Panen Grade A -->
        <div class="bg-white rounded-[16px] shadow-card p-6 border-l-8 border-[#43B75D] flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-xl font-bold text-gray-800">Batch #001 - Padi Sawah</h2>
                    <span class="bg-[#D1FAE5] text-[#065F46] rounded-full px-2 py-0.5 text-[12px] font-semibold">Grade A</span>
                </div>
                <p class="text-sm text-gray-500">Dipanen pada: 10 Agustus 2026 &bull; Umur Panen: 90 Hari</p>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Jumlah Panen</p>
                    <p class="text-3xl font-bold text-primary-dark">2.450 <span class="text-lg font-medium">kg</span></p>
                </div>
                <button class="bg-primary-mid text-white px-5 py-2.5 rounded-[8px] hover:bg-primary-dark transition-colors font-semibold">
                    Input Penjualan
                </button>
            </div>
        </div>

        <!-- Kartu Panen Grade B -->
        <div class="bg-white rounded-[16px] shadow-card p-6 border-l-8 border-[#F59E0B] flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-xl font-bold text-gray-800">Batch #002 - Padi Sawah</h2>
                    <span class="bg-[#FEF3C7] text-[#92400E] rounded-full px-2 py-0.5 text-[12px] font-semibold">Grade B</span>
                </div>
                <p class="text-sm text-gray-500">Dipanen pada: 25 Juli 2026 &bull; Umur Panen: 88 Hari</p>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Jumlah Panen</p>
                    <p class="text-3xl font-bold text-primary-dark">1.800 <span class="text-lg font-medium">kg</span></p>
                </div>
                <button class="bg-primary-mid text-white px-5 py-2.5 rounded-[8px] hover:bg-primary-dark transition-colors font-semibold">
                    Input Penjualan
                </button>
            </div>
        </div>

        <!-- Kartu Panen Grade C -->
        <div class="bg-white rounded-[16px] shadow-card p-6 border-l-8 border-[#EF4444] flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-xl font-bold text-gray-800">Batch #003 - Jagung Manis</h2>
                    <span class="bg-[#FEE2E2] text-[#991B1B] rounded-full px-2 py-0.5 text-[12px] font-semibold">Grade C</span>
                </div>
                <p class="text-sm text-gray-500">Dipanen pada: 15 Juni 2026 &bull; Umur Panen: 75 Hari (Diserang Wereng)</p>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Jumlah Panen</p>
                    <p class="text-3xl font-bold text-primary-dark">850 <span class="text-lg font-medium">kg</span></p>
                </div>
                <button class="bg-primary-mid text-white px-5 py-2.5 rounded-[8px] hover:bg-primary-dark transition-colors font-semibold">
                    Input Penjualan
                </button>
            </div>
        </div>
    </div>
</main>
@endsection
