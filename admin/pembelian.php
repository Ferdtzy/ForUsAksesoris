<?php
//Nama File: [pembelian.php]
//Deskripsi: Untuk menampilkan halaman pembelian untuk melihat data pembelian pelanggan
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [23-12-2024]
?>

<h2>Pembelian</h2>
<!-- Heading untuk halaman daftar pembelian -->

<table class="table table-bordered">
    <thead>
        <tr>
            <!-- Baris header tabel untuk memberikan nama pada kolom -->
            <th>No</th> <!-- Kolom nomor -->
            <th>Nama Pelanggan</th> <!-- Kolom nama pelanggan -->
            <th>Tanggal</th> <!-- Kolom tanggal pembelian -->
            <th>Total</th> <!-- Kolom total pembelian -->
            <th>Aksi</th> <!-- Kolom untuk aksi (seperti melihat detail pembelian) -->
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <!-- Inisialisasi variabel $nomor untuk menampilkan nomor urut -->

        <?php 
        $ambil = $koneksi->query(
            "SELECT * FROM pembelian JOIN pelanggan 
            ON pembelian.id_pelanggan = pelanggan.id_pelanggan"
        );
        ?>
        <!-- Mengambil data pembelian dan bergabung dengan data pelanggan berdasarkan id_pelanggan -->

        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
        <!-- Looping untuk setiap hasil query $ambil -->
        
        <tr>
            <td><?php echo $nomor; ?></td>
            <!-- Menampilkan nomor urut -->
            
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <!-- Menampilkan nama pelanggan -->
            
            <td><?php echo $pecah['tanggal_pembelian']; ?></td>
            <!-- Menampilkan tanggal pembelian -->
            
            <td><?php echo $pecah['total_pembelian']; ?></td>
            <!-- Menampilkan total pembelian -->
            
            <td>
                <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" 
                   class="btn btn-info">detail</a>
                <!-- Tombol detail untuk melihat detail pembelian berdasarkan id_pembelian -->
            </td>
        </tr>
        <?php $nomor++; ?>
        <!-- Increment nomor untuk penomoran baris -->
        
        <?php } ?>
        <!-- Penutup loop while -->
    </tbody>
</table>
