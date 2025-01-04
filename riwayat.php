<?php
//Nama File: [riwayat.php]
//Deskripsi: Untuk menampilkan riwayat pembelian
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [28-12-2024]
session_start();
// Memulai sesi untuk mengelola data pengguna, seperti login atau keranjang belanja.

// Koneksi ke database
include 'koneksi.php';

// Jika tidak ada session pelanggan (belum login)
if(!isset($_SESSION["pelanggan"]) or empty($_SESSION["pelanggan"]))
{
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    
}
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
                  <!-- Jika pengguna sudah login, tampilkan tombol logout -->
                <?php else: ?>
                  <a href="registrasi.php">Login</a>
                  <!-- Jika pengguna belum login, tampilkan tombol login -->
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

        <!-- Konten Riwayat -->
        <section class="riwayat">
            <div class="container">
                <h3>Riwayat belanja <?php echo htmlspecialchars($_SESSION["pelanggan"]["nama_pelanggan"]); ?></h3>

                 <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        // Mendapatkan id_pelanggan yg login dari session
                        $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                        // Mengambil data pembelian dari database
                        $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                        while ($pecah = $ambil->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo htmlspecialchars($pecah["tanggal_pembelian"]); ?></td>
                            <td><?php echo htmlspecialchars($pecah["status_pembelian"]); ?></td>
                            <td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
                            <td>
                                <a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info">Nota</a>
                                <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>" class="btn btn-success">Pembayaran</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                 </table>
            </div>
        </section>
      </div>
  </div>
  </body>
</html>
