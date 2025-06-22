<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $riwayat_pembelian = mysqli_real_escape_string($koneksi, $_POST['riwayat_pembelian']);
    $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    

    // Validasi id_pelanggan
    $cek_id_detail = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    if (mysqli_num_rows($cek_id_detail) > 0) {
        $_SESSION['error'] = "ID Pelanggan '$id_pelanggan' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }

    $cek_transaksi = mysqli_query($koneksi, "SELECT id_transaksi FROM transaksi WHERE id_transaksi = '$riwayat_pembelian'");
    if (mysqli_num_rows($cek_transaksi) == 0) {
        throw new Exception("ID Transaksi '$riwayat_pembelian' tidak ditemukan. Silakan masukkan ID Barang yang valid.");
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO pelanggan(id_pelanggan, nama_pelanggan, riwayat_pembelian, no_telepon) 
                VALUES ('$id_pelanggan', '$nama_pelanggan', '$riwayat_pembelian', '$no_telepon')";

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
