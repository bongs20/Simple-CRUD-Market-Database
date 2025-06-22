<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_trx = mysqli_real_escape_string($koneksi, $_POST['id_trx']);
    $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
    $id_barang = mysqli_real_escape_string($koneksi, $_POST['id_barang']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $sub_total = mysqli_real_escape_string($koneksi, $_POST['sub_total']);
    

    // Validasi id_trx
    $cek_id_detail = mysqli_query($koneksi, "SELECT id_trx FROM detail_transaksi WHERE id_trx = '$id_trx'");
    if (mysqli_num_rows($cek_id_detail) > 0) {
        $_SESSION['error'] = "ID Detail Transaksi '$id_trx' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }

    // Validasi id_transaksi
    $cek_pembelian = mysqli_query($koneksi, "SELECT id_transaksi FROM transaksi WHERE id_transaksi = '$id_transaksi'");
    if (mysqli_num_rows($cek_pembelian) == 0) {
        $_SESSION['error'] = "ID Transaksi tidak ditemukan. Silakan masukkan ID Pembelian yang valid.";
        header("Location: input.php");
        exit;
    }

    // Validasi id_barang
    $cek_barang = mysqli_query($koneksi, "SELECT id_barang FROM barang WHERE id_barang = '$id_barang'");
    if (mysqli_num_rows($cek_barang) == 0) {
        $_SESSION['error'] = "ID Barang tidak ditemukan. Silakan masukkan ID Barang yang valid.";
        header("Location: input.php");
        exit;
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO detail_transaksi(id_trx, id_transaksi, id_barang, jumlah, sub_total) 
              VALUES ('$id_trx', '$id_transaksi', '$id_barang', '$jumlah', '$sub_total')";

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
