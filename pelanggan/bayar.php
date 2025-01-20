<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once __DIR__ . '/../midtrans/Midtrans.php';
// Set Your server key
// Konfigurasi Midtrans
use Midtrans\Config;
use Midtrans\Snap;

Config::$serverKey = ''; // Ganti dengan server key Anda
Config::$isProduction = false; // Ubah ke true untuk produksi
Config::$isSanitized = true;
Config::$is3ds = true;

// Ambil ID pembelian dari URL
$order_id = $_GET['id_pembelian'];

// Ambil data pembelian dari database
require_once '../koneksi/koneksi.php'; // Sesuaikan path koneksi database
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$order_id'");
$data_pembelian = $ambil->fetch_assoc();

// Ambil detail pelanggan
$id_pelanggan = $data_pembelian['id_pelanggan'];
$ambil_pelanggan = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$data_pelanggan = $ambil_pelanggan->fetch_assoc();

// Detail transaksi
$transaction_details = array(
    'order_id' => $order_id,
    'gross_amount' => $data_pembelian['total_pembelian'], // Total pembayaran
);

// Item details (opsional)
$item_details = [];
$ambil_produk = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$order_id'");
while ($produk = $ambil_produk->fetch_assoc()) {
    $item_details[] = array(
        'id' => $produk['id_produk'],
        'price' => $produk['harga'],
        'quantity' => $produk['jumlah'],
        'name' => $produk['nama'],
    );
}

$item_details[] = array(
    'id' => 'ongkir',
    'price' => $data_pembelian['ongkir'],
    'quantity' => 1,
    'name' => 'Biaya Ongkir'
);

// Customer details
$customer_details = array(
    'first_name' => $data_pelanggan['nama_pelanggan'],
    'email' => $data_pelanggan['email_pelanggan'],
    'phone' => $data_pelanggan['telepon_pelanggan'],
    'address' => $data_pelanggan['alamat_pelanggan'],
);

// Buat payload transaksi
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

?>

<h3>Proses Pembayaran</h3>
<p>Silakan klik tombol di bawah untuk melanjutkan pembayaran.</p>
<p>Segera lakukan pembayaran sebesar <span><?= $data_pembelian['total_pembelian'];  ?></span></p>
<button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>

<!-- Tambahkan script Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Wrr7raYQk-ygmj3G">
</script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        snap.pay('<?= $snap_token ?>', {
            onSuccess: function(result) {
                alert("Pembayaran Berhasil!");
                window.location.href = "index.php?page=pesanan"; // Arahkan kembali ke halaman pesanan
            },
            onPending: function(result) {
                alert("Menunggu Pembayaran!");
                console.log(result);
            },
            onError: function(result) {
                alert("Pembayaran Gagal!");
                console.log(result);
            },
            onClose: function() {
                alert('Anda menutup proses pembayaran!');
            }
        });
    };
</script>