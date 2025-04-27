<?php
    $koneksi = mysqli_connect("localhost", "userphp","98j4F63bzZx0SRWH", "php_240209501088");

    //cek koneksi
    if (mysqli_connect_errno()){
        echo "Koneksi Database Gagal! : " . mysqli_connect_error(); 
    }
?>
