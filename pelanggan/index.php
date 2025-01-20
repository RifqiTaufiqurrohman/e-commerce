<?php
session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['pelanggan']['id_pelanggan'])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();



?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR & DEE | Profile </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo1.png">
    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="../assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../assets/vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="../assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style2.css" rel="stylesheet">

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
    <!-- Navbar Start -->
    <nav class="navbar sticky-top">
        <a href="../index.php" class="navbar-logo">CR<span> Hijup</span> </a>
        <div class="navbar-menu">
            <a href="../index.php">Beranda</a>
            <a href="../produk.php">Produk</a>
            <a href="../about.php">Tentang Kami</a>
            <a href="../contact.php">Kontak</a>
        </div>
        <div class="navbar-icon">
            <a href="#" id="btn-serach"><i class="ti-search"></i></a>
            <?php
            // Hitung total item dalam keranjang
            $total_items = 0;
            if (isset($_SESSION['keranjang_belanja'])) {
                $total_items = array_sum($_SESSION['keranjang_belanja']);
            }
            ?>
            <a href="../keranjang.php" class="cart-icon">
                <i class="ti-shopping-cart"></i>
                <span class="cart-badge"><?= $total_items; ?></span>
            </a>
            <a href="#" id="btn-user"><i class="ti-user"></i></a>
            <a href="#" id="btn-menu"><i class="ti-menu"></i></a>

            <form action="../produk.php" method="get">
                <div class="search-form">
                    <input type="search" name="keyword" id="search-box" class="form-control" placeholder="Search">
                    <button for="search-box" class="btn btn-primary">
                        <i class="ti-search"></i>
                    </button>
                </div>
            </form>

        </div>
        <div class="user">
            <li class=""><a href="index.php">Profile</a></li>
            <li class="#"><a href="../logout.php">Logout</a></li>
        </div>
    </nav>
    <!-- Navbar End -->

    <section class="page-profile">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="" href="index.php">Beranda</a></li>
                <li><a class="mx-1" href="">> </a></li>
                <li>Profile</li>
            </ul>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header profil">
                            <div class="img">
                                <img src="../assets/images/foto_pelanggan/<?= $pecah['foto_pelanggan']; ?>"
                                    class="rounded-circle rounded mx-auto d-block" width="150">
                            </div>
                        </div>
                        <div class="card-title">
                            <h3><?= $pecah['nama_pelanggan']; ?></h3>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="../index.php" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=pesanan" class="nav-link">Pesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=riwayat" class="nav-link">Riwayat</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=seting" class="nav-link">Setting</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <?php

                            if (isset($_GET['page'])) {
                                if ($_GET['page'] == "pesanan") {
                                    include 'pesanan.php';
                                } elseif ($_GET['page'] == "detail_pembelian") {
                                    include 'detail_pembelian.php';
                                } elseif ($_GET['page'] == "seting") {
                                    include 'setting.php';
                                } elseif ($_GET['page'] == "ubah_password") {
                                    include 'ubah_password.php';
                                } elseif ($_GET['page'] == "pembayaran") {
                                    include 'bayar.php';
                                } elseif ($_GET['page'] == "detail_pembayaran") {
                                    include 'detail_pembayaran.php';
                                } elseif ($_GET['page'] == "riwayat") {
                                    include 'riwayat.php';
                                }
                            } else {
                                include 'home.php';
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer Start-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Halaman Utama</h4>
                    <ul class="footer-menu">
                        <li><a href="../index.php">Beranda</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="../produk.php">Produk</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Hubungi Kami</h4>
                    <ul class="footer-kontak">
                        <b><i class="fa fa-shopping-cart"></i> CR&DEE</b>
                        <br><i class="fa fa-map-marker"></i> Tangerang Selatan, Banten
                        <br><i class="fa fa-phone"></i> 08976754564
                        <br><i class="fa fa-envelope"></i> cr&dee@gmail.com
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Social Media</h4>
                    <ul class="footer-social ">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter mx-2"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube mx-2"></i></a>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End-->

    <div class="created">
        <p>Creater By <a href="#">cr&dee</a>. | &copy; 2024</p>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../assets/vendor/global/global.min.js"></script>
    <script src="../assets/js/quixnav-init.js"></script>
    <script src="../assets/js/custom.min.js"></script>

    <script src="../assets/vendor/chartist/js/chartist.min.js"></script>

    <script src="../assets/vendor/moment/moment.min.js"></script>
    <script src="../assets/vendor/pg-calendar/js/pignose.calendar.min.js"></script>

    <!-- Vectormap -->
    <script src="../assets/vendor/raphael/raphael.min.js"></script>
    <script src="../assets/vendor/morris/morris.min.js"></script>


    <script src="../assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../assets/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="../assets/vendor/gaugeJS/dist/gauge.min.js"></script>

    <!-- Datatable -->
    <script src="../assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/plugins-init/datatables.init.js"></script>

    <!--  flot-chart js -->
    <script src="../assets/vendor/flot/jquery.flot.js"></script>
    <script src="../assets/vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="../assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="../assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="../assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="../assets/js/dashboard/dashboard-2.js"></script>
    <!-- Circle progress -->

    <!-- sweet alert -->
    <script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="../assets/js/plugins-init/sweetalert.init.js"></script>

    <!-- style custom -->
    <script src="../assets/js/main.js"></script>
</body>

</html>