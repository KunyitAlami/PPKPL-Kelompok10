<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h2>Input Hasil Sondir (Lokasi ID #{{ $lokasi->id }})</h2>
    <a href="{{ route('teknisi.sondir.index') }}" style="text-decoration: none;">&larr; Batal</a>
    
    <div style="margin: 15px 0; padding: 15px; background-color: #e9ecef; border-radius: 5px;">
        <strong>Informasi Koordinat:</strong> {{ $lokasi->latitude }}, {{ $lokasi->longitude }}
    </div>

    @if($errors->any())
        <div style="color: red; margin-bottom: 15px;">Terdapat kesalahan pengisian, pastikan input berupa angka.</div>
    @endif

    <form action="{{ route('teknisi.sondir.store', $lokasi->id) }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Nilai qc (Perlawanan Konus - kg/cm²):</label><br>
            <input type="number" step="any" name="nilai_qc" required style="width: 300px; padding: 8px;">
            <small style="display: block; color: gray;">Nilai indikatif: <20 (Lunak), 20-50 (Sedang), >50 (Keras)</small>
        </div>
        <div style="margin-bottom: 20px;">
            <label>Nilai fs (Hambatan Lekat - kg/cm²):</label><br>
            <input type="number" step="any" name="nilai_fs" required style="width: 300px; padding: 8px;">
        </div>
        
        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Hasil Sondir</button>
    </form>
</div>