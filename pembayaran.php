<?php
//Nama File: [pembayaran.php]
//Deskripsi: Untuk menampilkan detail pembayaran produk
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [27-12-2024]
session_start();
// Memulai sesi untuk mengelola data pengguna, seperti login atau keranjang belanja.

// Koneksi ke database
include 'koneksi.php';

// Jika tidak ada session pelanggan (belum login)
if (!isset($_SESSION["pelanggan"]) or empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Mendapatkan id_pembelian dari URL
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// Mendapatkan id_pelanggan dari pembelian
$id_pelanggan_beli = $detpem["id_pelanggan"];
// Mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

// Validasi: Apakah ID pelanggan pembelian cocok dengan ID pelanggan yang login?
if ($id_pelanggan_login !== $id_pelanggan_beli) {
    echo "<script>alert('Anda tidak dapat melihat pembelian orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <!-- Memuat file CSS untuk styling halaman -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- Memuat font dari Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Memuat font dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Memuat bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Favicon untuk halaman -->
    <link rel="icon" href="admin/assets/img/eiffel-tower 1.svg" type="image/x-icon">
</head>
<body>
    
  <!-- Navbar -->
  <div class="header">
      <div class="container">
        <div class="navbar">
          <div class="logo">
            <!-- Logo situs web -->
            <img src="admin/assets/img/Logo.png" width="125px" />
          </div>
          <nav>
            <ul>
              <!-- Menu navigasi -->
              <li><a href="index.php">Home</a></li>
              <li>
                <?php if (isset($_SESSION["pelanggan"])): ?>
                  <a href="logout.php">LogOut</a>
                <?php else: ?>
                  <a href="registrasi.php">Login</a>
                <?php endif; ?>
              </li>
              <li><a href="keranjang.php">Keranjang</a></li>
              <?php if (isset($_SESSION["pelanggan"])): ?>
                <li><a href="riwayat.php">Riwayat</a></li>
              <?php else: ?> 
                <li><a href="checkout.php">Checkout</a></li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>

        <!-- Konten Pembayaran -->
        <div class="container">
            <h2>Konfirmasi Pembayaran</h2>
            <p>Kirim bukti pembayaran anda disini</p>

            <form action="" method="post">
                <div class="form-group">
                    <label for="">Nama Penyetor</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group">
                    <label for="">Bank</label>
                    <input type="text" class="form-control" name="bank">
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" min="1">
                </div>
                <div class="form-group">
                    <label for="">Foto Bukti</label>
                    <input type="file" class="form-control" name="bukti">
                    <p class="text-danger">Bukti foto harus format JPEG maksimal 2MB</p>
                </div>
                <button class="btn btn-primary" name="kirim">Kirim</button>
            </form>
         </div>
      </div>
  </div>
</body>
</html>
