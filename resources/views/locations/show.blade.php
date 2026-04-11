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
            <p class="text-gray-900 font-medium">{{ $location->latitude }}, {{ $location->longitude }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <p class="text-gray-500 text-xs uppercase font-bold">Tanggal Pengujian</p>
            <p class="text-gray-900 font-medium">{{ $location->tanggal_uji->format('d M Y') }}</p>
        </div>
    </div>

    <div id="map-show" class="w-full h-96 rounded-lg mb-6 border border-gray-300"></div>

    <div class="flex justify-start space-x-4">
        <a href="#" class="text-blue-600 hover:underline"> Kembali ke Daftar</a>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const lat = {{ $location->latitude }};
    const lng = {{ $location->longitude }};
    
    const mapShow = L.map('map-show').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(mapShow);

    L.marker([lat, lng]).addTo(mapShow)
        .bindPopup("Lokasi Titik Bor Tanah")
        .openPopup();
</script>