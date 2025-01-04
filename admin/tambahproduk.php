<?php
//Nama File: [tambahproduk.php]
//Deskripsi: Untuk menampilkan halaman pembelian untuk melihat data pembelian pelanggan
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [24-12-2024]
?>

<h2>Tambah Produk</h2>
<!-- Heading untuk halaman form tambah produk -->

<form method="post" enctype="multipart/form-data">
    <!-- Form untuk menambahkan produk baru -->
    
    <div class="form_group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required>
        <!-- Input untuk nama produk. Properti `required` memastikan field tidak boleh kosong. -->
    </div>

    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" required>
        <!-- Input untuk harga produk dengan tipe number untuk validasi angka -->
    </div>

    <div class="form-group">
        <label>Berat</label>
        <input type="number" class="form-control" name="berat" required>
        <!-- Input untuk berat produk. Sama seperti harga, menggunakan tipe number. -->
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10" required></textarea>
        <!-- Input untuk deskripsi produk -->
    </div>

    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto" accept="image/*" required>
        <!-- Input untuk file foto dengan filter hanya untuk file gambar (`accept="image/*"`). -->
    </div>

    <button class="btn btn-primary" name="save">Simpan</button>
    <!-- Tombol untuk menyimpan data -->
</form>

<?php 
if (isset($_POST['save']))
{
    // Mengambil nama file dan lokasi file yang diupload
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];

    // Menggunakan `move_uploaded_file` untuk memindahkan file ke direktori target
    move_uploaded_file($lokasi, "../foto_produk/".$nama);

    // Menyimpan data ke database
    $koneksi->query("INSERT INTO produk (nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk)
                     VALUES ('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$nama', '$_POST[deskripsi]')");

    // Menampilkan pesan sukses dan melakukan refresh halaman
    echo "<div class='alert alert-info'>Data tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>
