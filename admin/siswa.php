<?php
session_start();
include '../koneksi.php';

// Cek login admin
if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

// Ambil data semua siswa
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nama != 'ThisAdmin'");
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

<body style="background-image: url('../assets/img/this_background.png'); background-size: cover; background-position: center;">

  <!-- Navbar Admin -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg fixed-top">
    <div class="container-fluid px-3">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../assets/img/this_logo.png" alt="Logo" width="30" class="me-2">
        Admin Panel - AbsenKu
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link px-3" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link px-3 active" href="siswa.php">Siswa</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="absen.php">Absen</a></li>
          <li class="nav-item"><a class="btn btn-danger" href="logout.php">Keluar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold">Data Siswa</h3>
      <a href="siswa-tambah.php" class="btn btn-success">+ Tambah Siswa</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered border-dark table-striped table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="text-center align-middle">
          <?php
          $no = 1;
          while ($siswa = mysqli_fetch_assoc($query)) :
            $foto = !empty($siswa['foto']) ? $siswa['foto'] : 'profil.jpg';
          ?>
            <tr>
              <td><?= $no++; ?>.</td>
              <td>
                <img src="../assets/img/<?= htmlspecialchars($foto) ?>" alt="Foto" class="rounded-circle" style="height: 50px;width: 50px;">
              </td>
              <td><?= htmlspecialchars($siswa['nama']) ?></td>
              <td><?= htmlspecialchars($siswa['nis']) ?></td>
              <td><?= htmlspecialchars($siswa['kelas']) ?></td>
              <td><?= htmlspecialchars($siswa['jenis_kelamin']) ?></td>
              <td>
                <a href="siswa-edit.php?nis=<?= $siswa['nis'] ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="siswa-hapus.php?nis=<?= $siswa['nis'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

   <!-- Footer -->
   <footer class="bg-white border-top border-2 text-dark mt-5 pt-5 pb-3">
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
