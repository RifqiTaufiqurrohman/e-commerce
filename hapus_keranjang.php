<?php
session_start();

$id_produk = $_GET['idproduk'];

unset($_SESSION['keranjang_belanja'][$id_produk]);

echo "<script>alert('Produk Berhasil dihapus');</script>";
echo "<script>location='keranjang.php';</script>";
