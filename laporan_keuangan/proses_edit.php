<?php
session_start();
include '../koneksi.php';

// Tangkap data dari form
$old_id_laporan = $_POST['old_id_laporan'];
$id_laporan = $_POST['id_laporan'];
$total_pemasukan = $_POST['total_pemasukan'];
$total_pengeluaran = $_POST['total_pengeluaran'];
$periode = $_POST['periode'];
$keuntungan = $total_pemasukan - $total_pengeluaran;

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
   // Validasi
    $cek_laporan = mysqli_query($koneksi, "SELECT id_laporan FROM laporan_keuangan WHERE id_laporan = '$id_laporan'");
    if (mysqli_num_rows($cek_laporan) == 0) {
        $_SESSION['error'] = "ID Laporan '$id_laporan' sudah ada. Silakan masukkan ID yang berbeda.";
        header("Location: input.php");
        exit;
    }
    // Update data di tabel detail_pembelian
    $update_query = mysqli_query($koneksi, "UPDATE laporan_keuangan SET
        id_laporan = '$id_laporan',
        periode = '$periode', 
        total_pemasukan = '$total_pemasukan', 
        total_pengeluaran = '$total_pengeluaran',
        keuntungan = '$keuntungan' 
        WHERE id_laporan = '$old_id_laporan'");

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
    header("Location: edit.php?id_laporan=$old_id_laporan&error=$error_message&periode=$periode&total_pemasukan=$total_pemasukan&total_pengeluaran=$total_pengeluaran&keuntungan=$keuntungan");
    exit;
}
?>
