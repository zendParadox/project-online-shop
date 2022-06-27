<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "toko_online");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" href="citytech-logo/citytech1.png" type="image/x-icon">
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
            font-size: 40px;
            color: crimson;
        }
        .gambar {
          margin-right: 10px;
        }
  </style>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container px-4 px-lg-5">
        <img src="citytech-logo/citytech2.png" width="65px" alt="" class="gambar">
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

            <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
          </ul>
          <form class="d-flex" action="keranjang.php">
            <button class="btn btn-outline-dark" type="submit">
              <i class="bi-cart-fill me-1"></i>
              Keranjang
              <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-4 fw-bolder">City Tech</h1>
          <p class="lead fw-normal text-white-50 mb-0">Your Technology Partner</p>
        </div>
      </div>
    </header>
    <!-- Section-->
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
          
            <?php $ambil = $koneksi -> query("SELECT * FROM produk"); ?>
            <?php while($perproduk = $ambil -> fetch_assoc()){ ?>
        <div class="col mb-5">
            <div class="card h-100">
                
              <!-- Product image-->
              <img class="card-img-top" src="foto-produk/<?php echo $perproduk['foto_produk']; ?>" alt="..." />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder"><?php echo $perproduk['nama_produk']; ?></h5>
                  <!-- Product price-->
                  <?php echo number_format($perproduk['harga_produk']) ?>
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="beli.php?id=<?php echo $perproduk['id_produk']; ?>">Beli</a></div>
              </div>
            </div>
          </div>
          <?php } ?>
    </section>


    <!-- Footer-->
    <footer class="py-5 bg-dark">
      <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
  </body>
</html>