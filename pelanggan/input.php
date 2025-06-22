<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php"); // Perbarui path ke index.php
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Pelanggan</title>
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
        <h3 class="text-center mb-4">Input Pelanggan</h3>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']); // Hapus pesan error setelah ditampilkan
                ?>
            </div>
        <?php endif; ?>

        <form action="proses_input.php" method="post"> <!-- Perbarui path ke proses_input.php -->
            <div class="mb-3">
                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" pattern="P\d{3}" title="Format : PXXX" required>
            </div>
            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
            </div>
            <div class="mb-3">
                <label for="riwayat_pembelian" class="form-label">Riwayat Pembelian</label>
                <input type="text" class="form-control" id="riwayat_pembelian" name="riwayat_pembelian" pattern="T\d{3}" title="Format : TXXX" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="no_telepon" name="no_telepon" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
