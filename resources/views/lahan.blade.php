<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tani - Data Lahan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Leaflet CSS & Turf.js (Untuk hitung luas poligon otomatis) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: {
                        primary: { dark: '#004F3B', mid: '#43B75D', teal: '#003C3C' },
                        cream: '#FFF5E4',
                        gray: { 50: '#F9FAFB', 100: '#F3F4F6', 400: '#9CA3AF', 700: '#374151', 900: '#111827' }
                    },
                    boxShadow: { 'card': '0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.06)' }
                }
            }
        }
    </script>
    <style>
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }
        #map { height: 420px; border-radius: 12px; z-index: 1; }
        .leaflet-draw-toolbar a { border-radius: 6px !important; }
    </style>
</head>
<body class="bg-cream font-sans text-gray-700 h-screen flex overflow-hidden">

    {{-- SIDEBAR NAVBAR --}}
    <aside class="w-[260px] bg-primary-dark flex flex-col shrink-0 text-white shadow-xl z-20">
        
        <div class="h-[80px] flex items-center px-6 border-b border-white/10 shrink-0">
            <div class="w-8 h-8 rounded bg-primary-mid flex items-center justify-center mr-3">
                <i class="ph ph-leaf text-white text-xl"></i>
            </div>
            <h1 class="text-[20px] leading-[28px] font-semibold tracking-wide">Sistem Tani</h1>
        </div>

        <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-4 flex flex-col gap-1.5">
            <a href="/" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-house text-[20px]"></i><span class="text-[15px]">Dashboard</span></a>
            <a href="{{ route('peta.gis') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-map-trifold text-[20px]"></i><span class="text-[15px]">Peta GIS</span></a>
            
            {{-- Data Lahan (Aktif) --}}
            <a href="{{ route('lahan.index') }}" class="flex items-center gap-3 px-3 py-2.5 bg-primary-mid border-l-[3px] border-white text-white font-semibold rounded-r-lg transition-colors">
                <i class="ph ph-plant text-[20px]"></i><span class="text-[15px]">Data Lahan</span>
            </a>
            
            <a href="{{ route('penanaman') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-potted-plant text-[20px]"></i><span class="text-[15px]">Penanaman</span></a>
            <a href="{{ route('jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-calendar-blank text-[20px]"></i><span class="text-[15px]">Kalender Jadwal</span></a>
            <a href="{{ route('irigasi') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-drop text-[20px]"></i><span class="text-[15px]">Pengairan & Irigasi</span></a>
            <a href="{{ route('pemupukan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-flask text-[20px]"></i><span class="text-[15px]">Pemupukan</span></a>
            <a href="{{ route('hama') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-bug text-[20px]"></i><span class="text-[15px]">Pengendalian Hama</span></a>
            <a href="{{ route('perawatan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-wrench text-[20px]"></i><span class="text-[15px]">Perawatan Lain</span></a>
            <a href="{{ route('panen') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-package text-[20px]"></i><span class="text-[15px]">Hasil Panen</span></a>
            <a href="{{ route('penjualan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-money text-[20px]"></i><span class="text-[15px]">Penjualan</span></a>
            <a href="{{ route('laporan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors"><i class="ph ph-chart-bar text-[20px]"></i><span class="text-[15px]">Laporan</span></a>

            <div class="h-px bg-white/10 my-2 mx-3"></div>

            <a href="{{ route('notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors">
                <i class="ph ph-bell-ringing text-[20px]"></i><span class="text-[15px] flex-1">Notifikasi</span>
                @php $notifCount = \App\Models\BatchTanam::countNotifikasiPanen(); @endphp
                @if($notifCount > 0)<span class="bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-sm">{{ $notifCount }}</span>@endif
            </a>
            <a href="{{ route('pengaturan') }}" class="flex items-center gap-3 px-3 py-2.5 hover:bg-white/5 transition-colors">
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
                <button type="submit" title="Keluar" class="flex items-center justify-center"><i class="ph ph-sign-out text-white/50 hover:text-red-400 transition text-[20px]"></i></button>
            </form>
        </div>
    </aside>

    {{-- ================= MAIN CONTENT AREA ================= --}}
    <div class="flex-1 flex flex-col min-w-0 bg-cream">

        <header class="h-[64px] bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0 z-10">
            <div class="flex items-center gap-2">
                <span class="text-[12px] text-gray-400">Pages</span>
                <i class="ph ph-caret-right text-[10px] text-gray-400"></i>
                <a href="{{ route('lahan.index') }}" class="text-[12px] {{ $mode == 'index' ? 'text-gray-900 font-semibold' : 'text-gray-400 hover:text-primary-dark' }}">Data Lahan</a>
                
                @if($mode != 'index')
                <i class="ph ph-caret-right text-[10px] text-gray-400"></i>
                <span class="text-[20px] font-semibold text-gray-900 leading-none mt-0.5">
                    {{ $mode == 'create' ? 'Tambah Lahan' : ($mode == 'edit' ? 'Edit Lahan' : 'Detail Lahan') }}
                </span>
                @endif
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">

            @if($mode == 'index')
                {{-- TAMPILAN INDEX --}}
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-[32px] font-semibold text-primary-dark leading-tight">Data Lahan</h2>
                        <p class="text-[14px] text-gray-400 mt-1">Kelola semua data lahan pertanian Anda</p>
                    </div>
                    <a href="{{ route('lahan.create') }}" class="bg-primary-dark text-white px-6 py-3 rounded-[8px] font-semibold text-[14px] hover:bg-primary-teal transition shadow-sm flex items-center gap-2">
                        <i class="ph ph-plus-bold"></i> Tambah Lahan
                    </a>
                </div>

                @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-[10px] mb-6 flex items-center gap-3">
                    <i class="ph ph-check-circle text-[20px] text-green-600"></i>
                    <span class="text-[14px] font-semibold">{{ session('success') }}</span>
                </div>
                @endif

                <div class="bg-white rounded-[16px] shadow-card border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="text-left px-6 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Nama Lahan</th>
                                    <th class="text-left px-6 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Luas (ha)</th>
                                    <th class="text-left px-6 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($lahans as $i => $lahan)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4"><p class="text-[14px] font-semibold text-gray-900">{{ $lahan->nama_lahan }}</p></td>
                                    <td class="px-6 py-4 text-[14px] font-semibold text-gray-900">{{ number_format($lahan->luas_ha, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('lahan.show', $lahan) }}" class="w-8 h-8 rounded-[6px] bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition"><i class="ph ph-eye"></i></a>
                                            <a href="{{ route('lahan.edit', $lahan) }}" class="w-8 h-8 rounded-[6px] bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-100 transition"><i class="ph ph-pencil"></i></a>
                                            <form action="{{ route('lahan.destroy', $lahan) }}" method="POST" class="inline-block form-delete">
                                                @csrf @method('DELETE')
                                                <button type="button" class="w-8 h-8 rounded-[6px] bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition btn-hapus" title="Hapus Lahan">
                                                    <i class="ph ph-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center py-10 text-gray-500">Belum ada data lahan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            @elseif($mode == 'create' || $mode == 'edit')
                {{-- TAMPILAN CREATE & EDIT --}}
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-[32px] font-semibold text-primary-dark leading-tight">{{ $mode == 'create' ? 'Tambah Lahan Baru' : 'Edit Lahan' }}</h2>
                    </div>
                    <a href="{{ route('lahan.index') }}" class="border-[1.5px] border-gray-300 text-gray-700 px-5 py-2.5 rounded-[8px] font-semibold text-[14px] hover:bg-gray-50 transition flex items-center gap-2">
                        <i class="ph ph-arrow-left"></i> Kembali
                    </a>
                </div>

                <form action="{{ $mode == 'create' ? route('lahan.store') : route('lahan.update', $lahan) }}" method="POST" id="lahanForm">
                    @csrf @if($mode == 'edit') @method('PUT') @endif

                    <input type="hidden" name="titik_batas" id="titik_batas" value="{{ old('titik_batas', $mode == 'edit' ? json_encode($lahan->titik_batas) : '') }}">
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $mode == 'edit' ? $lahan->latitude : '') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $mode == 'edit' ? $lahan->longitude : '') }}">

                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-1 flex flex-col gap-5">
                            
                            @if ($errors->any())
                                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-[8px]">
                                    <strong class="font-semibold text-[13px]">Gagal menyimpan!</strong>
                                    <ul class="list-disc pl-5 mt-1 text-[12px]">
                                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="bg-white rounded-[16px] shadow-card border border-gray-100 p-6">
                                <h3 class="text-[15px] font-semibold text-gray-900 mb-5"><i class="ph ph-note-pencil text-primary-mid"></i> Informasi Lahan</h3>
                                
                                <div class="mb-4">
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nama Lahan</label>
                                    <input type="text" name="nama_lahan" value="{{ old('nama_lahan', $mode == 'edit' ? $lahan->nama_lahan : '') }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2 text-[14px]" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5 flex justify-between items-center">
                                        Luas (Hektar)
                                        <span class="text-[10px] text-primary-mid font-bold bg-green-50 px-2 py-0.5 rounded-full"><i class="ph ph-magic-wand"></i> Otomatis</span>
                                    </label>
                                    {{-- FIXED: Tambah ID 'luas_ha' agar terhubung dengan JS --}}
                                    <input type="number" id="luas_ha" name="luas_ha" step="0.01" value="{{ old('luas_ha', $mode == 'edit' ? $lahan->luas_ha : '') }}" class="w-full border border-gray-200 rounded-[8px] px-4 py-2 text-[14px] bg-gray-50 focus:bg-white transition" required placeholder="Gambar area di peta...">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Jenis Tanah</label>
                                    <select name="jenis_tanah" class="w-full border border-gray-200 rounded-[8px] px-4 py-2 text-[14px]" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach(['Alluvial','Latosol','Regosol','Grumosol','Andosol'] as $jenis)
                                            <option value="{{ $jenis }}" {{ old('jenis_tanah', $mode == 'edit' ? $lahan->jenis_tanah : '') === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Status Kepemilikan</label>
                                    <select name="status_kepemilikan" class="w-full border border-gray-200 rounded-[8px] px-4 py-2 text-[14px]" required>
                                        <option value="">Pilih Status</option>
                                        @foreach(['Milik Sendiri','Sewa','Gadai','Bagi Hasil'] as $status)
                                            <option value="{{ $status }}" {{ old('status_kepemilikan', $mode == 'edit' ? $lahan->status_kepemilikan : '') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Catatan</label>
                                    <textarea name="catatan" rows="2" class="w-full border border-gray-200 rounded-[8px] px-4 py-2 text-[14px]">{{ old('catatan', $mode == 'edit' ? $lahan->catatan : '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="bg-white rounded-[16px] shadow-card border border-gray-100 p-6 h-full">
                                <h3 class="text-[15px] font-semibold text-gray-900 mb-4 flex justify-between items-center">
                                    <span><i class="ph ph-map-trifold text-primary-mid"></i> Gambar Batas Lahan</span>
                                    <span class="text-[11px] text-gray-400 font-normal">Gunakan alat segi-lima di kiri peta untuk menggambar area.</span>
                                </h3>
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="bg-primary-dark text-white px-8 py-3 rounded-[8px] font-semibold text-[14px] hover:bg-primary-teal transition">
                            <i class="ph ph-floppy-disk"></i> Simpan Data
                        </button>
                    </div>
                </form>

            @elseif($mode == 'show')
                {{-- TAMPILAN SHOW --}}
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-[32px] font-semibold text-primary-dark leading-tight">{{ $lahan->nama_lahan }}</h2>
                    </div>
                    <a href="{{ route('lahan.index') }}" class="border-[1.5px] border-gray-300 text-gray-700 px-5 py-2.5 rounded-[8px] font-semibold text-[14px]">Kembali</a>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-1 bg-white p-6 rounded-[16px] shadow-card">
                        <p><strong>Luas:</strong> {{ $lahan->luas_ha }} ha</p>
                        <p><strong>Jenis Tanah:</strong> {{ $lahan->jenis_tanah }}</p>
                    </div>
                    <div class="col-span-2 bg-white p-6 rounded-[16px] shadow-card">
                        <div id="map"></div>
                    </div>
                </div>
            @endif

        </main>
    </div>

    {{-- ================= SCRIPT PETA (LEAFLET & TURF.JS) ================= --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

    @if($mode == 'create' || $mode == 'edit')
        <script>
            const existingLat = document.getElementById('latitude').value || -7.1044;
            const existingLng = document.getElementById('longitude').value || 107.3914;
            
            const ciwideyBounds = [
                [-7.2000, 107.3000],
                [-7.0000, 107.5000]  
            ];

            const map = L.map('map', {
                maxBounds: ciwideyBounds,
                maxBoundsViscosity: 1.0,
                minZoom: 12
            }).setView([existingLat, existingLng], 14);
            
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '© Esri'
            }).addTo(map);

            const drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            const drawControl = new L.Control.Draw({
                edit: { featureGroup: drawnItems },
                draw: { polygon: true, marker: true, polyline: false, rectangle: false, circle: false, circlemarker: false }
            });
            map.addControl(drawControl);

            // =========================================================
            // FUNGSI UPDATE DATA (KOORDINAT & PERHITUNGAN LUAS)
            // =========================================================
            function updateHiddenInput() {
                const data = drawnItems.toGeoJSON();
                
                if (data.features.length === 0) {
                    document.getElementById('titik_batas').value = '';
                    document.getElementById('latitude').value = '';
                    document.getElementById('longitude').value = '';
                } else {
                    const geom = data.features[0].geometry;
                    document.getElementById('titik_batas').value = JSON.stringify(geom);
                    
                    const layer = drawnItems.getLayers()[0];
                    if (layer instanceof L.Polygon) {
                        // 1. Simpan Center Koordinat
                        const center = layer.getBounds().getCenter();
                        document.getElementById('latitude').value = center.lat;
                        document.getElementById('longitude').value = center.lng;

                        // 2. HITUNG LUAS OTOMATIS MENGGUNAKAN TURF.JS
                        // turf.area mengembalikan luas dalam satuan Meter Persegi (m2)
                        const areaM2 = turf.area(data.features[0]);
                        // Konversi Meter Persegi ke Hektar (1 Ha = 10.000 m2)
                        const areaHa = (areaM2 / 10000).toFixed(2);
                        
                        // Suntikkan ke input form
                        document.getElementById('luas_ha').value = areaHa;
                    }
                }
            }

            @if($mode == 'edit')
                try {
                    let existingGeo = {!! json_encode($lahan->titik_batas ?? null) !!};
                    if (existingGeo) {
                        if (typeof existingGeo === 'string') {
                            existingGeo = JSON.parse(existingGeo);
                        }
                        const layer = L.geoJSON(existingGeo);
                        layer.eachLayer(l => drawnItems.addLayer(l));
                        map.fitBounds(layer.getBounds(), { padding: [20, 20] });
                        document.getElementById('titik_batas').value = JSON.stringify(existingGeo);
                    }
                } catch (e) {
                    console.error("Gagal memuat poligon:", e);
                }
            @endif

            // EVENT LISTENER GAMBAR POLIGON
            map.on(L.Draw.Event.CREATED, function(e) {
                drawnItems.clearLayers(); 
                drawnItems.addLayer(e.layer);
                updateHiddenInput();
            });

            map.on(L.Draw.Event.EDITED, function(e) {
                updateHiddenInput();
            });

            map.on(L.Draw.Event.DELETED, function(e) {
                updateHiddenInput();
                document.getElementById('luas_ha').value = ''; // Kosongkan luas jika dihapus
            });
        </script>
    @elseif($mode == 'show')
        <script>
            const lat = {{ $lahan->latitude ?? -7.1044 }};
            const lng = {{ $lahan->longitude ?? 107.3914 }};
            const ciwideyBounds = [ [-7.2000, 107.3000], [-7.0000, 107.5000] ];
            const map = L.map('map', { maxBounds: ciwideyBounds, maxBoundsViscosity: 1.0, minZoom: 12 }).setView([lat, lng], 15);
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { attribution: '© Esri' }).addTo(map);

            try {
                let geoData = {!! json_encode($lahan->titik_batas ?? null) !!};
                if(geoData) {
                    if (typeof geoData === 'string') geoData = JSON.parse(geoData);
                    const layer = L.geoJSON(geoData, { style: { color: '#43B75D', fillColor: '#43B75D', fillOpacity: 0.5, weight: 3 } }).addTo(map);
                    map.fitBounds(layer.getBounds());
                } else {
                    L.marker([lat, lng]).addTo(map);
                }
            } catch (e) {
                console.error("Gagal merender mode show", e);
            }
        </script>
    @endif
            
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.form-delete');
                Swal.fire({
                    title: 'Hapus Lahan?',
                    text: "Data lahan yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#9CA3AF',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                })
            });
        });

        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false }); @endif
        @if(session('error')) Swal.fire({ icon: 'error', title: 'Ditolak!', text: "{{ session('error') }}" }); @endif
    </script>
</body>
</html>