<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $tanggal_transaksi = mysqli_real_escape_string($koneksi, $_POST['tanggal_transaksi']);
    $total_harga = mysqli_real_escape_string($koneksi, $_POST['total_harga']);
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);
    
    // Periksa apakah ID transaksi sudah ada di database
    $check_duplicate = mysqli_query($koneksi, "SELECT id_transaksi FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    if (mysqli_num_rows($check_duplicate) > 0) {
        // Redirect kembali ke input.php dengan pesan error dan data yang sudah diisi
        $error_message = urlencode("ID Transaksi '$id_transaksi' sudah ada di database. Silakan gunakan ID Transaksi yang berbeda.");
        header("Location: input.php?error=$error_message&id_pelanggan=$id_pelanggan&tanggal_transaksi=$tanggal_transaksi&total_harga=$total_harga&metode_pembayaran=$metode_pembayaran");
        exit;
    }

    // Periksa ID Pelanggan apakah sesuai
    $check_pelanggan = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    if (mysqli_num_rows($check_pelanggan) == 0) {
        $error_message = urlencode("ID Pelanggan '$id_pelanggan' tidak valid. Silahkan gunakan ID Pelanggan yang valid.");
        header("Location: input.php?error=$error_message&id_transaksi=$id_transaksi&tanggal_transaksi=$tanggal_transaksi&total_harga=$total_harga&metode_pembayaran=$metode_pembayaran");
        exit;
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO transaksi (id_transaksi, id_pelanggan, tanggal_transaksi, total_harga, metode_pembayaran) 
              VALUES ('$id_transaksi', '$id_pelanggan', '$tanggal_transaksi', '$total_harga', '$metode_pembayaran')";

    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil
    if ($result) {
        header("Location: index.php"); // Perbarui path ke index.php
        exit;
    } else {
        // Redirect kembali ke input.php dengan pesan error
        $error_message = urlencode("Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi));
        header("Location: input.php?error=$error_message&id_pelanggan=$id_pelanggan&tanggal_transaksi=$tanggal_transaksi&total_harga=$total_harga&metode_pembayaran=$metode_pembayaran");
        exit;
    }
} else {
    // Jika tidak ada data yang dikirim, kembali ke halaman input
    header("Location: input.php"); // Perbarui path ke input.php
    exit;
}
?>
