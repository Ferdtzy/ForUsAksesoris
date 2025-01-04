<?php
if (isset($_GET['id'])) {
    $id_produk = intval($_GET['id']); // Validasi input ID sebagai integer

    // Mengambil data produk
    $ambil = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
    $ambil->bind_param("i", $id_produk);
    $ambil->execute();
    $result = $ambil->get_result();
    $pecah = $result->fetch_assoc();

    if ($pecah) {
        $fotoproduk = $pecah['foto_produk'];

        // Hapus file foto jika ada
        if (file_exists("../foto_produk/$fotoproduk")) {
            unlink("../foto_produk/$fotoproduk");
        }

        // Hapus data produk dari database
        $hapus = $koneksi->prepare("DELETE FROM produk WHERE id_produk = ?");
        $hapus->bind_param("i", $id_produk);
        $hapus->execute();

        if ($hapus->affected_rows > 0) {
            echo "<script>alert('Produk berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Produk gagal dihapus');</script>";
        }
    } else {
        echo "<script>alert('Produk tidak ditemukan');</script>";
    }
} else {
    echo "<script>alert('ID produk tidak valid');</script>";
}

// Redirect ke halaman produk
echo "<script>location='index.php?halaman=produk';</script>";
?>
