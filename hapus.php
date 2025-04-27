<?php
// koneksi
include 'koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id'];

// menghapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM anggota WHERE id='$id'");

// mengalihkan halaman kembali ke lihat_anggota.php
if ($query) {
    header("location:lihat_anggota.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
