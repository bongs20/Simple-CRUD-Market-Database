<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_pembelian = mysqli_real_escape_string($koneksi, $_POST['id_pembelian']);
    $id_pemasok = mysqli_real_escape_string($koneksi, $_POST['id_pemasok']);
    $tanggal_pembelian = mysqli_real_escape_string($koneksi, $_POST['tanggal_pembelian']);
    $total_biaya = mysqli_real_escape_string($koneksi, $_POST['total_biaya']);

    // Validasi id_pembelian
    $cek_id_detail = mysqli_query($koneksi, "SELECT id_pembelian FROM pembelian_stok WHERE id_pembelian = '$id_pembelian'");
    if (mysqli_num_rows($cek_id_detail) > 0) {
        $_SESSION['error'] = "ID Pembelian '$id_pembelian' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }
    // Validasi id_pemasok
    $cek_pembelian = mysqli_query($koneksi, "SELECT id_pemasok FROM pemasok WHERE id_pemasok = '$id_pemasok'");
    if (mysqli_num_rows($cek_pembelian) == 0) {
        $_SESSION['error'] = "ID Pemasok tidak ditemukan. Silakan masukkan ID Pemasok yang valid.";
        header("Location: input.php");
        exit;
    }
    // Query untuk menyimpan data ke database
    $query = "INSERT INTO pembelian_stok(id_pembelian, id_pemasok, tanggal_pembelian, total_biaya) 
                VALUES ('$id_pembelian', '$id_pemasok', '$tanggal_pembelian', '$total_biaya')";

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
