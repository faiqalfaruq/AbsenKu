<?php
session_start();
include '../koneksi.php';

// Cek login
if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

$username = $_SESSION['username'];

// Ambil data siswa
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$username'");
$siswa = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = htmlspecialchars($_POST['nama']);
  $kelas = htmlspecialchars($_POST['kelas']);
  $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
  $fotoLama = $siswa['foto'];
  $fotoBaru = $fotoLama;

  // Cek jika upload foto baru
  if (!empty($_FILES['foto']['name'])) {
    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    $namaBaru = uniqid() . '.' . $ext;

    $folder = '../assets/img/';
    move_uploaded_file($tmpName, $folder . $namaBaru);
    $fotoBaru = $namaBaru;

    // Hapus foto lama (jika bukan default)
    if (!empty($fotoLama) && file_exists($folder . $fotoLama) && $fotoLama !== 'banana-character.png') {
      unlink($folder . $fotoLama);
    }
  }

  // Update data
  mysqli_query($koneksi, "UPDATE siswa SET nama='$nama', kelas='$kelas', jenis_kelamin='$jenis_kelamin', foto='$fotoBaru' WHERE nis='$username'");
  echo "<script>alert('Profil berhasil diperbarui!'); window.location='profil.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AbsenKu</title>
  <link rel="icon" href="../assets/img/this_logo.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body
  style="background-image: url('../assets/img/this_background.png'); background-size: cover; background-position: center;">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-lg bg-light fixed-top">
    <div class="container-fluid px-3">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../assets/img/this_logo.png" alt="Logo" width="30" class="me-2" />
        AbsenKu
      </a>
    </div>
  </nav>

  <!-- Form Edit Profil -->
  <section class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 bg-light p-4 rounded border border-dark shadow">
        <h3 class="fw-bold text-center mb-4">Edit Profil</h3>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3 text-center">
            <img
              src="../assets/img/<?= empty($siswa['foto']) ? 'banana-character.png' : htmlspecialchars($siswa['foto']) ?>"
              alt="Foto Siswa" class="img-thumbnail rounded-circle" style="height: 150px;width: 150px;">
          </div>
          <div class="mb-3">
            <label class="form-label">Upload Foto Baru</label>
            <input type="file" name="foto" class="form-control border border-dark" accept="image/*">
          </div>
          <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control border border-dark bg-dark text-white"
              value="<?= htmlspecialchars($siswa['nis']); ?>" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control border border-dark"
              value="<?= htmlspecialchars($siswa['nama']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="kelas" class="form-select border border-dark" required>
              <option value="12 PPLG A" <?= $siswa['kelas'] === '12 PPLG A' ? 'selected' : '' ?>>12 PPLG A</option>
              <option value="12 PPLG B" <?= $siswa['kelas'] === '12 PPLG B' ? 'selected' : '' ?>>12 PPLG B</option>
              <option value="12 PPLG C" <?= $siswa['kelas'] === '12 PPLG C' ? 'selected' : '' ?>>12 PPLG C</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select border border-dark" required>
              <option value="Laki-laki" <?= $siswa['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
              <option value="Perempuan" <?= $siswa['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
          </div>
          <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-dark">Simpan perubahan</button>
          </div>
          <div class="d-grid gap-2 mt-2">
            <a href="profil.php" class="btn btn-danger">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </section>

 <!-- Footer -->
 <footer class="bg-white border-top border-2 mt-5 text-dark pt-5 pb-3">
        <div class="container-fluid px-4">
            <div class="row text-center">
                <div class="col-md-12 mb-3 text-center">
                    <div class="text-center mb-2">
                        <img src="../assets/img/this_logo.png" width="25" class="me-2" alt="Logo">
                        <h5 class="mb-0">AbsenKu</h5>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="index.php" class="text-dark text-decoration-none">&copy; AbsenKu 2025, All rights
                    reserved.</a>
            </div>
        </div>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>