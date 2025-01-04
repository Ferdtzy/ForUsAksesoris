<?php
//Nama File: [logout.php]
//Deskripsi: Untuk melakukan logout
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [28-12-2024]
session_start();

// menghancurkan $_SESSION["pelanggan"]
session_destroy();
// memunculkan pesan dan mengalihkan ke halaman ke index
echo "<script>alert('anda telah logout');</script>";
echo "<script>location='index.php';</script>";
?>