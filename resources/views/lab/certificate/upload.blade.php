<h2>Upload Sertifikat</h2>

<form action="{{ route('lab.certificate.store', $soilTest->id) }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf

    <input type="file" name="sertifikat_uji" required>

    @error('sertifikat_uji')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <button type="submit">Upload</button>
</form>