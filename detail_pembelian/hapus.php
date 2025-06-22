<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_detail_pembelian dari URL
$id_detail_pembelian = $_GET['id_detail_pembelian'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM detail_pembelian WHERE id_detail_pembelian='$id_detail_pembelian'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
