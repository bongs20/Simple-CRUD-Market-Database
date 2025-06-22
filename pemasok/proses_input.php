<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_pemasok = mysqli_real_escape_string($koneksi, $_POST['id_pemasok']);
    $nama_pemasok = mysqli_real_escape_string($koneksi, $_POST['nama_pemasok']);
    $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $kode_pos = mysqli_real_escape_string($koneksi, $_POST['kode_pos']);
    $kota = mysqli_real_escape_string($koneksi, $_POST['kota']);
    

    // Validasi id_pemasok
    $cek_id_detail = mysqli_query($koneksi, "SELECT id_pemasok FROM pemasok WHERE id_pemasok = '$id_pemasok'");
    if (mysqli_num_rows($cek_id_detail) > 0) {
        $_SESSION['error'] = "ID Pemasok '$id_pemasok' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }
    // Query untuk menyimpan data ke database
    $query = "INSERT INTO pemasok(id_pemasok, nama_pemasok, no_telepon, email, alamat, kode_pos, kota) 
              VALUES ('$id_pemasok', '$nama_pemasok', '$no_telepon', '$email', '$alamat', '$kode_pos', '$kota')";

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
