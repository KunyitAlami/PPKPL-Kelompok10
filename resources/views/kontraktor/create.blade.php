<div class="max-w-xl mx-auto bg-white border rounded-xl shadow-sm p-6">

    <h2 class="text-lg font-semibold mb-4">
        Ajukan Jadwal Uji Tanah
    </h2>

    <form action="{{ route('pengajuan.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Lokasi -->
        <div>
            <label class="block text-sm font-medium mb-1">
                Lokasi Proyek
            </label>
            <input 
                type="text" 
                name="lokasi_proyek" 
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Jenis Pengujian -->
        <div>
            <label class="block text-sm font-medium mb-1">
                Jenis Pengujian
            </label>
            <select 
                name="jenis_pengujian" 
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
                <option value="">-- Pilih Jenis --</option>
                <option value="Sondir">Sondir</option>
                <option value="Boring">Boring (SPT)</option>
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block text-sm font-medium mb-1">
                Tanggal Rencana
            </label>
            <input 
                type="date" 
                name="tanggal_keinginan" 
                required
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Button -->
        <div class="pt-2">
            <button 
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
            >
                Ajukan Jadwal
            </button>
        </div>

    </form>

</div>