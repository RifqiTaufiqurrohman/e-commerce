<?php
session_start();
include 'koneksi/koneksi.php';

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo1.png">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style2.css" rel="stylesheet">

</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <!-- navbar -->
    <?php include 'include/navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center align-items-center" id="login">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">Login</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label><strong>E-mail</strong></label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukan E-mail" required>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukan Password" required>
                                    </div>
                                    <div class="text-center">
                                        <button name="login" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Belum Mempunyai Akun? <a class="text-primary"
                                                        href="register.php">Sign
                                                        up</a>
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <p><a class="text-primary" href="reset.php">Lupa Password?</a>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = sha1($_POST['password']);

        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

        $akun = $ambil->num_rows;

        if ($akun == 1) {
            $_SESSION['pelanggan'] = $ambil->fetch_assoc();
            echo "<script>alert('Login Berhasil');</script>";
            if (isset($_SESSION['keranjang_belanja']) or !empty($_SESSION['keranjang_belanja'])) {
                echo "<script>location='keranjang.php';</script>";
            } else {
                echo "<script>location='pelanggan/index.php';</script>";
            }
        } else {
            echo "<script>alert('Login Gagal');</script>";
            echo "<script>location='login.php';</script>";
        }
    }
    ?>

    <!-- Footer -->
    <?php include 'include/footer.php' ?>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="assets/vendor/global/global.min.js"></script>
    <script src="assets/js/quixnav-init.js"></script>
    <script src="assets/js/custom.min.js"></script>

    <script src="assets/vendor/chartist/js/chartist.min.js"></script>

    <script src="assets/vendor/moment/moment.min.js"></script>
    <script src="assets/vendor/pg-calendar/js/pignose.calendar.min.js"></script>

    <!-- Vectormap -->
    <script src="assets/vendor/raphael/raphael.min.js"></script>
    <script src="assets/vendor/morris/morris.min.js"></script>


    <script src="assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="assets/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="assets/vendor/gaugeJS/dist/gauge.min.js"></script>

    <!-- Datatable -->
    <script src="assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins-init/datatables.init.js"></script>

    <!--  flot-chart js -->
    <script src="assets/vendor/flot/jquery.flot.js"></script>
    <script src="assets/vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="assets/js/dashboard/dashboard-2.js"></script>
    <!-- Circle progress -->

    <!-- sweet alert -->
    <script src="assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="assets/js/plugins-init/sweetalert.init.js"></script>

    <!-- style custom -->
    <script src="assets/js/main.js"></script>
</body>

</html>