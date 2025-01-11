<?php
date_default_timezone_set( 'Asia/Jakarta' );
mysql_connect( 'localhost', 'root', '' );
mysql_select_db( 'db_penggajian' );
$act = isset( $_POST['act'] ) ? $_POST['act'] : '';
$page = isset( $_GET['page'] ) ? $_GET['page'] : '';

define( 'WEB', 'Program Penggajian' );
define( 'URL', 'http://localhost/program-penggajian' );

function AturKode( $table, $id, $init ) {
	$data = mysql_fetch_array( mysql_query( "SELECT MAX($id) AS kode FROM {$table}" ) );
	$kode = $data['kode'];
	if( $kode ) {
		$kode = substr( $kode, 0, 5 );
		$kode++;
	} else {
		$kode = $init . "001";
	}
	return $kode;
}

function Rupiah( $id ) {
	return number_format( $id, 0, ", ", "." );
}
?>