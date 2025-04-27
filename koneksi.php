<?php
    // Ambil konfigurasi dari environment variables
    $host = getenv('MYSQLHOST') ?: 'localhost';
    $user = getenv('MYSQLUSER') ?: 'userphp';
    $password = getenv('MYSQLPASSWORD') ?: '98j4F63bzZx0SRWH';
    $database = getenv('MYSQLDATABASE') ?: 'php_240209501088';

    // Koneksi ke database
    $koneksi = mysqli_connect($host, $user, $password, $database);

    // Cek koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi Database Gagal! : " . mysqli_connect_error();
    }
?>
