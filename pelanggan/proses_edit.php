<?php
session_start();
include '../koneksi.php';

// Tangkap data dari form
$old_id_pelanggan = $_POST['old_id_pelanggan']; // ID Detail Pembelian Lama
$id_pelanggan = $_POST['id_pelanggan']; // ID Detail Pembelian Baru
$nama_pelanggan = $_POST['nama_pelanggan'];
$riwayat_pembelian = $_POST['riwayat_pembelian'];
$no_telepon = $_POST['no_telepon'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    if ($old_id_pelanggan !== $id_pelanggan) {
        $cek_duplicate = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
        if (mysqli_num_rows($cek_duplicate) > 0) {
            throw new Exception("ID Pelanggan '$id_pelanggan' sudah ada di database.");
        }
    }

    $cek_transaksi = mysqli_query($koneksi, "SELECT id_transaksi FROM transaksi WHERE id_transaksi = '$riwayat_pembelian'");
    if (mysqli_num_rows($cek_transaksi) == 0) {
        throw new Exception("ID Transaksi '$riwayat_pembelian' tidak ditemukan. Silakan masukkan ID Barang yang valid.");
    }


    // Update data di tabel detail_pembelian
    $update_query = mysqli_query($koneksi, "UPDATE pelanggan SET 
        id_pelanggan = '$id_pelanggan',
        nama_pelanggan = '$nama_pelanggan', 
        riwayat_pembelian = '$riwayat_pembelian', 
        no_telepon = '$no_telepon'
        WHERE id_pelanggan = '$old_id_pelanggan'");

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
    header("Location: edit.php?id_pelanggan=$old_id_pelanggan&error=$error_message&nama_pelanggan=$nama_pelanggan&riwayat_pembelian=$riwayat_pembelian&no_telepon=$no_telepon");
    exit;
}
?>
