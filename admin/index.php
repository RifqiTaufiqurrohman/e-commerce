<?php
session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Login Terlebih Dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

// Notifikasi Pembayaran
$data_pem = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.transaction_status = '3' ORDER BY id_pembelian DESC LIMIT 4");
while ($pem = $ambil->fetch_assoc()) {
    $data_pem[] = $pem;
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Admin </title>
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

    <style>
        .description label {
            white-space: pre-line;
        }
    </style>
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
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <img class="logo-abbr" src="../assets/images/logo1.png" alt="">
                <img class="logo-compact" src="../assets/images/logo3.png" alt="">
                <img class="brand-title" src="../assets/images/logo3.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <?php foreach ($data_pem as $pembayaran): ?>
                                            <li class="media dropdown-item">
                                                <span class="success"><i class="ti-money"></i></span>
                                                <div class="media-body">
                                                    <a
                                                        href="index.php?halaman=detail_pembelian&id=<?= $pembayaran['id_pembelian']; ?>">
                                                        <p><strong><?= htmlspecialchars($pembayaran['nama_pelanggan']); ?></strong>
                                                            berhasil melakukan pembayaran sebesar Rp.
                                                            <?= number_format($pembayaran['total_pembelian'], 0, ',', '.'); ?>.
                                                        </p>
                                                    </a>
                                                </div>
                                                <span class="notify-time"></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <a class="all-notification" href="index.php?halaman=pembelian">See all notifications
                                        <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="index.php?halaman=admin" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="index.php?halaman=logout" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="index.php"><i class="icon icon-home"></i><span class="nav-text">Dashboard</span></a>
                    </li>
                    <li><a href="index.php?halaman=kategori"><i class="icon icon-app-store"></i><span
                                class="nav-text">Kategori</span></a>
                    </li>
                    <li><a href="index.php?halaman=produk"><i class="icon icon-form"></i><span
                                class="nav-text">Produk</span></a>
                    </li>
                    <li><a href="index.php?halaman=pembelian"><i class="icon icon-chart-bar-33"></i><span
                                class="nav-text">Pembelian</span></a>
                    </li>
                    <li><a href="index.php?halaman=laporan"><i class="fa fa-file-text-o"></i><span
                                class="nav-text">Laporan</span></a>
                    </li>
                    <li><a href="index.php?halaman=pelanggan"><i class="icon icon-single-04"></i><span
                                class="nav-text">Pelanggan</span></a>
                    </li>
                    <li><a href="index.php?halaman=logout"><i class="icon-key"></i><span
                                class="nav-text">Logout</span></a>
                    </li>

                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <?php
                if (isset($_GET['halaman'])) {
                    // Halaman Admin
                    if ($_GET['halaman'] == "admin") {
                        include 'admin.php';
                    }

                    // halaman kategori
                    elseif ($_GET['halaman'] == "kategori") {
                        include 'kategori.php';
                    } elseif ($_GET['halaman'] == "tambah_kategori") {
                        include 'tambah/tambah_kategori.php';
                    } elseif ($_GET['halaman'] == "edit_kategori") {
                        include 'edit/edit_kategori.php';
                    } elseif ($_GET['halaman'] == "hapus_kategori") {
                        include 'hapus/hapus_kategori.php';
                    }

                    // halaman produk
                    elseif ($_GET['halaman'] == "produk") {
                        include 'produk.php';
                    } elseif ($_GET['halaman'] == "tambah_produk") {
                        include 'tambah/tambah_produk.php';
                    } elseif ($_GET['halaman'] == "detail_produk") {
                        include 'detail/detail_produk.php';
                    } elseif ($_GET['halaman'] == "hapus_foto") {
                        include 'hapus/hapus_foto.php';
                    } elseif ($_GET['halaman'] == "edit_produk") {
                        include 'edit/edit_produk.php';
                    } elseif ($_GET['halaman'] == "hapus_produk") {
                        include 'hapus/hapus_produk.php';
                    }

                    // halaman pembelian
                    elseif ($_GET['halaman'] == "pembelian") {
                        include 'pembelian.php';
                    } elseif ($_GET['halaman'] == "detail_pembelian") {
                        include 'detail/detail_pembelian.php';
                    } elseif ($_GET['halaman'] == "laporan") {
                        include 'laporan.php';
                    }

                    // halaman pelanggan
                    elseif ($_GET['halaman'] == "pelanggan") {
                        include 'pelanggan.php';
                    } elseif ($_GET['halaman'] == "edit_password") {
                        include 'edit/edit_password.php';
                    } elseif ($_GET['halaman'] == "hapus_pelanggan") {
                        include 'hapus/hapus_pelanggan.php';
                    }

                    // logout
                    elseif ($_GET['halaman'] == "logout") {
                        include 'logout.php';
                    }
                } else {
                    include 'dashboard.php';
                }
                ?>

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © <a href="#" target="_blank">CR Hijup</a> 2024</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

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

    <script>
        $(document).ready(function() {
            $(".btn-tambah").on("click", function() {
                $(".input-foto").append(
                    "<input type='file' class='form-control mb-2' name='foto[]' placeholder='Choose file'>"
                );
            })
        })
    </script>

    <script>
        // Menampilkan form resi dan pesan
        function toggleFormFields() {
            const status = document.getElementById('status').value;
            const resiField = document.getElementById('resiField');
            const pesanField = document.getElementById('pesanField');

            // Reset fields visibility
            resiField.style.display = 'none';
            pesanField.style.display = 'none';

            if (status === 'Barang Dikirim') {
                resiField.style.display = 'flex';
            } else if (status === 'Pesanan Dibatalkan') {
                pesanField.style.display = 'flex';
            }
        }
    </script>

</body>

</html>