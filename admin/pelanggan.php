<h1>pelanggan</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>email</th>
            <th>telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;?>
        <?php $ambil = $koneksi -> query("SELECT * FROM pelanggan"); ?>
        <?php while($pecah = $ambil -> fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pelanggan'] ?></td>
            <td><?php echo $pecah['email_pelanggan'] ?></td>
            <td><?php echo $pecah['telepon_pelanggan'] ?></td>
            <td>
                <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger">hapus</a>
                <a href="index.php?halaman=ubahpelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-info">ubah</a>
            </td>
        </tr>
        <?php $nomor++?>
        <?php } ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary">Tambah Data</a>