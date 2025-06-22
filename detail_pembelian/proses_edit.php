<?php
session_start();
include '../koneksi.php';

// Tangkap data dari form
$old_id_detail_pembelian = $_POST['old_id_detail_pembelian']; // ID Detail Pembelian Lama
$id_detail_pembelian = $_POST['id_detail_pembelian']; // ID Detail Pembelian Baru
$id_pembelian = $_POST['id_pembelian'];
$id_barang = $_POST['id_barang'];
$harga_satuan = $_POST['harga_satuan'];
$jumlah = $_POST['jumlah'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Validasi id_pembelian
    $cek_pembelian = mysqli_query($koneksi, "SELECT id_pembelian FROM pembelian_stok WHERE id_pembelian = '$id_pembelian'");
    if (mysqli_num_rows($cek_pembelian) == 0) {
        throw new Exception("ID Pembelian tidak ditemukan. Silakan masukkan ID Pembelian yang valid.");
    }

    // Validasi id_barang
    $cek_barang = mysqli_query($koneksi, "SELECT id_barang FROM barang WHERE id_barang = '$id_barang'");
    if (mysqli_num_rows($cek_barang) == 0) {
        throw new Exception("ID Barang tidak ditemukan. Silakan masukkan ID Barang yang valid.");
    }

    // Periksa apakah ID Detail Pembelian Baru sudah ada di database
    if ($old_id_detail_pembelian !== $id_detail_pembelian) {
        $cek_duplicate = mysqli_query($koneksi, "SELECT id_detail_pembelian FROM detail_pembelian WHERE id_detail_pembelian = '$id_detail_pembelian'");
        if (mysqli_num_rows($cek_duplicate) > 0) {
            throw new Exception("ID Detail Pembelian '$id_detail_pembelian' sudah ada di database.");
        }
    }

    // Update data di tabel detail_pembelian
    $update_query = mysqli_query($koneksi, "UPDATE detail_pembelian SET 
        id_detail_pembelian = '$id_detail_pembelian',
        id_pembelian = '$id_pembelian', 
        id_barang = '$id_barang', 
        harga_satuan = '$harga_satuan', 
        jumlah = '$jumlah' 
        WHERE id_detail_pembelian = '$old_id_detail_pembelian'");

    if (!$update_query) {
        throw new Exception("Gagal memperbarui data: " . mysqli_error($koneksi));
    }

    // Commit transaksi
    mysqli_commit($koneksi);
    header("Location: index.php");
    exit;
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    mysqli_rollback($koneksi);

    // Redirect kembali ke edit.php dengan pesan error
    $error_message = urlencode($e->getMessage());
    header("Location: edit.php?id_detail_pembelian=$old_id_detail_pembelian&error=$error_message&id_pembelian=$id_pembelian&id_barang=$id_barang&harga_satuan=$harga_satuan&jumlah=$jumlah");
    exit;
}
?>
