<?php 
//Nama File: [login.php]
//Deskripsi: Untuk malakukan logout
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [25-12-2024]
session_start();
$koneksi = new mysqli("localhost", "root", "", "forusaksesoris");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>
    <link rel="stylesheet" href="admin/assets/css/style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <!-- Login Section -->
<div class="login-form">
    <h3 class="panel-title">Login Pengguna</h3>
    <div class="panel-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required placeholder="Masukkan email Anda">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required placeholder="Masukkan password Anda">
            </div>
            <button class="btn btn-primary" name="login">Login</button>
            <div class="form-footer">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                <p><a href="forgot-password.php">Lupa password?</a></p>
            </div>
        </form>
    </div>
</div>

    <?php 
    // Jika tombol login ditekan
    if (isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        // Lakukan query untuk mengecek akun di tabel pelanggan di database
        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

        // Menghitung akun yang terambil
        $akunyangcocok = $ambil->num_rows;

        // Jika 1 akun yang cocok, maka diloginkan
        if ($akunyangcocok == 1)
        {
            // Anda sudah login
            $akun = $ambil->fetch_assoc();
            $_SESSION["pelanggan"] = $akun;
            echo "<script>alert('Anda berhasil login');</script>";

            if (isset($_SESSION["keranjang"]) or !empty($_SESSION["keranjang"]))
            {
            echo "<script>location='checkout.php';</script>";
            }
            else
            {
              echo "<script>location='index.php';</script>";
            }
        }
        else
        {
            // Gagal login
            echo "<script>alert('Anda gagal login, periksa akun Anda');</script>";
            echo "<script>location='login.php';</script>";
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
