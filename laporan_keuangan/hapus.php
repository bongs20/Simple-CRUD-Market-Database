<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Tangkap data id_laporan dari URL
$id_laporan = $_GET['id_laporan'];

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM laporan_keuangan WHERE id_laporan='$id_laporan'");

if ($query) {
    header("Location: index.php"); // Perbarui path ke index.php
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
