<h1>logout</h1>
<?php
// session_destroy();
unset($_SESSION['admin']);
echo"<script>alert('Anda telah logout')</script>";
echo"<script>location='login.php';</script>";
?>