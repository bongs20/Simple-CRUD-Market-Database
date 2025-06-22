<?php
session_start();
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_laporan = mysqli_real_escape_string($koneksi, $_POST['id_laporan']);
    $periode = mysqli_real_escape_string($koneksi, $_POST['periode']);
    $total_pemasukan = mysqli_real_escape_string($koneksi, $_POST['total_pemasukan']);
    $total_pengeluaran = mysqli_real_escape_string($koneksi, $_POST['total_pengeluaran']);
    $keuntungan = $total_pemasukan - $total_pengeluaran;

    // Validasi id_detail_pembelian
    $cek_id_laporan = mysqli_query($koneksi, "SELECT id_laporan FROM laporan_keuangan WHERE id_laporan = '$id_laporan'");
    if (mysqli_num_rows($cek_id_laporan) > 0) {
        $_SESSION['error'] = "ID Laporan '$id_laporan' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO laporan_keuangan(id_laporan, periode, total_pemasukan, total_pengeluaran, keuntungan) 
              VALUES ('$id_laporan', '$periode', '$total_pemasukan', '$total_pengeluaran', '$keuntungan')";

    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil
    if ($result) {
        header("Location: index.php"); // Perbarui path ke index.php
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan: " . mysqli_error($koneksi);
        header("Location: input.php");
        exit;
    }
} else {
    // Jika tidak ada data yang dikirim, kembali ke halaman input
    header("Location: input.php"); // Perbarui path ke input.php
    exit;
}
?>
