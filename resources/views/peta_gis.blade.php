<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Peta Analisis GIS</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: { primary: { dark: '#004F3B', mid: '#43B75D' } },
                    boxShadow: { 'floating': '0 4px 20px rgba(0,0,0,0.15)' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR NAVBAR UNIVERSAL --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        
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
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition-colors">
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
                @php $notifCount = \App\Models\BatchTanam::countNotifikasiPanen(); @endphp
                @if($notifCount > 0)<span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">{{ $notifCount }}</span>@endif
            </a>
            <a href="{{ route('pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                <i class="ph ph-gear text-[20px]"></i><span class="text-[16px]">Pengaturan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 shrink-0 hover:bg-white/5 transition flex items-center justify-between">
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

    {{-- LOGIKA PENGAMBILAN DATA DINAMIS --}}
    @php
        // Ambil SEMUA data batch tanam untuk mendapatkan List Komoditas secara dinamis
        $semuaBatch = \App\Models\BatchTanam::all();
        
        // 1. Buat list unik Komoditas (dari Batch Penanaman). Gunakan ucwords agar rapi (padi -> Padi)
        $listKomoditasUnik = $semuaBatch->pluck('komoditas')->map(function($item) {
            return ucwords(strtolower(trim($item)));
        })->filter()->unique()->sort();

        // 2. Buat list unik Jenis Tanah (dari Data Lahan)
        $listTanahUnik = collect($lahans ?? [])->pluck('jenis_tanah')->map(function($item) {
            return ucwords(strtolower(trim($item)));
        })->filter()->unique()->sort();

        // 3. Masukkan Komoditas ke dalam Lahan agar JS Peta bisa membacanya
        if(isset($lahans)) {
            foreach($lahans as $lahan) {
                // Cari batch aktif di lahan ini
                $batchAktif = $semuaBatch->where('lahan_id', $lahan->id)->where('status', 'aktif')->first();
                // Jika tidak ada yang aktif, ambil batch history terakhir
                if(!$batchAktif) {
                    $batchAktif = $semuaBatch->where('lahan_id', $lahan->id)->sortByDesc('created_at')->first();
                }
                
                // Suntikkan properti baru bernama 'komoditas_saat_ini'
                $lahan->komoditas_saat_ini = $batchAktif ? ucwords(strtolower(trim($batchAktif->komoditas))) : 'Belum Ditanami';
            }
        }
    @endphp

    {{-- AREA MAP FULL SCREEN --}}
    <div class="flex-1 h-full relative z-10 bg-gray-900">
        
        <div id="map-gis" class="w-full h-full"></div>

        {{-- FLOATING PANEL: FILTER PETA --}}
        <div class="absolute top-6 left-6 w-[280px] bg-white rounded-[16px] shadow-floating p-5 z-[1000] border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-[15px] text-gray-900">Filter Peta</h3>
                <i class="ph ph-sliders text-gray-400 text-lg"></i>
            </div>
            
            <div class="space-y-3.5">
                {{-- Filter 1: Komoditas (Dari Penanaman) --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 mb-1">Komoditas</label>
                    <select id="filter-komoditas" onchange="eksekusiFilterGIS()" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid bg-white font-medium text-gray-700 shadow-sm hover:border-gray-300 transition">
                        <option value="">-- Semua Komoditas --</option>
                        @foreach($listKomoditasUnik as $komo)
                            <option value="{{ strtolower($komo) }}">{{ $komo }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter 2: Jenis Tanah (Dari Lahan) --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 mb-1">Jenis Tanah</label>
                    <select id="filter-tanah" onchange="eksekusiFilterGIS()" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid bg-white font-medium text-gray-700 shadow-sm hover:border-gray-300 transition">
                        <option value="">-- Semua Jenis Tanah --</option>
                        @foreach($listTanahUnik as $tanah)
                            <option value="{{ strtolower($tanah) }}">{{ $tanah }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter 3: Luas Lahan --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 mb-1">Luas Minimum (Ha)</label>
                    <input type="number" id="filter-luas" onkeyup="eksekusiFilterGIS()" onchange="eksekusiFilterGIS()" placeholder="0" class="w-full border border-gray-200 rounded-[8px] px-3 py-2 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid shadow-sm">
                </div>
                
                <button onclick="resetFilterGIS()" class="w-full border border-gray-200 text-gray-500 font-semibold rounded-[8px] py-2.5 text-[12px] mt-2 hover:bg-gray-50 transition shadow-sm">
                    Reset Filter
                </button>
            </div>
        </div>

    </div>

    {{-- SCRIPT JAVASCRIPT GIS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const boundsCiwidey = [
            [-7.2000, 107.3000], 
            [-7.0000, 107.5000]
        ];
        
        const map = L.map('map-gis', {
            maxBounds: boundsCiwidey,
            maxBoundsViscosity: 1.0,
            minZoom: 12,
            zoomControl: false 
        }).setView([-7.1044, 107.3914], 13);

        L.control.zoom({ position: 'bottomright' }).addTo(map);

        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
        }).addTo(map);

        const gisLayerGroup = L.layerGroup().addTo(map);
        // Menggunakan data lahan yang sudah disuntik komoditas_saat_ini dari PHP
        const dataLahans = @json($lahans ?? []);
        const localGisItems = [];

        if(dataLahans && dataLahans.length > 0) {
            dataLahans.forEach(lahan => {
                if(lahan.titik_batas) {
                    try {
                        let geoObj = (typeof lahan.titik_batas === 'string') ? JSON.parse(lahan.titik_batas) : lahan.titik_batas;
                        
                        let warnaPoligon = '#43B75D'; // Default Green
                        
                        const polyLayer = L.geoJSON(geoObj, {
                            style: { color: warnaPoligon, fillColor: warnaPoligon, fillOpacity: 0.5, weight: 2 }
                        });

                        // TOOLTIP UPDATE: Tampilkan komoditas yang ditarik dari Batch Tanam
                        polyLayer.bindTooltip(`
                            <div style="font-family: Montserrat, sans-serif; padding:2px;">
                                <strong style="color:${warnaPoligon}; font-size:13px; display:block; border-bottom:1px solid #eee; padding-bottom:4px; margin-bottom:4px;">
                                    ${lahan.nama_lahan}
                                </strong>
                                <span style="font-size:11px; color:#555;">
                                    Komoditas: <b>${lahan.komoditas_saat_ini}</b><br>
                                    Pemilik: <b>${lahan.petani ? lahan.petani.name : '-'}</b><br>
                                    Luas: <b>${lahan.luas_ha} Ha</b><br>
                                    Tanah: <b>${lahan.jenis_tanah}</b>
                                </span>
                            </div>
                        `, { sticky: true, opacity: 0.95 });

                        polyLayer.on('mouseover', function () { this.setStyle({ fillOpacity: 0.8, weight: 3 }); });
                        polyLayer.on('mouseout', function () { this.setStyle({ fillOpacity: 0.5, weight: 2 }); });

                        localGisItems.push({ data: lahan, layer: polyLayer });
                    } catch(e) { console.error("Gagal mendecode poligon GIS: ", e); }
                }
            });
        }

        // FUNGSI EKSEKUSI FILTER OTOMATIS
        function eksekusiFilterGIS() {
            gisLayerGroup.clearLayers();
            
            const filterKomoditas = document.getElementById('filter-komoditas').value.toLowerCase().trim();
            const filterTanah = document.getElementById('filter-tanah').value.toLowerCase().trim();
            const filterLuas = parseFloat(document.getElementById('filter-luas').value) || 0;

            const finalBounds = new L.LatLngBounds();
            let visibleCount = 0;

            localGisItems.forEach(item => {
                let match = true;
                
                // Pengecekan Komoditas (dari Batch Penanaman yang sudah kita suntik di PHP tadi)
                const namaKomoditas = item.data.komoditas_saat_ini ? item.data.komoditas_saat_ini.toLowerCase() : '';
                const jenisTanah = item.data.jenis_tanah ? item.data.jenis_tanah.toLowerCase() : '';
                const luasHa = parseFloat(item.data.luas_ha) || 0;

                // Logika Filter
                if(filterKomoditas && !namaKomoditas.includes(filterKomoditas)) match = false;
                if(filterTanah && !jenisTanah.includes(filterTanah)) match = false;
                if(luasHa < filterLuas) match = false;

                if(match) {
                    gisLayerGroup.addLayer(item.layer);
                    finalBounds.extend(item.layer.getBounds());
                    visibleCount++;
                }
            });

            if(visibleCount > 0 && finalBounds.isValid()) {
                map.fitBounds(finalBounds, { padding: [50, 50] });
            }
        }

        function resetFilterGIS() {
            document.getElementById('filter-komoditas').value = '';
            document.getElementById('filter-tanah').value = '';
            document.getElementById('filter-luas').value = '';
            eksekusiFilterGIS();
            
            map.setView([-7.1044, 107.3914], 13);
        }

        // Inisialisasi awal
        eksekusiFilterGIS();
    </script>
</body>
</html>