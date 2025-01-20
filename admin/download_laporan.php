<?php
// Require composer autoload
require_once '../koneksi/koneksi.php';
require_once '../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$tgl_mulai = $_GET['tglm'];
$tgl_selesai = $_GET['tgls'];
$status = $_GET['status'];

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

$html = '

    <h2 style="text-align: center;">Data Laporan Pembelian</h2>
    <div style="margin: 0 500px 0 ; border: 2px solid black;"></div>
    <h5 style="text-align: center;" >Laporan Pembelian Dari Tanggal <strong> ' . date("d F Y", strtotime($tgl_mulai)) . ' </strong> Sampai Tanggal <strong> ' . date("d F Y", strtotime($tgl_selesai)) . ' </strong> </h5>
    <p style="text-align: center;" > Dengan Status Penjualan ' . $status . ' </p>
        <table border="1" style="border : 1px solid #f8f9fa; color: #343a40; width: 100%; text-align : center; 
                        margin-top : 20px;">
            <thead>
                <tr style="background: #5e72e4; color: #f8f9fa" >
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Jumlah</th>
                </tr>
            </thead>';
$total = 0;
foreach ($semuadata as $key => $value):
    $total += $value['total_pembelian'];
    $no = $key + 1;
    $nama = $value['nama_pelanggan'];
    $tgl = date("d F Y", strtotime($value['tanggal_pembelian']));
    $status = $value['status'];
    $jumlah = number_format($value['total_pembelian']);
    // $jumlah = number_format($total);

    $html .= '
            <tbody>
                <tr>
                    <td>' . $no . '</td>
                    <td>' . $nama . '</td>
                    <td>' . $tgl . '</td>
                    <td>' . $status . '</td>
                    <td>' . $jumlah . '</td>
                </tr>
            </tbody>';
endforeach;
$html .= '
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th>Rp. ' . number_format($total) . '</th>
                </tr>
            </tfoot>
        </table>

';

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('Laporan ' . date("d F Y", strtotime($tgl_mulai)) . ' sampai ' . date("d F Y", strtotime($tgl_selesai)) . '.pdf', 'I');
