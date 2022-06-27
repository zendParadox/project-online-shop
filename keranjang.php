<?php 
session_start();

// echo"<pre>";
// print_r($_SESSION['keranjang']);
// echo"</pre>";

$koneksi = new mysqli("localhost", "root", "", "toko_online");

if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']) ) {
  echo"<script>alert('keranjang kosong, silahkan berbelanja dulu')</script>";
  echo"<script>location='index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <title>Keranjang Belanja</title>
    
</head>
<body>
    <style>
        .merah {
            color: crimson;
            font-weight: bold;
        }
        .ukuran {
            font-size: 30px;
        }
        .titik {
            font-size: 50px;
            color: crimson;
        }
        h1 {
            margin-top: 20px;
        }
    </style>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php"><span class="ukuran">City<span class="merah">Tech <span class="titik">.</span></span></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
            
            <!-- jika sudah login (ada session pelanggan) -->
            <?php if (isset($_SESSION['pelanggan'])): ?>
                <li class="nav-item"><a class="nav-link" href="logout.php"><span class="gedein">Logout</span></a></li>

                        <!-- selain itu (belum login | belum ada session pelanggan) -->
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.php"><span class="gedein">Login</span></a></li>
                    <?php endif ?>

            <li class="nav-item"><a class="nav-link" href="#!">Checkout</a></li>
          </ul>
          <form class="d-flex">
            <button class="btn btn-outline-light" type="submit">
              <i class="bi-cart-fill me-1"></i>
              Keranjang
              <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
          </form>
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
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $nomor = 1; ?>
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
                    <td><a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger">hapus</a></td>
                </tr> 
                <?php $nomor++ ?>
            <?php } ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>
    </section>
</body>
</html>