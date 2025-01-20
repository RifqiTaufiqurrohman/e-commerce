<?php
session_start();
include 'koneksi/koneksi.php';

if (isset($_GET['idkategori'])) {
    $id_kategori = $_GET['idkategori'];
    $kategori_produk = array();

    $ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE produk.id_kategori='$id_kategori'");

    while ($pecah = $ambil->fetch_assoc()) {
        $kategori_produk[] = $pecah;
    }
} elseif (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    $cariproduk = array();
    $ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
    while ($pecah = $ambil->fetch_assoc()) {
        $cariproduk[] = $pecah;
    }
} else {
    $produk = array();

    $ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori");

    while ($pecah = $ambil->fetch_assoc()) {
        $produk[] = $pecah;
    }
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Produk </title>
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

    <section class="page-produk">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="" href="index.php">Beranda</a></li>
                <li><a class="mx-1" href="">> </a></li>
                <li>Produk</li>
                <?php if (isset($keyword)): ?>
                    <li class="mx-1">> </li>
                    <li><?= $keyword ?></li>
                <?php endif ?>
            </ul>
            <div class="row">
                <div class="col-md-3">
                    <?php include 'include/sidebar.php' ?>
                </div>
                <div class="col-md-9">
                    <div class="card box">
                        <div class="card-body">
                            <h2>Produk Kami</h2>
                           <br>
                           <p>CR Hijup adalah toko yang berfokus menyediakan berbagai produk fashion wanita berupa kemeja, kaos,
								blouse, hijab, dan lain-lain. Semua produk sudah didesain sedemikian rupa dengan visual yang elegan dan
								bahan yang amat nyaman kamu kenakan serta harga yang terjangkau untuk semua kalangan. <br><br>


								Jam operasional : Setiap hari pada pukul 08.00 – 18.00 WIB. <br><br>

								Mau MODIS HARGA EKONOMIS ingat.... CR HIJUP ✨
								Happy Shopping Girls 🛍
							</p>
                        </div>
                    </div>
                    <div class="row">

                        <?php if (isset($_GET['idkategori'])): ?>
                            <?php foreach ($kategori_produk as $key => $value): ?>
                                <div class="col-md-4 card-produk">
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

                        <?php elseif (isset($keyword)) : ?>
                            <?php foreach ($cariproduk as $key => $value): ?>
                                <div class="col-md-4 card-produk">
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

                            <?php if (!empty($keyword)): ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger shadow text-center">
                                        <p>Pencarian Tidak ditemukan!</p>
                                    </div>
                                </div>
                            <?php endif ?>

                        <?php else: ?>

                            <?php foreach ($produk as $key =>  $value): ?>
                                <div class="col-md-4 card-produk">
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

                        <?php endif; ?>
                    </div>

                    <div class="pagination justify-content-center">
                        <li class="page-item prev">
                            <a href="" class="page-link disabled ">Prev</a>
                        </li>
                        <li class="page-item halaman">
                            <a href="" class="page-link active ">1</a>
                        </li>
                        <li class="page-item dots">
                            <a href="" class="page-link">...</a>
                        </li>
                        <li class="page-item halaman">
                            <a href="" class="page-link">5</a>
                        </li>
                        <li class="page-item halaman">
                            <a href="" class="page-link">6</a>
                        </li>
                        <li class="page-item dots">
                            <a href="" class="page-link">...</a>
                        </li>
                        <li class="page-item halaman">
                            <a href="" class="page-link">10</a>
                        </li>
                        <li class="page-item prev">
                            <a href="" class="page-link">Next</a>
                        </li>
                    </div>

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