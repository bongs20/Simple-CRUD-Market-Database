<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
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
            <h1 class="text-center mb-4">Data Anggota</h1>
            <form action="hapus_terpilih.php" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"></th>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>E-Mail</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksi.php";
                            $sql = "SELECT * FROM anggota ORDER BY id";
                            $qry = mysqli_query($koneksi, $sql);

                            $i = 1;
                            while ($a = mysqli_fetch_array($qry)) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='selected_ids[]' value='{$a['id']}'></td>";
                                echo "<td>$i</td>";
                                echo "<td>{$a['nama']}</td>";
                                echo "<td>{$a['alamat']}</td>";
                                echo "<td>{$a['email']}</td>";
                                echo "<td>{$a['telp']}</td>";
                                echo "<td>
                                        <a href=\"edit.php?id={$a['id']}\" class=\"btn btn-warning btn-sm\">Edit</a>
                                      </td>";
                                echo "</tr>";
                                $i++;
                            }

                            if (mysqli_num_rows($qry) == 0) {
                                echo "<tr><td colspan='7' class='text-center'>Data tidak ditemukan!</td></tr>";
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
                    <a href="logout.php" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">Dibuat oleh <strong>Muhammad Syaiful</strong></p>
        <p class="mb-0">Kelas: PTIK D | NIM: 240209501088</p>
        <p class="mb-0">Jurusan Teknik Informatika dan Komputer</p>
        <p class="mb-0">Fakultas Teknik, Universitas Negeri Makassar</p>
    </footer>
</body>
</html>
