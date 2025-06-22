<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_barang dari URL
$id_barang = $_GET['id_barang'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
