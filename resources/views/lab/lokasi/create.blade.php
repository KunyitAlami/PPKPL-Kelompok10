<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Lokasi GPS</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-3xl mx-auto bg-white border rounded-xl shadow-sm p-6">

    <!-- Header -->
    <h2 class="text-lg font-semibold mb-2">
        Input Koordinat GPS
    </h2>
    <p class="text-sm text-gray-600 mb-4">
        Pengajuan #{{ $soilTest->id }}
    </p>

    <a href="{{ route('lab.lokasi.index') }}"
       class="inline-block text-blue-500 text-sm hover:underline mb-4">
        ← Kembali
    </a>

    <!-- Map Section -->
    <div class="mb-5">
        <label class="block text-sm font-medium mb-1">
            Pilih Titik di Peta
        </label>
        <p class="text-xs text-gray-500 mb-2">
            Klik pada peta untuk menentukan koordinat otomatis.
        </p>

        <div id="map" class="h-80 w-full rounded-lg border"></div>
    </div>

    <!-- Revert Button -->
    <button type="button" id="btn-revert"
        class="mb-5 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
        ↺ Hapus Titik
    </button>

    <!-- Form -->
    <form action="{{ route('locations.store.simple') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Latitude -->
        <div>
            <label class="block text-sm font-medium mb-1">Latitude</label>
            <input 
                type="number" 
                step="any" 
                id="input-lat" 
                name="latitude" 
                required
                placeholder="-3.316694"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Longitude -->
        <div>
            <label class="block text-sm font-medium mb-1">Longitude</label>
            <input 
                type="number" 
                step="any" 
                id="input-lng" 
                name="longitude" 
                required
                placeholder="114.590111"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Uji</label>
            <input 
                type="date" 
                name="tanggal_uji" 
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Button -->
        <button 
            type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
            Simpan Lokasi & Jadwal
        </button>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var centerLat = -3.316694;
    var centerLng = 114.590111;

    var map = L.map('map').setView([centerLat, centerLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = null;

    var inputLat = document.getElementById('input-lat');
    var inputLng = document.getElementById('input-lng');
    var btnRevert = document.getElementById('btn-revert');

    // Klik map
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        inputLat.value = lat;
        inputLng.value = lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });

    // Input manual update map
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
            map.panTo(newPos);
        }
    }

    inputLat.addEventListener('input', updateMapFromInput);
    inputLng.addEventListener('input', updateMapFromInput);

    // Revert
    btnRevert.addEventListener('click', function() {
        if (marker) {
            map.removeLayer(marker);
            marker = null;
        }
        inputLat.value = '';
        inputLng.value = '';
    });

});
</script>

</body>
</html>