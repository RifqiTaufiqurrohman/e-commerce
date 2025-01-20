<div class="row page-titles mx-0">
    <div class="col-sm-12 p-md-0">
        <div class="welcome-text">
            <h4>Selamat Datang <strong><?= $_SESSION['admin']['nama_lengkap']; ?></strong> Anda Login Sebagai
                <strong>Administrator</strong>
            </h4>
        </div>
    </div>
</div>
<?php
// Menghitung total pelanggan
$ambilPelanggan = $koneksi->query("SELECT COUNT(*) as total_pelanggan FROM pelanggan");
$totalPelanggan = $ambilPelanggan->fetch_assoc()['total_pelanggan'];

// Menghitung total produk
$ambilProduk = $koneksi->query("SELECT COUNT(*) as total_produk FROM produk");
$totalProduk = $ambilProduk->fetch_assoc()['total_produk'];

// Menghitung total Kategori
$ambilKategori = $koneksi->query("SELECT COUNT(*) as total_kategori FROM kategori");
$totalKategori = $ambilKategori->fetch_assoc()['total_kategori'];

// Mendapatkan bulan dan tahun saat ini
$currentMonth = date('m');
$currentYear = date('Y');

// Query untuk menghitung total profit bulanan dengan status "Pesanan Selesai"
$ambilProfit = $koneksi->query("SELECT SUM(total_pembelian) AS total_profit 
                                FROM pembelian 
                                WHERE MONTH(tanggal_pembelian) = '$currentMonth' 
                                AND YEAR(tanggal_pembelian) = '$currentYear' 
                                AND `status` = 'Pesanan Selesai'");

// Mengambil hasil query
$totalProfit = $ambilProfit->fetch_assoc()['total_profit'];

// Jika hasilnya null (tidak ada data), set total profit menjadi 0
$totalProfit = $totalProfit ? $totalProfit : 0;

// Query untuk mendapatkan data pesanan bulan ini
$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian 
                          JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
                          WHERE MONTH(tanggal_pembelian) = '$currentMonth' 
                          AND YEAR(tanggal_pembelian) = '$currentYear' 
                          ORDER BY pembelian.id_pembelian DESC");

while ($pecah = $ambil->fetch_assoc()) {
    $pembelian[] = $pecah;
}
?>
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-money text-success border-success"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Profit Bulan Ini</div>
                    <div class="stat-digit"><?= number_format($totalProfit, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-user text-primary border-primary"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Pelanggan</div>
                    <div class="stat-digit"><?= $totalPelanggan; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-layout-grid2 text-pink border-pink"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Produk</div>
                    <div class="stat-digit"><?= $totalProduk; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="icon icon-app-store text-danger border-danger"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Kategori</div>
                    <div class="stat-digit"><?= $totalKategori; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="year-calendar"></div>
            </div>
        </div>
        <!-- /# card -->
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pesanan Bulan Ini</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pembelian as $data): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['nama_pelanggan']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($data['tanggal_pembelian'])); ?></td>
                                    <td>Rp. <?= number_format($data['total_pembelian'], 0, ',', '.'); ?></td>
                                    <td>
                                        <?php
                                        // Menentukan badge berdasarkan status pesanan
                                        if ($data['status'] == "Pending") {
                                            echo '<span class="badge badge-warning">Pending</span>';
                                        } elseif ($data['status'] == "Pesanan Dibatalkan") {
                                            echo '<span class="badge badge-danger">Cancel</span>';
                                        } elseif ($data['status'] == "Barang Dikirim") {
                                            echo '<span class="badge badge-info">Send</span>';
                                        } elseif ($data['status'] == "Pembayaran Dikonfirmasi") {
                                            echo '<span class="badge badge-warning">Accept</span>';
                                        } elseif ($data['status'] == "Pesanan Selesai") {
                                            echo '<span class="badge badge-success">Success</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>