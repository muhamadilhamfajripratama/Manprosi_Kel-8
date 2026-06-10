<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Dashboard Distributor</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: { fontFamily: { sans: ['Montserrat', 'sans-serif'] }, colors: { primary: { dark: '#004F3B', mid: '#43B75D' }, cream: '#EEEEEE' }, boxShadow: { 'floating': '0 4px 20px rgba(0,0,0,0.15)' } }
            }
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

    {{-- LOGIKA PENGAMBILAN DATA DINAMIS --}}
    @php
        // Ambil SEMUA data batch tanam
        $semuaBatch = \App\Models\BatchTanam::all();

        // 1. Kumpulkan List Nama Komoditas Unik Untuk Dropdown Filter
        $listKomoditasUnik = $semuaBatch->pluck('komoditas')->map(function($item) {
            return ucwords(strtolower(trim($item)));
        })->filter()->unique()->sort();

        // 2. Masukkan Komoditas ke dalam Lahan agar JS Peta bisa membacanya
        if(isset($lahans)) {
            foreach($lahans as $lahan) {
                $batchAktif = $semuaBatch->where('lahan_id', $lahan->id)->where('status', 'aktif')->first();
                if(!$batchAktif) {
                    $batchAktif = $semuaBatch->where('lahan_id', $lahan->id)->sortByDesc('created_at')->first();
                }
                
                $lahan->komoditas_saat_ini = $batchAktif ? ucwords(strtolower(trim($batchAktif->komoditas))) : 'Belum Ditentukan';
            }
        }
    @endphp

    {{-- MAIN CONTENT (PETA FULL SCREEN) --}}
    <div class="flex-1 h-full relative z-10 bg-gray-900 flex flex-col">
        
        <div class="absolute top-0 left-0 right-0 h-16 bg-gradient-to-b from-black/60 to-transparent z-[1000] flex items-center px-8 pointer-events-none">
            <h2 class="text-white text-xl font-bold shadow-sm flex items-center gap-2">
                <i class="ph ph-map-pin-line text-primary-mid"></i> Peta Persebaran Komoditas Tani
            </h2>
        </div>

        <div id="map-distributor" class="w-full h-full"></div>

        {{-- FLOATING PANEL KIRI: PENCARIAN KOMODITAS --}}
        <div class="absolute top-20 left-6 w-[320px] bg-white rounded-[16px] shadow-floating p-5 z-[1000] border border-gray-100">
            <div class="flex items-center gap-3 mb-4 border-b border-gray-100 pb-3">
                <div class="w-8 h-8 rounded-full bg-primary-light text-primary-dark flex items-center justify-center"><i class="ph ph-magnifying-glass text-lg"></i></div>
                <div>
                    <h3 class="font-bold text-[14px] text-gray-900 leading-tight">Cari Komoditas</h3>
                    <p class="text-[11px] text-gray-500">Temukan area panen spesifik</p>
                </div>
            </div>
            
            <div class="space-y-4">
                {{-- FIXED: UPDATE JADI DROPDOWN DINAMIS --}}
                <div>
                    <label class="block text-[11px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Nama Komoditas</label>
                    <div class="relative">
                        <i class="ph ph-plant absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                        <select id="filter-komoditas" onchange="eksekusiFilter()" class="w-full border border-gray-300 rounded-[8px] pl-9 pr-8 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid transition appearance-none bg-white font-medium text-gray-700 cursor-pointer">
                            <option value="">-- Semua Komoditas --</option>
                            @foreach($listKomoditasUnik as $komo)
                                <option value="{{ strtolower($komo) }}">{{ $komo }}</option>
                            @endforeach
                        </select>
                        <i class="ph ph-caret-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none z-10"></i>
                    </div>
                </div>
                
                <div>
                    <label class="block text-[11px] font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Luas Minimal (Hektar)</label>
                    <input type="number" id="filter-luas" onkeyup="eksekusiFilter()" onchange="eksekusiFilter()" placeholder="Misal: 5" class="w-full border border-gray-300 rounded-[8px] px-3 py-2.5 text-[13px] focus:outline-none focus:border-primary-mid focus:ring-1 focus:ring-primary-mid transition">
                </div>
                
                <button onclick="resetFilter()" class="w-full bg-gray-100 text-gray-600 font-bold rounded-[8px] py-2.5 text-[12px] mt-2 hover:bg-gray-200 transition">
                    Reset Pencarian
                </button>
            </div>
            
            <div class="mt-4 pt-3 border-t border-gray-100">
                <p class="text-[10px] text-gray-400 text-center flex items-center justify-center gap-1">
                    <i class="ph ph-info"></i> Klik area pada peta untuk detail.
                </p>
            </div>
        </div>

        {{-- FLOATING PANEL KANAN: PREDIKSI PANEN 30 HARI --}}
        <div onclick="lihatDetailPrediksi()" class="absolute top-20 right-6 w-[320px] bg-gradient-to-br from-amber-600 to-amber-500 rounded-[16px] p-5 shadow-floating z-[1000] cursor-pointer hover:scale-[1.02] transition-transform border border-amber-400/50 flex items-center justify-between text-white">
            <div>
                <p class="text-white/80 text-[11px] font-bold uppercase tracking-wider mb-1">Estimasi Suplai (30 Hari)</p>
                <h3 class="text-2xl font-bold">{{ $prediksiStokTeks ?? '0 Kg' }}</h3>
                <p class="text-[10px] text-white/80 mt-1 flex items-center gap-1">
                    <i class="ph ph-hand-tap"></i> Klik lihat detail sumber
                </p>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm shrink-0">
                <i class="ph ph-truck text-2xl text-white"></i>
            </div>
        </div>

    </div>

    {{-- SCRIPT LEAFLET PETA --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const boundsCiwidey = [[-7.2000, 107.3000], [-7.0000, 107.5000]];
        const map = L.map('map-distributor', { maxBounds: boundsCiwidey, maxBoundsViscosity: 1.0, minZoom: 12, zoomControl: false }).setView([-7.1044, 107.3914], 13);
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { attribution: '© Esri' }).addTo(map);

        const layerGroup = L.layerGroup().addTo(map);
        const dataLahans = @json($lahans ?? []);
        const localItems = [];

        if(dataLahans && dataLahans.length > 0) {
            dataLahans.forEach(lahan => {
                if(lahan.titik_batas) {
                    try {
                        let geoObj = (typeof lahan.titik_batas === 'string') ? JSON.parse(lahan.titik_batas) : lahan.titik_batas;
                        
                        let komoditasName = lahan.komoditas_saat_ini ? lahan.komoditas_saat_ini : 'Belum Ditentukan';
                        let warna = '#43B75D'; // Default Hijau
                        
                        const polyLayer = L.geoJSON(geoObj, { style: { color: warna, fillColor: warna, fillOpacity: 0.6, weight: 2 } });

                        polyLayer.bindTooltip(`
                            <div style="font-family: Montserrat, sans-serif; min-width: 150px;">
                                <strong style="color:#004F3B; font-size:14px; display:block; border-bottom:1px solid #eee; padding-bottom:5px; margin-bottom:5px;">
                                    ${komoditasName.toUpperCase()}
                                </strong>
                                <div style="font-size:12px; color:#555; line-height:1.6;">
                                    <i class="ph ph-user text-primary-mid"></i> Petani: <b>${lahan.petani ? lahan.petani.name : '-'}</b><br>
                                    <i class="ph ph-map-pin text-primary-mid"></i> Lahan: <b>${lahan.nama_lahan}</b><br>
                                    <i class="ph ph-arrows-out text-primary-mid"></i> Luas: <b>${lahan.luas_ha} Ha</b>
                                </div>
                            </div>
                        `, { sticky: true, opacity: 0.95 });

                        polyLayer.on('mouseover', function () { this.setStyle({ fillOpacity: 0.9, weight: 3, color: '#F59E0B', fillColor: '#F59E0B' }); });
                        polyLayer.on('mouseout', function () { this.setStyle({ fillOpacity: 0.6, weight: 2, color: warna, fillColor: warna }); });

                        localItems.push({ data: lahan, layer: polyLayer, komoditasTxt: komoditasName.toString().toLowerCase() });
                    } catch(e) { console.error("Error geojson:", e); }
                }
            });
        }

        function eksekusiFilter() {
            layerGroup.clearLayers();
            const txtKomoditas = document.getElementById('filter-komoditas').value.toLowerCase().trim();
            const txtLuas = parseFloat(document.getElementById('filter-luas').value) || 0;
            const bounds = new L.LatLngBounds();
            let count = 0;

            localItems.forEach(item => {
                let match = true;
                const luasHa = parseFloat(item.data.luas_ha) || 0;

                if(txtKomoditas && !item.komoditasTxt.includes(txtKomoditas)) match = false;
                if(txtLuas > 0 && luasHa < txtLuas) match = false;

                if(match) {
                    layerGroup.addLayer(item.layer);
                    bounds.extend(item.layer.getBounds());
                    count++;
                }
            });

            if(count > 0 && bounds.isValid()) {
                map.fitBounds(bounds, { padding: [50, 50] });
            }
        }

        function resetFilter() {
            document.getElementById('filter-komoditas').value = '';
            document.getElementById('filter-luas').value = '';
            eksekusiFilter();
            map.setView([-7.1044, 107.3914], 13);
        }

        eksekusiFilter();
    </script>

    {{-- SCRIPT SWEETALERT UNTUK POP-UP PREDIKSI --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function lihatDetailPrediksi() {
            const details = @json($detailPrediksi ?? []);
            
            if(details.length === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Belum Ada Suplai',
                    text: 'Tidak ada jadwal panen dari mitra dalam 30 hari ke depan.',
                    confirmButtonColor: '#B45309'
                });
                return;
            }

            let htmlContent = '<div class="text-left space-y-3 mt-4 text-[13px] max-h-[60vh] overflow-y-auto pr-2">';
            details.forEach(item => {
                htmlContent += `
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex justify-between items-center shadow-sm">
                        <div>
                            <strong class="text-gray-900 block text-[15px] mb-1">${item.petani}</strong>
                            <span class="text-gray-500 text-[12px] flex items-center gap-1">
                                <i class="ph ph-map-pin"></i> ${item.lahan} (${item.luas} Ha)
                            </span>
                            <span class="text-primary-dark font-semibold text-[11px] mt-1 block px-2 py-0.5 bg-primary-light rounded w-fit">
                                ${item.komoditas}
                            </span>
                        </div>
                        <strong class="text-amber-600 text-xl font-bold">${item.estimasi}</strong>
                    </div>
                `;
            });
            htmlContent += '</div>';

            Swal.fire({
                title: 'Rincian Suplai Mitra',
                html: htmlContent,
                icon: 'info',
                confirmButtonColor: '#B45309',
                confirmButtonText: 'Tutup'
            });
        }
    </script>
</body>
</html>