<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Tambah Produk<h4>
        </div>
    </div>
</div>

<?php
$kategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($pecah = $ambil->fetch_assoc()) {
    $kategori[] = $pecah;
}
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
                                        <option selected disabled>Pilih Kategori</option>
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
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Produk">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Harga</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" name="harga" placeholder="Harga">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Berat (g)</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" name="berat" placeholder="Berat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-label">Foto Produk</label>
                                <div class="col-md-10 ">
                                    <div class="input-foto">
                                        <input type="file" class="form-control mb-2" name="foto[]" required>
                                    </div>
                                    <span class="btn btn-sm btn-primary btn-tambah">Tambah
                                        Foto </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Deskripsi</label>
                                <div class="col-lg-10">
                                    <textarea rows="5" class="form-control" name="deskripsi"
                                        placeholder="Masukan Deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 form-label">Stock</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" name="stok" placeholder="Stock">
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

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    // Proses file pertama untuk disimpan di tabel `produk` dan `produk_foto`
    $ext = pathinfo($nama_foto[0], PATHINFO_EXTENSION); // Mendapatkan ekstensi file pertama
    $nama_foto_baru = uniqid() . '.' . $ext; // Membuat nama file baru yang acak
    move_uploaded_file($lokasi_foto[0], "../assets/images/foto_produk/" . $nama_foto_baru);

    // Simpan produk ke tabel `produk`
    $koneksi->query("INSERT INTO produk (id_kategori, nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk, stock_produk) VALUES ('$id_kategori', '$nama', '$harga', '$berat', '$nama_foto_baru', '$deskripsi', '$stok' ) ");

    $id_baru = $koneksi->insert_id; // Mendapatkan ID produk yang baru saja disimpan

    // Simpan foto pertama sebagai foto utama ke tabel produk_foto (is_main=1)
    $koneksi->query("INSERT INTO produk_foto (id_produk, nama_produk_foto, is_main) VALUES ('$id_baru', '$nama_foto_baru', 1)");

    // Proses setiap foto lainnya (jika ada)
    foreach ($nama_foto as $key => $tiap_nama) {
        if ($key == 0) continue; // Lewati foto pertama karena sudah diproses di atas
        $ext = pathinfo($tiap_nama, PATHINFO_EXTENSION); // Mendapatkan ekstensi file
        $nama_foto_baru = uniqid() . '.' . $ext; // Membuat nama file baru yang acak
        $tiap_lokasi = $lokasi_foto[$key];
        move_uploaded_file($tiap_lokasi, "../assets/images/foto_produk/" . $nama_foto_baru);

        // Simpan setiap foto lainnya ke tabel produk_foto sebagai foto tambahan (is_main=0)
        $koneksi->query("INSERT INTO produk_foto (id_produk, nama_produk_foto, is_main) VALUES ('$id_baru', '$nama_foto_baru', 0)");
    }

    echo "<script>alert('Data Berhasil Disimpan');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>