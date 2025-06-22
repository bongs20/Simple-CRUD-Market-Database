<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_pembelian dari URL
$id_pembelian = $_GET['id_pembelian'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM pembelian_stok WHERE id_pembelian='$id_pembelian'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
