<?php

$id_foto = $_GET['idfoto'];
$id_produk = $_GET['idproduk'];

// Mengambil data foto berdasarkan ID foto
$ambil = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto = '$id_foto'");
$detailfoto = $ambil->fetch_assoc();
$nama_foto = $detailfoto['nama_produk_foto'];

// Memeriksa apakah file benar-benar ada sebelum dihapus
if (file_exists("../assets/images/foto_produk/" . $nama_foto)) {
    unlink("../assets/images/foto_produk/" . $nama_foto);
} else {
    echo "File tidak ditemukan.";
}

// Menghapus data foto di database
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto = '$id_foto'");

echo "<script>alert('Foto Produk Berhasil Dihapus');</script>";
echo "<script>location='index.php?halaman=detail_produk&id=$id_produk';</script>";
