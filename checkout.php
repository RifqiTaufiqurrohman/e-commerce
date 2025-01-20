<?php

session_start();
include 'koneksi/koneksi.php';

// Jika Pelanggan Belum Login
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

if (empty($_SESSION['keranjang_belanja']) or !isset($_SESSION['keranjang_belanja'])) {
    echo "<script>alert('Keranjang Kosong, Silahkan Belanja');</script>";
    echo "<script>location='produk.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Checkout </title>
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
                <li>Checkout</li>
            </ul>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>SubHarga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total_belanja = 0; // Inisialisasi variabel untuk total belanja
                                $total_berat = 0; // Inisialisasi variabel untuk total berat
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah):
                                    // Ambil data produk berdasarkan id_produk
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    // Hitung subharga per produk
                                    $subharga = $jumlah * $pecah['harga_produk'];
                                    // Hitung subberat per produk
                                    $subberat = $jumlah * $pecah['berat_produk'];

                                    // Tambahkan subharga ke total belanja
                                    $total_belanja += $subharga;
                                    // Tambahkan subberat ke total berat
                                    $total_berat += $subberat;
                                ?>
                                    <tr class="text-center">
                                        <td width="50"><?= $no++; ?></td>
                                        <td><img src="assets/images/foto_produk/<?= $pecah['foto_produk']; ?>" width="50">
                                        </td>
                                        <td><?= $pecah['nama_produk']; ?></td>
                                        <td><?= $jumlah; ?></td>
                                        <td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
                                        <td>Rp. <?= number_format($subharga); ?></td>

                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr class="">
                                    <th colspan="5">Total Belanja : </th>
                                    <th>Rp. <?= number_format($total_belanja); ?></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="form-control"
                                value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>" readonly>
                            <br>
                            <input type="text" class="form-control"
                                value="<?= $_SESSION['pelanggan']['email_pelanggan']; ?>" readonly>
                            <br>
                            <input type="text" class="form-control"
                                value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Alamat : </label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" rows="3" id="" class="form-control"
                                            placeholder="Masukan Alamat Lengkap"></textarea>
                                        <small class="text-danger">Masukan Alamat Lengkap dengan RT/RW</small>
                                    </div>
                                </div>
                                <!-- Provinsi -->
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label ">Provinsi : </label>
                                    <div class="col-sm-9">
                                        <select name="provinsi" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <!-- Kota / Kabupaten -->
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label ">Distrik : </label>
                                    <div class="col-sm-9">
                                        <select name="distrik" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <!-- Kecamatan -->
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label ">Kelurahan : </label>
                                    <div class="col-sm-9">
                                        <input name="kelurahan" class="form-control" placeholder="Masukan Kelurahan">
                                    </div>
                                </div>
                                <!-- Kecamatan -->
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label ">Kecamatan : </label>
                                    <div class="col-sm-9">
                                        <input name="kecamatan" class="form-control" placeholder="Masukan Kecamatan">
                                    </div>
                                </div>
                                <!-- Ekspedisi -->
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label ">Ekspedisi : </label>
                                    <div class="col-sm-9">
                                        <select name="ekspedisi" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <!-- jenis Paket -->
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label ">Jenis Paket : </label>
                                    <div class="col-sm-9">
                                        <select name="paket" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <input type="text" name="total_berat" class="form-control" value="<?= $total_berat; ?>"
                                    hidden>
                                <input type="text" name="nama_provinsi" class="form-control" hidden>
                                <input type="text" name="nama_distrik" class="form-control" hidden>
                                <input type="text" name="type_distrik" class="form-control" hidden>
                                <input type="text" name="kode_pos" class="form-control" hidden>
                                <input type="text" name="nama_ekspedisi" class="form-control" hidden>
                                <input type="text" name="paket" class="form-control" hidden>
                                <input type="text" name="ongkir" class="form-control" hidden>
                                <input type="text" name="estimasi" class="form-control" hidden>

                                <div class="text-right">
                                    <button name="checkout" class="btn btn-primary">Checkout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['checkout'])) {
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $tanggal_pembelian = date('Y-m-d');
        $alamat = $_POST['alamat'];
        $berat = $_POST['total_berat'];
        $provinsi = $_POST['nama_provinsi'];
        $distrik = $_POST['nama_distrik'];
        $type = $_POST['type_distrik'];
        $kelurahan = $_POST['kelurahan'];
        $kecamatan = $_POST['kecamatan'];
        $pos = $_POST['kode_pos'];
        $ekspedisi = $_POST['nama_ekspedisi'];
        $paket = $_POST['paket'];
        $ongkir = $_POST['ongkir'];
        $estimasi = $_POST['estimasi'];
        $total_pembelian = $total_belanja + $ongkir;
        $kode_unik = rand();
        $transaction_status = 1;

        $koneksi->query("INSERT INTO pembelian (id_pelanggan, tanggal_pembelian, total_pembelian, alamat, total_berat, provinsi,distrik, `type`, kelurahan, kecamatan, kode_pos, ekspedisi, paket, ongkir, estimasi, kode_unik, transaction_status) VALUES ('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$alamat','$berat','$provinsi','$distrik','$type','$kelurahan','$kecamatan','$pos','$ekspedisi','$paket','$ongkir','$estimasi', '$kode_unik', '$transaction_status')");

        $id_pembelian_baru = $koneksi->insert_id;
        $nama_produk_list = []; // Inisialisasi array kosong

        foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $pecah = $ambil->fetch_assoc();

            $nama = $pecah['nama_produk'];
            $harga = $pecah['harga_produk'];
            $berat = $pecah['berat_produk'];
            $subberat = $pecah['berat_produk'] * $jumlah;
            $subharga = $pecah['harga_produk'] * $jumlah;

            $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah) VALUES ('$id_pembelian_baru','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah') ");

            $koneksi->query("UPDATE produk SET stock_produk=stock_produk-$jumlah WHERE id_produk='$id_produk' ");

            // Menambahkan nama produk ke dalam array
            $nama_produk_list[] = $nama;
        }
        // Ambil nomor telepon pelanggan
        $ambil_pelanggan = $koneksi->query("SELECT nama_pelanggan, telepon_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
        $data_pelanggan = $ambil_pelanggan->fetch_assoc();
        $telepon_pelanggan = $data_pelanggan['telepon_pelanggan'];
        $nama_produk = implode(', ', $nama_produk_list); // Menggabungkan nama produk menjadi satu string

        // Format pesan WhatsApp
        $pesan_wa = "Checkout Berhasil! Pesanan Anda untuk produk *$nama_produk* telah berhasil dilakukan.\n\nAlamat Pengiriman:\n$alamat, $kelurahan, $kecamatan, $distrik, $provinsi.\n\nJenis Paket Pengiriman: $ekspedisi - $paket (Estimasi $estimasi hari).\n\nSilahkan Segera Melakukan Pembayaran.\n\nTerima kasih sudah berbelanja di toko kami!";

        // Konfigurasi API WhatsApp
        $token = ""; // Isi dengan token anda
        $target = $telepon_pelanggan; // Nomor WhatsApp pelanggan

        // Membuat payload untuk dikirimkan ke API WhatsApp
        $payload = array(
            'target' => $target,
            'message' => $pesan_wa,
        );

        // Menggunakan cURL untuk mengirimkan pesan WhatsApp
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token"
                ),
            )
        );

        $response = curl_exec($curl);
        curl_close($curl);


        unset($_SESSION['keranjang_belanja']);
        echo "<script>alert('Pembelian Sukses')</script>";
        echo "<script>location='pelanggan/index.php?page=pesanan'</script>";
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