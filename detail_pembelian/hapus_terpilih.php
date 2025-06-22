<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php"); // Disesuaikan dengan direktori terbaru
    exit;
}

include "../koneksi.php"; // Disesuaikan jalur

// Periksa apakah ada data yang dipilih
if (isset($_POST['selected_ids']) && !empty($_POST['selected_ids'])) {
    $selected_ids = $_POST['selected_ids'];
    $ids = implode(",", array_map(function ($id) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $id) . "'";
    }, $selected_ids)); // Pastikan ID aman untuk query

    // Hapus data dari tabel `barang`
    $delete_barang = mysqli_query($koneksi, "DELETE FROM detail_pembelian WHERE id_detail_pembelian IN ($ids)");
    if ($delete_barang) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>"; // Disesuaikan jalur
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data di tabel barang: " . mysqli_error($koneksi) . "'); window.location='index.php';</script>"; // Disesuaikan jalur
    }
} else {
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='index.php';</script>"; // Disesuaikan jalur
}
?>
