<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$root = 'http://localhost/kasirserver/'; 
include $path.'/kasirserver/lib/koneksi.php';
include $path.'/kasirserver/lib/SafeSQL.class.php';

class posting {
	
	private $tujuan;
	private $value;
	private $triger;
	private $koneksi;
	private $status = 'ok';
	private $safe;
	private $paths;
	private $roots;
	private $multi = false;
	
	public function __construct($koneksi,$triger,$value,$paths = '',$roots='') {
		$this->koneksi = $koneksi;
		$this->triger = $triger;
		$this->value = $value;
		$this->paths = $paths;
		$this->roots = $roots;
		$this->safe =& new SafeSQL_MySQL($koneksi);
	}
	
	public function isMulti($status) {
		$this->multi = $status;
	}
	
	private function setTujuan($url,$limit) {
		if (!isset($url)) {
			$url = $_SERVER['PHP_SELF'];
		}
		if (!isset($limit)) {
			$limit = 0;
		}
		$tujuan = '';
		$tujuan .='<meta http-equiv="refresh" content="'.$limit.'; url='.$url.'">';
		
		$this->tujuan = $tujuan;
	}
	
	private function isNull($myarray) {
		if (is_array($myarray)) {
			foreach ($myarray as $key => $nilai) {
				if (is_null($nilai) || $nilai == '') {
					return true;
					break;
				}
			}
		} else {
			if (is_null($nilai) || $nilai == '') {
				return true;
				break;
			}
		}
	}
	
	private function proses($table, $field) {
		if (isset($this->triger)) {
			if (!empty($this->value)) {
				//array check
				if (is_array($this->value)) {
					if (!is_array($field)) {
						$this->status = 'error';
					} else {
						if (count($field) ==! count($this->value)) {
							$this->status = 'error';
						} else {
							if ($this->isNull($this->value)) {
								$this->status = 'error';
							} else {
								$clausa = "SELECT * FROM ".$table." WHERE ";
								foreach ($field as $key => $value) {
									$field[$key] = $value." ='%s'";
								}
								$neo = implode(' and ',$field);
								$clausa .= $neo;
								$query = $this->safe->query($clausa,$this->value);
								$cari = $this->koneksi->query($query);
								$row = $cari->num_rows;
								
								if ($row >= 1) {
									$this->koneksi->close;
									$this->status = 'sama';
								} else {
									$this->status = 'ok';
								}
							}
						}
					}
				} else {
					$query = $this->safe->query("SELECT * FROM ".$table." WHERE ".$field."='%s'",array($this->value)); 
					$cari = $this->koneksi->query($query);
					$row = $cari->num_rows;
					
					if ($row >= 1) {
						$this->koneksi->close;
						$this->status = 'sama';
					} else {
						$this->status = 'ok';
					}
				}
			} else {
				$this->status = 'null';
			}
		} else {
			$this->status= 'error';
		}	
	}
	
	private function setUpload($file) {
		$asal = $file['tmp_name'];
		$nama = $file['name'];
		$ukuran = $file['size'];
		$tipe = $file['type'];
		$this->paths = $this->paths.'/'.$nama;
		$this->roots = $this->roots.'/'.$nama;
		$maks = 1000000;
		
		if ($tipe != "image/gif" AND $tipe != "image/jpeg" AND $tipe != "image/pjpeg" AND $tipe != "image/png") {
			$this->status = 'gambar';
			return false;
		} elseif ( $ukuran > $maks ) {
			$this->status = 'gambar';
			return false;
		} elseif (file_exists($direktory)){
			$this->status = 'gambar';
			return false;
		} else {
			if (move_uploaded_file($asal,$this->paths)){
				return true;
			}else {
				return false;	
			}
		}
	}
	
	private function getError ($url,$limit) {
		switch ($this->status){
			case 'null':
				echo 'Data Anda kosong dan harus diisi';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'sama':
				echo 'Data sudah ada, coba cek kembali';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'error':
				echo 'Data Belum Vallid';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'gambar':
				echo 'gambar tidak Vallid';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
		}
		
	}
	public function getResult($table,$field,$url,$limit) {
		if ($this->multi == true) {
			$this->proses($table,$field);
			if ($this->status == 'ok') {
				//upload
				if (isset($this->value['file'])) {
					if (!$this->setUpload($this->value['file'])) {
						$this->koneksi->close;
						$this->getError($url,$limit);
						die;
					}
					$this->value['file'] = $this->roots;
					$this->value = array_values($this->value);
				}
				//end of upload
				$field = implode(',',$field);
				
				$hitungValue = count($this->value);
				$parameter = "'%s'";
				$value=array();
				
				for ($i=0;$i<$hitungValue;$i++){
					$value[$i] = $parameter;
				}
				$break = implode(',',$value);
				
				$final_query = $this->safe->query("INSERT INTO ".$table." (".$field.") values (".$break.");",$this->value);
				$this->koneksi->query($final_query);
				$this->setTujuan($url,3);
				echo $this->tujuan;	
				$this->koneksi->close;	
			} else {
				$this->getError($url,$limit);
				print_r($this->value);
				$this->koneksi->close;
			}
		} else {
			$this->proses($table,$field);
			if ($this->status == 'ok') {
				$final_query = $this->safe->query("insert into ".$table." (".$field.") values ('%s')",array($this->value));
				$this->koneksi->query($final_query);
				$this->setTujuan($url,0);
				echo $this->tujuan;	
				$koneksi->close;	
			} else {
				$this->getError($url,$limit);
				$this->koneksi->close;
			}
		}
		
	}
	
}



class update {
	
	private $koneksi;
	private $safe;
	private $table;
	private $id;
	private $value;
	private $field;
	private $sequreSql;
	private $status = 'ok';
	private $tujuan;
	private $pk;
	private $triger;
	private $file = '';
	private $paths;
	private $roots;
	private $penampung;
	
	public function __construct($koneksi) {
		$this->koneksi = $koneksi;
		$this->safe =& new SafeSQL_MySQL($koneksi);
	}
	
	public function setTable($table,$field,$value,$id,$triger) {
		$this->table = $table;
		$this->field = $field;
		$this->id = $id;
		$this->value = $value;
		if (is_int($triger)) {
			$this->triger=$triger;
		} else {
			$this->triger = '';
		}
	}
	
	public function updateGambar($file,$penampung,$paths = '', $roots = '') {
		$this->file = $file;
		$this->penampung = $penampung;
		$this->paths = $paths;
		$this->roots = $roots;
	}
	
	private function filter() {
		if (isset($this->triger)) {
			if (!empty($this->value) || $this->value ==! '') { 
				if (!is_array($this->value)) {
					$this->status = 'ok';
				} else {
					if (is_array($this->field)) {
						if (!$this->isNull($this->value)) {
							if (!isset($this->file)) {
								if ($this->setUpload($this->file)) {
									$this->status = 'ok';
									$this->value = array_push($this->value,$this->roots);
									$this->field = array_push($this->field,$this->penampung);
								} else {
									$this->status = 'gambar';
								}
							} else {
								$this->status='ok';	
							}
						} else {
							$this->status='elemen';
						}
					} else {
						$this->status='field';
					}
				}
			} else {
				$this->status='null';
			}
		} else {
			$this->status = 'error';
		}
	}
	
	private function isNull($myarray) {
		foreach ($myarray as $key => $nilai) {
			if (is_null($nilai) || $nilai == '') {
				return true;
				break;
			}
		}
	}
	
	private function setTujuan($url,$limit) {
		if (!isset($url)) {
			$url = $_SERVER['PHP_SELF'];
		}
		if (!isset($limit)) {
			$limit = 0;
		}
		$tujuan = '';
		$tujuan .='<meta http-equiv="refresh" content="'.$limit.'; url='.$url.'">';
		
		$this->tujuan = $tujuan;
	}
	
	private function createSQL() {
		$sql = "UPDATE ".$this->table." SET ";
		$this->getPK();
		if (!is_array($this->value)) {
			$sql .= "".$this->field."='%s' WHERE ".$this->pk."=".$this->id."";
		} else {
			$merge = array();
			$jml = count($this->field);
			for ($i=0;$i<$jml;$i++) {
				$merge[$i] = $this->field[$i]."='%s'";
			}
			$fields = implode(',',$merge);
			$sql .= "".$fields." WHERE ".$this->pk."=".$this->id."";
		}
		$this->sequreSql = $sql;
	}
	
	private function getPK() {
		$sql = "SHOW KEYS FROM ".$this->table;
		$query = $this->koneksi->query($sql);
		while ($row = $query->fetch_assoc()) {
			if ($row['Key_name'] == 'PRIMARY') {
				$this->pk = $row['Column_name'];
			}
		}
	}
	
	private function getError($url,$limit) {
		switch ($this->status) {
			case 'null' :
				echo 'Tidak ada data yang dikirimkan';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'field' :
				echo 'Jumlah field tidak sesuai dengan jumlah value';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'elemen' :
				echo 'Salah satu inputan ada yang kosong';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'error' :
				echo 'Terjadi kesalahan';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
			case 'gambar' :
				echo 'gambar tidak valid';
				$this->setTujuan($url,$limit);
				echo $this->tujuan;
				break;
		}
	}
	
	private function setUpload($file) {
		$asal = $file['tmp_name'];
		$nama = $file['name'];
		$ukuran = $file['size'];
		$tipe = $file['type'];
		$this->paths = $this->paths.'/'.$nama;
		$this->roots = $this->roots.'/'.$nama;
		$maks = 1000000;
		
		if ($tipe != "image/gif" AND $tipe != "image/jpeg" AND $tipe != "image/pjpeg" AND $tipe != "image/png") {
			$this->status = 'gambar';
			return false;
		} elseif ( $ukuran > $maks ) {
			$this->status = 'gambar';
			return false;
		} elseif (file_exists($direktory)){
			$this->status = 'gambar';
			return false;
		} else {
			if (move_uploaded_file($asal,$this->paths)){
				return true;
			}else {
				return false;	
			}
		}
	}
		
	public function getResult($url,$limit) {
		$this->filter();
		if ($this->status == 'ok') {
			$this->createSQL();
			is_array($this->value) ? $value = $this->value : $value = array($this->value);
			$final_query = $this->safe->query($this->sequreSql,$value);
			$this->koneksi->query($final_query);
			$this->setTujuan($url,$limit);
			echo $this->tujuan;	
			$this->koneksi->close;	
		} else {
			$this->getError($url,5);
			$this->koneksi->close;
		}
	}

}

?>
