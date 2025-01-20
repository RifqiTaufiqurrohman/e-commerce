<div class="shadow bg-white p-3 mb-3 rounded">
    <h3><strong>Pesanan Saya</strong></h3>
</div>

<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
        WHERE pembelian.id_pelanggan='$id_pelanggan'
        AND (pembelian.status = 'Pending' 
        OR pembelian.status = 'Pembayaran Dikonfirmasi' OR pembelian.status = 'Barang Dikirim' OR pembelian.status = 'Sedang Diproses') 
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
                    <th>Pembayaran</th>
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
                        <?php if ($value['status'] == 'Pending' || $value['status'] == 'Pesanan Dibatalkan'): ?>
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
                            <?php
                            // Menentukan badge berdasarkan status pesanan
                            if ($value['transaction_status'] == "1") {
                                echo '<span class="badge badge-danger">Belum Bayar</span>';
                            } elseif ($value['transaction_status'] == "2") {
                                echo '<span class="badge badge-success">Success</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?page=detail_pembelian&id=<?= $value['id_pembelian']; ?>"
                                class="btn btn-info">Nota</a>
                            <?php if ($value['transaction_status'] == 1): ?>
                                <a href="index.php?page=pembayaran&id_pembelian=<?= $value['id_pembelian']; ?>"
                                    class="btn btn-primary">Bayar</a>
                            <?php elseif ($value['status'] == 'Barang Dikirim') : ?>
                                <form action="" method="post" style="float: left; margin-right: 10px;">
                                    <input type="hidden" name="id_pembelian" value="<?= $value['id_pembelian']; ?>">
                                    <input type="hidden" name="diterima" value="Pesanan Selesai">
                                    <button class="btn btn-primary" name="terima">Terima</button>
                                </form>
                            <?php endif; ?>
                            <div style="clear: both;"></div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php
if (isset($_POST['terima'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $terima = $_POST['diterima'];

    // Jalankan query update status
    $koneksi->query("UPDATE pembelian SET `status`='$terima' WHERE id_pembelian='$id_pembelian'");

    // Berikan feedback ke pengguna
    echo "<script>alert('Pesanan Berhasil Diterima');</script>";
    echo "<script>location='index.php?page=riwayat';</script>";
}

?>