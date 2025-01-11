<?php
include 'lib/config.php';
include 'lib/tablegen.cls.php';
include 'lib/page.cls.php';
include 'lib/form_generator.cls.php';
?>
<?
session_start();
//periksa apakah user telah login atau memiliki session
if(!isset($_SESSION['user']) || !isset($_SESSION['passwd'])) {
?><script language=’javascript’>alert('Anda belum login. Please login dulu' );
document.location='login.php'</script><?
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" 
	"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="themes/style.css" type="text/css" media="all"/>
<style type="text/css">
body{
background: url('images/WALLPAPER.jpg') no-repeat scroll;
background-size: 100% 100%;
min-height: 700px;
}
.style1 {color: #FFFFFF}
</style>
</head>
<body>


<div id="topmenuwrapper">
	<ul id="menu" class="dropdown">
		<li><a href="#">File</a>
			<ul class="sub_menu">
				<li><a href="logout.php" >Keluar</a></li>
				<li><a href="index.php" >Konfigurasi</a>
					<ul>
						<li><a href="view2.php" >Data Pegawai</a>
						<li><a href="view.php" >Data Siswa</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="#">Transaksi</a>
			<ul class="sub_menu">
				<li><a href="view3.php" >Nilai</a></li>
			</ul>
		</li>
		<li><a href="#">Bantuan</a>
			<ul class="sub_menu">
				<li><a href="form_cari.php" >Cari Data Siswa</a></li>
				<li><a href="form_cari2.php" >Cari Data Pegawai</a></li>
				<li><a href="form_cari3.php" >Cari Data Nilai</a></li>
			</ul>
		</li>
		<li><a href="#">Laporan</a>
			<ul class="sub_menu">
				<li><a href="form_cetak.php" >Laporan Siswa Tertentu</a></li>
				<li><a href="form_cetak2.php" >Laporan Pegawai Tertentu</a></li>
				<li><a href="form_cetak3.php" >Laporan Nilai Tertentu</a></li>
			</ul>
		</li>
	</ul>
</div>
</body>
</html>
<? } ?>
