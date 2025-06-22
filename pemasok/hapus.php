<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_pemasok dari URL
$id_pemasok = $_GET['id_pemasok'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM pemasok WHERE id_pemasok='$id_pemasok'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
