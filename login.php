<?php
    session_start();
    $koneksi = new mysqli("localhost", "root", "", "toko_online");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link href="css/styles.css" rel="stylesheet" />
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
        .gedein {
            font-size: 17px;
        }
  </style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php"><span class="ukuran">City<span class="merah">Tech <span class="titik">.</span></span></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!"><span class="gedein">Home</span></a></li>

            <!-- jika sudah login (ada session pelanggan) -->
            <?php if (isset($_SESSION['pelanggan'])): ?>
                <li class="nav-item"><a class="nav-link" href="logout.php"><span class="gedein">Logout</span></a></li>

                        <!-- selain itu (belum login | belum ada session pelanggan) -->
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.php"><span class="gedein">Login</span></a></li>
                    <?php endif ?>

            <li class="nav-item"><a class="nav-link" href="#!"><span class="gedein">Checkout</span></a></li>
          </ul>
          <form class="d-flex" action="keranjang.php">
            <button class="btn btn-outline-dark" type="submit">
              <i class="bi-cart-fill me-1"></i>
              <span class="gedein">Keranjang</span>
              <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
            </button>
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    // jika ada tombol login (tombol simpan di tekan)
    // jika ada tombol simpan (tombol simpan di tekan)
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // lakukan query ngecek akun dari tabel pelanggan di db
        $ambil = $koneksi -> query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'
        AND password_pelanggan = '$password'");

        // ngitung akun yang terambil
        $akunyangcocok = $ambil -> num_rows;

        // jika 1 akun yang cocok, maka boleh di loginkan
        if ($akunyangcocok == 1) {
            // anda sudah login
            // mendapatkan akun dalam bentuk array
            $akun = $ambil -> fetch_assoc();
            // simpan di session pelanggan
            $_SESSION['pelanggan'] = $akun;
            echo"<script>alert('Anda sukses login')</script>";
            echo"<script>location = 'checkout.php';</script>";


        }else {
            // anda gagal login
            echo"<script>alert('Anda gagal login, periksa kembali email atau password anda!')</script>";
            echo"<script>location = 'login.php';</script>";
        }
    }
?>