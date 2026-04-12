<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Detail Lokasi Titik Uji</h2>
        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
            Terarsip
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-gray-500 text-xs uppercase font-bold">Petugas Lab</p>
            <p class="text-gray-900 font-medium">{{ $location->petugasLab->nama }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-gray-500 text-xs uppercase font-bold">Koordinat</p>
            <p class="text-gray-900 font-medium">
                {{ $location->latitude }}, {{ $location->longitude }}
            </p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-gray-500 text-xs uppercase font-bold">Tanggal Pengujian</p>
            <p class="text-gray-900 font-medium">
                {{ $location->tanggal_uji->format('d M Y') }}
            </p>
        </div>
    </div>

    <!-- MAP -->
    <div id="map-show" style="height: 400px;" class="mb-6 border rounded-lg"></div>

    <div class="flex justify-start">
        <a href="/" class="text-blue-600 hover:underline">Kembali ke Daftar</a>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const lat = {{ $location->latitude ?? 0 }};
    const lng = {{ $location->longitude ?? 0 }};

    const map = L.map('map-show').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // marker
    L.marker([lat, lng]).addTo(map)
        .bindPopup("Lokasi Titik Uji")
        .openPopup();

    // fix rendering
    setTimeout(() => {
        map.invalidateSize();
    }, 200);

});
</script>