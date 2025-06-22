<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php"); // Disesuaikan dengan direktori terbaru
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pelanggan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
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
    <script>
        // Fungsi untuk memilih semua checkbox
        function toggleSelectAll(source) {
            const checkboxes = document.getElementsByName('selected_ids[]');
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>
<body class="bg-light">
    <div class="content">
        <div class="container mt-5">
        <a href="../index.php" class="btn btn-primary mb-3">Kembali ke Dashboard</a>
        <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Tabel Lain
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../barang/index.php">Barang</a></li>
        <li><a class="dropdown-item" href="../detail_pembelian/index.php">Detail Pembelian</a></li>
        <li><a class="dropdown-item" href="../pelanggan/index.php">Detail Transaksi</a></li>
        <li><a class="dropdown-item" href="../pemasok/index.php">Supplier</a></li>
        <li><a class="dropdown-item" href="../transaksi/index.php">Transaksi</a></li>
        <li><a class="dropdown-item" href="../laporan_keuangan/index.php">Laporan Keuangan</a></li>
        <li><a class="dropdown-item" href="../pelanggan/index.php">Pelanggan</a></li>
        <li><a class="dropdown-item" href="../pembelian_stok/index.php">Pembelian Stok</a></li>


    </ul>
    </div>
            <h1 class="text-center mb-4">Pelanggan</h1>
            <form action="hapus_terpilih.php" method="post"> <!-- Disesuaikan jalur -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"></th>
                                <th>ID Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Riwayat Pembelian</th>
                                <th>No. Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../koneksi.php"; // Disesuaikan jalur
                            $sql = "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC";
                            $qry = mysqli_query($koneksi, $sql);

                            while ($a = mysqli_fetch_array($qry)) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='selected_ids[]' value='{$a['id_pelanggan']}'></td>";
                                echo "<td>{$a['id_pelanggan']}</td>";
                                echo "<td>{$a['nama_pelanggan']}</td>";
                                echo "<td>{$a['riwayat_pembelian']}</td>";
                                echo "<td>{$a['no_telepon']}</td>";
                                echo "<td>
                                        <a href=\"edit.php?id_pelanggan={$a['id_pelanggan']}\" class=\"btn btn-warning btn-sm\" title=\"Edit\">
                                            <i class=\"fas fa-edit\"></i>
                                        </a>
                                            <a href=\"hapus.php?id_pelanggan={$a['id_pelanggan']}\" class=\"btn btn-danger btn-sm\" title=\"Hapus\" onclick=\"return confirm('Yakin ingin menghapus data ini?')\"> <!-- Disesuaikan jalur -->
                                            <i class=\"fas fa-trash-alt\"></i>
                                        </a>
                                    </td>";
                                echo "</tr>";
                            }

                            if (mysqli_num_rows($qry) == 0) {
                                echo "<tr><td colspan='9' class='text-center'>Data tidak ditemukan!</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-wrap justify-content-end mt-3 gap-2">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button formaction="export_csv_selected.php" formmethod="post" class="btn btn-info btn-sm"> 
                        <i class="fas fa-file-download"></i>
                    </button>
                    <a href="input.php" class="btn btn-success btn-sm"> 
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="../logout.php" class="btn btn-danger btn-sm"> 
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
