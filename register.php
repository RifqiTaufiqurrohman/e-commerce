<?php

include 'koneksi/koneksi.php';

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CR Hijup | Daftar </title>
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
                                <h4 class="text-center mb-4">Register</h4>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label><strong>Nama Lengkap</strong></label>
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukan Nama Lengkap" required>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>E-mail</strong></label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukan E-mail" required>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Telephone</strong></label>
                                        <input type="number" class="form-control" name="telepon"
                                            placeholder="6282320099999" id="telepon" required>
                                        <small class="text-danger">Harap Masukan nomor <strong> AKTIF</strong> dan
                                            terhubung ke Whatsapp,
                                            awali dengan
                                            62</small>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukan Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Konfirmasi Password</strong></label>
                                        <input type="password" class="form-control" name="konfirm_password"
                                            id="konfirm_password" placeholder="Konfirmasi Password" required>
                                    </div>
                                    <input type="hidden" class="form-control" value="Alamat" name="alamat"></input>
                                    <input type="file" class="form-control" name="foto" hidden>
                                    <div class="text-center">
                                        <button type="submit" name="daftar" class="btn btn-primary btn-block"
                                            onclick="return validasiForm()">Sign Up</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Sudah Mempunyai Akun? <a class="text-primary" href="login.php">Login</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['daftar'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];

        // Validasi panjang nomor telepon
        if (strlen($telepon) > 14) {
            echo "<script>alert('Nomor telepon tidak boleh lebih dari 14 angka');</script>";
            echo "<script>location='register.php';</script>";
            exit;
        }

        // Ambil informasi file foto
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $ekstensi_foto = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_default = "Profile.png"; // Foto default
        $nama_foto_acak = uniqid() . '.' . $ekstensi_foto;

        if (!empty($lokasi_foto)) {
            move_uploaded_file($lokasi_foto, "assets/images/foto_pelanggan/" . $nama_foto_acak);
            $foto_terakhir = "assets/images/foto_pelanggan/" . $nama_foto_acak;
        } else {
            $foto_terakhir = $foto_default;
        }

        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' OR telepon_pelanggan = '$telepon'");
        $ada_email_atau_telepon = $ambil->num_rows;

        if ($ada_email_atau_telepon > 0) {
            echo "<script>alert('Email atau nomor telepon sudah terdaftar');</script>";
            echo "<script>location='register.php';</script>";
        } else {
            $koneksi->query("INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, password_pelanggan, telepon_pelanggan, alamat_pelanggan, foto_pelanggan) 
                        VALUES ('$nama', '$email', '$password', '$telepon', '$alamat', '$foto_terakhir')");

            echo "<script>alert('Daftar Berhasil, Silahkan Login');</script>";
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

    <script>
        function validasiForm() {
            var telepon = document.getElementById('telepon').value;
            var password = document.getElementById('password').value;
            var konfirmPassword = document.getElementById('konfirm_password').value;

            // Validasi panjang nomor telepon
            if (telepon.length > 14) {
                alert('Nomor telepon tidak boleh lebih dari 14 angka');
                return false;
            }

            // Validasi password dan konfirmasi password
            if (password !== konfirmPassword) {
                alert('Password harus sama!');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>