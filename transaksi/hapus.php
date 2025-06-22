<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_transaksi dari URL
$id_transaksi = $_GET['id_transaksi'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
