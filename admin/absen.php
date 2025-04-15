<?php
session_start();
include '../config.php';

if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

// Ambil data absen gabung dengan data siswa
$where = '';
if (isset($_GET['nis']) && $_GET['nis'] != '') {
  $nisFilter = mysqli_real_escape_string($koneksi, $_GET['nis']);
  $where = "WHERE a.nis = '$nisFilter'";
}

$query = mysqli_query($koneksi, "
  SELECT a.*, s.nama, s.kelas
  FROM absen a
  JOIN siswa s ON a.nis = s.nis
  $where
  ORDER BY a.tanggal DESC, a.waktu ASC
");

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
          <li class="nav-item"><a class="nav-link px-3" href="siswa.php">Siswa</a></li>
          <li class="nav-item"><a class="nav-link px-3 active" href="absen.php">Absen</a></li>
          <li class="nav-item"><a class="btn btn-danger" href="logout.php">Keluar</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-5 pt-5">
    <h3 class="fw-bold mb-4">Rekap Absen Siswa</h3>

    <form method="get" class="mb-4 d-flex" action="">
      <input type="text" name="nis" class="form-control border border-dark me-2" placeholder="Masukkan NIS" required
        value="<?= $_GET['nis'] ?? '' ?>">
      <button type="submit" class="btn btn-primary">Filter</button>
      <?php if (isset($_GET['nis'])): ?>
        <a href="absen.php" class="btn btn-danger ms-2">Reset</a>
        <a href="cetak-absen.php?nis=<?= $_GET['nis'] ?>" class="btn btn-success ms-2" target="_blank">Print</a>
      <?php endif; ?>
    </form>


    <div class="table-responsive">
      <table class="table table-bordered border border-dark table-striped table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <!-- Tambahkan pada bagian <thead> -->
          </tr>
        </thead>
        <tbody class="text-center align-middle">
          <?php
          $no = 1;
          while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $no++ . ".</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
            echo "<td>" . ($row['waktu'] ?? '-') . "</td>";

            // Badge status
            $badge = 'secondary';
            if ($row['status'] === 'hadir')
              $badge = 'success';
            elseif ($row['status'] === 'terlambat')
              $badge = 'warning text-dark';
            elseif ($row['status'] === 'izin')
              $badge = 'primary';
            elseif ($row['status'] === 'sakit')
              $badge = 'warning ';
            elseif ($row['status'] === 'alfa')
              $badge = 'danger';

            echo "<td><span class='badge bg-$badge'>" . htmlspecialchars($row['status']) . "</span></td>";
            echo "</tr>";
          }

          echo ""
          ;
          if ($no === 1) {
            echo "<tr><td colspan='7'>Belum ada data absen</td></tr>";
          }
          ?>

          <!-- Tambahkan pada bagian <tbody> di dalam perulangan while -->
        </tbody>
      </table>
    </div>
  </div>

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