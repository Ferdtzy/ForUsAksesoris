<?php 
//Nama File: [login.php]
//Deskripsi: Untuk malakukan logout
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [25-12-2024]
session_start(); // Memulai sesi untuk melacak data pengguna yang sedang aktif
$koneksi = new mysqli("localhost", "root", "", "forusaksesoris"); // Membuat koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pengguna</title>
    <!-- Menghubungkan file CSS eksternal -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- Menghubungkan ikon Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Menghubungkan font Google Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Menghubungkan favicon -->
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
                <!-- Menampilkan menu login/logout sesuai dengan status sesi pengguna -->
                <?php if (isset($_SESSION["pelanggan"])): ?>
                  <a href="logout.php">LogOut</a>
                <?php else: ?>
                  <a href="login.php">Login</a>
                <?php endif; ?>
              </li>
              <li><a href="keranjang.php">Keranjang</a></li>
              <li><a href="checkout.php">Checkout</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Formulir Registrasi Pengguna -->
    <div class="register-form">
      <h3 class="panel-title">Register Pengguna</h3>
      <div class="panel-body">
        <form action="" method="post">
          <!-- Input untuk Nama Lengkap -->
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" required placeholder="Masukkan nama lengkap Anda">
          </div>
          <!-- Input untuk Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required placeholder="Masukkan email Anda">
          </div>
          <!-- Input untuk Telepon -->
          <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" name="telepon" required placeholder="Masukkan nomor telepon Anda">
          </div>
          <!-- Input untuk Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required placeholder="Masukkan password Anda">
          </div>
          <!-- Tombol untuk mendaftar -->
          <button class="btn btn-primary" name="register">Daftar</button>
          <div class="form-footer">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
          </div>
        </form>
      </div>
    </div>

    <?php 
    // Jika tombol register ditekan, proses registrasi dilakukan
    if (isset($_POST["register"])) {
        $nama = $_POST["nama"]; // Menangkap data nama pengguna
        $email = $_POST["email"]; // Menangkap data email pengguna
        $telepon = $_POST["telepon"]; // Menangkap data telepon pengguna
        $password = $_POST["password"]; // Menangkap data password pengguna

        // Periksa apakah email sudah terdaftar
        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
        $akunyangcocok = $ambil->num_rows;

        if ($akunyangcocok == 0) { 
            // Jika email belum terdaftar, simpan data pengguna ke database
            $koneksi->query("INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, telepon_pelanggan, password_pelanggan) VALUES ('$nama', '$email', '$telepon', '$password')");
            echo "<script>alert('Registrasi berhasil! Silakan login.');</script>";
            echo "<script>location='login.php';</script>"; // Arahkan ke halaman login
        } else {
            // Jika email sudah terdaftar, tampilkan pesan kesalahan
            echo "<script>alert('Email sudah terdaftar. Gunakan email lain.');</script>";
            echo "<script>location='register.php';</script>"; // Arahkan kembali ke halaman register
        }
    }
    ?>

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
