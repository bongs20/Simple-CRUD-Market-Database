<?php
session_start();
include '../koneksi.php';

// Tangkap data dari form
$old_id_trx = $_POST['old_id_trx']; // ID Detail Pembelian Lama
$id_trx = $_POST['id_trx']; // ID Detail Pembelian Baru
$id_transaksi = $_POST['id_transaksi'];
$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];
$sub_total = $_POST['sub_total'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
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
    // Periksa apakah ID Detail Pembelian Baru sudah ada di database
    if ($old_id_trx !== $id_trx) {
        $cek_duplicate = mysqli_query($koneksi, "SELECT id_trx FROM detail_transaksi WHERE id_trx = '$id_trx'");
        if (mysqli_num_rows($cek_duplicate) > 0) {
            throw new Exception("ID Detail Transaksi '$id_trx' sudah ada di database.");
        }
    }

    // Update data di tabel detail_pembelian
    $update_query = mysqli_query($koneksi, "UPDATE detail_transaksi SET 
        id_trx = '$id_trx',
        id_transaksi = '$id_transaksi', 
        id_barang = '$id_barang', 
        jumlah = '$jumlah',
        sub_total = '$sub_total' 
        WHERE id_trx = '$old_id_trx'");

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
    header("Location: edit.php?id_trx=$old_id_trx&error=$error_message&id_transaksi=$id_transaksi&id_barang=$id_barang&jumlah=$jumlah&sub_total=$sub_total");
    exit;
}
?>
