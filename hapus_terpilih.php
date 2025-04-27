<?php
include 'koneksi.php';

// Periksa apakah ada data yang dipilih
if (isset($_POST['selected_ids'])) {
    $selected_ids = $_POST['selected_ids'];
    $ids = implode(",", $selected_ids);

    // Hapus data berdasarkan ID yang dipilih
    $query = mysqli_query($koneksi, "DELETE FROM anggota WHERE id IN ($ids)");

    if ($query) {
        header("location:lihat_anggota.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>alert('Tidak ada data yang dipilih!'); window.location='lihat_anggota.php';</script>";
}
?>
