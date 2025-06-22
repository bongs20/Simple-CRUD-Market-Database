<?php
session_start();
include '../koneksi.php';

// Tangkap data dari form
$old_id_pembelian = $_POST['old_id_pembelian']; // ID Detail Pembelian Lama
$id_pembelian = $_POST['id_pembelian']; // ID Detail Pembelian Baru
$id_pemasok = $_POST['id_pemasok'];
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$total_biaya = $_POST['total_biaya'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Validasi id_pemasok
    $cek_pembelian = mysqli_query($koneksi, "SELECT id_pemasok FROM pemasok WHERE id_pemasok = '$id_pemasok'");
    if (mysqli_num_rows($cek_pembelian) == 0) {
        throw new Exception("ID Pemasok tidak ditemukan. Silakan masukkan ID Pembelian yang valid.");
    }

    // Periksa apakah ID Detail Pembelian Baru sudah ada di database
    if ($old_id_pembelian !== $id_pembelian) {
        $cek_duplicate = mysqli_query($koneksi, "SELECT id_pembelian FROM pembelian_stok WHERE id_pembelian = '$id_pembelian'");
        if (mysqli_num_rows($cek_duplicate) > 0) {
            throw new Exception("ID Pembelian '$id_pembelian' sudah ada di database.");
        }
    }

    // Update data di tabel pembelian_stok
    $update_query = mysqli_query($koneksi, "UPDATE pembelian_stok SET 
        id_pembelian = '$id_pembelian',
        id_pemasok = '$id_pemasok', 
        tanggal_pembelian = '$tanggal_pembelian', 
        total_biaya = '$total_biaya'
        WHERE id_pembelian = '$old_id_pembelian'");

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
    header("Location: edit.php?id_pembelian=$old_id_pembelian&error=$error_message&id_pemasok=$id_pemasok&tanggal_pembelian=$tanggal_pembelian&total_biaya=$total_biaya");
    exit;
}
?>
