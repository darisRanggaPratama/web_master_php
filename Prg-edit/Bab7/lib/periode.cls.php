<?php
class periode {
	private $today;
	private $day;
	private $month;
	private $year;
	private $namabulan = array('1'=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	private $start = '';
	private $end ='';
	
	public function __construct($url = null){
		$this->today = date('d/m/Y');
		$this->day = date('d');
		$this->month = date('m');
		$this->year = date('Y');
		if ($url !== null) {
			$this->start = '<form method="POST" action="'.$url.'">';
			$this->end = $this->submit().'</form>';
		}
	}
	
	private function tanggal($datename) {
	$tanggal = '<input type="text" name="'.$datename.'" size="10" value="'.$this->today.'">';
	return $tanggal;
	}
	
	private function bulan($monthname) {
	$bulan = '<select name="'.$monthname.'">';
	for($i=1;$i<=12;$i++){
		$bulan .= '<option value="'.$i.'" ';
		if ($i == $this->month) {
			$bulan .= 'selected ';
		}
		$bulan .= '>'.$this->namabulan[$i].'</option>';
	}
	$bulan .='</select>';
	return $bulan;
	}
	
	private function tahun($yearname) {
	$tahun = '<select name="'.$yearname.'">';
	$years = $this->year;
	for($i=($years-10);$i<=($years+20);$i++){
		$tahun .= '<option value="'.$i.'" ';
		if ($i == $this->year) {
			$tahun .= 'selected ';
		}
		$tahun .= '>'.$i.'</option>';
	}
	$tahun .= '</select>';
	return $tahun;
	}
	
	private function submit($namebutton="tombol",$value="kirim") {
	$tombol = '<input type="submit" name="'.$namebutton.'" value="'.$value.'">';
	return $tombol;
	}
	
	public function show_periode() {
	echo $this->start;
	echo '<input style="float:left;" type="radio" name="periode" value="bytanggal"><label>Tanggal</label> '.$this->tanggal("bytanggalawal").' s/d '.$this->tanggal("bytanggalakhir").'</input><br>';
	echo '<input style="float:left;" type="radio" name="periode" value="bybulan"><label>Bulan</label> '.$this->bulan("bulanbybulan").' Tahun '.$this->tahun("tahunbybulan").'</input><br>';
	echo '<input style="float:left;" type="radio" name="periode" value="bytahun"><label>Tahun</label> '.$this->tahun("bytahun").'</input><br>';
	echo $this->end;
	}
}

/*
function filter_periode($periode) {
	switch ($periode) {
		case 'bytanggal':
		$hasil = $_POST['bytanggalawal'].' s/d '.$_POST['bytanggalakhir'];
		return $hasil;
		
		case 'bybulan':
		$hasil = $_POST['bulanbybulan'].' tahun '.$_POST['tahunbybulan']; ;
		return $hasil;
		
		case 'bytahun':
		$hasil = $_POST['bytahun'];
		return $hasil;
		
		case null:
		$hasil = 'Tidak ada item ter posting';
		return $hasil;
	}
};
*/ 
