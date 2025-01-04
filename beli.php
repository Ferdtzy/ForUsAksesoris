<?php
session_start();
// mendapatkan id produk dari url
$id_produk = $_GET['id'];

// jika sudah ada produk itu di keranjang, maka tambahkan jumlahnya
if (isset($_SESSION['keranjang'][$id_produk])) 
{
    $_SESSION['keranjang'][$id_produk] += 1;
}
// jika belum ada produk itu di keranjang, maka produk itu dianggap dibeli 1
else
{
    $_SESSION['keranjang'][$id_produk] = 1;
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

// redirect ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>   