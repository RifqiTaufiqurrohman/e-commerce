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
    <title>CR Hijup | Keranjang </title>
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

    <section class="page-keranjang">
        <div class="container">
            <ul class="breadcrumb">
                <li><a class="" href="index.php">Beranda</a></li>
                <li><a class="mx-1" href="">> </a></li>
                <li>Keranjang</li>
            </ul>
            <div class="card box">
                <div class="card-body">
                    <?php
                    // Hitung total item dalam keranjang
                    $total_items = 0;
                    if (isset($_SESSION['keranjang_belanja'])) {
                        $total_items = array_sum($_SESSION['keranjang_belanja']);
                    }
                    ?>
                    <h2>Keranjang Belanja</h2>
                    <p>
                        Anda mempunyai (<?= $total_items; ?>) items di dalam keranjang
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        // Cek apakah keranjang_belanja sudah ada dan tidak kosong
                        if (isset($_SESSION['keranjang_belanja']) && !empty($_SESSION['keranjang_belanja'])):
                        ?>
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah):
                                        // Ambil data produk berdasarkan id_produk
                                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                                        $pecah = $ambil->fetch_assoc();
                                    ?>
                                        <tr class="text-center">
                                            <td width="50"><?= $no++; ?></td>
                                            <td><img src="assets/images/foto_produk/<?= $pecah['foto_produk']; ?>" width="50">
                                            </td>
                                            <td><?= $pecah['nama_produk']; ?></td>
                                            <td><?= $jumlah; ?></td>
                                            <td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
                                            <td>Rp. <?= number_format($jumlah * $pecah['harga_produk']); ?></td>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="hapus_keranjang.php?idproduk=<?= $pecah['id_produk']; ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="checkout.php" class="btn btn-primary">Checkout</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>Keranjang belanja Anda kosong.</p>
            <?php endif; ?>
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