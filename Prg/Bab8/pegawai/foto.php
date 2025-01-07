<?php
include "koneksi.php";
?>
<div id="content">
	<h2>Foto Pegawai</h2>
	<div align="center">
	<?
	$nip = (isset($_GET['nip']))? $_GET['nip'] : 0;
	if ($nip ==0) die ("no id selected");
	$query = "SELECT namafoto FROM pegawai WHERE nip='$nip'";
	$sql = mysql_query ($query);
	$hasil = mysql_fetch_array ($sql);
	$foto = $hasil['namafoto'];
	if (empty($foto)) echo "<strong>Foto pegawai tidak tersedia</strong>";
	echo "<img src='images/$foto' />";
	?>
	</div>
</div>