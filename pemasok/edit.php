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
    <title>Edit Pemasok</title>
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
        <h3 class="text-center mb-4">Edit Pemasok</h3>
        <?php
        include '../koneksi.php';

        // Tangkap id_pemasok dari URL
        $id_pemasok = $_GET['id_pemasok'];

        // Query untuk mendapatkan data berdasarkan id_pemasok
        $query_mysql = mysqli_query($koneksi, "SELECT * FROM pemasok WHERE id_pemasok='$id_pemasok'");
        $data = mysqli_fetch_array($query_mysql);

        if (!$data) {
            echo "<p class='text-danger text-center'>Data tidak ditemukan!</p>";
            exit;
        }

        // Tangkap data dari parameter URL jika ada
        $id_pemasok = isset($_GET['id_pemasok']) ? $_GET['id_pemasok'] : $data['id_pemasok'];
        $nama_pemasok = isset($_GET['nama_pemasok']) ? $_GET['nama_pemasok'] : $data['nama_pemasok'];
        $no_telepon = isset($_GET['no_telepon']) ? $_GET['no_telepon'] : $data['no_telepon'];
        $email = isset($_GET['email']) ? $_GET['email'] : $data['email'];
        $alamat = isset($_GET['alamat']) ? $_GET['alamat'] : $data['alamat'];
        $kode_pos = isset($_GET['kode_pos']) ? $_GET['kode_pos'] : $data['kode_pos'];
        $kota = isset($_GET['kota']) ? $_GET['kota'] : $data['kota'];
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
                <label for="id_pemasok" class="form-label">ID Pemasok</label>
                <input type="text" class="form-control" id="id_pemasok" name="id_pemasok" pattern="S\d{3}" title="Format : SXXX" value="<?php echo $id_pemasok; ?>" required>
            </div>
            <!-- Hidden input untuk menyimpan old_id_pemasok -->
            <input type="hidden" name="old_id_pemasok" value="<?php echo $id_pemasok; ?>">

            <div class="mb-3">
                <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                <input type="text" class="form-control" id="nama_pemasok" name="nama_pemasok" value="<?php echo $nama_pemasok; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $no_telepon; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="number" class="form-control" id="kode_pos" name="kode_pos" value="<?php echo $kode_pos; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $kota; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" title="Simpan">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</body>
</html>
