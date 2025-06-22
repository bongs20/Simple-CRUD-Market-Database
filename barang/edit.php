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
    <title>Edit Data Barang</title>
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
        <h3 class="text-center mb-4">Edit Data Barang</h3>
        <?php
        include '../koneksi.php'; // Perbarui path ke koneksi.php

        // Tangkap id_barang dari URL
        $id_barang = $_GET['id_barang'];

        // Query untuk mendapatkan data berdasarkan id_barang
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_barang = isset($_GET['id_barang']) ? $_GET['id_barang'] : $data['id_barang'];
        $nama_barang = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : $data['nama_barang'];
        $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : $data['kategori'];
        $harga_beli = isset($_GET['harga_beli']) ? $_GET['harga_beli'] : $data['harga_beli'];
        $harga_jual = isset($_GET['harga_jual']) ? $_GET['harga_jual'] : $data['harga_jual'];
        $stok = isset($_GET['stok']) ? $_GET['stok'] : $data['stok'];
        $tanggal_kadaluarsa = isset($_GET['tanggal_kadaluarsa']) ? $_GET['tanggal_kadaluarsa'] : $data['tanggal_kadaluarsa'];
        ?>

        <!-- Tampilkan pesan error jika ada -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="proses_edit.php" method="post"> <!-- Perbarui path ke proses_edit.php -->
            <input type="hidden" name="old_id_barang" value="<?php echo $id_barang; ?>"> <!-- ID Barang Lama -->
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" pattern="B\d{3}" title="Format : BXXX" value="<?php echo $id_barang; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $nama_barang; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $kategori; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_beli" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $harga_beli; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_jual" class="form-label">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $harga_jual; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?php echo $tanggal_kadaluarsa; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
