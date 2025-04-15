<?php
session_start();
include '../koneksi.php';

// Redirect jika belum login
if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

// Ambil username dari session
$username = $_SESSION['username'];

// Ambil data siswa berdasarkan username (yang sama dengan nis)
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$username'");
$siswa = mysqli_fetch_assoc($query);
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link px-3" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link px-3 active" href="profil.php">Profil</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="absen.php">Absen</a></li>
          <li class="nav-item"><a class="btn btn-danger" href="logout.php">Keluar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Profil Siswa -->
  <section class="container mt-5 pt-5 mb-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-md-8 bg-light p-4 rounded border border-dark shadow">
        <div class="row align-items-center">
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <?php
            $foto = !empty($siswa['foto']) ? $siswa['foto'] : 'banana-character.png';
            ?>
            <img src="../assets/img/<?= htmlspecialchars($foto); ?>" alt="Foto Siswa"
              class="img-thumbnail rounded-circle" style="width: 150px;height: 150px;">
          </div>
          <div class="col-md-8">
            <h2 class="fw-bold mb-3">Profil Siswa</h2>
            <table class="table table-borderless">
              <tbody >
                <tr>
                  <th class="bg-light">Nama</th>
                  <td class="bg-light">: <?= htmlspecialchars($siswa['nama']); ?></td>
                </tr>
                <tr>
                  <th class="bg-light">NIS</th>
                  <td class="bg-light">: <?= htmlspecialchars($siswa['nis']); ?></td>
                </tr>
                <tr>
                  <th class="bg-light">Kelas</th>
                  <td class="bg-light">: <?= htmlspecialchars($siswa['kelas']); ?></td>
                </tr>
                <tr>
                  <th class="bg-light">Jenis Kelamin</th>
                  <td class="bg-light">: <?= htmlspecialchars($siswa['jenis_kelamin']); ?></td>
                </tr>
              </tbody>
            </table>
            <a href="profil-edit.php" class="btn btn-dark mt-3">Edit Profil</a>
          </div>
        </div>
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