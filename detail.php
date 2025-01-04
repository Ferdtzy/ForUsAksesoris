<?php session_start(); ?>
<?php 
//Nama File: [detail.php]
//Deskripsi: Untuk menampilkan detail produk
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [26-12-2024]
include 'koneksi.php';
?>
<?php 

//mendapatkan id_produk dari url
$id_produk = $_GET['id'];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detail produk</title>
    <!-- Memuat file CSS untuk styling halaman -->
    <link rel="stylesheet" href="admin/assets/css/style4.css">
    <!-- Memuat font dari Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Memuat font dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Favicon untuk halaman -->
    <link rel="icon" href="admin/assets/img/eiffel-tower 1.svg" type="image/x-icon">
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
                            <a href="logout.php">LogOut</a>
                        <?php else: ?>
                            <a href="registrasi.php">Login</a>
                        <?php endif; ?>
                    </li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<section class="konten">
    <div class="container">
        <div class="row product-detail">
            <div class="col-md-6 product-image">
                <img src="foto_produk/<?php echo $detail['foto_produk']; ?>" class="img-responsive" alt="Produk">
            </div>
            <div class="col-md-6 product-info">
                <h2><?php echo $detail['nama_produk']; ?></h2>
                <h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4>
                <p><?php echo $detail['deskripsi_produk']; ?></p>

                <form action="" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" name="jumlah" class="form-control" min="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                //jika ada tombol beli
                if (isset($_POST["beli"]))
                {
                    //mendapatkan jumlah yg di inputkan
                    $jumlah = $_POST["jumlah"];
                    //masukkan di keranjang belanja
                    $_SESSION["keranjang"]["$id_produk"] = $jumlah;

                    echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
                    echo "<script>location.href='keranjang.php';</script>";
                }
                ?>
                <a href="beli.php?id=<?php echo $detail['id_produk']; ?>" class="btn btn-primary">Tambah ke Keranjang</a>
            </div>
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