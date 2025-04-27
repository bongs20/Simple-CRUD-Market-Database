<?php
include 'koneksi.php';

// Periksa apakah ada data yang dipilih
if (isset($_POST['selected_ids']) && !empty($_POST['selected_ids'])) {
    $selected_ids = $_POST['selected_ids'];
    $ids = implode(",", array_map('intval', $selected_ids)); // Pastikan ID aman untuk query

    // Set header untuk file CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data_anggota_selected.csv');

    // Buka output stream
    $output = fopen('php://output', 'w');

    // Tulis header kolom ke file CSV
    fputcsv($output, array('ID', 'Nama', 'Alamat', 'Email', 'Telepon'));

    // Ambil data dari database berdasarkan ID yang dipilih
    $query = mysqli_query($koneksi, "SELECT id, nama, alamat, email, telp FROM anggota WHERE id IN ($ids)");

    // Tulis data ke file CSV
    while ($row = mysqli_fetch_assoc($query)) {
        fputcsv($output, $row);
    }

    // Tutup output stream
    fclose($output);
    exit;
} else {
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='lihat_anggota.php';</script>";
}
?>
