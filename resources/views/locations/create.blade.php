<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Input Koordinat Titik Uji</h2>
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('lokasi.store', $soilTest->id) }}" method="POST" onsubmit="return validateForm()">
        @csrf
        <input type="hidden" name="pengajuan_id" value="{{ $soilTest->id ?? '' }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label>Latitude</label>
                <input type="text" name="latitude" id="latitude" readonly class="border p-2 w-full bg-gray-100">
            </div>
            <div>
                <label>Longitude</label>
                <input type="text" name="longitude" id="longitude" readonly class="border p-2 w-full bg-gray-100">
            </div>
        </div>

        <div class="mb-4">
            <label>Tanggal Uji</label>
            <input type="date" name="tanggal_uji" value="{{ date('Y-m-d') }}" class="border p-2 w-full">
        </div>

        <p class="text-sm text-gray-500 mb-2">
            Klik pada peta untuk memilih lokasi
        </p>

        <div id="map" style="height: 400px;" class="mb-4 border"></div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan Lokasi
        </button>
    </form>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

    const konfirmasi = confirm(
        `Apakah lokasi ini sudah benar?\n\nLatitude: ${lat}\nLongitude: ${lng}`
    );

    return konfirmasi;
}
</script>