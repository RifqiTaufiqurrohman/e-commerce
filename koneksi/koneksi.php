<?php

// $koneksi = mysqli_connect("localhost", "sepm3391_hijup", "Chemonsadjah123@", "sepm3391_hijup");
$koneksi = mysqli_connect("localhost", "root", "", "");

// Check connection
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
