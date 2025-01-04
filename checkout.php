<?php
//Nama File: [checkout.php]
//Deskripsi: Untuk menampilkan checkout dari pembelian produk
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [26-12-2024]
session_start(); // Memulai sesi untuk melacak pengguna yang login

include 'koneksi.php';

// Memeriksa apakah pengguna sudah login, jika belum, arahkan ke halaman login
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckOut</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css"> <!-- Menghubungkan file CSS Bootstrap -->
    <link rel="stylesheet" href="admin/assets/css/style3.css"> <!-- Menghubungkan file CSS untuk styling khusus -->
    <link rel="icon" href="admin/assets/img/eiffel-tower 1.svg" type="image/x-icon" />
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

<!-- Konten CheckOut -->
<section class="konten">
    <div class="container">
        <h1>CheckOut</h1>
        <hr>
        
        <!-- Tabel yang menampilkan produk yang ada di keranjang belanja -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $nomor = 1; 
                $totalbelanja = 0; 
                ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <!-- Menampilkan informasi produk yang ada di keranjang -->
                    <?php 
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk ='$id_produk'");
                    $pecah = $ambil->fetch_assoc(); // Ambil data produk berdasarkan id_produk
                    $subharga = $pecah["harga_produk"] * $jumlah; // Hitung subharga
                    ?>    
                    <tr>
                        <td><?php echo $nomor; ?></td> <!-- Nomor urut produk -->
                        <td><?php echo $pecah["nama_produk"];?></td> <!-- Nama produk -->
                        <td>Rp. <?php echo number_format($pecah["harga_produk"]);?></td> <!-- Harga produk dalam format Rupiah -->
                        <td><?php echo $jumlah; ?></td> <!-- Jumlah produk yang dipesan -->
                        <td>Rp. <?php echo number_format($subharga); ?></td> <!-- Subharga (harga * jumlah) -->
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja += $subharga; ?> <!-- Menjumlahkan total belanja -->
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja) ?></th> <!-- Menampilkan total belanja -->
                </tr>
            </tfoot>
        </table>
 
        <!-- Form untuk pengisian informasi pengiriman -->
        <form action="" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']?>" class="form-control"> <!-- Nama pelanggan -->
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?>" class="form-control"> <!-- Telepon pelanggan -->
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Dropdown untuk memilih ongkos kirim -->
                    <select name="id_ongkir" class="form-control-inline">
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php 
                        // Mengambil data ongkir dari database
                        $ambil = $koneksi->query("SELECT * FROM ongkir");
                        while ($perongkir = $ambil->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                <?php echo $perongkir['nama_kota'] ?> - Rp.<?php echo number_format($perongkir['tarif']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" name="checkout">Bayar</button> <!-- Tombol untuk menyelesaikan pembelian -->
        </form>

        <!-- Proses Checkout jika tombol checkout ditekan -->
        <?php 
        if (isset($_POST["checkout"])) {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");

            // Mengambil tarif ongkir yang dipilih
            $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $tarif = $arrayongkir['tarif'];

            // Menghitung total pembelian (belanja + ongkir)
            $total_pembelian = $totalbelanja + $tarif;

            // Menyimpan data ke tabel pembelian
            $koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian) VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian')");

            // Mendapatkan id_pembelian yang baru saja dimasukkan
            $id_pembelian_barusan = $koneksi->insert_id;

            // Menyimpan data produk yang dibeli ke tabel pembelian_produk
            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {

                // mendapatkan data produk berdasarakan id_produk
                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perproduk = $ambil->fetch_assoc();

                $nama = $perproduk["nama_produk"];
                $harga = $perproduk["harga_produk"];
                $berat = $perproduk["berat_produk"];

                $subberat = $perproduk['berat_produk']*$jumlah;
                $subharga = $perproduk['harga_produk']*$jumlah;
                $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga,berat, subberat,subharga, jumlah) VALUES ('$id_pembelian_barusan', '$id_produk','$nama','$harga','$berat','$subberat','$subharga', '$jumlah')");
            }

            // Mengosongkan keranjang belanja setelah checkout
            unset($_SESSION["keranjang"]);

            // Menampilkan alert dan mengarahkan pengguna ke halaman nota pembelian
            echo "<script>alert('Pembelian Berhasil');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
        ?>  
    </div>
</section>



</body>
</html>
