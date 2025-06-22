<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">SISTEM BASIS DATA HASAN MART</h3>
            <a href="logout.php" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Table</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $query = mysqli_query($koneksi, "SHOW TABLES");
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    $tableName = htmlspecialchars($row[0]);
                    if ($tableName === 'users') {
                        continue; // Skip the 'user' table
                    }
                    $filePath = $tableName . "/index.php"; // File tujuan berdasarkan folder nama tabel
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . ucwords(str_replace('_', ' ', $tableName)) . "</td>";
                    if (file_exists($filePath)) {
                        echo "<td><a href='" . $filePath . "' class='btn btn-primary'>Lihat Data</a></td>";
                    } else {
                        echo "<td><button class='btn btn-secondary' disabled>File Tidak Ada</button></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
