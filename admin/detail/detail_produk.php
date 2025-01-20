<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Detail Produk</h4>
        </div>
    </div>
</div>

<?php
$id_produk = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori 
    WHERE id_produk='$id_produk'");
$detailproduk = $ambil->fetch_assoc();

$produk_foto = array();
$ambil = $koneksi->query("SELECT * FROM produk_foto  WHERE id_produk='$id_produk'");
while ($tiap = $ambil->fetch_assoc()) {
    $produk_foto[] = $tiap;
}
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Produk</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 for="">Nama Kategori : </h6>
                                <label><?= $detailproduk['nama_kategori']; ?></label>
                            </div>
                            <div class="col-md-6">
                                <h6 for="">Nama Produk : </h6>
                                <label><?= $detailproduk['nama_produk']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 for="">Harga : </h6>
                                <label><?= $detailproduk['harga_produk']; ?></label>
                            </div>
                            <div class="col-md-6">
                                <h6 for="">Berat : </h6>
                                <label><?= $detailproduk['berat_produk']; ?>(g)</label>
                            </div>
                            <div class="col-md-6">
                                <h6 for="">Stock : </h6>
                                <label><?= $detailproduk['stock_produk']; ?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="description">
                                    <h6 for="">Deskripsi : </h6>
                                    <label><?= $detailproduk['deskripsi_produk']; ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <?php foreach ($produk_foto as $key => $value): ?>
                                <div class="col-md-4 mb-2 text-center">
                                    <img width="140" class="img-thumbnail"
                                        src="../assets/images/foto_produk/<?= $value['nama_produk_foto']; ?>">
                                    <a href="index.php?halaman=hapus_foto&idfoto=<?= $value['id_produk_foto']; ?>&idproduk=<?= $value['id_produk']; ?>"
                                        class="btn btn-sm btn-danger mt-2">Hapus</a>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="card shadow bg-white">
                                    <div class="card-header">
                                        <h5>Tambah Foto </h5>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <h6 class="col-md-3 form-label">Foto Produk</h6>
                                                <div class="col-md-9 ">
                                                    <div class="input-foto">
                                                        <input type="file" class="form-control mb-2" name="produk_foto"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <button name="simpan" class="btn btn-sm btn-primary">Simpan</button>
                                                <a href="index.php?halaman=produk"
                                                    class="btn btn-sm btn-light m-1">Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $namafoto = $_FILES['produk_foto']['name'];
    $lokasifoto = $_FILES['produk_foto']['tmp_name'];

    // Mendapatkan ekstensi file
    $ext = pathinfo($namafoto, PATHINFO_EXTENSION);

    // Membuat nama acak untuk foto dengan kombinasi uniqid() dan ekstensi file
    $nama_foto_baru = uniqid() . '.' . $ext;

    // Memindahkan foto ke direktori tujuan dengan nama acak
    move_uploaded_file($lokasifoto, "../assets/images/foto_produk/" . $nama_foto_baru);

    // Menyimpan data ke database dengan nilai is_main = 0 (foto tambahan)
    $koneksi->query("INSERT INTO produk_foto (id_produk, nama_produk_foto, is_main) VALUES ('$id_produk', '$nama_foto_baru', 0)");

    echo "<script>alert('Data Berhasil Disimpan');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>