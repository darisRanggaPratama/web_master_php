<?php
session_start();
$user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : ''; // cek jika user sudah login
$kary_id = isset( $_GET['kary_id'] ) ? $_GET['kary_id'] : '';
include "fungsi.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Program Penggajian</title>
<link rel="stylesheet" type="text/css" href="images/style.css" />
<script type="text/javascript">
function hitung_gaji() {
	var jam_lembur = document.transfer.jam_lembur.value;
	var uang_lembur = document.transfer.uang_lembur.value;
	var gaji_utama = document.transfer.gaji_utama.value;
	uang_lembur = ( gaji_utama / 173 ) * jam_lembur;
	document.transfer.uang_lembur.value = Math.floor( uang_lembur );
}

function tanya(id) {
	var aa = confirm( 'Yakin akan menghapus data dengan ID - ' + id + '?' );
	if( aa == true ) return true;
	else return false;
}
</script>
</head>
<body>

<?php
// jika user sudah login
if( $user_id ) {
	// ambil data user dari database
	$userdata = mysql_fetch_array( mysql_query( "SELECT * FROM tb_user WHERE user_id='{$user_id}'" ) );
	
	echo "<div class=\"wrap\">\n";
	echo "	<div class=\"header\">\n";
	echo "		<div class=\"h-left\">\n";
	echo "		</div>\n";
	echo "		<div class=\"h-right\">\n";
	echo "			<div class=\"u-info\">\n";
	echo "				<div class=\"u-text\">\n";
	echo "					<div class=\"u-name\">Welcome, <b>{$userdata['fullname']}</b></div>\n";
	echo "					<div class=\"u-link\"><a href=\"".URL."/index.php?page=logout\">Logout Now</a></div>\n";
	echo "				</div>\n";
	echo "				<div class=\"clear\"></div>\n";
	echo "			</div>\n";
	echo "		</div>\n";
	echo "		<div class=\"clear\"></div>\n";
	echo "	</div>\n";
	
	echo "	<div class=\"page\">\n";
	echo "		<div class=\"p-left\">\n";
	echo "			<div class=\"box\">\n";
	echo "				<h1>Menu Utama</h1>\n";
	echo "				<ul class=\"nav\">\n";
	echo "					<li><a href=\"index.php\">Home</a></li>\n";
	echo "					<li><a href=\"index.php?page=daftar-karyawan\">Daftar Karyawan</a></li>\n";
	echo "					<li><a href=\"index.php?page=tambah-karyawan\">Tambah Karyawan</a></li>\n";
	echo "					<li><a href=\"index.php?page=cari-karyawan\">Cari Karyawan</a></li>\n";
	echo "					<li><a href=\"index.php?page=data-gajian\">Data Gajian</a></li>\n";
	echo "					<li><a href=\"index.php?page=logout\">Logout</a></li>\n";
	echo "				</ul>\n";
	echo "			</div>\n";
	echo "		</div>\n";
	echo "		<div class=\"p-right\">\n";

	if( $page == 'daftar-karyawan' ) {
		echo "		<div class=\"box\">\n";
		echo "			<h1>Daftar Karyawan</h1>\n";
		echo "			<p>Berikut daftar karyawan yang terdapat di database.</p>\n";
		echo "			<table border=\"0\">\n";
		echo "			<tr class=\"head\">\n";
		echo "				<td width=\"30\" align=\"center\">No</td>\n";
		echo "				<td width=\"150\">Nama</td>\n";
		echo "				<td width=\"180\">Alamat</td>\n";
		echo "				<td width=\"90\">Gaji Utama</td>\n";
		echo "				<td width=\"30\" align=\"center\">Gol.</td>\n";
		echo "				<td width=\"80\" align=\"center\">Aksi</td>\n";
		echo "			</tr>\n";
		$sql_karyawan = mysql_query( "SELECT * FROM tb_karyawan" );
		if( mysql_num_rows( $sql_karyawan ) == 0 ) {
			echo "		<tr class=\"no-data\"><td colspan=\"6\">Maaf, belum ada data karyawan saat ini</td></tr>\n";		
		} else {
			$no = 1;
			while( $row_karyawan = mysql_fetch_array( $sql_karyawan ) ) {
				echo "	<tr class=\"data\">\n";
				echo "		<td align=\"center\">{$no}</td>\n";
				echo "		<td><a href=\"".URL."/index.php?page=transfer-gaji&kary_id={$row_karyawan['kary_id']}\" title=\"Transfer Gaji &rarr; {$row_karyawan['nama_kar']}\">{$row_karyawan['nama_kar']}</a></td>\n";
				echo "		<td>{$row_karyawan['alamat_kar']}</td>\n";
				echo "		<td>Rp. ".Rupiah( $row_karyawan['gaji_utama'] )."</td>\n";
				echo "		<td align=\"center\">{$row_karyawan['gol_kar']}</td>\n";
				echo "		<td align=\"center\">\n";
				echo "			<a href=\"".URL."/index.php?page=transfer-gaji&kary_id={$row_karyawan['kary_id']}\" title=\"Transfer Gaji &rarr; {$row_karyawan['nama_kar']}\"><img src=\"".URL."/images/s_okay.png\"></a> &nbsp;\n";
				echo "			<a href=\"".URL."/index.php?page=edit-karyawan&kary_id={$row_karyawan['kary_id']}\" title=\"Ubah Karyawan &rarr; {$row_karyawan['nama_kar']}\"><img src=\"".URL."/images/b_edit.png\"></a> &nbsp;\n";
				echo "			<a href=\"".URL."/index.php?page=delete-karyawan&kary_id={$row_karyawan['kary_id']}\" title=\"Hapus Karyawan &rarr; {$row_karyawan['nama_kar']}\" onclick=\"return tanya('".$row_karyawan['kary_id']."')\"><img src=\"".URL."/images/b_drop.png\"></a></td>\n";
				echo "	</tr>\n";
				$no++;
			}
		}
		echo "			</table>\n";
		echo "			<p>Gunakan tombol Edit dan Delete untuk manipulasi data lebih lanjut.</p>\n";
		echo "		</div>\n";	
	} elseif( $page == 'tambah-karyawan' ) {
		echo "		<div class=\"box\">\n";
		echo "			<h1>Tambah Data Karyawan</h1>\n";
		if( isset( $_SESSION['tambah-kar']['gagal'] ) ) {
			echo "		<div class=\"salah\">".$_SESSION['tambah-kar']['gagal']."</div>\n";
			unset( $_SESSION['tambah-kar']['gagal'] );
		}
		echo "			<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"form\">\n";
		echo "				Kode Karyawan:<br><input type=\"text\" name=\"kode_kar\" value=\"".AturKode( "tb_karyawan", "kode_kar", "KR" )."\" disabled=\"disabled\"><br>\n";
		echo "				Nama Karyawan:<br><input type=\"text\" name=\"nama_kar\" placeholder=\"Isi nama karyawan...\" id=\"nama_kar\" autofocus><br>\n";
		echo "				Alamat Karyawan:<br><input type=\"text\" name=\"alamat_kar\" placeholder=\"Isi alamat karyawan...\" id=\"alamat_kar\"><br>\n";
		echo "				Nomor Rekening Karyawan:<br><input type=\"text\" name=\"no_rek\" placeholder=\"Isi nomor rekening karyawan...\" id=\"no_rek\"><br>\n";
		echo "				Gaji Utama Karyawan:<br><input type=\"text\" name=\"gaji_utama\" placeholder=\"Isi gaji utama karyawan...\" id=\"gaji_utama\"><br>\n";
		echo "				Golongan Karyawan:<br><input type=\"text\" name=\"gol_kar\" placeholder=\"Isi golongan karyawan...\" id=\"gol_kar\"><br>\n";
		echo "				<input type=\"submit\" name=\"act\" value=\"Simpan Karyawan\">\n";
		echo "			</form>\n";
		echo "		</div>\n";
	} elseif( $page == 'edit-karyawan' ) {
		$editkar = mysql_fetch_array( mysql_query( "SELECT * FROM tb_karyawan WHERE kary_id='{$kary_id}'" ) );	
		echo "		<div class=\"box\">\n";
		echo "			<h1>Edit Data Karyawan</h1>\n";
		if( isset( $_SESSION['edit-kar']['gagal'] ) ) {
			echo "		<div class=\"salah\">".$_SESSION['edit-kar']['gagal']."</div>\n";
			unset( $_SESSION['edit-kar']['gagal'] );
		}
		echo "			<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"form\">\n";
		echo "				Kode Karyawan:<br><input type=\"text\" name=\"kode_kar\" value=\"{$editkar['kode_kar']}\" disabled=\"disabled\"><br>\n";
		echo "				Nama Karyawan:<br><input type=\"text\" name=\"nama_kar\" value=\"{$editkar['nama_kar']}\" placeholder=\"Isi nama karyawan...\" id=\"nama_kar\" autofocus><br>\n";
		echo "				Alamat Karyawan:<br><input type=\"text\" name=\"alamat_kar\" value=\"{$editkar['alamat_kar']}\" placeholder=\"Isi alamat karyawan...\" id=\"alamat_kar\"><br>\n";
		echo "				Nomor Rekening Karyawan:<br><input type=\"text\" name=\"no_rek\" value=\"{$editkar['no_rek']}\" placeholder=\"Isi nomor rekening karyawan...\" id=\"no_rek\"><br>\n";
		echo "				Gaji Utama Karyawan:<br><input type=\"text\" name=\"gaji_utama\" value=\"{$editkar['gaji_utama']}\" placeholder=\"Isi gaji utama karyawan...\" id=\"gaji_utama\"><br>\n";
		echo "				Golongan Karyawan:<br><input type=\"text\" name=\"gol_kar\" value=\"{$editkar['gol_kar']}\" placeholder=\"Isi golongan karyawan...\" id=\"gol_kar\"><br>\n";
		echo "				<input type=\"submit\" name=\"act\" value=\"Edit Karyawan\">\n";
		echo "			</form>\n";
		echo "		</div>\n";
	} elseif( $page == 'transfer-gaji' ) {
		if( $kary_id ) {
			$transfer = mysql_fetch_array( mysql_query( "SELECT * FROM tb_karyawan WHERE kary_id='{$kary_id}'" ) );		
			echo "		<div class=\"box\">\n";
			echo "			<h1>Transfer Gaji</h1>\n";
			echo "			<p>Harap hati-hati dalam melakukan penginputan data transfer gaji karyawan.</p>\n";
			echo "			<table border=\"0\">\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td width=\"180\">Kode Karyawan</td>\n";
			echo "				<td width=\"350\"><b>: &nbsp; {$transfer['kode_kar']}</b></td>\n";
			echo "				<td width=\"140\">Kode Penggajian</td>\n";
			echo "				<td width=\"130\"><b>: ".AturKode( "tb_gaji", "kode_gaji", "GJ" )."</b></td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Nama Karyawan</td>\n";
			echo "				<td><b>: &nbsp; {$transfer['nama_kar']}</b></td>\n";
			echo "				<td>Bulan Penggajian</td>\n";
			echo "				<td><b>: ".date("F Y")."</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Alamat Karyawan</td>\n";
			echo "				<td><b>: &nbsp; {$transfer['alamat_kar']}</b></td>\n";
			echo "				<td>Tanggal Transfer</td>\n";
			echo "				<td><b>: ".date("d/m/Y")."</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Gaji Utama</td>\n";
			echo "				<td><b>: &nbsp; Rp. ".Rupiah( $transfer['gaji_utama'] )."</b></td>\n";
			echo "				<td>Jam Transfer</td>\n";
			echo "				<td><b>: ".date("H:i:s")."</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Golongan Karyawan</td>\n";
			echo "				<td><b>: &nbsp; {$transfer['gol_kar']}</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Nomor Rekening</td>\n";
			echo "				<td><b>: &nbsp; {$transfer['no_rek']}</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			</table>\n";
			echo "			<p>Gunakan form di bawah untuk melakukan transfer gaji ke rekening karyawan.</p>\n";
			echo "		</div>\n";
			
			echo "		<div class=\"box\">\n";
			if( isset( $_SESSION['gaji']['gagal'] ) ) {
				echo "		<div class=\"salah\">".$_SESSION['gaji']['gagal']."</div>\n";
				unset( $_SESSION['gaji']['gagal'] );
			}
			
			echo "			<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"form\" name=\"transfer\">\n";
			echo "				<input type=\"text\" name=\"jam_lembur\" placeholder=\"Isi total jam lembur\" onkeyup=\"hitung_gaji()\" onkeydown=\"hitung_gaji()\" onchange=\"hitung_gaji()\"> &nbsp; \n";
			echo "				<input type=\"text\" name=\"gaji_utama\" value=\"{$transfer['gaji_utama']}\" style=\"display:none;\">\n";
			echo "				<input type=\"text\" name=\"kode_gaji\" value=\"".AturKode( "tb_gaji", "kode_gaji", "GJ" )."\" style=\"display:none;\">\n";
			echo "				<input type=\"text\" name=\"uang_lembur\" placeholder=\"Uang Lembur\"><br>\n";
			echo "				<input type=\"submit\" name=\"act\" value=\"Transfer Gaji\">\n";
			echo "			</form>\n";
			echo "		</div>\n";
		}
	} elseif( $page == 'data-transfer-gaji' ) {
		if( $kary_id ) {
			echo "		<div class=\"box\">\n";
			echo "			<h1>Data Transfer Gaji</h1>\n";
			echo "			<p>Berikut ini adalah detail proses transfer gaji bulanan untuk karyawan:</p>\n";
			$transfer_gaji = mysql_fetch_array( mysql_query( "SELECT * FROM tb_karyawan k,tb_gaji g WHERE k.kary_id=g.kary_id AND k.kary_id='{$kary_id}'" ) );
			echo "			<table border=\"0\">\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td width=\"180\">Kode Karyawan</td>\n";
			echo "				<td width=\"350\"><b>: &nbsp; {$transfer_gaji['kode_kar']}</b></td>\n";
			echo "				<td width=\"140\">Kode Penggajian</td>\n";
			echo "				<td width=\"130\"><b>: {$transfer_gaji['kode_gaji']}</b></td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Nama Karyawan</td>\n";
			echo "				<td><b>: &nbsp; {$transfer_gaji['nama_kar']}</b></td>\n";
			echo "				<td>Bulan Penggajian</td>\n";
			echo "				<td><b>: {$transfer_gaji['bulan_transfer']}</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Alamat Karyawan</td>\n";
			echo "				<td><b>: &nbsp; {$transfer_gaji['alamat_kar']}</b></td>\n";
			echo "				<td>Tanggal Transfer</td>\n";
			echo "				<td><b>: {$transfer_gaji['tgl_transfer']}</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Gaji Utama</td>\n";
			echo "				<td><b>: &nbsp; Rp. ".Rupiah( $transfer_gaji['gaji_utama'] )."</b></td>\n";
			echo "				<td>Jam Transfer</td>\n";
			echo "				<td><b>: {$transfer_gaji['jam_transfer']}</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Golongan Karyawan</td>\n";
			echo "				<td><b>: &nbsp; {$transfer_gaji['gol_kar']}</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Nomor Rekening</td>\n";
			echo "				<td><b>: &nbsp; {$transfer_gaji['no_rek']}</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\"><td colspan=\"4\"></td></tr>\n";			
			
			echo "			<tr class=\"data\">\n";
			echo "				<td>Total Jam Lembur</td>\n";
			echo "				<td><b>: &nbsp; {$transfer_gaji['jam_lembur']} Jam</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Uang Lembur</td>\n";
			echo "				<td><b>: &nbsp; Rp. ".Rupiah( $transfer_gaji['uang_lembur'] )."</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			<tr class=\"data\">\n";
			echo "				<td>Total Gaji</td>\n";
			echo "				<td><b>: &nbsp; Rp. ".Rupiah( $transfer_gaji['total_gaji'] )."</b></td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "				<td>&nbsp;</td>\n";
			echo "			</tr>\n";
			echo "			</table>\n";
			echo "			<p><a href=\"index.php?page=daftar-karyawan\">Klik untuk transfer gaji karyawan</a></p>\n";
			echo "		</div>\n";
		}
	} elseif( $page == 'data-gajian' ) {
		echo "		<div class=\"box\">\n";
		echo "			<h1>Data Gajian Karyawan</h1>\n";
		echo "			<p>Berikut data gajian karyawan untuk bulan penggajian: <b>".date( "F Y" )."</b></p>\n";
		echo "			<table border=\"0\">\n";
		echo "			<tr class=\"head\">\n";
		echo "				<td width=\"25\" align=\"center\">No</td>\n";
		echo "				<td width=\"180\">Nama</td>\n";
		echo "				<td width=\"90\">Rekening</td>\n";
		echo "				<td width=\"80\">Kode Gaji</td>\n";
		echo "				<td width=\"100\">Transfer</td>\n";
		echo "				<td width=\"60\" align=\"center\">Tanggal</td>\n";
		echo "				<td width=\"60\" align=\"center\">Jam</td>\n";
		echo "			</tr>\n";
		$bulan_transfer = date("F Y"); // bulan transfer
		$data_gajian = mysql_query( "SELECT * FROM tb_karyawan k,tb_gaji g WHERE k.kary_id=g.kary_id AND g.bulan_transfer='{$bulan_transfer}'" );
		if( mysql_num_rows( $data_gajian ) == 0 ) {
			echo "		<tr class=\"no-data\"><td colspan=\"7\">Maaf, belum ada data transfer gajian saat ini</td></tr>\n";		
		} else {
			$no = 1;
			while( $row_gaji = mysql_fetch_array( $data_gajian ) ) {
				echo "	<tr class=\"data\">\n";
				echo "		<td align=\"center\">{$no}</td>\n";
				echo "		<td>{$row_gaji['nama_kar']}</td>\n";
				echo "		<td>{$row_gaji['no_rek']}</td>\n";
				echo "		<td>{$row_gaji['kode_gaji']}</td>\n";
				echo "		<td>Rp. ".Rupiah( $row_gaji['gaji_utama'] )."</td>\n";
				echo "		<td align=\"center\">{$row_gaji['tgl_transfer']}</td>\n";
				echo "		<td align=\"center\">{$row_gaji['jam_transfer']}</td>\n";
				echo "	</tr>\n";
				$no++;
			}
		}
		echo "			</table>\n";
		echo "			<p>&nbsp;</p>\n";
		echo "		</div>\n";
	} elseif( $page == 'cari-karyawan' ) {
		echo "		<div class=\"box\">\n";
		echo "			<h1>Pencarian Data Karyawan</h1>\n";
		echo "			<form method=\"post\" action=\"\" autocomplete=\"off\" class=\"form\">\n";
		echo "				<input type=\"text\" name=\"kata\" id=\"kata\" placeholder=\"Ketik kata kunci pencarian berdasarkan nama, kode, dan golongan...\" autofocus><br>\n";
		echo "				<input type=\"submit\" name=\"act\" value=\"Cari Data\">\n";
		echo "			</form>\n";
		echo "		</div>\n";
		if( $act == 'Cari Data' ) {
			$kata = isset( $_POST['kata'] ) ? $_POST['kata'] : '';
			$katas = ( $kata == "" ) ? "Kata Kunci Pencarian Tidak Disebutkan" : $kata;
			$cari = mysql_query( "SELECT * FROM tb_karyawan WHERE nama_kar LIKE '%$kata%' OR kode_kar LIKE '%$kata%' OR gol_kar LIKE '%$kata%'" );
			echo "		<div class=\"box\">\n";
			echo "			<h1>Daftar Hasil Pencarian Karyawan</h1>\n";
			echo "			<p>Kata Kunci: <b>{$katas}</b> | Jumlah Data: <b>".mysql_num_rows( $cari )."</b> Data</p>\n";
			echo "			<table border=\"0\">\n";
			echo "			<tr class=\"head\">\n";
			echo "				<td width=\"30\" align=\"center\">No</td>\n";
			echo "				<td width=\"150\">Nama</td>\n";
			echo "				<td width=\"180\">Alamat</td>\n";
			echo "				<td width=\"90\">Gaji Utama</td>\n";
			echo "				<td width=\"30\" align=\"center\">Gol.</td>\n";
			echo "				<td width=\"90\" align=\"center\">Rekening</td>\n";
			echo "			</tr>\n";
			if( mysql_num_rows( $cari ) == 0 ) {
				echo "		<tr class=\"no-data\"><td colspan=\"6\">Maaf, belum ada data karyawan saat ini</td></tr>\n";		
			} else {
				$no = 1;
				while( $datacari = mysql_fetch_array( $cari ) ) {
					echo "	<tr class=\"data\">\n";
					echo "		<td align=\"center\">{$no}</td>\n";
					echo "		<td><a href=\"".URL."/index.php?page=transfer-gaji&kary_id={$datacari['kary_id']}\" title=\"Transfer Gaji &rarr; {$datacari['nama_kar']}\">{$datacari['nama_kar']}</a></td>\n";
					echo "		<td>{$datacari['alamat_kar']}</td>\n";
					echo "		<td>Rp. ".Rupiah( $datacari['gaji_utama'] )."</td>\n";
					echo "		<td align=\"center\">{$datacari['gol_kar']}</td>\n";
					echo "		<td align=\"center\">{$datacari['no_rek']}</td>\n";
					echo "	</tr>\n";
					$no++;
				}
			}
			echo "			</table>\n";
			echo "			<p>Hasil pencarian data.</p>\n";
			echo "		</div>\n";
		}
	} else {
		echo "		<div class=\"box\">\n";
		echo "			<h1>Program Penggajian</h1>\n";
		echo "			<p>Pada program ini, memiliki Fiur-fitur:</p>\n";
		echo "			<ul class=\"fitur\">\n";
		echo "				<li>Fitur login dan logout bagi user terdaftar</li>\n";
		echo "				<li>Fitur tambah data karyawan</li>\n";
		echo "				<li>Fitur edit data karyawan</li>\n";
		echo "				<li>Fitur hapus data karyawan</li>\n";
		echo "				<li>Fitur transfer gaji bulanan ke rekening karyawan</li>\n";
		echo "				<li>Fitur pencarian data karyawan</li>\n";
		echo "				<li>Fitur menampilkan data gajian untuk setiap bulan tertentu yang disesuaikan dengan tanggal di sistem komputer</li>\n";
		echo "				<li>Fitur untuk menghitung total uang lembur secara otomatis</li>\n";
		echo "			</ul>\n";
		
		echo "			<p>Untuk memakai Aplikasi Penggajian ini pilih Menu Utama pada Kolom Sebelah Kiri.</p>\n";
		echo "		</div>\n";	
	}
	echo "		</div>\n";
	echo "		<div class=\"clear\"></div>\n";
	echo "	</div>\n";
	echo "	<div class=\"footer\">\n";
	echo "		All Rights Reserved | Copyright &copy; - ".date("Y")." | Program Penggajian by: Yuniar Supardi\n";
	echo "	</div>\n";
	echo "</div>\n";	
} else {
	// user sama sekali belum login, tampilkan form login
	echo "<div class=\"login-box\">\n";
	echo "	<div class=\"login-logo\">\n";
	echo "	</div>\n";
	echo "	<div class=\"login-form\">\n";
	echo "		<div class=\"login-info\">Silahkan login dengan mengisi username dan password</div>\n";
	echo "		<form method=\"post\" action=\"\" name=\"login\" autocomplete=\"off\">\n";
	echo "			<input type=\"text\" name=\"username\" placeholder=\"Ketik Username...\" id=\"username\" autofocus><br>\n";
	echo "			<input type=\"password\" name=\"password\" placeholder=\"Ketik Password...\" id=\"password\"><br>\n";
	echo "			<input type=\"submit\" name=\"act\" value=\"User Login\" onclick=\"cek_login();\">\n";
	echo "		</form>\n";
	if( isset( $_SESSION['login']['gagal'] ) ) {
		echo "	<div class=\"error-login\">".$_SESSION['login']['gagal']."</div>\n";
		unset( $_SESSION['login']['gagal'] );
	}
	echo "	</div>\n";
	echo "	<div class=\"copy\">All Rights Reserved | Copyright &copy; - ".date("Y")." | Program Penggajian by: Yuniar Supardi</div>\n";
	echo "</div>\n";
}
?>

</body>
</html>