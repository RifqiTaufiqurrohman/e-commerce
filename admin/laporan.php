<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Laporan Penjualan<h4>
        </div>
    </div>
</div>

<?php

$tgl_mulai = isset($_POST['tglm']) ? $_POST['tglm'] : '';
$tgl_selesai = isset($_POST['tgls']) ? $_POST['tgls'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';

if (isset($_POST['cari'])) {
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];
    $status = $_POST['status'];

    $semuadata = array();
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
            ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
            WHERE status = '$status' AND tanggal_pembelian 
            BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
    // echo "<pre>";
    // print_r($semuadata);
    // echo "</pre>";
}
?>

<div class="card shadow bg-white">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mulai : </label>
                        <div class="col-sm-8">
                            <input type="date" name="tglm" class="form-control" value="<?= $tgl_mulai; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Selesai : </label>
                        <div class="col-sm-8">
                            <input type="date" name="tgls" class="form-control" value="<?= $tgl_selesai; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="status" id="" class="form-control">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Pending" <?= $status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="Pembayaran Dikonfirmasi"
                                    <?= $status == 'Pembayaran Dikonfirmasi' ? 'selected' : ''; ?>>Pembayaran
                                    Dikonfirmasi</option>
                                <option value="Barang Dikirim" <?= $status == 'Barang Dikirim' ? 'selected' : ''; ?>>
                                    Barang Dikirim</option>
                                <option value="Pesanan Dibatalkan"
                                    <?= $status == 'Pesanan Dibatalkan' ? 'selected' : ''; ?>>Pesanan Dibatalkan
                                </option>
                                <option value="Pesanan Selesai" <?= $status == 'Pesanan Selesai' ? 'selected' : ''; ?>>
                                    Pesanan Selesai
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button name="cari" class="btn btn-primary">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php if (!empty($semuadata)): ?>
    <div class="alert alert-primary shadow text-center">
        <h5>
            Laporan Pembelian dari tanggal <strong> <?= date("d F Y", strtotime($tgl_mulai)) ?> </strong> s/d
            <strong><?= date("d F Y", strtotime($tgl_selesai)) ?> </strong>
        </h5>
    </div>
<?php endif ?>

<div class="card shadow bg-white">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="display">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($semuadata)): ?>
                        <?php $total = 0; ?>
                        <?php foreach ($semuadata as $key => $value): ?>
                            <?php $jumlah = $total += $value['total_pembelian']; ?>
                            <tr class="text-center">
                                <td width="50"><?php echo $key + 1; ?></td>
                                <td><?= $value['nama_pelanggan']; ?></td>
                                <td><?= date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
                                <td><?= $value['status']; ?></td>
                                <td class="">Rp. <?= number_format($value['total_pembelian']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="alert alert-danger shadow text-center">
                                Tidak Ada Data
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?php if (!empty($semuadata)): ?>
                        <tr>
                            <th colspan="4">Total</th>
                            <th class="text-center">Rp. <?= number_format($jumlah); ?></th>
                        </tr>
                    <?php endif ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php if (!empty($semuadata)): ?>
    <div class="alert alert-primary shadow">
        <a href="download_laporan.php?tglm=<?= $tgl_mulai; ?>&tgls=<?= $tgl_selesai; ?>&status=<?= $status; ?>"
            class="btn btn-primary" target="_blank">Download Laporan</a>
    </div>
<?php endif ?>