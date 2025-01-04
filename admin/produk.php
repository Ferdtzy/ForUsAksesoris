<?php 
//Nama File: [produk.php]
//Deskripsi: Untuk menampilkan halaman produk yang dapat dikelola
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [23-12-2024]
?>

<h2>Data Produk</h2>
<!-- Heading untuk halaman daftar produk -->

<table class="table table-bordered">
    <thead>
        <tr>
            <!-- Baris header tabel untuk memberikan nama pada kolom -->
            <th>No</th> <!-- Kolom nomor urut -->
            <th>Nama</th> <!-- Kolom nama produk -->
            <th>Harga</th> <!-- Kolom harga produk -->
            <th>Berat</th> <!-- Kolom berat produk -->
            <th>Foto</th> <!-- Kolom foto produk -->
            <th>Aksi</th> <!-- Kolom untuk aksi (hapus dan ubah) -->
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <!-- Inisialisasi variabel $nomor untuk menampilkan nomor urut -->

        <?php 
        $ambil = $koneksi->query("SELECT * FROM produk");
        ?>
        <!-- Mengambil semua data dari tabel `produk` -->

        <?php while($pecah = $ambil->fetch_assoc()) { ?>
        <!-- Looping untuk setiap hasil query $ambil -->
        
        <tr>
            <td><?php echo $nomor; ?></td>
            <!-- Menampilkan nomor urut -->
            
            <td><?php echo htmlspecialchars($pecah['nama_produk']); ?></td>
            <!-- Menampilkan nama produk dengan proteksi XSS -->

            <td><?php echo number_format($pecah['harga_produk'], 0, ',', '.'); ?></td>
            <!-- Menampilkan harga produk dengan format angka (contoh: 10.000) -->

            <td><?php echo $pecah['berat_produk']; ?> gram</td>
            <!-- Menampilkan berat produk dan menambahkan satuan gram -->

            <td>
                <img src="../foto_produk/<?php echo htmlspecialchars($pecah['foto_produk']); ?>" width="100">
                <!-- Menampilkan foto produk. Pastikan nama file aman dari XSS -->
            </td>

            <td>
                <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk'];?>" class="btn-danger btn">Hapus</a>
                <!-- Tombol untuk menghapus produk berdasarkan ID -->

                <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'];?>" class="btn btn-warning">Ubah</a>
                <!-- Tombol untuk mengubah data produk berdasarkan ID -->
            </td>
        </tr>
        <?php $nomor++; ?>
        <!-- Increment nomor untuk penomoran baris -->

        <?php } ?>
        <!-- Penutup loop while -->
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>
<!-- Tombol untuk menambahkan data produk -->
