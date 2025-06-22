<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php"); // Perbarui path ke index.php
    exit;
}

// Tangkap pesan error jika ada
$error_message = isset($_GET['error']) ? urldecode($_GET['error']) : null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        @media (max-width: 576px) {
            h1 {
                font-size: 1.5rem;
            }
            .table th, .table td {
                font-size: 0.875rem;
            }
            .btn {
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">Lihat Semua Data</a> <!-- Perbarui path ke index.php -->
        <h3 class="text-center mb-4">Edit Transaksi</h3>
        <?php
        include '../koneksi.php'; // Perbarui path ke koneksi.php

        // Tangkap id_transaksi dari URL
        $id_transaksi = $_GET['id_transaksi'];

        // Query untuk mendapatkan data berdasarkan id_transaksi
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : $data['id_transaksi'];
        $id_pelanggan = isset($_GET['id_pelanggan']) ? $_GET['id_pelanggan'] : $data['id_pelanggan'];
        $tanggal_transaksi = isset($_GET['tanggal_transaksi']) ? $_GET['tanggal_transaksi'] : $data['tanggal_transaksi'];
        $total_harga = isset($_GET['total_harga']) ? $_GET['total_harga'] : $data['total_harga'];
        $metode_pembayaran = isset($_GET['metode_pembayaran']) ? $_GET['metode_pembayaran'] : $data['metode_pembayaran'];
        ?>

        <!-- Tampilkan pesan error jika ada -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="proses_edit.php" method="post"> <!-- Perbarui path ke proses_edit.php -->
            <input type="hidden" name="old_id_transaksi" value="<?php echo $id_transaksi; ?>"> <!-- ID transaksi Lama -->
            <div class="mb-3">
                <label for="id_transaksi" class="form-label">ID Transaksi</label>
                <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" pattern="T\d{3}" title="Format : TXXX" value="<?php echo $id_transaksi; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" pattern="P\d{3}" title="Format : PXXX" value="<?php echo $id_pelanggan; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="<?php echo $tanggal_transaksi; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?php echo $total_harga; ?>" required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $metode_pembayaran; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
