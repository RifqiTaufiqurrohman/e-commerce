<?php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

?>
<div class="shadow bg-white p-3 mb-3 rounded">
    <h3><strong>Setting Password</strong></h3>
</div>

<div class="p-3 mt-3 shadow rounded">
    <form action="" class="" method="post">
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Password Lama :</label>
            <div class="col-sm-9">
                <input type="password" name="pass_lama" class="form-control" placeholder="Masukan Password Lama">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Password Baru :</label>
            <div class="col-sm-9">
                <input type="password" name="pass_baru" class="form-control" placeholder="Masukan Password Baru">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label"></label>
            <div class="col-md-9">
                <button name="update" class="btn btn-primary">Update Password</button>
            </div>
        </div>
    </form>
</div>

<?php
if (isset($_POST['update'])) {
    $pass_lama = sha1($_POST['pass_lama']);
    $pass_baru = sha1($_POST['pass_baru']);

    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE password_pelanggan = '$pass_lama'");
    $pass = $ambil->num_rows;

    if ($pass == 1) {
        $koneksi->query("UPDATE pelanggan SET password_pelanggan = '$pass_baru' WHERE id_pelanggan='$id_pelanggan'");

        echo "<script>alert('Password Berhasil Diupdate');</script>";
        echo "<script>location='../login.php';</script>";
    } else {
        echo "<script>alert('Password Salah');</script>";
        echo "<script>location='index.php?page=ubah_password';</script>";
    }
}
?>