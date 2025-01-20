<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Password<h4>
        </div>
    </div>
</div>

<?php
$id_pelanggan = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$edit = $ambil->fetch_assoc();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="form-valide" action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="val_norek">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="val_norek" name="password"
                                        value="<?= $edit['password_pelanggan']; ?>">
                                </div>
                            </div>
                            <div class="m-1 text-right">
                                <button name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="index.php?halaman=pelanggan" class="btn btn-sm btn-light">Kembali</a>
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
    // Securely hash the password using password_hash
    $password_hashed = sha1($_POST['password']);

    // Update the password in the database
    $stmt = $koneksi->prepare("UPDATE pelanggan SET password_pelanggan = ? WHERE id_pelanggan = ?");
    $stmt->bind_param("si", $password_hashed, $id_pelanggan);

    // Execute and check if the update was successful
    if ($stmt->execute()) {
        echo "<script>alert('Password Berhasil Diperbarui');</script>";
        echo "<script>location='index.php?halaman=pelanggan';</script>";
    } else {
        echo "<script>alert('Password Gagal Diperbarui');</script>";
    }

    $stmt->close();
}
?>