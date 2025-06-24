<?php
$koneksi = mysqli_connect("localhost", "root", "", "hotel_booking");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
