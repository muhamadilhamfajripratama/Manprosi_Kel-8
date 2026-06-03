<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Notifikasi Panen</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } }
            }
        }
    </script>
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>
<body class="bg-cream font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR NAVBAR UNIVERSAL --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-20">
        
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] leading-[28px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('/') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span>
            </a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('peta-gis*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span>
            </a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('lahan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span>
            </a>
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('penanaman*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-potted-plant text-[20px]"></i><span class="text-[15px]">Penanaman</span>
            </a>
            <a href="{{ route('jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('jadwal*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-calendar-blank text-[20px]"></i><span class="text-[15px]">Kalender Jadwal</span>
            </a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('irigasi*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span>
            </a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('pemupukan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span>
            </a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('hama*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span>
            </a>
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('perawatan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span>
            </a>
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('panen*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span>
            </a>
            <a href="{{ route('penjualan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('penjualan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span>
            </a>
            <a href="{{ route('laporan') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('laporan*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span>
            </a>
            <div class="h-px bg-white/10 my-2 mx-3"></div>
            <a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->is('notifikasi*') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition-colors">
                <i class="ph ph-bell-ringing text-[20px]"></i>
                <span class="text-[15px] flex-1">Notifikasi</span>
                
                {{-- Hitung langsung dari Model agar selalu muncul --}}
                @php
                    $notifCount = \App\Models\BatchTanam::countNotifikasiPanen();
                @endphp
                
                @if($notifCount > 0)
                    <span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">{{ $notifCount }}</span>
                @endif
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-gear text-[20px]"></i>
                <span class="text-[16px]">Pengaturan</span>
            </a>
        </nav>

        {{-- PROFIL SIDEBAR BAWAH --}}
        <div class="p-4 border-t border-white/10 shrink-0 hover:bg-white/5 transition flex items-center justify-between">
            
            {{-- Bagian ini dibungkus tag <a> agar bisa diklik menuju profil --}}
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
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-[28px] font-bold text-primary-dark flex items-center gap-3">
                <i class="ph ph-bell-ringing text-yellow-500"></i> Pemberitahuan Sistem
            </h2>
        </div>

        <div class="max-w-4xl">
            
            {{-- ======================================================= --}}
            {{-- 1. BLOK NOTIFIKASI PERMINTAAN DISTRIBUTOR (WARNA BIRU) --}}
            {{-- ======================================================= --}}
            @if(isset($permintaanDistributor) && $permintaanDistributor->count() > 0)
                @foreach($permintaanDistributor as $req)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border-l-[6px] border-blue-500 mb-4 flex items-start gap-5 transition hover:shadow-md">
                        
                        <div class="w-12 h-12 shrink-0 rounded-full flex items-center justify-center bg-blue-50 text-blue-600">
                            <i class="ph ph-handshake text-2xl"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-[16px] font-bold text-gray-900">Permintaan Pembelian Baru!</h3>
                                    <p class="text-[13px] text-gray-500 mt-1">Distributor ingin membeli <span class="font-bold text-primary-dark">{{ $req->kuantitas }} Ton</span> komoditas <span class="font-semibold">{{ $req->komoditas }}</span>.</p>
                                </div>
                                <span class="text-[12px] font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-md">
                                    {{ $req->created_at ? $req->created_at->diffForHumans() : 'Baru saja' }}
                                </span>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex gap-3">
                                {{-- Tombol TERIMA --}}
                                <button onclick="updateStatusPermintaan({{ $req->id }}, 'diterima')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-[12px] font-bold hover:bg-blue-700 transition flex items-center gap-2">
                                    <i class="ph ph-check-circle"></i> Terima & Buat Invoice
                                </button>
                                {{-- Tombol TOLAK --}}
                                <button onclick="updateStatusPermintaan({{ $req->id }}, 'ditolak')" class="bg-white border border-gray-200 text-gray-500 px-4 py-2 rounded-lg text-[12px] font-bold hover:bg-gray-50 transition">
                                    Tolak Permintaan
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            {{-- ======================================================= --}}
            {{-- 2. BLOK NOTIFIKASI JADWAL PANEN PETANI (MERAH/KUNING) --}}
            {{-- ======================================================= --}}
            @forelse($notifikasi as $notif)
                @php
                    // PEMBERSIH DESIMAL: Menghapus angka di belakang koma pada kalimat
                    $pesanBersih = preg_replace('/(\d+)\.\d+/', '$1', $notif->pesan);
                    
                    // ID AMAN: Mengantisipasi jika nama variabel ID batch berbeda
                    $idBatchAman = $notif->batch_id ?? $notif->id ?? 1;
                @endphp
            
                <div class="bg-white rounded-2xl p-6 shadow-sm border-l-[6px] {{ $notif->tipe == 'urgent' ? 'border-red-600' : 'border-yellow-400' }} mb-4 flex items-start gap-5 transition hover:shadow-md">
                    
                    <div class="w-12 h-12 shrink-0 rounded-full flex items-center justify-center {{ $notif->tipe == 'urgent' ? 'bg-red-50 text-red-600' : 'bg-yellow-50 text-yellow-600' }}">
                        <i class="ph {{ $notif->tipe == 'urgent' ? 'ph-warning-circle' : 'ph-clock-countdown' }} text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-[16px] font-bold text-gray-900">{{ $pesanBersih }}</h3>
                                <p class="text-[13px] text-gray-500 mt-1">Komoditas <span class="font-bold text-primary-dark">{{ $notif->komoditas }}</span> di <span class="font-semibold">{{ $notif->lahan }}</span>.</p>
                            </div>
                            <span class="text-[12px] font-bold {{ $notif->tipe == 'urgent' ? 'text-red-500 bg-red-50' : 'text-yellow-600 bg-yellow-50' }} px-3 py-1.5 rounded-md">
                                Est. Panen: {{ $notif->tgl_panen }}
                            </span>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-100 flex gap-3">
                            <a href="{{ route('panen') }}" class="bg-primary-dark text-white px-4 py-2 rounded-lg text-[12px] font-bold hover:bg-opacity-90 transition">
                                Proses Panen Sekarang
                            </a>
                            <a href="{{ url('/penanaman/detail/' . $idBatchAman) }}" class="bg-white border border-gray-200 text-gray-500 px-4 py-2 rounded-lg text-[12px] font-bold hover:bg-gray-50 transition block text-center">
                                Lihat Detail Lahan
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                {{-- Hanya tampilkan "Belum ada jadwal panen" JIKA tidak ada permintaan distributor juga --}}
                @if(!isset($permintaanDistributor) || $permintaanDistributor->count() == 0)
                    <div class="bg-white rounded-2xl p-10 shadow-sm border border-gray-100 text-center">
                        <i class="ph ph-check-circle text-5xl text-green-400 mb-3"></i>
                        <h3 class="text-[18px] font-bold text-gray-900">Pemberitahuan Kosong</h3>
                        <p class="text-[13px] text-gray-500 mt-1">Belum ada permintaan dari distributor atau jadwal panen terdekat.</p>
                    </div>
                @endif
            @endforelse
        </div>
    </main>
{{-- SCRIPT UNTUK UPDATE STATUS PERMINTAAN --}}
    <script>
        function updateStatusPermintaan(id, statusTarget) {
            let actionText = statusTarget === 'diterima' ? 'menerima' : 'menolak';
            let confirmBtnColor = statusTarget === 'diterima' ? '#43B75D' : '#d33';

            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin ingin ${actionText} permintaan ini?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#6e7d88',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    // Eksekusi AJAX Fetch ke Controller
                    fetch(`/permintaan/${id}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ status: statusTarget })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire(
                                'Berhasil!',
                                'Permintaan telah ' + statusTarget + '.',
                                'success'
                            ).then(() => {
                                // Refresh halaman otomatis untuk menghilangkan notifikasi
                                window.location.reload();
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
                    });
                }
            });
        }
    </script>
</body>
</html>