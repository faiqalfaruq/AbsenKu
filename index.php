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
    session_start();
    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['nis'];
        $password = $_POST['password'];

        $user = query("SELECT * FROM akun WHERE username = '$username'");

        if ($user && password_verify($password, $user[0]['password'])) {
            $_SESSION['username'] = $user[0]['username'];
            $_SESSION['role'] = $user[0]['role'];

            $redirect = ($user[0]['role'] === 'admin') ? 'admin/index.php' : 'user/index.php';
            header("Location: $redirect");
            exit();
        } else {
            echo "<script>alert('Username atau password salah!');</script>";
        }
    }
    ?>

    <!-- Login Section -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card border border-dark shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <img src="assets/img/this_logo.png" alt="Logo" width="50" class="mb-2">
                <h4 class="fw-bold mb-0">Login AbsenKu</h4>
            </div>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS / Nomor Induk Siswa</label>
                    <input type="text" class="border border-dark form-control" name="nis" id="nis"
                        placeholder="Masukkan Nis" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="border border-dark form-control" name="password" id="password"
                        placeholder="Masukkan password" required />
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-dark">Masuk</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <small class="text-muted">Belum punya akun? <a href="daftar.php" class="text-decoration-none">Daftar
                        dulu</a></small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>