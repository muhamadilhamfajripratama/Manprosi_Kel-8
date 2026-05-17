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

    {{-- SIDEBAR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-30">
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1.5">
            <div class="text-[10px] font-semibold text-white/50 tracking-wider uppercase mb-2 px-3">Menu Petani</div>
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition">
                <i class="ph ph-house text-[20px]"></i><span class="text-[16px]">Dashboard</span>
            </a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 bg-white/10 border-l-[3px] border-primary-mid text-white font-semibold rounded-r-lg transition">
                <i class="ph ph-map-trifold text-[20px]"></i><span class="text-[16px]">Peta GIS</span>
            </a>
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/5 hover:text-white rounded-lg transition">
                <i class="ph ph-plant text-[20px]"></i><span class="text-[16px]">Data Lahan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 shrink-0 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-white text-primary-dark flex items-center justify-center font-semibold text-[14px]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-[12px] font-semibold text-white leading-tight truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                    <span class="text-[11px] text-white/60 capitalize">{{ Auth::user()->role }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit"><i class="ph ph-sign-out text-white/50 hover:text-red-400 text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- AREA MAP FULL SCREEN --}}
    <div class="flex-1 h-full relative z-10 bg-gray-900">
        
        {{-- PETA LEAFLET --}}
        <div id="map-gis" class="w-full h-full"></div>

        {{-- FLOATING PANEL: FILTER PETA (Kiri Atas melayang) --}}
        <div class="absolute top-6 left-6 w-[280px] bg-white rounded-[16px] shadow-floating p-5 z-[1000] border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-[15px] text-gray-900">Filter Peta</h3>
                <i class="ph ph-sliders text-gray-400 text-lg"></i>
            </div>
            
            <div class="space-y-3.5">
                {{-- Filter 1: Komoditas (Input Ketik Bebas) --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 mb-1">Komoditas</label>
                    <input type="text" id="filter-komoditas" onkeyup="eksekusiFilterGIS()" placeholder="Ketik (misal: Bawang)" class="w-full border border-gray-200 rounded-[8px] px-3 py-1.5 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid">
                </div>
                {{-- Filter 2: Jenis Tanah --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 mb-1">Jenis Tanah</label>
                    <input type="text" id="filter-tanah" onkeyup="eksekusiFilterGIS()" placeholder="Misal: Latosol" class="w-full border border-gray-200 rounded-[8px] px-3 py-1.5 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid">
                </div>
                {{-- Filter 3: Luas Lahan --}}
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 mb-1">Luas Minimum (Ha)</label>
                    <input type="number" id="filter-luas" onkeyup="eksekusiFilterGIS()" onchange="eksekusiFilterGIS()" placeholder="0" class="w-full border border-gray-200 rounded-[8px] px-3 py-1.5 text-[13px] focus:outline-none focus:ring-1 focus:ring-primary-mid">
                </div>
                
                <button onclick="resetFilterGIS()" class="w-full border border-gray-200 text-gray-500 font-semibold rounded-[8px] py-2 text-[12px] mt-2 hover:bg-gray-50 transition shadow-sm">
                    Reset Filter
                </button>
            </div>
        </div>

    </div>

    {{-- SCRIPT JAVASCRIPT GIS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // 1. Inisialisasi Peta & Kunci Batas Ciwidey
        const boundsCiwidey = [
            [-7.2000, 107.3000], 
            [-7.0000, 107.5000]
        ];
        
        const map = L.map('map-gis', {
            maxBounds: boundsCiwidey,
            maxBoundsViscosity: 1.0,
            minZoom: 12,
            zoomControl: false // Matikan tombol default agar bisa digeser ke kanan bawah
        }).setView([-7.1044, 107.3914], 13);

        // Pindahkan tombol +/- zoom ke sudut kanan bawah
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // 2. Gunakan Peta Satelit Esri (Agar seragam dengan Dashboard)
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
        }).addTo(map);

        const gisLayerGroup = L.layerGroup().addTo(map);
        const dataLahans = @json($lahans ?? []);
        const localGisItems = [];

        if(dataLahans && dataLahans.length > 0) {
            dataLahans.forEach(lahan => {
                if(lahan.titik_batas) {
                    try {
                        let geoObj = (typeof lahan.titik_batas === 'string') ? JSON.parse(lahan.titik_batas) : lahan.titik_batas;
                        
                        // Menentukan warna poligon (Mengutamakan dari database, jika kosong fallback warna default)
                        let warnaPoligon = (lahan.komoditas && lahan.komoditas.warna) ? lahan.komoditas.warna : '#43B75D'; 
                        
                        // Buat Layer Polygon
                        const polyLayer = L.geoJSON(geoObj, {
                            style: { color: warnaPoligon, fillColor: warnaPoligon, fillOpacity: 0.5, weight: 2 }
                        });

                        // Tooltip Pop-up saat di hover
                        polyLayer.bindTooltip(`
                            <div style="font-family: Montserrat, sans-serif; padding:2px;">
                                <strong style="color:${warnaPoligon}; font-size:13px; display:block; border-bottom:1px solid #eee; padding-bottom:4px; margin-bottom:4px;">
                                    ${lahan.nama_lahan}
                                </strong>
                                <span style="font-size:11px; color:#555;">
                                    Komoditas: <b>${lahan.komoditas ? lahan.komoditas.nama_komoditas : '-'}</b><br>
                                    Pemilik: <b>${lahan.petani ? lahan.petani.name : '-'}</b><br>
                                    Luas: <b>${lahan.luas_ha} Ha</b>
                                </span>
                            </div>
                        `, { sticky: true, opacity: 0.95 });

                        // Efek Hover Poligon
                        polyLayer.on('mouseover', function () { this.setStyle({ fillOpacity: 0.8, weight: 3 }); });
                        polyLayer.on('mouseout', function () { this.setStyle({ fillOpacity: 0.5, weight: 2 }); });

                        localGisItems.push({ data: lahan, layer: polyLayer });
                    } catch(e) { console.error("Gagal mendecode poligon GIS: ", e); }
                }
            });
        }

        // 3. FUNGSI EKSEKUSI FILTER OTOMATIS (Tanpa tombol "Terapkan")
        function eksekusiFilterGIS() {
            gisLayerGroup.clearLayers();
            
            const filterKomoditas = document.getElementById('filter-komoditas').value.toLowerCase().trim();
            const filterTanah = document.getElementById('filter-tanah').value.toLowerCase().trim();
            const filterLuas = parseFloat(document.getElementById('filter-luas').value) || 0;

            const finalBounds = new L.LatLngBounds();
            let visibleCount = 0;

            localGisItems.forEach(item => {
                let match = true;
                
                const namaLahan = item.data.nama_lahan.toLowerCase();
                const namaKomoditas = item.data.komoditas ? item.data.komoditas.nama_komoditas.toLowerCase() : '';
                const jenisTanah = item.data.jenis_tanah ? item.data.jenis_tanah.toLowerCase() : '';
                const luasHa = parseFloat(item.data.luas_ha) || 0;

                // Cek Pencarian Komoditas (Mencari di nama_lahan ATAU nama_komoditas database)
                if(filterKomoditas && !(namaLahan.includes(filterKomoditas) || namaKomoditas.includes(filterKomoditas))) match = false;

                // Cek Jenis Tanah
                if(filterTanah && !jenisTanah.includes(filterTanah)) match = false;

                // Cek Luas Minimum
                if(luasHa < filterLuas) match = false;

                if(match) {
                    gisLayerGroup.addLayer(item.layer);
                    finalBounds.extend(item.layer.getBounds());
                    visibleCount++;
                }
            });

            // Fokus zoom peta otomatis
            if(visibleCount > 0 && finalBounds.isValid()) {
                map.fitBounds(finalBounds, { padding: [50, 50] });
            }
        }

        function resetFilterGIS() {
            document.getElementById('filter-komoditas').value = '';
            document.getElementById('filter-tanah').value = '';
            document.getElementById('filter-luas').value = '';
            eksekusiFilterGIS();
            
            // Kembalikan view peta ke default Ciwidey saat di-reset
            map.setView([-7.1044, 107.3914], 13);
        }

        // Jalankan pas pertama kali load biar peta langsung keisi penuh
        eksekusiFilterGIS();
    </script>
</body>
</html>