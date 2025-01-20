<?php
session_start();
include "../koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR & DEE | Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo1.png">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Welcome Back!</h4>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="user" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="pass"
                                                placeholder="Password">
                                        </div>
                                        <div class="text-center">
                                            <button name="login" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>

</body>

</html>


<?php

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['user']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['pass']);

    // Query untuk mendapatkan data berdasarkan username
    $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$user'");

    if ($ambil->num_rows > 0) {
        $akun = $ambil->fetch_assoc();

        // Verifikasi password
        if (sha1($pass) === $akun['password']) {
            $_SESSION['admin'] = $akun;
            echo "<script>alert('Login Berhasil');</script>";
            echo "<script>location='index.php';</script>";
        } else {
            echo "<script>alert('Password Salah');</script>";
            echo "<script>location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>