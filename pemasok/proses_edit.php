<?php
session_start();
include '../koneksi.php';

// Tangkap data dari form
$old_id_pemasok = $_POST['old_id_pemasok']; // ID Detail Pembelian Lama
$id_pemasok = $_POST['id_pemasok']; // ID Detail Pembelian Baru
$nama_pemasok = $_POST['nama_pemasok'];
$no_telepon = $_POST['no_telepon'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$kode_pos = $_POST['kode_pos'];
$kota = $_POST['kota'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Periksa apakah ID Detail Pembelian Baru sudah ada di database
    if ($old_id_pemasok !== $id_pemasok) {
        $cek_duplicate = mysqli_query($koneksi, "SELECT id_pemasok FROM pemasok WHERE id_pemasok = '$id_pemasok'");
        if (mysqli_num_rows($cek_duplicate) > 0) {
            throw new Exception("ID Pemasok '$id_pemasok' sudah ada di database.");
        }
    }

    // Update data di tabel detail_pembelian
    $update_query = mysqli_query($koneksi, "UPDATE pemasok SET 
        id_pemasok = '$id_pemasok',
        nama_pemasok = '$nama_pemasok', 
        no_telepon = '$no_telepon', 
        email = '$email',
        alamat = '$alamat', 
        kode_pos = '$kode_pos',
        kota = '$kota'
        WHERE id_pemasok = '$old_id_pemasok'");

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
    header("Location: edit.php?id_pemasok=$old_id_pemasok&error=$error_message&nama_pemasok=$nama_pemasok&no_telepon=$no_telepon&email=$email&alamat=$alamat&kode_pos=$kode_pos&kota=$kota");
    exit;
}
?>
