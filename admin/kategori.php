<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Kategori</h4>
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
<a href="index.php?halaman=tambah_kategori" class="btn btn-sm btn-primary">Tambah</a>
<div class="row">
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Data Kategori</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kategori as $key => $value): ?>
                                <tr class="text-center">
                                    <td width="50"><?php echo $key + 1; ?></td>
                                    <td><?php echo $value['nama_kategori']; ?></td>
                                    <td class="">
                                        <a href="index.php?halaman=edit_kategori&id=<?= $value['id_kategori']; ?>"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        <a href="index.php?halaman=hapus_kategori&id=<?= $value['id_kategori']; ?>"
                                            class="btn btn-sm btn-danger">HAPUS</a>
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