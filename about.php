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
    <title>CR Hijup | About Us </title>
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

    <section class="page-keranjang text-center">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="" href="index.php">Beranda</a></li>
                <li><a class="mx-1" href="">> </a></li>
                <li>Tentang Kami</li>
            </ul>
            <div class="card box">
                <div class="card-body">
                    <h2>Tentang Kami</h2>
                    <p>
                        CR HIJUP adalah platform e-commerce terkemuka di Indonesia yang berfokus pada modest fashion,
                        khususnya dalam menyediakan berbagai pilihan hijab, tunik, gamis, serta aksesori wanita yang
                        mendukung gaya berpakaian yang santun dan modis. Sebagai pelopor di industri modest fashion, CR
                        HIJUP memahami kebutuhan para pelanggan yang mencari pakaian berkualitas dengan desain elegan
                        dan mengikuti perkembangan tren mode terkini.
                    </p>
                    <p>
                        Sejak didirikan pada tahun 2012, CR HIJUP telah berkomitmen untuk menghadirkan koleksi hijab dan
                        pakaian wanita berkualitas tinggi yang tidak hanya indah dipandang, tetapi juga nyaman dikenakan
                        dalam berbagai aktivitas sehari-hari. Koleksi kami mencakup beragam jenis hijab, mulai dari
                        pashmina, segi empat, hingga hijab instan dengan bahan-bahan yang dipilih secara teliti, seperti
                        voal, katun, dan satin. Kami juga menyediakan pakaian wanita seperti tunik, gamis, blus, dan rok
                        yang didesain secara eksklusif untuk memberikan kesan anggun dan modern bagi para wanita
                        muslimah. Setiap produk dirancang dengan detail, menggunakan bahan premium, dan dipasarkan
                        dengan harga terbaik agar terjangkau oleh semua kalangan.
                    </p>
                    <p>
                        Selain menawarkan produk berkualitas, CR HIJUP juga memberikan kemudahan dalam proses berbelanja
                        online. Kami mengerti bahwa kepuasan pelanggan adalah prioritas utama, oleh karena itu kami
                        menyediakan layanan pengiriman yang cepat dan efisien ke seluruh wilayah Indonesia. Tak hanya
                        itu, kami juga memiliki layanan pelanggan yang siap membantu setiap saat untuk memastikan bahwa
                        setiap pengalaman berbelanja bersama CR HIJUP berjalan lancar dan menyenangkan. Melalui
                        kombinasi produk unggulan dan layanan pelanggan yang responsif, CR HIJUP bertekad untuk menjadi
                        destinasi utama bagi mereka yang ingin tampil modis dengan tetap mempertahankan kesantunan dalam
                        berbusana.
                    </p>
                </div>
            </div>
        </div>
    </section>

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