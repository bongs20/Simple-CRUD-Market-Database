<?php
session_start();
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_detail_pembelian = mysqli_real_escape_string($koneksi, $_POST['id_detail_pembelian']);
    $id_pembelian = mysqli_real_escape_string($koneksi, $_POST['id_pembelian']);
    $id_barang = mysqli_real_escape_string($koneksi, $_POST['id_barang']);
    $harga_satuan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);

    // Validasi id_detail_pembelian
    $cek_id_detail = mysqli_query($koneksi, "SELECT id_detail_pembelian FROM detail_pembelian WHERE id_detail_pembelian = '$id_detail_pembelian'");
    if (mysqli_num_rows($cek_id_detail) > 0) {
        $_SESSION['error'] = "ID Detail Pembelian '$id_detail_pembelian' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }

    // Validasi id_pembelian
    $cek_pembelian = mysqli_query($koneksi, "SELECT id_pembelian FROM pembelian_stok WHERE id_pembelian = '$id_pembelian'");
    if (mysqli_num_rows($cek_pembelian) == 0) {
        $_SESSION['error'] = "ID Pembelian tidak ditemukan. Silakan masukkan ID Pembelian yang valid.";
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
    $query = "INSERT INTO detail_pembelian(id_detail_pembelian, id_pembelian, id_barang, harga_satuan, jumlah) 
              VALUES ('$id_detail_pembelian', '$id_pembelian', '$id_barang', '$harga_satuan', '$jumlah')";

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
