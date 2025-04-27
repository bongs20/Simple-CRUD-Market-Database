<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: lihat_anggota.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk memeriksa username dan password
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['username'] = $username;
        header("Location: lihat_anggota.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        <h3 class="text-center mb-4">Login</h3>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100" title="Login">
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>
    </div>
</body>
</html>
