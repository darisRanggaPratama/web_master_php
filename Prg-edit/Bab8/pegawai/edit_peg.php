<?php
include "koneksi.php";

if (isset($_GET['nip'])) {
	$nip = $_GET['nip'];
} else {
	die ("Error. No Nip Selected! ");	
}

$query = "SELECT nip, nama, tgllahir, jenkel, alamat, namafoto FROM pegawai WHERE nip='$nip'";
$sql = mysql_query ($query);
$hasil = mysql_fetch_array ($sql);
$nip = $hasil['nip'];
$nama = stripslashes ($hasil['nama']);
$jenkel = $hasil['jenkel'];
list($thn,$bln,$tgl) = explode ("-",$hasil['tgllahir']);
$alamat = stripslashes ($hasil['alamat']);
$namafoto = stripslashes ($hasil['namafoto']);

//proses edit berita
if (isset($_POST['Edit'])) {
	$nip = $_POST['hnip'];
	$nama = addslashes (strip_tags ($_POST['nama']));
	$tgllahir = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$jenkel = $_POST['jenkel'];
	$alamat = addslashes (strip_tags ($_POST['alamat']));
	$namafoto = $_FILES['foto']['name'];
	if (strlen($namafoto)>0) {
		//upload
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			move_uploaded_file ($_FILES['foto']['tmp_name'], "images/".$namafoto);
			mysql_query ("UPDATE pegawai SET namafoto='$namafoto' WHERE nip='$nip'");
		}
	}
	//update data
	$query = "UPDATE pegawai SET nama='$nama',tgllahir='$tgllahir',jenkel='$jenkel',
			  alamat='$alamat' WHERE nip='$nip'";
	$sql = mysql_query ($query);
	if ($sql) {
		echo "<h2><font color=blue>Data Pegawai telah berhasil diedit</font></h2>";	
	} else {
		echo "<h2><font color=red>Data Pegawai gagal diedit</font></h2>";	
	}
}
?>
<div id="content">
	<h2>Edit Data Pegawai</h2>
	<FORM ACTION="" METHOD="POST" NAME="input" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" border="0" width="700">
			
			<tr>
				<td width="200">NIP</td>
				<td>: <b><?=$nip?></b></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>: <input type="text" name="nama" size="30" maxlength="30" value="<?=$nama?>"></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>: 
				<select name="tgl">
				<?
					for ($i=1; $i<=31; $i++) {
						$tg = ($i<10) ? "0$i" : $i;
						$sele = ($tg==$tgl)? "selected" : "";
						echo "<option value='$tg' $sele>$tg</option>";	
					}
				?>
				</select> - 
				<select name="bln">
				<?
					for ($i=1; $i<=12; $i++) {
						$bl = ($i<10) ? "0$i" : $i;
						$sele = ($bl==$bln)?"selected" : "";
						echo "<option value='$bl' $sele>$bl</option>";	
					}
				?>
				</select> - 
				<select name="thn">
				<?
					for ($i=1970; $i<=2000; $i++) {
						$sele = ($i==$thn)?"selected" : "";
						echo "<option value='$i' $sele>$i</option>";	
					}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>: <input type="radio" name="jenkel" value="0" <? echo ($jenkel==0)?"checked":""; ?>> Pria &nbsp;&nbsp;
				<input type="radio" name="jenkel" value="1" <? echo ($jenkel==1)?"checked":""; ?>> Wanita</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>: <textarea name="alamat" cols="40" rows="5"><?=$alamat?></textarea></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>: <input type="file" name="foto"/> Foto: <?=$namafoto?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;&nbsp;
				<input type="hidden" name="hnip" value="<?=$nip?>">
				<input type="submit" name="Edit" value="Edit Data">&nbsp;
				<input type="reset" name="reset" value="Reset"></td>
			</tr>
		</table>
	</FORM>
</div>