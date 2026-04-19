<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Koordinat Titik Uji</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-4xl mx-auto bg-white border rounded-xl shadow-sm p-6">

    <!-- Title -->
    <h2 class="text-xl font-bold mb-4">
        Input Koordinat Titik Uji
    </h2>

    <!-- Error -->
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lokasi.store', $soilTest->id) }}" 
          method="POST" 
          onsubmit="return validateForm()"
          class="space-y-4">
        @csrf

        <input type="hidden" name="pengajuan_id" value="{{ $soilTest->id ?? '' }}">

        <!-- Lat & Lng -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Latitude</label>
                <input 
                    type="text" 
                    name="latitude" 
                    id="latitude" 
                    readonly
                    class="w-full border rounded-lg px-3 py-2 bg-gray-100"
                >
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Longitude</label>
                <input 
                    type="text" 
                    name="longitude" 
                    id="longitude" 
                    readonly
                    class="w-full border rounded-lg px-3 py-2 bg-gray-100"
                >
            </div>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block text-sm font-medium mb-1">Tanggal Uji</label>
            <input 
                type="date" 
                name="tanggal_uji" 
                value="{{ date('Y-m-d') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Info -->
        <p class="text-sm text-gray-500">
            Klik pada peta untuk memilih lokasi
        </p>

        <!-- Map -->
        <div id="map" class="h-96 w-full border rounded-lg"></div>

        <!-- Button -->
        <button 
            type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
            Simpan Lokasi
        </button>

    </form>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const map = L.map('map').setView([-3.316694, 114.590111], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    setTimeout(() => {
        map.invalidateSize();
    }, 200);

    let marker;

    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(8);
        const lng = e.latlng.lng.toFixed(8);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng, { draggable: true }).addTo(map);

            marker.on('dragend', function(ev) {
                const pos = ev.target.getLatLng();
                document.getElementById('latitude').value = pos.lat.toFixed(8);
                document.getElementById('longitude').value = pos.lng.toFixed(8);
            });
        }

        marker.bindPopup(`Lat: ${lat}<br>Lng: ${lng}`).openPopup();
    });

});

function validateForm() {
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;

    if (!lat || !lng) {
        alert("Silakan pilih lokasi di peta terlebih dahulu!");
        return false;
    }

    return confirm(
        `Apakah lokasi ini sudah benar?\n\nLatitude: ${lat}\nLongitude: ${lng}`
    );
}
</script>

</body>
</html>