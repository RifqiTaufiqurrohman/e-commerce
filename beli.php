<?php

session_start();
$id_produk = $_GET['idproduk'];

if (isset($_SESSION['keranjang_belanja'][$id_produk])) {
    $_SESSION['keranjang_belanja'][$id_produk] += 1;
} else {
    $_SESSION['keranjang_belanja'][$id_produk] = 1;
}

echo "<script>alert('Produk Berhasil dimasukan ke Keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
