<div class="card">
    <div class="card-body">
        <h3><strong>Detail Pesanan</strong></h3>
    </div>
</div>
<?php
$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian=$id_pembelian");
$detail = $ambil->fetch_assoc();

$idpembelian = $detail['id_pelanggan'];
$idpelanggan = $_SESSION['pelanggan']['id_pelanggan'];

if ($idpembelian !== $idpelanggan) {
    echo "<script>alert('Session Tidak Ditemukan');</script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}

?>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h6 for="">Nama : </label></h6>
                            <label for=""><?= $detail['nama_pelanggan']; ?>
                        </div>
                        <div class="">
                            <h6 for="">Email : </h6>
                            <label for=""><?= $detail['email_pelanggan']; ?></label>
                        </div>
                        <div class="">
                            <h6 for="">Telephone : </h6>
                            <label for=""><?= $detail['telepon_pelanggan']; ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title">Data Pembelian</h4>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h6 for="">No Pembelian : </label></h6>
                            <label for=""><?= $detail['id_pembelian']; ?>
                        </div>
                        <div class="">
                            <h6 for="">Email : </h6>
                            <label for=""><?= date("d F Y", strtotime($detail['tanggal_pembelian'])); ?></label>
                        </div>
                        <div class="">
                            <h6 for="">Total Pembelian : </h6>
                            <label for=""><?= number_format($detail['total_pembelian']); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title">Data Pengiriman</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <h6 for="">Ekspedisi : </label></h6>
                                <label for="" style="text-transform: uppercase;"><?= $detail['ekspedisi']; ?>
                            </div>
                            <div class="col-md-7">
                                <h6 for="">Paket : </h6>
                                <label for=""><?= $detail['paket']; ?></label>
                            </div>
                            <div class="col-md-5">
                                <h6 for="">Ongkir : </h6>
                                <label for=""><?= $detail['ongkir']; ?></label>
                            </div>
                            <div class="col-md-7">
                                <h6 for="">No Resi : </h6>
                                <label for=""><?= $detail['no_resi']; ?></label>
                            </div>
                            <div class="col-md-12">
                                <h6 for="">Alamat : </h6>
                                <label for=""><?= $detail['alamat']; ?></label>
                                <label><?= $detail['kelurahan']; ?>, <?= $detail['kecamatan']; ?>,
                                    <?= $detail['type']; ?> <?= $detail['distrik']; ?>,
                                    <?= $detail['provinsi']; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$pembelianproduk = array();
$ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE pembelian_produk.id_pembelian='$id_pembelian'");
while ($pecah = $ambil->fetch_assoc()) {
    $pembelianproduk[] = $pecah;
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>SubBerat</th>
                                <th>SubHarga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pembelianproduk as $key => $value): ?>
                                <tr class="text-center text-dark">
                                    <td width=""><?= $key + 1 ?></td>
                                    <td width=""><?= $value['nama']; ?></td>
                                    <td width="">Rp.<?= number_format($value['harga']); ?></td>
                                    <td width=""><?= $value['jumlah']; ?></td>
                                    <td width=""><?= number_format($value['subberat']); ?>(g)</td>
                                    <td width="">Rp.<?= number_format($value['subharga']);  ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>