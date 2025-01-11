<?php
$hos = "localhost";
$uname = "rangga"; 
$pswd = "rangga";
$nama_db = "sekolah";

// Membuat koneksi
$koneksi = new mysqli($hos, $uname, $pswd, $nama_db);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

echo "Koneksi berhasil!";

?>
