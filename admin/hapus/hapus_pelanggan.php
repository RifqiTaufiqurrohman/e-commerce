<?php

$id_pelanggan = $_GET['id'];

// Retrieve the existing photo file name
$ambil = $koneksi->query("SELECT foto_pelanggan FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$foto = $ambil->fetch_assoc();

if ($foto) {
    $target_dir = "../assets/images/foto_pelanggan/";
    $file_path = $target_dir . $foto['foto_pelanggan'];

    // Check if the file exists and delete it
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Delete the record from the database
    $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    echo "<script>alert('Data Berhasil Dihapus');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
} else {
    echo "<script>alert('Data tidak ditemukan atau sudah dihapus');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
}
