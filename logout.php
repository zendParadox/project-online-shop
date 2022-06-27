<?php
    session_start();

    // menghancurkan $_SESSION['pelanggan']
    unset($_SESSION['pengguna']);

    echo"<script>alert('Anda telah logout')</script>";
    echo"<script>location='index.php'</script>";
?>