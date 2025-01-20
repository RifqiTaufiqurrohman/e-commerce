<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();

?>
<div class="shadow bg-white p-3 mb-3 rounded">
    <h3>Selamat Datang <strong><?= $pecah['nama_pelanggan']; ?></strong> </h3>
</div>

<div class="p-3 mt-3 shadow rounded">
    <form action="" class="" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Nama :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?= $pecah['nama_pelanggan']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Email :</label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control" value="<?= $pecah['email_pelanggan']; ?>"
                    readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">No. HP :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?= $pecah['telepon_pelanggan']; ?>"
                    readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Alamat :</label>
            <div class="col-sm-9">
                <textarea rows="4" name="judul" class="form-control" value=""
                    readonly><?= $pecah['alamat_pelanggan']; ?></textarea>
            </div>
        </div>
    </form>
</div>