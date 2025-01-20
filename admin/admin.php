<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Profile</h4>
        </div>
    </div>
</div>
<?php

$id_admin = $_SESSION['admin']['id_admin'];

$ambil = $koneksi->query("SELECT * FROM `admin` WHERE id_admin ='$id_admin' ");
$pecah = $ambil->fetch_assoc();

?>

<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Nama : </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control"
                                        value="<?= $pecah['nama_lengkap']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Username : </label>
                                <div class="col-sm-9">
                                    <input type="text" name="user" class="form-control"
                                        value="<?= $pecah['username']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Password : </label>
                                <div class="col-sm-9">
                                    <input type="text" name="password" class="form-control">
                                    <small class="text-danger">Kosongkan Pasword Jika Tidak Dirubah</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label"> </label>
                                <div class="col-sm-9">
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['user'];
    $password = $_POST['password'];

    // Cek apakah password diubah atau tidak
    if (!empty($password)) {
        // Password diubah, hash password baru dengan sha1
        $hashed_password = sha1($password);
    } else {
        // Password tidak diubah, gunakan password lama dari database
        $hashed_password = $pecah['password'];
    }

    // Update data ke database
    $koneksi->query("UPDATE `admin` SET nama_lengkap='$nama', username='$username', `password`='$hashed_password' WHERE id_admin='$id_admin'");

    echo "<script>alert('Data berhasil diperbarui');</script>";
    echo "<script>location='index.php?halaman=admin';</script>";
}

?>