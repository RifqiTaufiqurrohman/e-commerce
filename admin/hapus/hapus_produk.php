<?php

$id_produk = $_GET['id'];

// Mengambil data produk untuk mendapatkan foto utama
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$pecah = $ambil->fetch_assoc();

// Menghapus foto utama produk jika ada
$hapus_foto = $pecah['foto_produk'];
if (file_exists("../assets/images/foto_produk/" . $hapus_foto)) {
    unlink("../assets/images/foto_produk/" . $hapus_foto);
}

// Mengambil semua foto tambahan di tabel produk_foto
$hapusprodukfoto = array();
$ambil_foto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while ($hapus = $ambil_foto->fetch_assoc()) {
    $hapusprodukfoto[] = $hapus;
}

// Menghapus setiap file foto di tabel produk_foto
foreach ($hapusprodukfoto as $key => $value) {
    $hapusfoto = $value['nama_produk_foto'];
    if (file_exists("../assets/images/foto_produk/" . $hapusfoto)) {
        unlink("../assets/images/foto_produk/" . $hapusfoto); // Hapus file fisik
    }
}

// Hapus data di tabel produk_foto (hapus semua foto terkait produk)
$koneksi->query("DELETE FROM produk_foto WHERE id_produk='$id_produk'");

// Hapus data di tabel produk setelah semua file foto dihapus
$koneksi->query("DELETE FROM produk WHERE id_produk='$id_produk'");

// Redirect dan konfirmasi penghapusan
echo "<script>alert('Data Berhasil Dihapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";
