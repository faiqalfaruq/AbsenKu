<?php
session_start();
include '../koneksi.php';

// Cek jika admin belum login
if (!isset($_SESSION['username'])) {
  header("Location: ../index.php");
  exit();
}

// Pastikan parameter NIS dikirim
if (isset($_GET['nis'])) {
  $nis = $_GET['nis'];

  // Ambil data siswa dulu (untuk hapus foto kalau ada)
  $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$nis'");
  $siswa = mysqli_fetch_assoc($query);

  if ($siswa) {
    // Hapus foto jika ada dan bukan foto default
    if (!empty($siswa['foto']) && $siswa['foto'] != 'banana-character.png') {
      $fotoPath = "../assets/img/" . $siswa['foto'];
      if (file_exists($fotoPath)) {
        unlink($fotoPath); // hapus file dari folder
      }
    }

    // Hapus data siswa dari database
    mysqli_query($koneksi, "DELETE FROM siswa WHERE nis = '$nis'");

    // Redirect kembali ke halaman siswa
    header("Location: siswa.php?hapus=berhasil");
    exit();
  } else {
    // Siswa tidak ditemukan
    header("Location: siswa.php?error=notfound");
    exit();
  }
} else {
  // NIS tidak dikirim
  header("Location: siswa.php?error=invalid");
  exit();
}
