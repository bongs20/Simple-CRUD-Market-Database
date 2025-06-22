<?php
include '../koneksi.php'; // Perbarui path ke koneksi.php

// Periksa apakah ada data yang dipilih
if (isset($_POST['selected_ids']) && !empty($_POST['selected_ids'])) {
    $selected_ids = $_POST['selected_ids'];
    $ids = implode(",", array_map(function ($id) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $id) . "'";
    }, $selected_ids)); // Pastikan ID aman untuk query

    // Set header untuk file CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data_barang_selected.csv');

    // Buka output stream
    $output = fopen('php://output', 'w');

    // Tulis header kolom ke file CSV
    fputcsv($output, array('ID Barang', 'Nama Barang', 'Kategori', 'Harga Beli', 'Harga Jual', 'Stok', 'Tanggal Kadaluarsa'));

    // Ambil data dari database berdasarkan ID yang dipilih
    $query = mysqli_query($koneksi, "SELECT id_barang, nama_barang, kategori, harga_beli, harga_jual, stok, tanggal_kadaluarsa FROM barang WHERE id_barang IN ($ids)");

    // Tulis data ke file CSV
    while ($row = mysqli_fetch_assoc($query)) {
        fputcsv($output, $row);
    }

    // Tutup output stream
    fclose($output);
    exit;
} else {
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='index.php';</script>"; // Perbarui path ke index.php
}
?>
