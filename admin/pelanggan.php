<?php
//Nama File: [pembelian.php]
//Deskripsi: Untuk menampilkan halaman pembelian untuk melihat data pembelian pelanggan
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [24-12-2024]
?>

<h2>Pelanggan</h2>
<!-- Heading untuk halaman daftar pelanggan -->

<table class="table table-bordered">
    <thead>
        <tr>
            <!-- Baris header tabel untuk memberikan nama pada kolom -->
            <th>no</th> <!-- Kolom nomor -->
            <th>nama</th> <!-- Kolom nama pelanggan -->
            <th>email</th> <!-- Kolom email pelanggan -->
            <th>telepon</th> <!-- Kolom telepon pelanggan -->
            <th>aksi</th> <!-- Kolom aksi (misalnya, hapus pelanggan) -->
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <!-- Inisialisasi variabel $nomor untuk penomoran tabel -->

        <?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
        <!-- Mengambil semua data pelanggan dari tabel pelanggan menggunakan query SQL -->

        <?php while($pecah = $ambil->fetch_assoc()) { ?>
        <!-- Looping untuk setiap hasil query $ambil -->
        
        <tr>
            <td><?php echo $nomor; ?></td>
            <!-- Menampilkan nomor urut -->
            
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <!-- Menampilkan nama pelanggan -->
            
            <td><?php echo $pecah['email_pelanggan']; ?></td>
            <!-- Menampilkan email pelanggan -->
            
            <td><?php echo $pecah['telepon_pelanggan']; ?></td>
            <!-- Menampilkan nomor telepon pelanggan -->
            
            <td>
                <a href="" class="btn btn-danger">Hapus</a>
                <!-- Tombol hapus, tetapi saat ini tidak memiliki aksi -->
            </td>
        </tr>
        <?php $nomor++;  ?>
        <!-- Increment nomor untuk penomoran baris -->
        
        <?php } ?>
        <!-- Penutup loop while -->
    </tbody>
</table>
