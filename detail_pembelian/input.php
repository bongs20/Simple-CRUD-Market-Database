<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php"); // Perbarui path ke index.php
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input Detail Pembelian</title>
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
        <h3 class="text-center mb-4">Input Detail Pembelian</h3>

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
                <label for="id_detail_pembelian" class="form-label">Id Detail Pembelian</label>
                <input type="text" class="form-control" id="id_detail_pembelian" name="id_detail_pembelian" pattern="DP\d{3}" title="Format : DPXXX" required>
            </div>
            <div class="mb-3">
                <label for="id_pembelian" class="form-label">Id Pembelian</label>
                <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" pattern="PB\d{3}" title="Format : PBXXX" required>
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">Id Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" pattern="B\d{3}" title="Format : BXXX" required>
            </div>
            <div class="mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
