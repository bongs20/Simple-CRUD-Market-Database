<?php
    include 'koneksi.php';

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];

    $query = mysqli_query($koneksi, "INSERT INTO anggota(nama, alamat, email, telp) VALUES
    ('$nama', '$alamat', '$email', '$telp')");
    if ($query) {
        header("location:lihat_anggota.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    ?>
