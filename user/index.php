<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AbsenKu</title>
    <link rel="icon" href="../assets/img/this_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body
    style="background-image: url('../assets/img/this_background.png'); background-size: cover; background-position: center;">

    <?php
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'siswa') {
        header("Location: ../index.php");
        exit();
    }
    ?>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-lg bg-light fixed-top">
        <div class="container-fluid px-3">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../assets/img/this_logo.png" alt="Logo" width="30" class="me-2">
                AbsenKu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link px-3 active" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="profil.php">Profil</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="absen.php">Absen</a></li>
                    <li class="nav-item"><a class="btn btn-danger" href="logout.php">Keluar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mt-5 pt-5 text-white">
        <div class="row align-items-center py-5">
            <div class="col-md-6 text-dark">
                <h1 class="display-4 fw-bold">Kamu Udah Absen Belum?</h1>
                <p class="lead">Jangan lupa absen yaa, biar apa? biarin!</p>
                <a href="absen.php" class="btn btn-dark">Absen Sekarang</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="../assets/img/character.png" class="img-fluid" alt="Manggo Character">
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