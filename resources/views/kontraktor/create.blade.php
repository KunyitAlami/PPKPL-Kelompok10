<form action="{{ route('pengajuan.store') }}" method="POST">
    @csrf
    <div>
        <label>Lokasi Proyek:</label>
        <input type="text" name="lokasi_proyek" required>
    </div>
    <div>
        <label>Jenis Pengujian:</label>
        <select name="jenis_pengujian" required>
            <option value="Sondir">Sondir</option>
            <option value="Boring">Boring (SPT)</option>
        </select>
    </div>
    <div>
        <label>Tanggal Rencana:</label>
        <input type="date" name="tanggal_keinginan" required>
    </div>
    <button type="submit">Ajukan Jadwal</button>
</form>