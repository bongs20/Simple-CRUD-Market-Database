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
    <title>Edit Data Detail Pembelian</title>
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
        <h3 class="text-center mb-4">Edit Data Detail Pembelian</h3>
        <?php
        include '../koneksi.php';

        // Tangkap id_detail_pembelian dari URL
        $id_detail_pembelian = $_GET['id_detail_pembelian'];

        // Query untuk mendapatkan data berdasarkan id_detail_pembelian
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM detail_pembelian WHERE id_detail_pembelian='$id_detail_pembelian'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_detail_pembelian = isset($_GET['id_detail_pembelian']) ? $_GET['id_detail_pembelian'] : $data['id_detail_pembelian'];
        $id_pembelian = isset($_GET['id_pembelian']) ? $_GET['id_pembelian'] : $data['id_pembelian'];
        $id_barang = isset($_GET['id_barang']) ? $_GET['id_barang'] : $data['id_barang'];
        $harga_satuan = isset($_GET['harga_satuan']) ? $_GET['harga_satuan'] : $data['harga_satuan'];
        $jumlah = isset($_GET['jumlah']) ? $_GET['jumlah'] : $data['jumlah'];
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
                <label for="id_detail_pembelian" class="form-label">ID Detail Pembelian</label>
                <input type="text" class="form-control" id="id_detail_pembelian" name="id_detail_pembelian" pattern="DP\d{3}" title="Format : DPXXX" value="<?php echo $id_detail_pembelian; ?>" required>
            </div>
            <!-- Hidden input untuk menyimpan old_id_detail_pembelian -->
            <input type="hidden" name="old_id_detail_pembelian" value="<?php echo $id_detail_pembelian; ?>">

            <div class="mb-3">
                <label for="id_pembelian" class="form-label">ID Pembelian</label>
                <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" pattern="PB\d{3}" title="Format : PBXXX" value="<?php echo $id_pembelian; ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" pattern="B\d{3}" title="Format : BXXX" value="<?php echo $id_barang; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="<?php echo $harga_satuan; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
