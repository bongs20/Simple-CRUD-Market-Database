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
    <title>Edit Pelanggan</title>
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
        <h3 class="text-center mb-4">Edit Pelanggan</h3>
        <?php
        include '../koneksi.php';

        // Tangkap id_pelanggan dari URL
        $id_pelanggan = $_GET['id_pelanggan'];

        // Query untuk mendapatkan data berdasarkan id_pelanggan
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_pelanggan = isset($_GET['id_pelanggan']) ? $_GET['id_pelanggan'] : $data['id_pelanggan'];
        $nama_pelanggan = isset($_GET['nama_pelanggan']) ? $_GET['nama_pelanggan'] : $data['nama_pelanggan'];
        $riwayat_pembelian = isset($_GET['riwayat_pembelian']) ? $_GET['riwayat_pembelian'] : $data['riwayat_pembelian'];
        $no_telepon = isset($_GET['no_telepon']) ? $_GET['no_telepon'] : $data['no_telepon'];
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
                <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" pattern="P\d{3}" title="Format : PXXX" value="<?php echo $id_pelanggan; ?>" required>
            </div>
            <!-- Hidden input untuk menyimpan old_id_pelanggan -->
            <input type="hidden" name="old_id_pelanggan" value="<?php echo $id_pelanggan; ?>">

            <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>" required>
            </div>
            <div class="mb-3">
                <label for="riwayat_pembelian" class="form-label">Riwayat Pembelian</label>
                <input type="text" class="form-control" id="riwayat_pembelian" name="riwayat_pembelian" pattern="T\d{3}" title="Format : TXXX" value="<?php echo $riwayat_pembelian; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $no_telepon; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
