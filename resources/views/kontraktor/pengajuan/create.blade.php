<form action="{{ route('pengajuan.store') }}" method="POST">
    @csrf
    
    <div style="margin-bottom: 15px;">
        <label>Pilih Proyek:</label><br>
        <select name="proyek_id" required style="width: 100%; padding: 8px;">
            <option value="">-- Pilih Proyek --</option>
            @foreach($proyeks as $proyek)
                <option value="{{ $proyek->id }}">{{ $proyek->nama_proyek ?? 'Proyek ID: '.$proyek->id }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Jenis Pengujian:</label><br>
        <select name="jenis_pengujian" required style="width: 100%; padding: 8px;">
            <option value="Sondir">Sondir</option>
            <option value="Boring">Boring (SPT)</option>
        </select>
    </div>

    <button type="submit" style="padding: 10px 15px;">Ajukan Jadwal</button>
</form>