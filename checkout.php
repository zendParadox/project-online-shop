<?php
    session_start();
    $koneksi = new mysqli("localhost", "root", "", "toko_online");

// jika tidak ada session pelanggan (belum login). maka dilarikan ke login.php
if (!isset($_SESSION['pelanggan'])) {
    echo"<script>alert('Anda harus login terlebih dahulu!')</script>";
    echo"<script>location='login.php'</script>";
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="nav navbar-default">
        <div class="container">
            <div class="nav navbar-nav">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <!-- jika sudah login (ada session pelanggan) -->
                    <?php if (isset($_SESSION['pelanggan'])): ?>
                        <li><a href="logout.php">Logout</a></li>

                        <!-- selain itu (belum login | belum ada session pelanggan) -->
                        <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <?php endif ?>

                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="konten">
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Harga</th>
                </tr>
            </thead>

            <tbody>
                <?php $nomor = 1; ?>
                <?php $totalbelanja = 0; ?>
                <?php
                    
                    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {?>
                    <!-- menampilkan produk yang sedang di perulangkan berdasarkan id_produk -->
                    <?php
                    $ambil = $koneksi -> query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $pecah = $ambil -> fetch_assoc();
                    $subharga = $pecah['harga_produk'] * $jumlah;
                    ?>
                <tr>
                    <td><?php echo $nomor ?></td>
                    <td><?php echo $pecah['nama_produk']; ?></td>
                    <td><?php echo number_format($pecah['harga_produk']); ?></td>
                    <td><?php echo $jumlah ?></td>
                    <td><?php echo number_format($subharga)?></td>
                </tr> 
                <?php $nomor++ ?>
                <?php $totalbelanja += $subharga ?>
            <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                </tr>
            </tfoot>
        </table>

        <form method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                        <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan'] ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <select name="id_ongkir" id="" class="form-control">
                                <option value="">Pilih ongkos kirim</option>
                                <?php 
                                    $ambil = $koneksi -> query("SELECT * FROM ongkir");
                                    while($perongkir = $ambil -> fetch_assoc()){
                                ?>
                                <option value="<?php echo $perongkir['id_ongkir'] ?>"><?php echo $perongkir['nama_kota'] ?> - Rp. 
                                <?php echo number_format($perongkir['tarif']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>
        <?php 
             if (isset($_POST['checkout'])) {
                $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                $id_ongkir = $_POST['id_ongkir'];
                $tanggal_pembelian = date("Y-m-d");

                $ambil = $koneksi -> query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                $arrayongkir = $ambil -> fetch_assoc();
                $tarif = $arrayongkir['tarif'];

                $total_pembelian = $totalbelanja + $tarif;

                // 1. menyimpan data ke tabel pembelian
                $koneksi -> query("INSERT INTO pembelian
                (id_pembelian, id_ongkir, tanggal_pembelian, total_pembelian)
                VALUE ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian')");
            }
        ?>
    </div>
    </section>

    <pre>
        <?php print_r($_SESSION['pelanggan']) ?>
    </pre>
    <pre><?php print_r($_SESSION['keranjang']); ?></pre>

</body>
</html>