<?php
//Nama File: [logout.php]
//Deskripsi: Untuk malakukan logout
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [25-12-2024]
session_start();
// Memulai sesi untuk mengelola data pengguna, seperti login atau keranjang belanja.

// Koneksi ke database
include 'koneksi.php';

// Membuat koneksi ke database MySQL dengan nama database "forusaksesoris".
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Us Aksesoris</title>
    <!-- Memuat file CSS untuk styling halaman -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- Memuat font dari Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Memuat font dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Favicon untuk halaman -->
    <link rel="icon" href="admin/assets/img/eiffel-tower 1.svg" type="image/x-icon">
  </head>

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
                  <!-- Jika pengguna sudah login, tampilkan tombol logout -->
                <?php else: ?>
                  <a href="registrasi.php">Login</a>
                  <!-- Jika pengguna belum login, tampilkan tombol login -->
                <?php endif; ?>
              </li>
              <li><a href="keranjang.php">Keranjang</a></li>
              <li><a href="checkout.php">Checkout</a></li>
            </ul>
          </nav>
        </div>
        <div class="row">
            <div class="col-2">
                <h1>For Us<br />Aksesoris</h1>
                <p>
                  success isnot always about greatness. It's about consistency.
                  consistent<br />hard work gains succes. greatness will come.
                </p>
              </div>
              <div class="col-2">
                 <!-- Gambar utama untuk hero halaman -->
                <img src="admin/assets/img/image1.png" />
            </div>
        </div>
      </div>
    </div>

    <section class="konten">
      <div class="container">
        <h1>Daftar Produk</h1>
        <!-- Menampilkan daftar produk yang tersedia -->

        <div class="row">
          <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
          <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
          <!-- Melakukan loop untuk mengambil dan menampilkan setiap produk dari database -->
            <div class="col-md-3">
              <div class="thumbnail">
                <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
                <!-- Menampilkan gambar produk -->
                <div class="caption">
                  <h3><?php echo $perproduk['nama_produk']; ?></h3>
                  <!-- Menampilkan nama produk -->
                  <p>Rp. <?php echo number_format($perproduk['harga_produk']); ?></p>
                  <!-- Menampilkan harga produk dengan format angka -->
                  <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
                  <!-- Tombol untuk membeli produk -->
                  <a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="detail">detail</a> 
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="footer-col-2">
            <img src="admin/assets/img/Logo.png" />
            <p>
              Our Purpose is sustainably to make the pleasure and benefits of
              sports accessible to many.
            </p>
          </div>
          <div class="footer-col-3">
            <h3>Useful Links</h3>
            <ul>
              <li>Alamat: "Kunjungi kami di: Jl. Contoh No. 123, Jakarta, Indonesia"</li>
              <li>Telepon: "Hubungi kami: (021) 123-4567"</li>
              <li>Email: "Email kami: support@forusaksesoris.com"</li>
              
            </ul>
          </div>
          <div class="footer-col-4">
            <h3>Follow us</h3>
            <ul>
              <li>Facebook</li>
              <li>Twitter</li>
              <li>Instagram</li>
              <li>YouTube</li>
            </ul>
          </div>
        </div>
        <hr />
        <p class="copyright">Copyright 2024 - For Us Aksesoris</p>
      </div>
    </div>
  </body>
</html>