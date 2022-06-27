<h1>ubah produk</h1>

<?php
    $ambil = $koneksi -> query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
    $pecah = $ambil -> fetch_assoc();

    echo"<pre>";
    print_r($pecah);
    echo"</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama Produk</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Harga Produk</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk'];?>">
    </div>
    <div class="form-group">
        <label for="">Berat Produk</label>
        <input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="../foto-produk/<?php echo $pecah['foto_produk'] ?>" width="200px">
    </div>
    <div class="form-group">
        <label for="">Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label for="">Deskripsi Produk</label>
        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"><?php echo $pecah['deskripsi_produk']; ?></textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
    if (isset($_POST['ubah'])) {
        $namafoto = $_FILES['foto']['name']; // name apa nama?????
        $lokasifoto = $_FILES['foto']['tmp_name'];
        //jika foto dirubah
        if (!empty($lokasifoto)) {
            move_uploaded_file($lokasifoto, "../foto-produk/$namafoto");

            $koneksi -> query("UPDATE produk SET 
            nama_produk = '$_POST[nama]',
            harga_produk = '$_POST[harga]',
            berat_produk = '$_POST[berat]',
            foto_produk = '$namafoto',
            deskripsi_produk = '$_POST[deskripsi]'
            WHERE id_produk = '$_GET[id]'");
        }
        else {
            $koneksi -> query("UPDATE produk SET 
            nama_produk = '$_POST[nama]',
            harga_produk = '$_POST[harga]',
            berat_produk = '$_POST[berat]',
            deskripsi_produk = '$_POST[deskripsi]'
            WHERE id_produk = '$_GET[id]'");
        }
        echo"<script>alert('data produk telah di ubah');</script>";
        echo"<script>location='index.php?halaman=produk';</script>";
    }
?>