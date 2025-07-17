<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buku Tamu BPS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow p-4">
    <h3 class="text-primary mb-4">Form Buku Tamu</h3>
    <form action="simpan.php" method="POST">

      <div class="row">
        <!-- Nama -->
        <div class="col-md-6 mb-3">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>

        <!-- No HP -->
        <div class="col-md-6 mb-3">
          <label>Nomor Handphone</label>
          <input type="number" name="hp" class="form-control">
        </div>

        <!-- Jenis Kelamin -->
        <div class="col-md-6 mb-3">
          <label>Jenis Kelamin</label><br>
          <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="Laki-laki" class="form-check-input" required>
            <label class="form-check-label">Laki-laki</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="Perempuan" class="form-check-input" required>
            <label class="form-check-label">Perempuan</label>
          </div>
        </div>

        <!-- Pendidikan -->
        <div class="col-md-6 mb-3">
          <label>Pendidikan Tertinggi yang Ditamatkan</label>
          <select name="pendidikan" class="form-select" required>
            <option value="">---Pilih Salah Satu---</option>
            <option>SMA/SMK</option>
            <option>D1/D2/D3</option>
            <option>S1</option>
            <option>S2</option>
            <option>S3</option>
          </select>
        </div>

        <!-- Pekerjaan -->
        <div class="col-md-6 mb-3">
          <label>Pekerjaan Utama</label>
          <select name="pekerjaan" class="form-select" required>
            <option value="">---Pilih Salah Satu---</option>
            <option>Pelajar/Mahasiswa</option>
            <option>Peneliti/Dosen</option>
            <option>ASN/TNI/Polri</option>
            <option>Pegawai BUMN/BUMD</option>
            <option>Pegawai Swasta</option>
            <option>Wiraswasta</option>
            <option>Lainnya</option>
          </select>
        </div>

        <!-- Kategori Instansi -->
        <div class="col-md-6 mb-3">
          <label>Kategori Instansi</label>
          <select name="kategori_instansi" class="form-select" required>
            <option value="">---Pilih Salah Satu---</option>
            <option>Lembaga Negara</option>
            <option>Kementrian & Lembaga Pemerintahan</option>
            <option>TNI/POLRI/BIN/Kejaksaan</option>
            <option>Pemerintah Daerah</option>
            <option>Lembaga Internasional</option>
            <option>Lembaga Penlitian & Pendidikan</option>
            <option>BUMN/BUMD</option>
            <option>Swasta</option>
            <option>Lainnya</option>
          </select>
        </div>

        <!-- Nama Instansi -->
        <div class="col-md-6 mb-3">
          <label>Nama Instansi</label>
          <input type="text" name="nama_instansi" class="form-control">
        </div>

        <!-- Pemanfaatan -->
        <div class="col-md-12 mb-3">
          <label>Pemanfaatan Utama Hasil Kunjungan dan/atau Akses Layanan</label>
          <select name="pemanfaatan" class="form-select" required>
            <option value="">---Pilih Salah Satu---</option>
            <option>Tugas Sekolah / Kuliah</option>
            <option>Pemerintah</option>
            <option>Komersial</option>
            <option>Penelitian</option>
            <option>Lainnya</option>
          </select>
        </div>
      </div>

      <!-- Jenis Layanan -->
      <hr>
      <label class="mb-2">Jenis Layanan yang Digunakan</label><br>
      <div class="form-check">
        <input type="checkbox" name="layanan[]" value="Perpustakaan" class="form-check-input" onclick="toggleLayanan()">
        <label class="form-check-label">Perpustakaan</label>
      </div>
      <div class="form-check">
        <input type="checkbox" name="layanan[]" value="Permintaan Data" class="form-check-input" onclick="toggleLayanan()">
        <label class="form-check-label">Permintaan Data</label>
      </div>
      <div class="form-check">
        <input type="checkbox" name="layanan[]" value="Konsultasi Statistik" class="form-check-input" onclick="toggleLayanan()">
        <label class="form-check-label">Konsultasi Statistik</label>
      </div>
      <div class="form-check">
        <input type="checkbox" name="layanan[]" value="Rekomendasi" class="form-check-input" onclick="toggleLayanan()">
        <label class="form-check-label">Rekomendasi Kegiatan Statistik</label>
      </div>

      <!-- Form Lanjutan -->
      <div id="form-lanjutan" class="mt-3"></div>

      <hr>
      <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
  </div>
</div>

<!-- Script -->
<script>
function toggleLayanan() {
  const layananDipilih = [...document.querySelectorAll('input[name="layanan[]"]:checked')].map(cb => cb.value);
  let html = '';

  if (layananDipilih.includes('Perpustakaan')) {
    html += `
      <div class="form-group mb-3">
        <label>Judul Buku</label>
        <input type="text" name="perpustakaan_detail" class="form-control">
      </div>`;
  }

  if (layananDipilih.includes('Permintaan Data')) {
    html += `
      <div class="form-group mb-3">
        <label>Jenis Data yang Diminta</label>
        <input type="text" name="permintaan_data_detail" class="form-control">
      </div>`;
  }

  if (layananDipilih.includes('Konsultasi Statistik')) {
    html += `
      <div class="form-group mb-3">
        <label>Topik Konsultasi</label>
        <input type="text" name="konsultasi_detail" class="form-control">
      </div>`;
  }

  if (layananDipilih.includes('Rekomendasi')) {
    html += `
      <div class="form-group mb-3">
        <label>Jenis Rekomendasi</label>
        <input type="text" name="rekomendasi_detail" class="form-control">
      </div>`;
  }

  document.getElementById('form-lanjutan').innerHTML = html;
}
</script>

</body>
</html>
