<?php
    $host = 'localhost';
    $user = 'adminToko';
    $password = '';
    $database = 'sistem_penjualan';

    // Koneksi ke database
    $koneksi = mysqli_connect($host, $user, $password, $database);

    // Cek koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi Database Gagal! : " . mysqli_connect_error();
    }
?>
