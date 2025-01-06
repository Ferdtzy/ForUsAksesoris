<?php
// Nama File: [nota.php]
// Deskripsi: Untuk menampilkan nota pesanan
// Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
// Tanggal: [27-12-2024]
session_start();
// Koneksi ke database
include 'koneksi.php';

// Validasi ID pembelian
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID pembelian tidak valid');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

// Mengambil data pembelian dan pelanggan
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
                          ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
                          WHERE pembelian.id_pembelian='{$_GET['id']}'");
$detail = $ambil->fetch_assoc();

// Jika data pembelian tidak ditemukan
if (!$detail) {
    echo "<script>alert('Data pembelian tidak ditemukan');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

// Mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];

// Mendapatkan id_pelanggan yang login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

// Jika pelanggan yang login bukan pemilik pembelian
if ($idpelangganyangbeli !== $idpelangganyanglogin) {
    echo "<script>alert('Anda tidak bisa melihat detail pembelian orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="icon" href="admin/assets/img/eiffel-tower 1.svg" type="image/x-icon" />
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                <?php if (isset($_SESSION["pelanggan"])): ?>
                    <li><a href="riwayat.php">Riwayat</a></li>
                    <li><a href="logout.php">LogOut</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
    </nav>

    <div class="konten">
        <div class="container">
            <h2>Detail Pembelian</h2>
            <strong><?php echo htmlspecialchars($detail['nama_pelanggan']); ?></strong> <br>
            <p>
                <?php echo htmlspecialchars($detail['telepon_pelanggan']); ?> <br>
                <?php echo htmlspecialchars($detail['email_pelanggan']); ?>
            </p>
            <p>
                Tanggal: <?php echo htmlspecialchars($detail['tanggal_pembelian']); ?><br>
                Total: Rp.<?php echo number_format($detail['total_pembelian']); ?>
            </p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Subberat</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomor = 1; 
                    $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '{$_GET['id']}'"); 
                    while ($pecah = $ambil->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo htmlspecialchars($pecah['nama']); ?></td>
                            <td>Rp.<?php echo number_format($pecah['harga']); ?></td>
                            <td><?php echo htmlspecialchars($pecah['berat']); ?> Gr.</td>
                            <td><?php echo htmlspecialchars($pecah['jumlah']); ?></td>
                            <td><?php echo htmlspecialchars($pecah['subberat']); ?> Gr.</td>
                            <td>Rp.<?php echo number_format($pecah['subharga']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan melakukan pembayaran sebesar Rp.<?php echo number_format($detail['total_pembelian']); ?><br>
                            <strong>BANK MANDIRI 138-0001922-4156 AN. RIZKY</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
