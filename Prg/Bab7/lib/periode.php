<?php
function periode($url=null) {
	$today = date('m/d/Y');
	$day = date('d');
	$month = date('m');
	$year = date('Y');
	$namabulan = array('1'=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	
	$start = '';
	$end ='';
	if ($url !== null) {
		$start = '<form method="POST" action="'.$url.'">';
		$end = '</form>';
	}
	
	$tanggal = '<input type="text" name="tanggal" size="5">';
	$bulan = '<select name="bulan">';
	for($i=1;$i<=12;$i++){
		$bulan .= '<option value="'.$i.'" ';
		if ($i == $month) {
			$bulan .= 'selected ';
		}
		$bulan .= '>'.$namabulan[$i].'</option>';
	}
	$bulan .='</select>';
	$tahun = '<select name="tahun">';
	for($i=($year-10);$i<=($year+20);$i++){
		$tahun .= '<option value="'.$i.'" ';
		if ($i == $year) {
			$tahun .= 'selected ';
		}
		$tahun .= '>'.$i.'</option>';
	}
	$tahun .= '</select>';
	
	echo $start;
	echo '<input type="radio" name="periode" value="bytanggal"></input>'.$tanggal.'<br>';
	echo '<input type="radio" name="periode" value="bybulan"></input>'.$bulan.'<br>';
	echo '<input type="radio" name="periode" value="bytahun"></input>'.$tahun.'<br>';
	echo $end;
}

?>
