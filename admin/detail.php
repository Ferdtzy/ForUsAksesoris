
<h2>Detail Pembelian</h2>
<?php
// Mengambil data pembelian beserta informasi pelanggan yang terkait dari database berdasarkan parameter id yang dikirimkan melalui URL ($_GET['id']).
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
// Menyimpan data hasil query dalam array asosiatif.
$detail = $ambil->fetch_assoc();
?>
<!-- Menampilkan isi array $detail dalam format yang mudah dibaca (termasuk struktur key dan value) untuk keperluan debugging. -->
<pre><?php print_r($detail); ?></pre>

<!-- Menampilkan nama pelanggan dalam teks tebal (<strong>). -->
<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
<p>
    <!-- Menampilkan informasi kontak pelanggan seperti nomor telepon dan email. -->
    <?php echo $detail['telepon_pelanggan']; ?> <br>
    <?php echo $detail['email_pelanggan']; ?>
</p>

<p>
    <!-- Menampilkan informasi tanggal pembelian dan total transaksi. -->
    Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
    Total : <?php echo $detail['total_pembelian']; ?>
</p>

<!-- Membuat tabel untuk menampilkan detail produk yang dibeli. -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Inisialisasi nomor untuk penomoran tabel.
        $nomor = 1; 
        // Mengambil data produk yang terkait dengan pembelian dari database.
        $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian = '$_GET[id]'"); 
        ?>
        <?php 
        // Loop untuk menampilkan setiap baris data produk dalam tabel.
        while($pecah = $ambil->fetch_assoc()) { 
        ?>
        <tr>
            <!-- Menampilkan nomor urut. -->
            <td><?php echo $nomor++; ?></td>
            <!-- Menampilkan nama produk. -->
            <td><?php echo $pecah['nama_produk']; ?></td>
            <!-- Menampilkan harga produk. -->
            <td><?php echo $pecah['harga_produk']; ?></td>
            <!-- Menampilkan jumlah produk yang dibeli. -->
            <td><?php echo $pecah['jumlah']; ?></td>
            <!-- Menghitung dan menampilkan subtotal (harga x jumlah). -->
            <td>
                <?php echo $pecah['harga_produk'] * $pecah['jumlah']; ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Tombol untuk menambahkan produk baru, mengarahkan ke halaman tambah produk. -->
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>
