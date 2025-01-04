<?php
//Nama File: [tambahproduk.php]
//Deskripsi: Untuk menampilkan halaman pembelian untuk melihat data pembelian pelanggan
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [24-12-2024]
?>

<h2>Ubah Produk</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="text" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label>
        <input type="text" name="berat" class="form-control" value="<?php echo $pecah['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_produk']; ?></textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php 
if (isset($_POST['ubah']))
{
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    // Jika foto diubah
    if (!empty($lokasifoto))
    {
        // Hapus foto lama jika ada
        if (file_exists("../foto_produk/" . $pecah['foto_produk'])) {
            unlink("../foto_produk/" . $pecah['foto_produk']);
        }

        // Pindahkan foto baru ke folder tujuan
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

        // Update database dengan foto baru
        $koneksi->query("UPDATE produk SET 
            nama_produk = '$_POST[nama]',
            harga_produk = '$_POST[harga]',
            berat_produk = '$_POST[berat]',
            foto_produk = '$namafoto',
            deskripsi_produk = '$_POST[deskripsi]'
            WHERE id_produk = '$_GET[id]'");
    }
    else
    {
        // Update database tanpa foto baru
        $koneksi->query("UPDATE produk SET 
            nama_produk = '$_POST[nama]',
            harga_produk = '$_POST[harga]',
            berat_produk = '$_POST[berat]',
            deskripsi_produk = '$_POST[deskripsi]'
            WHERE id_produk = '$_GET[id]'");
    }

    echo "<script>alert('Data Berhasil Diubah');</script>";
    echo "<script>location.href='index.php?halaman=produk';</script>";
}
?>
