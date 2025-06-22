<?php
include '../koneksi.php';

// Tangkap data dari form
$old_id_transaksi = $_POST['old_id_transaksi']; // ID transaksi Lama
$id_transaksi = $_POST['id_transaksi']; // ID transaksi Baru
$id_pelanggan = $_POST['id_pelanggan'];
$tanggal_transaksi = $_POST['tanggal_transaksi'];
$total_harga = $_POST['total_harga'];
$metode_pembayaran = $_POST['metode_pembayaran'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Periksa apakah ID transaksi Baru sudah ada di database
    if ($old_id_transaksi !== $id_transaksi) { // Hanya periksa jika ID transaksi diubah
        $check_duplicate = mysqli_query($koneksi, "SELECT id_transaksi FROM transaksi WHERE id_transaksi = '$id_transaksi'");
        if (mysqli_num_rows($check_duplicate) > 0) {
            throw new Exception("ID transaksi '$id_transaksi' sudah ada di database.");
        }
    }

    // Validasi id_pelanggan
    $cek_barang = mysqli_query($koneksi, "SELECT id_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    if (mysqli_num_rows($cek_barang) == 0) {
        throw new Exception("ID Pelanggan tidak ditemukan. Silakan masukkan ID Pelanggan yang valid.");
    }

    // Update data di tabel transaksi
    $update_transaksi = mysqli_query($koneksi, "UPDATE transaksi SET 
        id_transaksi='$id_transaksi', 
        id_pelanggan='$id_pelanggan', 
        tanggal_transaksi='$tanggal_transaksi', 
        total_harga='$total_harga', 
        metode_pembayaran='$metode_pembayaran'
        WHERE id_transaksi='$old_id_transaksi'");
    if (!$update_transaksi) {
        throw new Exception("Gagal memperbarui data di tabel transaksi: " . mysqli_error($koneksi));
    }

    // Commit transaksi
    mysqli_commit($koneksi);
    header("location:index.php");
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    mysqli_rollback($koneksi);

    // Redirect kembali ke edit.php dengan pesan error dan data yang sudah diisi
    $error_message = urlencode($e->getMessage());
    header("location:edit.php?id_transaksi=$old_id_transaksi&error=$error_message&id_pelanggan=$id_pelanggan&tanggal_transaksi=$tanggal_transaksi&total_harga=$total_harga&metode_pembayaran=$metode_pembayaran");
    exit;
}
?>

