<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AbsenKu</title>
    <link rel="icon" href="assets/img/this_logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="background-image: url('assets/img/this_background.png'); background-size: cover; background-position: center;">
    <?php
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $nis = $_POST['nis'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $kelas = $_POST['kelas'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $cek = query("SELECT * FROM siswa WHERE nis='$nis'");
        $cekAkun = query("SELECT * FROM akun WHERE username='$nis'");

        if ($cek || $cekAkun) {
            echo "<script>alert('NIS sudah terdaftar!');</script>";
        } else {
            $insertSiswa = mysqli_query($koneksi, "INSERT INTO siswa (nama, nis, jenis_kelamin, kelas) VALUES ('$nama', '$nis', '$jenis_kelamin', '$kelas')");
            $insertAkun = mysqli_query($koneksi, "INSERT INTO akun (username, password, role) VALUES ('$nis', '$password', 'siswa')");

            if ($insertSiswa && $insertAkun) {
                echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='index.php';</script>";
            } else {
                echo "<script>alert('Pendaftaran gagal!');</script>";
            }
        }
    }
    ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-lg">
        <div class="container-fluid px-3">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/img/this_logo.png" alt="Logo" width="30" class="me-2">
                AbsenKu
            </a>
        </div>
    </nav>

    <!-- Form Daftar -->
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border border-dark shadow">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Daftar Akun Siswa</h3>
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="border border-dark form-control" id="nama" name="nama"
                                    required placeholder="Siapa nama lengkap kamu?">
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS / Nomor Induk Siswa</label>
                                <input type="text" class="border border-dark form-control" id="nis" name="nis" required
                                    placeholder="Jangan salah masukin NIS nya yaa..">
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                                <select class="form-select border border-dark" id="jenis_kelamin" name="jenis_kelamin"
                                    required placeholder="a">
                                    <option selected disabled>Pilih jenis kelamin</option>
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select class="form-select border border-dark" id="kelas" name="kelas" required
                                    placeholder="a">
                                    <option selected disabled>Pilih kelas</option>
                                    <option value="12 PPLG A">12 PPLG A</option>
                                    <option value="12 PPLG B">12 PPLG B</option>
                                    <option value="12 PPLG C">12 PPLG C</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="border border-dark form-control" id="password"
                                    name="password" required placeholder="Jangan sampai lupa ya!">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">Daftar</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <small class="text-muted">Sudah punya akun? <a href="index.php"
                                    class="text-decoration-none">Langsung masuk</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3 mt-5">
        <div class="container-fluid px-4">
            <div class="row text-center">
                <div class="col-md-12 mb-3 text-center">
                    <div class="text-center mb-2">
                        <img src="assets/img/logo.png" width="25" class="me-2" alt="Logo">
                        <h5 class="mb-0">AbsenKu</h5>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="login.php" class="text-white text-decoration-none">&copy; Manggoku 2025, All rights
                    reserved.</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>