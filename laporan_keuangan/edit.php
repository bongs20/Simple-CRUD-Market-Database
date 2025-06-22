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
    <title>Edit Laporan Keuangan</title>
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
        <a href="index.php" class="btn btn-secondary mb-3">Lihat Semua Data</a>
        <h3 class="text-center mb-4">Edit Laporan Keuangan</h3>
        <?php
        include '../koneksi.php';

        // Tangkap id_laporan dari URL
        $id_laporan = $_GET['id_laporan'];

        // Query untuk mendapatkan data berdasarkan id_laporan
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM laporan_keuangan WHERE id_laporan='$id_laporan'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_laporan = isset($_GET['id_laporan']) ? $_GET['id_laporan'] : $data['id_laporan'];
        $periode = isset($_GET['periode']) ? $_GET['periode'] : $data['periode'];
        $total_pemasukan = isset($_GET['total_pemasukan']) ? $_GET['total_pemasukan'] : $data['total_pemasukan'];
        $total_pengeluaran = isset($_GET['total_pengeluaran']) ? $_GET['total_pengeluaran'] : $data['total_pengeluaran'];
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
                <label for="id_laporan" class="form-label">ID Laporan</label>
                <input type="text" class="form-control" id="id_laporan" name="id_laporan" pattern="L\d{3}" title="Format : LXXX" value="<?php echo $id_laporan; ?>" required>
            </div>
            <!-- Hidden input untuk menyimpan old_id_laporan -->
            <input type="hidden" name="old_id_laporan" value="<?php echo $id_laporan; ?>">

            <div class="mb-3">
                <label for="periode" class="form-label">Periode</label>
                <input type="month" class="form-control" id="periode" name="periode" value="<?php echo $periode; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_pemasukan" class="form-label">Total Pemasukan</label>
                <input type="number" class="form-control" id="total_pemasukan" name="total_pemasukan" value="<?php echo $total_pemasukan; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_pengeluaran" class="form-label">Total Pengeluaran</label>
                <input type="number" class="form-control" id="total_pengeluaran" name="total_pengeluaran" value="<?php echo $total_pengeluaran; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
