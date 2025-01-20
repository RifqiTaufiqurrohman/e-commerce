<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Edit Produk<h4>
        </div>
    </div>
</div>

<?php
$id_produk = $_GET['id'];

$kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($pecah = $ambil->fetch_assoc()) {
    $kategori[] = $pecah;
}

$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori 
    ON produk.id_kategori=kategori.id_kategori WHERE id_produk = '$id_produk'");
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
                                <label class="col-lg-2 form-label">Nama Kategori</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="id_kategori">
                                        <option value="<?= $edit['id_kategori']; ?>">
                                            <?= $edit['nama_kategori']; ?></option>
                                        <?php foreach ($kategori as $key => $value): ?>
                                            <option value="<?= $value['id_kategori']; ?>">
                                                <?= $value['nama_kategori']; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Nama Produk</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="nama"
                                        value="<?= $edit['nama_produk']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Harga</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" name="harga"
                                        value="<?= $edit['harga_produk']; ?>">
                                </div>
                            </div>
                            <div class=" form-group row">
                                <label class="col-lg-2 form-label">Berat (g)</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" name="berat"
                                        value="<?= $edit['berat_produk']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-label">Foto Produk</label>
                                <div class="col-md-10 ">
                                    <img src="../assets/images/foto_produk/<?= $edit['foto_produk']; ?>" width="100"
                                        class="mb-2">
                                    <div class="input-foto">
                                        <input type="file" class="form-control mb-2" name="foto[]">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Deskripsi</label>
                                <div class="col-lg-10">
                                    <textarea rows="5" class="form-control"
                                        name="deskripsi"><?= $edit['deskripsi_produk']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Stock</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" name="stok"
                                        value="<?= $edit['stock_produk']; ?>">
                                </div>
                            </div>
                            <div class="m-1 text-right">
                                <button name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                                <a href="index.php?halaman=produk" class="btn btn-sm btn-light">Kembali</a>
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
    $id_kategori = $_POST['id_kategori'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $berat = $_POST['berat'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $nama_foto = $_FILES['foto']['name'][0]; // Mengambil nama foto pertama
    $lokasifoto = $_FILES['foto']['tmp_name'][0]; // Mengambil lokasi foto pertama

    // Generate nama foto acak dengan ekstensi file yang benar
    $ext_foto = pathinfo($nama_foto, PATHINFO_EXTENSION); // Mendapatkan ekstensi file
    $nama_foto_baru = uniqid() . '.' . $ext_foto; // Nama baru dengan ekstensi file

    // Jika foto produk diubah
    if (!empty($lokasifoto)) {
        // Unggah foto baru ke folder
        move_uploaded_file($lokasifoto, "../assets/images/foto_produk/" . $nama_foto_baru);

        // Ambil nama foto lama dari tabel produk_foto
        $ambil_foto_lama = $koneksi->query("SELECT nama_produk_foto FROM produk_foto WHERE id_produk='$id_produk' AND is_main=1"); // Ambil foto utama
        $foto_lama = $ambil_foto_lama->fetch_assoc();

        // Hapus foto lama dari folder (opsional, jika ingin menghapus file fisik lama)
        if (file_exists("../assets/images/foto_produk/" . $foto_lama['nama_produk_foto'])) {
            unlink("../assets/images/foto_produk/" . $foto_lama['nama_produk_foto']); // Hapus foto lama
        }

        // Update tabel produk dengan nama foto yang baru
        $koneksi->query("UPDATE produk SET
        id_kategori = '$id_kategori',
        nama_produk = '$nama',
        harga_produk = '$harga',
        berat_produk = '$berat',
        foto_produk = '$nama_foto_baru',
        deskripsi_produk = '$deskripsi',
        stock_produk = '$stok'
        WHERE id_produk = '$id_produk'");

        // Update foto utama di tabel produk_foto (mengubah foto utama yang ada)
        $koneksi->query("UPDATE produk_foto SET 
        nama_produk_foto = '$nama_foto_baru'
        WHERE id_produk = '$id_produk' AND is_main = 1"); // Hanya update foto utama

    }
    // Jika foto produk tidak diubah
    else {
        $koneksi->query("UPDATE produk SET
        id_kategori = '$id_kategori',
        nama_produk = '$nama',
        harga_produk = '$harga',
        berat_produk = '$berat',
        deskripsi_produk = '$deskripsi',
        stock_produk = '$stok'
        WHERE id_produk = '$id_produk'");
    }

    echo "<script>alert('Data Berhasil Diedit');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}

?>