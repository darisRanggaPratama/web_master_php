<?php
include "koneksi.php";

if( $act == 'User Login' ) {
	// cek login user
	$username = isset( $_POST['username'] ) ? $_POST['username'] : '';
	$password = isset( $_POST['password'] ) ? $_POST['password'] : '';
	$salah = array();
	if( empty( $username ) || empty( $password ) ) {
		$salah[] = 'Harap mengisi username dan password.';
	}
	if( !count( $salah ) ) {
		$data = mysql_fetch_array( mysql_query( "SELECT * FROM tb_user WHERE username='{$username}' AND password='".md5( $password )."'" ) );
		if( $data ) {
			$_SESSION['user_id'] = $data['user_id'];
		} else {
			$salah[] = 'Maaf, password Anda salah. Ulangi lagi.';
		}
	}
	if( count( $salah ) ) { $_SESSION['login']['gagal'] = implode( '<br>', $salah ); }
	header( "Location: index.php" );
	exit;
} elseif( $page == 'logout' ) {
	// logout user
	session_destroy();
	header( "Location: index.php" );
	exit;
} elseif( $act == 'Simpan Karyawan' ) {
	// tambah karyawan
	$kode_kar = AturKode( "tb_karyawan", "kode_kar", "KA" ); // kode urut karyawan
	$nama_kar = isset( $_POST['nama_kar'] ) ? $_POST['nama_kar'] : '';
	$alamat_kar = isset( $_POST['alamat_kar'] ) ? $_POST['alamat_kar'] : '';
	$gol_kar = isset( $_POST['gol_kar'] ) ? $_POST['gol_kar'] : '';
	$gaji_utama = isset( $_POST['gaji_utama'] ) ? $_POST['gaji_utama'] : '';
	$no_rek = isset( $_POST['no_rek'] ) ? $_POST['no_rek'] : '';
	$salah = array();
	if( empty( $nama_kar ) || empty( $alamat_kar ) || empty( $gaji_utama ) || empty( $gol_kar ) ) {
		$salah[] = 'Harap mengisi seluruh data karyawan yang diperlukan';
	}
	if( !count( $salah ) ) {
		if( mysql_num_rows( mysql_query( "SELECT * FROM tb_karyawan WHERE kode_kar='{$kode}'" ) ) == 0 ) {
			mysql_query( "INSERT INTO tb_karyawan VALUES( '', '{$kode_kar}', '{$nama_kar}', '{$alamat_kar}', '{$no_rek}', '{$gaji_utama}', '{$gol_kar}' )" );
		} else {
			$salah[] = 'Kode karyawan ini sudah ada sebelumnya';
		}
	}
	if( count( $salah ) ) { $_SESSION['tambah-kar']['gagal'] = implode( '<br>', $salah ); }
	if( count( $salah ) ) {
		header( "Location: index.php?page=tambah-karyawan" );
	} else {
		header( "Location: index.php?page=daftar-karyawan" );
	}
	exit;
} elseif( $act == 'Edit Karyawan' ) {
	$kary_id = isset( $_GET['kary_id'] ) ? $_GET['kary_id'] : '';
	$kary = mysql_fetch_array( mysql_query( "SELECT * FROM tb_karyawan WHERE kary_id='{$kary_id}'" ) );
	$nama_kar = isset( $_POST['nama_kar'] ) ? $_POST['nama_kar'] : '';
	$alamat_kar = isset( $_POST['alamat_kar'] ) ? $_POST['alamat_kar'] : '';
	$gol_kar = isset( $_POST['gol_kar'] ) ? $_POST['gol_kar'] : '';
	$gaji_utama = isset( $_POST['gaji_utama'] ) ? $_POST['gaji_utama'] : '';
	$no_rek = isset( $_POST['no_rek'] ) ? $_POST['no_rek'] : '';
	$salah = array();
	$nama_kar = ( $kary['nama_kar'] == "" ) ? $kary['nama_kar'] : $nama_kar;
	$alamat_kar = ( $kary['alamat_kar'] == "" ) ? $kary['alamat_kar'] : $alamat_kar;
	$no_rek = ( $kary['no_rek'] == "" ) ? $kary['no_rek'] : $no_rek;
	$gaji_utama = ( $kary['gaji_utama'] == "" ) ? $kary['gaji_utama'] : $gaji_utama;
	$gol_kar = ( $kary['gol_kar'] == "" ) ? $kary['gol_kar'] : $gol_kar;
	if( !count( $salah ) ) {
		mysql_query( "UPDATE tb_karyawan SET nama_kar='{$nama_kar}', no_rek='{$no_rek}', alamat_kar='{$alamat_kar}', gaji_utama='{$gaji_utama}', gol_kar='{$gol_kar}' WHERE kary_id='{$kary_id}'" );
	}
	if( count( $salah ) ) { $_SESSION['edit-kar']['gagal'] = implode( '<br>', $salah ); }
	if( count( $salah ) ) {
		header( "Location: index.php?page=edit-karyawan&kary_id=$kary_id" );
	} else {
		header( "Location: index.php?page=daftar-karyawan" );
	}
	exit;
} elseif( $act == 'Transfer Gaji' ) {
	// proses penggajian
	$kary_id = isset( $_GET['kary_id'] ) ? $_GET['kary_id'] : '';
	$jam_lembur = isset( $_POST['jam_lembur'] ) ? $_POST['jam_lembur'] : '';
	$uang_lembur = isset( $_POST['uang_lembur'] ) ? $_POST['uang_lembur'] : '';
	$kode_gaji = AturKode( "tb_gaji", "kode_gaji", "GJ" ); // kode urut gaji
	$bulan_transfer = date("F Y"); // bulan transfer
	$tgl_transfer = date("d/m/Y"); // tanggal transfer
	$jam_transfer = date("H:i:s"); // jam transfer
	$salah = array();
	
	// ambil data karyawan
	$karyawan = mysql_fetch_array( mysql_query( "SELECT * FROM tb_karyawan WHERE kary_id='{$kary_id}'" ) );
	$total_gaji = $uang_lembur + $karyawan['gaji_utama']; // total gaji
	
	if( empty( $jam_lembur ) ) { 
		$salah[] = 'Harap mengisi total jam lembur karyawan'; 
	}
	
	if( !count( $salah ) ) {
		mysql_query( "INSERT INTO tb_gaji VALUES( '', '{$kary_id}', '{$kode_gaji}', '{$jam_lembur}', '{$uang_lembur}', '{$total_gaji}', '{$bulan_transfer}', '{$tgl_transfer}', '{$jam_transfer}' )" );
	}
	if( count( $salah ) ) { $_SESSION['gaji']['gagal'] = implode( '<br>', $salah ); }
	if( count( $salah ) ) {
		header( "Location: index.php?page=transfer-gaji&kary_id=$kary_id" );
	} else {
		header( "Location: index.php?page=data-transfer-gaji&kary_id=$kary_id" );
	}
	exit;
} elseif( $page == 'delete-karyawan' ) {
	$kary_id = isset( $_GET['kary_id'] ) ? $_GET['kary_id'] : '';
	mysql_query( "DELETE FROM tb_karyawan WHERE kary_id='{$kary_id}'" );
	header( "Location: index.php?page=daftar-karyawan" );
	exit;
}
?>