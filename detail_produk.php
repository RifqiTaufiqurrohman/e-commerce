<?php
session_start();
include 'koneksi/koneksi.php';

$id_produk = $_GET['idproduk'];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
$produk = $ambil->fetch_assoc();

$produkfoto = array();
$ambil = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");

while ($pecah = $ambil->fetch_assoc()) {
    $produkfoto[] = $pecah;
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Detail Produk </title>
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

    <style>
        .description p {
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

    <!-- navbar -->
    <?php include 'include/navbar.php'; ?>

    <section class="page-produk">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="" href="index.php">Beranda</a></li>
                <li><a class="mx-1" href="">> </a></li>
                <li>Detail Produk</li>
            </ul>
            <div class="row">
                <div class="col-md-3">
                    <?php include 'include/sidebar.php' ?>
                </div>
                <div class="col-md-9 detail-produk">
                    <div class="row">
                        <div class="col-6">
                            <div id="owl-nav"></div>
                            <div class="owl-carousel owl-theme">
                                <?php foreach ($produkfoto as $key => $value): ?>
                                    <div class="item">
                                        <img src="assets/images/foto_produk/<?= $value['nama_produk_foto']; ?>" alt="">
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="col-6 detail-form">
                            <form action="" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <h3><?= $produk['nama_produk']; ?></h3>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Jumlah : </label>
                                            <div class="col-sm-9">
                                                <input type="number" name="jumlah" class="form-control" value="1"
                                                    min="1" max="<?= $produk['stock_produk']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Stock : </label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control"
                                                    value="<?= $produk['stock_produk']; ?>">
                                            </div>
                                        </div>
                                        <h5>Rp. <?= number_format($produk['harga_produk']); ?></h5>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button name="beli" class="btn btn-success"><i class="fa fa-shopping-cart"></i>
                                            Keranjang
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card detail">
                        <div class="card-body">
                            <div class="description">
                                <h3 class="mb-0">Detail Produk</h3>
                                <p>
                                    <?= $produk['deskripsi_produk']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['beli'])) {
        $jumlah = $_POST['jumlah'];
        $_SESSION['keranjang_belanja'][$id_produk] = $jumlah;

        echo "<script>alert('Produk Berhasil dimasukan ke Keranjang');</script>";
        echo "<script>location='keranjang.php';</script>";
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