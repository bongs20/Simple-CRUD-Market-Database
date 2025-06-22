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
    <title>Input Detail Transaksi</title>
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
        <h3 class="text-center mb-4">Input Detail Transaksi</h3>

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
                <label for="id_trx" class="form-label">Id Detail Transaksi</label>
                <input type="text" class="form-control" id="id_trx" name="id_trx" pattern="DT\d{3}" title="Format : DTXXX" required>
            </div>
            <div class="mb-3">
                <label for="id_transaksi" class="form-label">Id Transaksi</label>
                <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" pattern="T\d{3}" title="Format : TXXX" required>
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">Id Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" pattern="B\d{3}" title="Format : BXXX" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <div class="mb-3">
                <label for="sub_total" class="form-label">Sub Total</label>
                <input type="number" class="form-control" id="sub_total" name="sub_total" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
