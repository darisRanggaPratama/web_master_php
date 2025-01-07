<?php
$server = "localhost";
$database = "sekolah";
$username = "rangga";
$password = "rangga";

// Membuat koneksi
$connect = mysqli_connect($server, $username, $password, $database);

// Mengecek koneksi
if (!$connect){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>