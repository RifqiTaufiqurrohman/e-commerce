<?php

session_start();
include 'koneksi/koneksi.php';

if (isset($_POST['kirim_pesan'])) {
    $nama = urlencode($_POST['name']); // encoding URL untuk nama
    $pesan = urlencode($_POST['pesan']); // encoding URL untuk pesan
    $noWa = $_POST['noWa']; // nomor WhatsApp tujuan

    // Format URL WhatsApp dengan pesan yang telah dikodekan
    $urlWhatsApp = "https://wa.me/$noWa?text=Hallo%20CR%20Hijup!!!%0ASaya%20$nama%0A$pesan";

    // Redirect ke URL WhatsApp
    header("Location: $urlWhatsApp");
    exit();
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Contact </title>
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
    <!-- navbar -->
    <?php include 'include/navbar.php'; ?>

    <section class="page-keranjang">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="" href="index.php">Beranda</a></li>
                <li><a class="mx-1" href="">> </a></li>
                <li>Contact</li>
            </ul>
            <div class="card box">
                <div class="card-body">
                    <h2 class="text-center">Contact</h2>
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Nama : </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Masuka Nama Lengkap" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Pesan : </label>
                                    <div class="col-sm-9">
                                        <textarea name="pesan" rows="4" id="" class="form-control"
                                            placeholder="Masukan Pesan" required></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="noWa" value="628998469803">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label"> </label>
                                    <div class="col-sm-9">
                                        <button type="submit" name="kirim_pesan" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'include/footer.php' ?>

    <?php

    ?>

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