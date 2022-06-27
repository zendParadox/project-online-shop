<?php
session_start();
//script koneksi 
$koneksi = new mysqli("localhost", "root", "", "toko_online");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Loding font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="./styles.css">

    <title>Login</title>
  </head>
  <body>

    <!-- Backgrounds -->

    <div id="login-bg" class="container-fluid">

      <div class="bg-img"></div>
      <div class="bg-color"></div>
    </div>

    <!-- End Backgrounds -->

    <div class="container" id="login">
        <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="login">

            <h1>Login</h1>
            
            <!-- Loging form -->
                  <form method="post">
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="user">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
                    </div>

                      <div class="form-check">

                      <label class="switch">
                      <input type="checkbox">
                      <span class="slider round"></span>
                    </label>
                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                      
                      <label class="forgot-password"><a href="#">Forgot Password?<a></label>

                    </div>
                  
                    <br>
                    <button type="submit" class="btn btn-lg btn-block btn-success" name="login">Sign in</button>
                  </form>
             <!-- End Loging form -->
              <?php
                if (isset($_POST['login'])) {
                  $ambil = $koneksi -> query("SELECT * FROM admin WHERE username = '$_POST[user]'
                  AND password = '$_POST[pass]'");
                  $yangcocok = $ambil -> num_rows;
                  if ($yangcocok == 1) {
                    $_SESSION['admin'] = $ambil -> fetch_assoc();
                    echo"<div class='alert alert-info'>Login Sukses</div>";
                    echo"<meta http-equiv = 'refresh' content='1;url=index.php'>";
                  }else {
                    echo"<div class='alert alert-danger'>Login Gagal</div>";
                    echo"<meta http-equiv = 'refresh' content='1;url=login.php'>";
                  }
                }
              ?>
          </div>
        </div>
        </div>
    </div>


  </body>
</html>