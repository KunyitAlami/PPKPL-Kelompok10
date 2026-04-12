Skills Document: Construction Quality Assurance Platform
Version: 1.0

Target Stack: Laravel 12, PHP 8.3+, MySQL 8 (Production), SQLite (Development).

1. Project Scope & Boundaries
Dokumen ini secara eksklusif mengatur pengembangan fitur Input Lokasi Titik Uji Tanah.

DI DALAM LINGKUP: Pengolahan koordinat Latitude/Longitude, integrasi peta (Leaflet/Google Maps API), validasi koordinat GPS, dan penyimpanan ke tabel soil_test_points.

DI LUAR LINGKUP: Sistem autentikasi kompleks (asumsikan user sudah login), manajemen penggajian pekerja, atau integrasi sensor IoT secara langsung.

2. Structural Blueprint (MVC)
Ikuti struktur folder standar Laravel 12 untuk menjaga konsistensi antar anggota kelompok:

Model: app/Models/SoilTestPoint.php (Gunakan Eloquent).

Controller: app/Http/Controllers/SoilTestController.php.

View: resources/views/soil_test/create.blade.php.

Request: app/Http/Requests/StoreSoilTestRequest.php (Validasi terpisah).

Migration: database/migrations/[timestamp]_create_soil_test_points_table.php.

3. Step-by-Step Task Execution
Saat mengimplementasikan fitur US 1.2, ikuti urutan ini:

Database Migration: Buat tabel dengan kolom: id, project_id (foreign key), latitude (decimal 10,8), longitude (decimal 11,8), recorded_at (timestamp). [1]

Model Configuration: Tambahkan properti $fillable untuk latitude dan longitude guna mencegah mass assignment error.

Form Validation: Gunakan aturan required|numeric|between:-90,90 untuk latitude dan between:-180,180 untuk longitude.

Controller Logic:

GET: Tampilkan form input.

POST: Validasi input, simpan ke database, dan kirimkan flash message sukses.

View Layer: Gunakan komponen Blade. Integrasikan peta sederhana yang memungkinkan user mengklik peta untuk mengisi otomatis input latitude/longitude.

4. Logical Decision Rules (If/Then)
JIKA input koordinat berada di luar rentang geografis yang valid, MAKA sistem harus membatalkan penyimpanan dan mengembalikan pesan error "Koordinat tidak valid".

JIKA aplikasi dijalankan di lingkungan Local, MAKA gunakan driver database sqlite. JIKA di Production, MAKA gunakan mysql.

JIKA user memasukkan teks (bukan angka) pada kolom koordinat, MAKA sistem harus langsung memicu pesan error validasi sebelum masuk ke database.

5. Unsupported Actions & Constraints
Tidak Mendukung: Penyimpanan data lokasi secara offline. Aplikasi memerlukan koneksi internet untuk memvalidasi peta.

Konflik Konfigurasi: Jangan menggunakan tipe data float untuk koordinat di MySQL; gunakan decimal(10,8) untuk akurasi tinggi. [2]

Kendala Lingkungan: SQLite tidak mendukung beberapa fitur spasial MySQL (seperti ST_Distance). Gunakan logika PHP murni untuk perhitungan jarak dasar jika diperlukan di lingkungan pengembangan.

Mode Kegagalan: Jika API Peta (Google Maps/Leaflet) gagal dimuat, sistem harus tetap mengizinkan input manual koordinat angka tanpa menghalangi proses simpan.
