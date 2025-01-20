<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Tambah Kategori<h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="form-valide" action="#" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="val-username">Nama Kategori
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="val-username" name="nama"
                                        placeholder="Nama Kategori" required>
                                </div>
                            </div>
                            <div class="m-1 text-right">
                                <button name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="index.php?halaman=kategori" class="btn btn-sm btn-light">Kembali</a>
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

    $koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");

    echo "<script>alert('Data Berhasil Disimpan');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";
}
?>