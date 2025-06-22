<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

// Tangkap pesan error jika ada
$error_message = isset($_GET['error']) ? urldecode($_GET['error']) : null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembelian Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        @media (max-width: 576px) {
            h1 {
                font-size: 1.5rem;
            }
            .table th, .table td {
                font-size: 0.875rem;Pembelian
            }
            .btn {
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">Lihat Semua Data</a>
        <h3 class="text-center mb-4">Edit Pembelian Stok</h3>
        <?php
        include '../koneksi.php';

        // Tangkap id_pembelian dari URL
        $id_pembelian = $_GET['id_pembelian'];

        // Query untuk mendapatkan data berdasarkan id_pembelian
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM pembelian_stok WHERE id_pembelian='$id_pembelian'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_pembelian = isset($_GET['id_pembelian']) ? $_GET['id_pembelian'] : $data['id_pembelian'];
        $id_pemasok = isset($_GET['id_pemasok']) ? $_GET['id_pemasok'] : $data['id_pemasok'];
        $tanggal_pembelian = isset($_GET['tanggal_pembelian']) ? $_GET['tanggal_pembelian'] : $data['tanggal_pembelian'];
        $total_biaya = isset($_GET['total_biaya']) ? $_GET['total_biaya'] : $data['total_biaya'];
        ?>

        <!-- Tampilkan pesan error jika ada -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="proses_edit.php" method="post">
            <!-- Tampilkan ID Detail Pembelian -->
            <div class="mb-3">
                <label for="id_pembelian" class="form-label">ID Pembelian</label>
                <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" pattern="PB\d{3}" title="Format : PBXXX" value="<?php echo $id_pembelian; ?>" required>
            </div>
            <!-- Hidden input untuk menyimpan old_id_pembelian -->
            <input type="hidden" name="old_id_pembelian" value="<?php echo $id_pembelian; ?>">

            <div class="mb-3">
                <label for="id_pemasok" class="form-label">ID Pemasok</label>
                <input type="text" class="form-control" id="id_pemasok" name="id_pemasok" pattern="S\d{3}" title="Format : SXXX" value="<?php echo $id_pemasok; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?php echo $tanggal_pembelian; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_biaya" class="form-label">Total Biaya</label>
                <input type="number" class="form-control" id="total_biaya" name="total_biaya" value="<?php echo $total_biaya; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
