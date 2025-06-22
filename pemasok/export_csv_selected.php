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
    fputcsv($output, array('ID Pemasok', 'Nama Pemasok', 'No. Telepon', 'Email', 'Alamat', 'Kode Pos', 'Kota'));

    // Ambil data dari database berdasarkan ID yang dipilih
    $query = mysqli_query($koneksi, "SELECT id_pemasok, nama_pemasok, no_telepon, email, alamat, kode_pos, kota FROM pemasok WHERE id_pemasok IN ($ids)");

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
