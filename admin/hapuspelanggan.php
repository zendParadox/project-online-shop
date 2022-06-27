<h1>hapus pelanggan</h1>

<?php 
    $ambil = $koneksi -> query("SELECT * FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");
    $pecah = $ambil -> fetch_assoc();
    
    $koneksi -> query("DELETE FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");

    echo"<script>alert('Pelanggan Terhapus');</script>";
    echo"<script>location = 'index.php?halaman=pelanggan';</script>";
?>