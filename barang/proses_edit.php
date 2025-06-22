<?php
include '../koneksi.php';

// Tangkap data dari form
$old_id_barang = $_POST['old_id_barang']; // ID Barang Lama
$id_barang = $_POST['id_barang']; // ID Barang Baru
$nama_barang = $_POST['nama_barang'];
$kategori = $_POST['kategori'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$stok = $_POST['stok'];
$tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Periksa apakah ID Barang Baru sudah ada di database
    if ($old_id_barang !== $id_barang) { // Hanya periksa jika ID Barang diubah
        $check_duplicate = mysqli_query($koneksi, "SELECT id_barang FROM barang WHERE id_barang = '$id_barang'");
        if (mysqli_num_rows($check_duplicate) > 0) {
            throw new Exception("ID Barang '$id_barang' sudah ada di database.");
        }
    }

    // Update data di tabel barang
    $update_barang = mysqli_query($koneksi, "UPDATE barang SET 
        id_barang='$id_barang', 
        nama_barang='$nama_barang', 
        kategori='$kategori', 
        harga_beli='$harga_beli', 
        harga_jual='$harga_jual', 
        stok='$stok', 
        tanggal_kadaluarsa='$tanggal_kadaluarsa' 
        WHERE id_barang='$old_id_barang'");
    if (!$update_barang) {
        throw new Exception("Gagal memperbarui data di tabel barang: " . mysqli_error($koneksi));
    }

    // Commit transaksi
    mysqli_commit($koneksi);
    header("location:index.php");
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    mysqli_rollback($koneksi);

    // Redirect kembali ke edit.php dengan pesan error dan data yang sudah diisi
    $error_message = urlencode($e->getMessage());
    header("location:edit.php?id_barang=$old_id_barang&error=$error_message&nama_barang=$nama_barang&kategori=$kategori&harga_beli=$harga_beli&harga_jual=$harga_jual&stok=$stok&tanggal_kadaluarsa=$tanggal_kadaluarsa");
    exit;
}
?>

