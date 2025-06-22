<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form
    $id_barang = mysqli_real_escape_string($koneksi, $_POST['id_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga_beli = mysqli_real_escape_string($koneksi, $_POST['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi, $_POST['harga_jual']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $tanggal_kadaluarsa = mysqli_real_escape_string($koneksi, $_POST['tanggal_kadaluarsa']);

    // Periksa apakah ID Barang sudah ada di database
    $check_duplicate = mysqli_query($koneksi, "SELECT id_barang FROM barang WHERE id_barang = '$id_barang'");
    if (mysqli_num_rows($check_duplicate) > 0) {
        // Redirect kembali ke input.php dengan pesan error dan data yang sudah diisi
        $error_message = urlencode("ID Barang '$id_barang' sudah ada di database. Silakan gunakan ID Barang yang berbeda.");
        header("Location: input.php?error=$error_message&nama_barang=$nama_barang&kategori=$kategori&harga_beli=$harga_beli&harga_jual=$harga_jual&stok=$stok&tanggal_kadaluarsa=$tanggal_kadaluarsa");
        exit;
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO barang (id_barang, nama_barang, kategori, harga_beli, harga_jual, stok, tanggal_kadaluarsa) 
              VALUES ('$id_barang', '$nama_barang', '$kategori', '$harga_beli', '$harga_jual', '$stok', '$tanggal_kadaluarsa')";

    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil
    if ($result) {
        header("Location: index.php"); // Perbarui path ke index.php
        exit;
    } else {
        // Redirect kembali ke input.php dengan pesan error
        $error_message = urlencode("Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi));
        header("Location: input.php?error=$error_message&nama_barang=$nama_barang&kategori=$kategori&harga_beli=$harga_beli&harga_jual=$harga_jual&stok=$stok&tanggal_kadaluarsa=$tanggal_kadaluarsa");
        exit;
    }
} else {
    // Jika tidak ada data yang dikirim, kembali ke halaman input
    header("Location: input.php"); // Perbarui path ke input.php
    exit;
}
?>
