<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_pelanggan dari URL
$id_pelanggan = $_GET['id_pelanggan'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
