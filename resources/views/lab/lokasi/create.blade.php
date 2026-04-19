<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>Input Koordinat GPS untuk Pengajuan #{{ $soilTest->id }}</h2>
    <a href="{{ route('lab.lokasi.index') }}" style="text-decoration: none; margin-bottom: 15px; display: inline-block;">&larr; Batal & Kembali</a>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div style="margin-bottom: 15px;">
        <label><strong>Pilih Titik di Peta:</strong></label>
        <p style="font-size: 12px; color: #666; margin: 5px 0;">Klik pada peta untuk menentukan koordinat otomatis.</p>
        <div id="map" style="height: 350px; width: 100%; max-width: 600px; border: 1px solid #ccc; border-radius: 5px;"></div>
    </div>

    <button type="button" id="btn-revert" style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 15px;">
        &#x21BA; Revert / Hapus Titik
    </button>
{{-- 
    {{ dd($soilTest) }} --}}
    {{-- <form action="{{ route('lab.lokasi.store', $soilTest->id) }}" method="POST"> --}}
    <form action="{{ route('locations.store.simple') }}" method="POST">
        @csrf
        <div style="margin-bottom: 10px;">
            <label>Latitude:</label><br>
            <input type="number" step="any" id="input-lat" name="latitude" required style="width: 300px; padding: 5px;" placeholder="Contoh: -3.316694">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Longitude:</label><br>
            <input type="number" step="any" id="input-lng" name="longitude" required style="width: 300px; padding: 5px;" placeholder="Contoh: 114.590111">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Tanggal Uji Pasti:</label><br>
            <input type="date" name="tanggal_uji" required style="width: 300px; padding: 5px;">
        </div>
        
        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px;">Simpan Lokasi & Jadwal</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Karena kamu di area Kalimantan Selatan (Banjarmasin), kita jadikan ini titik tengah default petanya
        var centerLat = -3.316694; 
        var centerLng = 114.590111;

        // Inisialisasi peta
        var map = L.map('map').setView([centerLat, centerLng], 13);

        // Load layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = null; // Variabel untuk menyimpan pin point
        
        var inputLat = document.getElementById('input-lat');
        var inputLng = document.getElementById('input-lng');
        var btnRevert = document.getElementById('btn-revert');

        // FUNGSI 1: Jika Peta di-klik
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Masukkan nilai ke form input
            inputLat.value = lat;
            inputLng.value = lng;

            // Taruh/Pindahkan marker (tanda)
            if (marker) {
                marker.setLatLng(e.latlng); // Geser marker jika sudah ada
            } else {
                marker = L.marker(e.latlng).addTo(map); // Buat marker baru
            }
        });

        // FUNGSI 2: Jika User mengetik angka manual di form, peta ikut update
        function updateMapFromInput() {
            var lat = parseFloat(inputLat.value);
            var lng = parseFloat(inputLng.value);

            if (!isNaN(lat) && !isNaN(lng)) {
                var newPos = new L.LatLng(lat, lng);
                if (marker) {
                    marker.setLatLng(newPos);
                } else {
                    marker = L.marker(newPos).addTo(map);
                }
                map.panTo(newPos); // Arahkan kamera peta ke titik baru
            }
        }
        inputLat.addEventListener('input', updateMapFromInput);
        inputLng.addEventListener('input', updateMapFromInput);

        // FUNGSI 3: Revert / Hapus Titik
        btnRevert.addEventListener('click', function() {
            if (marker) {
                map.removeLayer(marker); // Hapus pin dari peta
                marker = null;
            }
            // Kosongkan form
            inputLat.value = '';
            inputLng.value = '';
        });
    });
</script>