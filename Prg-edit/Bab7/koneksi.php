<?php
$hos = "localhost";
$uname = "root"; 
$pswd= "";
$nama_db = "akademik";

$koneksi = mysql_connect($hos,$uname,$pswd) or 
           die ("Gagal terhubung ke server MySQL!");

mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");

?>
