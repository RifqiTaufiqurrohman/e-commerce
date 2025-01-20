<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Detail Pembelian<h4>
        </div>
    </div>
</div>
<?php
$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian=$id_pembelian");
$detail = $ambil->fetch_assoc();
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
                            <h6 for="">Tanggal : </h6>
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
$ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk
    ON pembelian_produk.id_produk = produk.id_produk
    WHERE pembelian_produk.id_pembelian='$id_pembelian'");
while ($pecah = $ambil->fetch_assoc()) {
    $pembelianproduk[] = $pecah;
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
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>SubBerat</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pembelianproduk as $key => $value): ?>
                                <?php $subtotal = $value['harga_produk'] * $value['jumlah']; ?>
                                <tr class="text-center text-dark">
                                    <td width="50"><?= $key + 1 ?></td>
                                    <td><?= $value['nama_produk']; ?></td>
                                    <td>Rp.<?= number_format($value['harga_produk']); ?></td>
                                    <td><?= $value['jumlah']; ?></td>
                                    <td><?= number_format($value['subberat']); ?>(g)</td>
                                    <td>Rp.<?= number_format($subtotal);  ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-footer">
                <form method="post" action="">
                    <div class="form-group row">
                        <h6 for="" class="col-sm-3 col-form-label">Status Pembayaran: </h6>
                        <div class="col-sm-9">
                            <?php
                            // Menentukan badge berdasarkan status pesanan
                            if ($detail['transaction_status'] == "1") {
                                echo '<span class="badge badge-danger">Belum Bayar</span>';
                            } elseif ($detail['transaction_status'] == "2") {
                                echo '<span class="badge badge-success">Success</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h6 class="col-sm-3 col-form-label">Status Pesanan : </h6>
                        <div cltas="col-sm-9">
                            <select name="status" id="status" class="form-control" onchange="toggleFormFields()">
                                <option selected disabled>Pilih Status</option>
                                <option value="Pembayaran Dikonfirmasi">Pembayaran Dikonfirmasi</option>
                                <option value="Barang Dikirim">Barang Dikirim</option>
                                <option value="Pesanan Dibatalkan">Pesanan Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="resiField" style="display: none;">
                        <label for="resi" class="col-sm-3 col-form-label">No. Resi pengiriman : </label>
                        <div class="col-sm-9">
                            <input type="text" name="resi" id="resi" class="form-control" placeholder="Masukan No Resi">
                        </div>
                    </div>
                    <div class="form-group row" id="pesanField" style="display: none;">
                        <label for="pesanbtl" class="col-sm-3 col-form-label">Pesan : </label>
                        <div class="col-sm-9">
                            <input type="text" name="pesanbtl" id="pesanbtl" class="form-control"
                                placeholder="Masukan Alasan Pembatalan Pesanan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button name="proses" class="btn btn-primary">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['proses'])) {
    $status = $_POST['status'];
    $resi = $_POST['resi'];
    $alasan = $_POST['pesanbtl'];

    $koneksi->query("UPDATE pembelian SET 
    no_resi='$resi',
    `status`='$status'
    WHERE id_pembelian='$id_pembelian'");

    // Ambil informasi pelanggan dan produk terkait
    $ambil_pelanggan = $koneksi->query("SELECT pelanggan.nama_pelanggan, pelanggan.telepon_pelanggan
        FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan
        WHERE pembelian.id_pembelian = '$id_pembelian'");
    $data_pelanggan = $ambil_pelanggan->fetch_assoc();

    // Ambil nama produk dari tabel pembelian_produk
    $ambil_produk = $koneksi->query("SELECT nama FROM pembelian_produk WHERE id_pembelian = '$id_pembelian'");
    $nama_produk = [];
    while ($produk = $ambil_produk->fetch_assoc()) {
        $nama_produk[] = $produk['nama'];
    }
    $nama_produk_list = implode(', ', $nama_produk);

    // Format tanggal pengiriman
    $tanggal_pengiriman = date("d F Y");

    // Menentukan pesan WhatsApp berdasarkan status
    if ($status == "Pembayaran Dikonfirmasi") {
        $pesan_wa = "Pembayaran telah dikonfirmasi, mohon tunggu pesanan Anda *$nama_produk_list* akan segera kami kirim.";
    } elseif ($status == "Barang Dikirim") {
        $pesan_wa = "Pesanan Anda produk *$nama_produk_list* dengan nomor resi *$resi* telah dikirim pada tanggal *$tanggal_pengiriman*.\n\nTerima kasih telah berbelanja di toko kami!";
    } elseif ($status == "Pesanan Dibatalkan") {
        $pesan_wa = "Pesanan Anda dibatalkan Karena *$alasan*\n\nTerima Kasih.";
    }

    // Konfigurasi API WhatsApp
    $token = ""; // Isi Token
    $target = $data_pelanggan['telepon_pelanggan']; // Nomor WhatsApp pelanggan

    // Membuat payload untuk dikirimkan ke API WhatsApp
    $payload = array(
        'target' => $target,
        'message' => $pesan_wa,
    );

    // Menggunakan cURL untuk mengirimkan pesan WhatsApp
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        )
    );

    $response = curl_exec($curl);
    curl_close($curl);

    echo "<script>alert('Data Pembelian berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}

?>