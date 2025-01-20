<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Pembelian<h4>
        </div>
    </div>
</div>
<?php

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
        ORDER BY pembelian.id_pembelian DESC");
while ($pecah = $ambil->fetch_assoc()) {
    $pembelian[] = $pecah;
}

?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <!-- <h4 class="card-title">Pesanan Masuk</h4> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pembelian as $key => $value): ?>
                                <tr class="text-center">
                                    <td width="50"><?php echo $key + 1 ?></td>
                                    <td><?php echo $value['nama_pelanggan']; ?></td>
                                    <td><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
                                    <td>Rp.<?php echo number_format($value['total_pembelian']); ?></td>
                                    <td><?php echo $value['status']; ?></td>
                                    <td>
                                        <?php
                                        // Menentukan badge berdasarkan status pesanan
                                        if ($value['transaction_status'] == "1") {
                                            echo '<span class="text-danger">Belum Bayar</span>';
                                        } elseif ($value['transaction_status'] == "2") {
                                            echo '<span class="text-success">Success</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="index.php?halaman=detail_pembelian&id=<?php echo $value['id_pembelian']; ?>"
                                            class="btn btn-sm btn-info">Detail</a>
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