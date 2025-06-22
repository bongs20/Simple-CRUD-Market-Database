<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    <title>Edit Data Detail Transaksi</title>
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
        <h3 class="text-center mb-4">Edit Data Detail Transaksi</h3>
        <?php
        include '../koneksi.php';

        // Tangkap id_trx dari URL
        $id_trx = $_GET['id_trx'];

        // Query untuk mendapatkan data berdasarkan id_trx
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_trx='$id_trx'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_trx = isset($_GET['id_trx']) ? $_GET['id_trx'] : $data['id_trx'];
        $id_transaksi = isset($_GET['id_transaksi']) ? $_GET['id_transaksi'] : $data['id_transaksi'];
        $id_barang = isset($_GET['id_barang']) ? $_GET['id_barang'] : $data['id_barang'];
        $jumlah = isset($_GET['jumlah']) ? $_GET['jumlah'] : $data['jumlah'];
        $sub_total = isset($_GET['sub_total']) ? $_GET['sub_total'] : $data['sub_total'];
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
                <label for="id_trx" class="form-label">ID Detail Transaksi</label>
                <input type="text" class="form-control" id="id_trx" name="id_trx" pattern="DT\d{3}" title="Format : DTXXX" value="<?php echo $id_trx; ?>" required>
            </div>
            <!-- Hidden input untuk menyimpan old_id_trx -->
            <input type="hidden" name="old_id_trx" value="<?php echo $id_trx; ?>">

            <div class="mb-3">
                <label for="id_transaksi" class="form-label">ID Transaksi</label>
                <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" pattern="T\d{3}" title="Format : TXXX" value="<?php echo $id_transaksi; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" pattern="B\d{3}" title="Format : BXXX" value="<?php echo $id_barang; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" required>
            </div>
            <div class="mb-3">
                <label for="sub_total" class="form-label">SUb Total</label>
                <input type="number" class="form-control" id="sub_total" name="sub_total" value="<?php echo $sub_total; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
