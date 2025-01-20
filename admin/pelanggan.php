<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Pelanggan</h4>
        </div>
    </div>
</div>

<?php

$pelanggan = array();
$ambil = $koneksi->query("SELECT * FROM pelanggan");
while ($pecah = $ambil->fetch_assoc()) {
    $pelanggan[] = $pecah;
}

?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <!-- <h4 class="card-title">Data </h4> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelanggan as $key => $value): ?>
                                <tr class="text-center">
                                    <td width="50"><?php echo $key + 1; ?></td>
                                    <td>
                                        <img src="../assets/images/foto_pelanggan/<?= $value['foto_pelanggan']; ?>"
                                            width="80">
                                    </td>
                                    <td><?= $value['nama_pelanggan']; ?></td>
                                    <td><?= $value['email_pelanggan']; ?></td>
                                    <td><?= $value['telepon_pelanggan']; ?></td>
                                    <td class="">
                                        <a href="index.php?halaman=edit_password&id=<?= $value['id_pelanggan']; ?>"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        <a href="index.php?halaman=hapus_pelanggan&id=<?= $value['id_pelanggan']; ?>"
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