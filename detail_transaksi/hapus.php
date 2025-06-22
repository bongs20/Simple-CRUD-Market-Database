<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_trx dari URL
$id_trx = $_GET['id_trx'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM detail_transaksi WHERE id_trx='$id_trx'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
