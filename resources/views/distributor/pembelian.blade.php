<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Pembelian Panen</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- TAMBAHKAN LIBRARY SWEETALERT2 UNTUK POP-UP CANTIK --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' } } }
        }
    </script>
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR DISTRIBUTOR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-truck text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] font-semibold tracking-wide">Distributor</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1.5 sidebar-scroll">
            <div class="text-[10px] font-semibold text-white/50 tracking-wider uppercase mb-2 px-3">Menu Utama</div>
            <a href="{{ route('distributor.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('distributor.dashboard') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition">
                <i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta Komoditas</span>
            </a>
            <a href="{{ route('distributor.pembelian') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('distributor.pembelian') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition">
                <i class="ph ph-shopping-cart text-[20px]"></i><span class="text-[15px]">Pembelian Panen</span>
            </a>
            <a href="{{ route('distributor.mitra') }}" class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('distributor.mitra') ? 'bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg' : 'text-white/70 hover:bg-white/5 hover:text-white rounded-lg' }} transition">
                <i class="ph ph-users text-[20px]"></i><span class="text-[15px]">Daftar Mitra Petani</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">
                    {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'DS' }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::check() ? Auth::user()->name : 'Distributor' }}</span>
                    <span class="text-[11px] text-white/60 capitalize">{{ Auth::check() ? Auth::user()->role : 'Mitra Bisnis' }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#EEEEEE] overflow-y-auto">
        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center px-8 shrink-0 z-10">
            <h2 class="text-[20px] font-semibold text-gray-900">Pembelian Panen</h2>
        </header>

        <div class="p-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-[16px] font-bold text-primary-dark">Daftar Penawaran Panen</h3>
                    {{-- TOMBOL BUAT PERMINTAAN --}}
                    <button onclick="buatPermintaan()" class="bg-primary-dark text-white px-4 py-2 rounded-lg text-[13px] font-bold hover:bg-primary-mid transition flex items-center gap-2">
                        <i class="ph ph-plus"></i> Buat Permintaan Pembelian
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-[11px] uppercase tracking-wider text-gray-500 font-bold border-b border-gray-100">
                                <th class="py-4 px-6">ID Transaksi</th>
                                <th class="py-4 px-6">Mitra Petani</th>
                                <th class="py-4 px-6">Komoditas</th>
                                <th class="py-4 px-6">Kuantitas</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-[13px] text-gray-700 divide-y divide-gray-100">
                            @forelse($permintaans as $req)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-4 px-6 font-semibold">REQ-00{{ $req->id }}</td>
                                    <td class="py-4 px-6">
                                        {{ $req->target_petani === 'all' ? '📢 Semua Petani' : '👨‍🌾 ' . $req->target_petani }}
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-primary-dark">{{ $req->komoditas }}</td>
                                    <td class="py-4 px-6">{{ $req->kuantitas }} Ton</td>
                                    <td class="py-4 px-6">
                                        @if($req->status == 'menunggu')
                                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-[11px] font-bold">Menunggu ACC</span>
                                        @elseif($req->status == 'diterima')
                                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-[11px] font-bold">Menunggu Pembayaran</span>
                                        @elseif($req->status == 'lunas')
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[11px] font-bold">Lunas</span>
                                        @elseif($req->status == 'ditolak')
                                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-[11px] font-bold">Ditolak</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-[11px] font-bold">{{ ucfirst($req->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center flex justify-center gap-2 mt-2">
                                        {{-- LOGIKA TOMBOL BERDASARKAN STATUS --}}
                                        @if($req->status == 'diterima')
                                            {{-- Jika di ACC petani, muncul tombol BAYAR --}}
                                            <button onclick="bayarPesanan({{ $req->id }}, '{{ $req->target_petani }}', '{{ $req->komoditas }}', {{ $req->kuantitas }})" class="bg-blue-500 text-white px-3 py-1.5 rounded text-[12px] font-semibold hover:bg-blue-600 transition shadow-sm">
                                                Bayar Sekarang
                                            </button>
                                        @else
                                            {{-- Jika selain 'diterima', muncul icon mata (Detail Dinamis) --}}
                                            <button onclick="lihatDetail('REQ-00{{ $req->id }}', '{{ $req->target_petani }}', '{{ $req->komoditas }}', '{{ strtoupper($req->status) }}', '{{ $req->created_at->format('d M Y') }}')" class="text-gray-400 hover:text-primary-dark transition" title="Lihat Detail">
                                                <i class="ph ph-eye text-xl"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-gray-400 font-semibold">
                                        Belum ada data permintaan pembelian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    {{-- SCRIPT UNTUK INTERAKSI TOMBOL --}}
    <script>
// Fungsi untuk tombol "Buat Permintaan Pembelian" dengan AJAX
        function buatPermintaan() {
            Swal.fire({
                title: 'Buat Permintaan Baru',
                html: `
                    <div style="text-align: left; font-size: 13px; margin-top: 10px;">
                        <label style="font-weight: bold; color: #555;">Kirim Ke:</label>
                        <select id="swal-input-petani" class="swal2-input" style="width: 100%; margin-top: 5px; font-size: 14px;">
                            <option value="all">📢 Broadcast (Semua Mitra Petani)</option>
                            <option value="Fajri">👨‍🌾 Fajri (Lahan Ciwidey)</option>
                            <option value="Reyhan">👨‍🌾 Reyhan (Lahan Ciwidey)</option>
                            <option value="Faiza">👩‍🌾 Faiza (Lahan Lembang)</option>
                            <option value="Alya">👩‍🌾 Alya (Lahan Pangalengan)</option>
                        </select>
                        
                        <label style="font-weight: bold; color: #555; display: block; margin-top: 15px;">Komoditas:</label>
                        {{-- Field komoditas sekarang bebas diketik --}}
                        <input id="swal-input-komoditas" type="text" class="swal2-input" style="width: 100%; margin-top: 5px; font-size: 14px;" placeholder="Ketik Komoditas (Misal: Sawi, Bawang...)">
                        
                        <label style="font-weight: bold; color: #555; display: block; margin-top: 15px;">Kuantitas (Ton):</label>
                        <input id="swal-input-kuantitas" type="number" step="0.1" class="swal2-input" style="width: 100%; margin-top: 5px; font-size: 14px;" placeholder="Misal: 5.5">
                    </div>
                `,
                confirmButtonText: 'Kirim Permintaan',
                confirmButtonColor: '#004F3B',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const petani = document.getElementById('swal-input-petani').value;
                    const komoditas = document.getElementById('swal-input-komoditas').value;
                    const kuantitas = document.getElementById('swal-input-kuantitas').value;
                    
                    if (!komoditas) {
                        Swal.showValidationMessage('Komoditas tidak boleh kosong!');
                        return false;
                    }
                    if (!kuantitas) {
                        Swal.showValidationMessage('Kuantitas tidak boleh kosong!');
                        return false;
                    }
                    
                    // Eksekusi AJAX Fetch API ke Laravel
                    return fetch("{{ route('distributor.permintaan.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json', // Memaksa Laravel membalas dengan JSON jika ada error
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            petani: petani,
                            komoditas: komoditas,
                            kuantitas: kuantitas
                        })
                    }).then(async response => {
                        if (!response.ok) {
                            // Menangkap pesan error asli dari Laravel
                            const errData = await response.json().catch(() => null);
                            const errMsg = errData && errData.message ? errData.message : response.statusText;
                            throw new Error(errMsg);
                        }
                        return { petani, komoditas, kuantitas };
                    }).catch(error => {
                        Swal.showValidationMessage(`Gagal: ${error.message}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    let targetText = result.value.petani === 'all' ? 'semua petani' : 'Petani ' + result.value.petani;
                    Swal.fire({
                        icon: 'success',
                        title: 'Permintaan Tercatat!',
                        text: result.value.kuantitas + ' Ton ' + result.value.komoditas + ' berhasil dikirim ke ' + targetText + '.',
                        confirmButtonColor: '#43B75D'
                    });
                }
            });
        }

        // Fungsi untuk tombol "Proses Beli"
        function prosesBeli(idTrx, namaPetani) {
            Swal.fire({
                title: 'Proses Pembelian?',
                text: "Anda akan memproses pembelian " + idTrx + " dari petani " + namaPetani + ".",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6', // Biru
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil diproses!',
                        text: 'Invoice telah dikirim ke ' + namaPetani + '.',
                        icon: 'success',
                        confirmButtonColor: '#43B75D'
                    });
                }
            });
        }

        // Fungsi untuk tombol "Booking"
        function prosesBooking(idTrx, namaPetani) {
            Swal.fire({
                title: 'Booking Panen?',
                text: "Lahan " + namaPetani + " masih menunggu masa panen. Lakukan pembayaran DP untuk mem-booking.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#F59E0B', // Kuning
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bayar DP Booking',
                cancelButtonText: 'Tutup'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Booking Berhasil!',
                        text: 'Panen ' + idTrx + ' sudah diamankan untuk Anda.',
                        icon: 'success',
                        confirmButtonColor: '#43B75D'
                    });
                }
            });
        }

        // Fungsi untuk tombol "Eye (Lihat Detail)"
        function lihatDetail(idTrx, namaPetani) {
            Swal.fire({
                title: 'Detail ' + idTrx,
                html: `
                    <div class="text-left space-y-2 mt-4 text-sm">
                        <p><strong>Petani:</strong> ${namaPetani}</p>
                        <p><strong>Komoditas:</strong> Bawang Putih Bonggol</p>
                        <p><strong>Status Pembayaran:</strong> <span class="text-green-600 font-bold">LUNAS</span></p>
                        <p><strong>Tanggal Transaksi:</strong> 2 Mei 2026</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonColor: '#004F3B',
                confirmButtonText: 'Tutup'
            });
        }

        // Fungsi Dinamis untuk Lihat Detail
        function lihatDetail(idTrx, namaPetani, komoditas, status, tanggal) {
            let statusColor = status === 'LUNAS' ? 'text-green-600' : (status === 'DITOLAK' ? 'text-red-600' : 'text-yellow-600');
            
            Swal.fire({
                title: 'Detail Transaksi ' + idTrx,
                html: `
                    <div class="text-left space-y-3 mt-4 text-sm bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div class="flex justify-between"><span class="text-gray-500">Mitra Petani:</span> <strong class="text-gray-900">${namaPetani === 'all' ? 'Semua Petani' : namaPetani}</strong></div>
                        <div class="flex justify-between"><span class="text-gray-500">Komoditas:</span> <strong class="text-primary-dark">${komoditas}</strong></div>
                        <div class="flex justify-between"><span class="text-gray-500">Tanggal Transaksi:</span> <strong class="text-gray-900">${tanggal}</strong></div>
                        <div class="flex justify-between border-t border-gray-200 pt-2 mt-2"><span class="text-gray-500">Status Pembayaran:</span> <strong class="${statusColor}">${status}</strong></div>
                    </div>
                `,
                icon: 'info',
                confirmButtonColor: '#004F3B',
                confirmButtonText: 'Tutup'
            });
        }

        // Fungsi Baru untuk Flow Pembayaran Distributor
        function bayarPesanan(id, petani, komoditas, kuantitas) {
            Swal.fire({
                title: 'Proses Pembayaran',
                html: `Anda akan membayar tagihan untuk <b>${kuantitas} Ton ${komoditas}</b> kepada petani <b>${petani === 'all' ? 'terpilih' : petani}</b>.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6e7d88',
                confirmButtonText: 'Konfirmasi Bayar',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`/distributor/permintaan/${id}/bayar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .catch(error => Swal.showValidationMessage(`Pembayaran Gagal: ${error}`));
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Pembayaran Berhasil!',
                        'Dana telah diteruskan ke petani. Status pesanan kini LUNAS.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    </script>
</body>
</html>