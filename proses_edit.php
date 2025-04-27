<?php
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$telp = $_POST['telp'];

// update data ke database
$query = mysqli_query($koneksi, "UPDATE anggota SET nama='$nama', alamat='$alamat', email='$email', telp='$telp' WHERE id='$id'");

// mengalihkan halaman kembali ke lihat_anggota.php
if ($query) {
    header("location:lihat_anggota.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
