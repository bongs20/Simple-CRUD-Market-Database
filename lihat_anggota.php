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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Loading palsu
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
        }
    </script>
</head>
<body class="bg-light">
    <div id="loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999; text-align: center; padding-top: 20%;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Loading...</p>
    </div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Anggota</h1>
        <form action="hapus_terpilih.php" method="post" onsubmit="showLoading()">
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
                                <a href=\"edit.php?id={$a['id']}\" class=\"btn btn-warning btn-sm\" onclick=\"showLoading()\">Edit</a>
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
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-danger">Hapus Terpilih</button>
                <a href="input.php" class="btn btn-success" onclick="showLoading()">+ Tambah Data</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </form>
    </div>
    <script>
        // Fungsi untuk memilih semua checkbox
        function toggleSelectAll(source) {
            checkboxes = document.getElementsByName('selected_ids[]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</body>
</html>
