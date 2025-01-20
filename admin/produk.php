<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Produk</h4>
        </div>
    </div>
</div>
<?php

$produk = array();
$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori");
while ($pecah = $ambil->fetch_assoc()) {
    $produk[] = $pecah;
}

?>
<a href="index.php?halaman=tambah_produk" class="btn btn-sm btn-primary">Tambah</a>
<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Data Produk</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Berat</th>
                                <th>Foto Produk</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $key => $value): ?>
                                <tr class="text-center">
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $value['nama_kategori']; ?></td>
                                    <td><?= $value['nama_produk']; ?></td>
                                    <td><?= number_format($value['harga_produk']); ?></td>
                                    <td><?= number_format($value['berat_produk']); ?></td>
                                    <td class="text-center">
                                        <img width="100" src="../assets/images/foto_produk/<?= $value['foto_produk']; ?>">
                                    </td>
                                    <td>
                                        <a href="index.php?halaman=edit_produk&id=<?= $value['id_produk']; ?>"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        <a href="index.php?halaman=hapus_produk&id=<?= $value['id_produk']; ?>"
                                            class="btn btn-sm btn-danger">HAPUS</a>
                                        <a href="index.php?halaman=detail_produk&id=<?= $value['id_produk']; ?>"
                                            class="btn btn-sm btn-info">DETAIL</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>