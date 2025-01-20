<?php
session_start();
include 'koneksi/koneksi.php';

$produk = array();

$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori LIMIT 8");

while ($pecah = $ambil->fetch_assoc()) {
    $produk[] = $pecah;
}

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
    <title>CR Hijup </title>
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
    <!-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> -->

    <div id="main-wrapper">

        <!-- navbar -->
        <?php include 'include/navbar.php'; ?>





        <!-- Hero Section Start -->
        <section class="hero">
            <div class="owl-nav"></div>
            <div class="owl-carousel owl-theme">
                <div class="item ">
                    <img src="assets/images/banner/s1.jpg" alt="" class="">
                    <main class="content">
                        <h1>CR <span>Hijup</span></h1>
                        <a href="produk.php" class="btn btn-info ">Order Now</a>
                    </main>
                </div>
                <div class="item ">
                    <img src="assets/images/banner/s2.jpg" alt="" class="">
                    <main class="content">
                        <h1>CR <span>Hijup</span></h1>
                        <a href="produk.php" class="btn btn-info ">Order Now</a>
                    </main>
                </div>
                <div class="item ">
                    <img src="assets/images/banner/s3.jpeg" alt="" class="">
                    <main class="content">
                        <h1>CR <span>Hijup</span></h1>
                        <a href="produk.php" class="btn btn-info ">Order Now</a>
                    </main>
                </div>

            </div>
        </section>
        <!-- Hero Section End -->


        <div class="container">
            <!-- about section start -->
            <section class="about">
                <h2 class="judul">Tentang Kami</h2>
                <div class="row">
                    <div class="col-md-6  mb-4">
                        <img src="assets/images/banner/cta-banner.jpg" class="img-fluid">
                    </div>
                    <div class="col-md-6 ">
                        <h3>Kenapa Memilih Produk Kami?</h3>
                        <p>CR HIJUP adalah e-commerce di Indonesia yang fokus pada modest fashion, menyediakan berbagai
                            koleksi hijab, tunik, gamis, dan aksesori wanita.
                        </p>
                        <p>CR HIJUP berdiri sejak 2012, dimana kami menawarkan koleksi hijab dan pakaian wanita yang
                            mengikuti tren terbaru dengan kualitas terjamin dan harga terbaik.
                        </p>
                        <p>Selain itu, CR HIJUP juga menyediakan berbagai kemudahan berbelanja, seperti pengiriman cepat
                            serta pelayanan yang baik.
                        </p>
                        <a href="about.php">
                            <p class="text-danger">More About Us <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </p>
                        </a>
                    </div>
                </div>
            </section>
            <!-- about section end -->

            <!-- produk section start -->
            <section class="produk">
                <h2 class="judul">Produk Kami</h2>
                <div class="row">
                    <?php foreach ($produk as $key =>  $value): ?>
                        <div class="col-md-3">
                            <div class="card">
                                <img width="100%" src="assets/images/foto_produk/<?= $value['foto_produk']; ?> ">
                                <div class="card-body content">
                                    <h5><?= $value['nama_produk']; ?></h5>
                                    <p>Rp. <?= $value['harga_produk']; ?></p>
                                    <a href="beli.php?idproduk=<?= $value['id_produk']; ?>" class="btn btn-primary">
                                        <i class="fa fa-shopping-cart"></i> Keranjang
                                    </a>
                                    <a href="detail_produk.php?idproduk=<?= $value['id_produk']; ?>"
                                        class="btn btn-primary">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
            <!-- produk section end -->

            <!-- Contact Section Start -->
            <section class="kontak">
                <h2 class="judul">Kontak Kami</h2>
                <div class="row">
                    <div class="col-md-6 kontak-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0150592166056!2d106.96120169999999!3d-6.2617461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698da8491a0025%3A0x409f7f62d7c3e952!2sJl.%20Pelda%20Tarmizi%20No.12%2C%20RT.002%2FRW.015%2C%20Jaka%20Mulya%2C%20Kec.%20Bekasi%20Sel.%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017146!5e0!3m2!1sid!2sid!4v1731859425150!5m2!1sid!2sid"
                            width="500" height="310" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-md-6 kontak-form">
                        <form action="" method="post">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <h6 class="col-sm-4 col-form-label">Nama Lengkap : </h6>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Masuka Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <h6 class="col-sm-4 col-form-label">Pesan : </h6>
                                        <div class="col-sm-8">
                                            <textarea name="pesan" rows="5" id="" class="form-control"
                                                placeholder="Masukan Pesan" required></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="noWa" value="628998469803">
                                    <div class="text-right">
                                        <button type="submit" name="kirim_pesan" class="btn btn-secondary">Sent
                                            message<span class="btn-icon-right"><i class="fa fa-envelope"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- Contact Section End -->
        </div>

        <!-- footer -->
        <?php include 'include/footer.php' ?>

    </div>

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