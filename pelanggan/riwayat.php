<div class="shadow bg-white p-3 mb-3 rounded">
    <h3>Riwayat Pembelian </h3>
</div>
<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
        WHERE pembelian.id_pelanggan='$id_pelanggan' 
        AND (pembelian.status = 'Pesanan Selesai' OR pembelian.status = 'Pesanan Dibatalkan') 
        ORDER BY pembelian.id_pembelian DESC");
while ($pecah = $ambil->fetch_assoc()) {
    $pembelian[] = $pecah;
}
?>

<div class="card shadow">
    <div class="card-body">
        <table id="example" class="display">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembelian as $key => $value): ?>
                    <tr class="text-center">
                        <td>
                            <?= $key + 1; ?>
                        </td>
                        <td>
                            <?= date("d F Y", strtotime($value['tanggal_pembelian'])); ?>
                        </td>
                        <td>
                            Rp. <?= number_format($value['total_pembelian']); ?>
                        </td>
                        <?php if ($value['status'] == 'Pesanan Dibatalkan'): ?>
                            <td class="text-danger">
                                <?= $value['status']; ?><br>
                                <!-- Jika resi pengiriman tidak kosong -->
                                <?php if (!empty($value['no_resi'])): ?>
                                    <?= $value['no_resi']; ?>
                                <?php endif ?>
                            </td>
                        <?php else: ?>
                            <td class="text-success">
                                <?= $value['status']; ?><br>
                                <!-- Jika resi pengiriman tidak kosong -->
                                <?php if (!empty($value['no_resi'])): ?>
                                    <?= $value['no_resi']; ?>
                                <?php endif ?>
                            </td>
                        <?php endif ?>
                        <td>
                            <a href="index.php?page=detail_pembelian&id=<?= $value['id_pembelian']; ?>"
                                class="btn btn-primary">Nota</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>