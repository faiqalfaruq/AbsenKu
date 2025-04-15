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

  <?php
  session_start();
  include '../config.php';

  $username = $_SESSION['username'] ?? '';
  $siswa = query("SELECT * FROM siswa WHERE nis = '$username'")[0] ?? null;

  // Cek apakah sudah absen hari ini
  $tanggal = date('Y-m-d');
  $cekAbsen = mysqli_query($koneksi, "SELECT * FROM absen WHERE nis = '$username' AND tanggal = '$tanggal'");
  $sudahAbsen = mysqli_num_rows($cekAbsen) > 0;

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$sudahAbsen) {
    $status = $_POST['status'];
    $waktu = date('H:i:s');

    mysqli_query($koneksi, "INSERT INTO absen (nis, status, tanggal, waktu) VALUES ('$username', '$status', '$tanggal', '$waktu')");
    echo "<script>alert('Absensi berhasil!'); window.location='absen.php';</script>";
  }

  // Ambil riwayat absensi siswa
  $riwayat = query("SELECT * FROM absen WHERE nis = '$username' ORDER BY tanggal DESC");
  ?>

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
          <li class="nav-item"><a class="nav-link px-3" href="profil.php">Profil</a></li>
          <li class="nav-item"><a class="nav-link active px-3" href="absen.php">Absen</a></li>
          <li class="nav-item"><a class="btn btn-danger" href="logout.php">Keluar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Absen Form -->
  <section class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 bg-light p-4 border border-dark rounded shadow">
        <h3 class="fw-bold mb-4">Form Absen</h3>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Status Kehadiran</label>
            <select name="status" class="form-select border border-dark" <?= $sudahAbsen ? 'disabled' : '' ?> required>
              <option selected disabled value="">Pilih Status</option>
              <option value="Hadir">Hadir</option>
              <option value="Izin">Izin</option>
              <option value="Sakit">Sakit</option>
              <option value="Alfa">Alfa</option>
            </select>
          </div>
          <?php if ($sudahAbsen): ?>
            <div class="alert alert-success">Kamu sudah absen hari ini.</div>
          <?php else: ?>
            <button type="submit" class="btn btn-dark">Kirim Absen</button>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </section>

  <!-- Riwayat Absen -->
  <section class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10 bg-light border border-dark p-4 rounded shadow">
        <h4 class="fw-bold mb-3">Riwayat Absen</h4>
        <div class="table-responsive">
          <table class="table table-striped border border-dark table-bordered">
            <thead class="table-dark text-center">
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Tanggal</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php
              $no = 1;
              foreach ($riwayat as $row): ?>
                <tr>
                  <td><?= $no++; ?>.</td>
                  <td><?= htmlspecialchars($siswa['nama']) ?></td>
                  <td><?= date('H:i:s', strtotime($row['waktu'])) ?></td>
                  <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                  <td>
                    <?php
                    $badge = [
                      'hadir' => 'success',
                      'izin' => 'primary',
                      'sakit' => 'warning',
                      'alfa' => 'danger'
                    ];
                    $status = htmlspecialchars($row['status']);
                    ?>
                    <span class="badge bg-<?= $badge[$status] ?? 'secondary' ?>">
                      <?= $status ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

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