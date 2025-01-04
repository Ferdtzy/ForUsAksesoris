<?php
//Nama File: [logout.php]
//Deskripsi: Untuk malakukan logout
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [24-12-2024]

//menghancurkan session
session_destroy();
//mengalihkan ke halaman login
echo "<script>alert('anda telah logout');</script>";
echo "<script>location='login.php';</script>";
?>