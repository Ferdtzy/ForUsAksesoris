<?php
//Nama File: [keranjang.php]
//Deskripsi: Untuk menampilkan keranjang belanja yang telah dimasukkan oleh user
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [27-12-2024]
session_start(); // Memulai sesi untuk melacak data pengguna yang sedang aktif

echo "<pre>";
print_r($_SESSION['keranjang']); // Menampilkan isi keranjang belanja (untuk debugging)
echo "</pre>";

// Koneksi ke database
include 'koneksi.php';

if(empty($_SESSION['keranjang']) OR !isset($_SESSION["keranjang"])) {
    // Jika keranjang kosong, arahkan pengguna ke halaman utama dan beri peringatan
    echo "<script>alert('keranjang kosong, silahkan belanja dulu');</script>";
    echo "<script>location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <!-- Menghubungkan file CSS Bootstrap untuk styling dan CSS khusus -->
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="icon" href="admin/assets/img/eiffel-tower 1.svg" type="image/x-icon" />
    <link rel="stylesheet" href="admin/assets/css/style2.css">
</head>
<body>
<!-- Navbar -->
<div class="header">
      <div class="container">
        <div class="navbar">
          <div class="logo">
            <img src="admin/assets/img/Logo.png" width="125px" />
          </div>
          <nav>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li>
                <?php if (isset($_SESSION["pelanggan"])): ?>
                  <!-- Menampilkan menu Logout jika pengguna sudah login -->
                  <a href="logout.php">LogOut</a>
                <?php else: ?>
                  <!-- Menampilkan menu Login jika pengguna belum login -->
                  <a href="registrasi.php">Login</a>
                <?php endif; ?>
              </li>
              <li><a href="keranjang.php">Keranjang</a></li>
              <li><a href="checkout.php">Checkout</a></li>
            </ul>
          </nav>
        </div>

    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <!-- Menampilkan produk yang sedang diproses berdasarkan id_produk -->
                    <?php 
                    // Mengambil data produk berdasarkan id_produk
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk ='$id_produk' ");
                    $pecah = $ambil->fetch_assoc(); // Mengambil data produk sebagai array
                    $subharga = $pecah["harga_produk"] * $jumlah; // Menghitung subharga (harga * jumlah)
                    ?>    
                    <tr>
                        <td><?php echo $nomor; ?></td> <!-- Menampilkan nomor urut produk -->
                        <td><?php echo $pecah["nama_produk"];?></td> <!-- Menampilkan nama produk -->
                        <td>Rp. <?php echo number_format($pecah["harga_produk"]);?></td> <!-- Menampilkan harga produk dengan format Rupiah -->
                        <td><?php echo $jumlah; ?></td> <!-- Menampilkan jumlah produk -->
                        <td>Rp. <?php echo number_format($subharga); ?></td> <!-- Menampilkan subharga produk (harga * jumlah) -->
                        <td>
                            <!-- Tombol untuk menghapus produk dari keranjang -->
                            <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">hapus</a>
                        </td>
                    </tr>
                    <?php $nomor++; ?> <!-- Increment nomor urut untuk setiap produk -->
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- Tombol untuk melanjutkan belanja atau pergi ke halaman checkout -->
            <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
            <a href="checkout.php" class="primary">Checkout</a>
        </div>
    </section>
</body>
</html>
