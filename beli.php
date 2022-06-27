<h1>tampilan beli</h1>

<?php
session_start();
    // mendapatkan id produk dari url
    $id_produk = $_GET['id'];
 
    // jika sudah ada produk itu di keranjang, maka produk itu jumlahnya +1
    if (isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] += 1;
    }

    // selain itu (belum ada di keranjang), maka produk itu dibeli 1
    else {
        $_SESSION['keranjang'][$id_produk] = 1;
    }

    // echo"<pre>";
    // print_r($_SESSION);
    // echo"</pre>";

    // larikan ke halaman keranjang
    echo"<script>alert('Produk telah masuk ke keranjang');</script>";
    echo"<script>location='keranjang.php';</script>";
?>