<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();

?>
<div class="shadow bg-white p-3 mb-3 rounded">
    <h3><strong>Setting</strong></h3>
</div>

<div class="p-3 mt-3 shadow rounded">
    <form action="" class="" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Nama :</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" value="<?= $pecah['nama_pelanggan']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Email :</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" value="<?= $pecah['email_pelanggan']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Password :</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" value="<?= $pecah['password_pelanggan']; ?>" readonly>
                <a href="index.php?page=ubah_password" class="btn btn-sm btn-primary mt-3">Update Password</a>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">No. HP :</label>
            <div class="col-sm-9">
                <input type="text" name="telepon" class="form-control" value="<?= $pecah['telepon_pelanggan']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Alamat :</label>
            <div class="col-sm-9">
                <textarea rows="4" name="alamat" class="form-control"><?= $pecah['alamat_pelanggan']; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-lebel">Foto :</label>
            <div class="col-sm-9">
                <img src="../assets/images/foto_pelanggan/<?= $pecah['foto_pelanggan']; ?>" alt="" width="150">
                <input type="file" name="foto" class="form-control mt-3">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label"></label>
            <div class="col-md-9">
                <button name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

</div>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $pass = sha1($_POST['password']);
    $telp = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    // Generate nama foto acak dengan ekstensi file yang benar
    $ext_foto = pathinfo($nama_foto, PATHINFO_EXTENSION); // Mendapatkan ekstensi file
    $nama_foto_baru = uniqid() . '.' . $ext_foto; // Nama baru dengan ekstensi file

    move_uploaded_file($lokasi_foto, "../assets/images/foto_pelanggan/" . $nama_foto_baru);

    if (!empty($lokasi_foto)) {
        $koneksi->query("UPDATE pelanggan SET 
        nama_pelanggan = '$nama',
        password_pelanggan = '$pass',
        telepon_pelanggan = '$telp',
        alamat_pelanggan = '$alamat',
        foto_pelanggan = '$nama_foto_baru'
        WHERE id_pelanggan = '$id_pelanggan'");
    } else {
        $koneksi->query("UPDATE pelanggan SET 
        nama_pelanggan = '$nama',
        telepon_pelanggan = '$telp',
        alamat_pelanggan = '$alamat'
        WHERE id_pelanggan = '$id_pelanggan'");
    }
    echo "<script>alert('Data Berhasil Disimpan');</script>";
    echo "<script>location='index.php';</script>";
}
?>