<?php

class form_generator {
	private $action;
	private $method;
	private $name;
	private $form;
	private $input = '';
	private $koneksi;
	private $enctype;
	
	
	function __construct ($action, $enctype = false, $method = 'post', $name = 'frm') {
		$this->action = $action;
		$this->method = $method;
		$this->name = $name;
		$this->enctype = $enctype;
	}
	
	function showForm() {
		if (!empty($this->input)) {
			$this->form = '<form method="' .
				$this->method. '"action="' .
				$this->action. '" name="' .
				$this->name. '"';
			if ($this->enctype == true) {
				$this->form .=' enctype="multipart/form-data">';
			} else {
				$this->form .='>';
			}
			$this->form .= $this->input;
			$this->form .= '</form>';
			echo $this->form;
		} else {
			return false;
		}
	}
	
	function addLabel ($prop) {
		if (isset($prop['label'])) {
			return '<label>' .$prop['label']. '</label>';
		} else {
			return false;
		}
	}
	
	function isField ($prop) {
		return (is_array($prop) && !empty($prop)) ? true:false;
	} 
	
	function addInput ($prop, $enable = true , $default = false, $next = true) {
		if ($this->isField($prop)) {
			$field = $this->addLabel($prop);
			$field .= '<input type="text" ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="' .$val.'" ';
			}
			if (!$enable) {
				$field .= ' disabled ';
			}
			if ($default) {
				$val = isset($_REQUEST[$prop['name']]) ? ($_REQUEST[$prop['name']]) : '';
				$field .= 'value="'.$val.'"';
			}
			if ($next) {
				$this->input .= $field .'/><br />';
			} else {
				$this->input .= $field .'/>';
			}
		}
	}
	
	function addPassword ($prop, $default = false) {
		if ($this->isField($prop)) {
			$field = $this->addLabel($prop);
			$field .= '<input type="password" ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="' .$val.'" ';
			}
			if ($default) {
				$val = isset($_REQUEST[$prop['name']]) ? ($_REQUEST[$prop['name']]) : '';
				$field .= 'value="'.$val.'"';
			}
			$this->input .= $field .' /><br />';
		}
	}
	
	function addFile ($prop, $default = false) {
		if ($this->isField($prop)) {
			$field = $this->addLabel($prop);
			$field .= '<input type="file" ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="' .$val.'" ';
			}
			if ($default) {
				$val = isset($_REQUEST[$prop['name']]) ? ($_REQUEST[$prop['name']]) : '';
				$field .= 'value="'.$val.'"';
			}
			$this->input .= $field .' /><br />';
		}
	}
	
	function addHidden ($prop, $default = false) {
		if ($this->isField($prop)) {
			$field = $this->addLabel($prop);
			$field .= '<input type="hidden" ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="' .$val.'" ';
			}
			if ($default) {
				$val = isset($_REQUEST[$prop['name']]) ? ($_REQUEST[$prop['name']]) : '';
				$field .= 'value="'.$val.'"';
			}
			$this->input .= $field .' /><br />';
		}
	}
	
	function addTextArea ($prop, $default = false) {
		if ($this->isField($prop)) {
			$field = $this->addLabel($prop);
			$field .= '<textarea ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="' .$val.'" '; 
			}
			$value = '';
			if (isset($prop['value'])) {
				$value = $prop['value'];
			}
			/*
			if ($default) {
				$value = isset($_REQUEST[$prop['name']]) ? ($_REQUEST[$prop['name']]) : '';
			}
			*/
			$this->input .= $field. '>'. $value. '</textarea><br />';
		}
	}
	
	function addSubmit ($prop) {
		if ($this->isField($prop)) {
			$field = '<input type="submit" ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="'.$val.'" ';
			}
			$this->input .= $field .' /><br />';
		}
	}
	
	function addDrop($koneksi,$prop,$opsi,$default = false, $next = true) {
		if (isset($koneksi) || $koneksi ==! '') {
			$this->koneksi = $koneksi;
		} else {
			die;
		}
		if ($this->isField($prop)) {
			$field = $this->addLabel($prop);
			$field .= '<SELECT ';
			foreach ($prop as $key => $val) {
				$field .= $key. '="' .$val.'" ';
			}
			if ($default) {
				$val = isset($_REQUEST[$prop['name']]) ? ($_REQUEST[$prop['name']]) : '';
				$field .= 'value="'.$val.'"';
			}
			$this->input .= $field .'>';
			
			//Penambahan Opsi
			if ($this->isField($opsi)) {
				$sql = 'SELECT * FROM '.$opsi['tabel'];
				$query = $this->koneksi->query($sql) or die;
				//default
				$pilihan = '';
				if (is_array($opsi['default'])) {
					$pilihan = '';
				} else {
					$pilihan = '<option selected>'.$opsi['default'].'</option>';
				}
				while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
					
					if (is_array($opsi['default'])) {
						if (isset($opsi['default']['value']) && isset($opsi['default']['pilihan'])) {
							if ($opsi['default']['value'] == $row[$opsi['id']]) {
								$pilihan .= '<option value="'.$opsi['default']['value'].'" selected>'.$opsi['default']['pilihan'].'</option>';
							} else {
								$pilihan .= '<option value="'.$row[$opsi['id']].'">'.$row[$opsi['field']].'</option>';
							}
						} else {
						$pilihan .= '<option selected>--KOSONG--</option>';
						}
					} else {
						$pilihan .= '<option value="'.$row[$opsi['id']].'">'.$row[$opsi['field']].'</option>';
					}
				}
				$this->input .= $pilihan;
			}
			if ($next) {
				$this->input .= '</SELECT><br />';
			} else {
				$this->input .= '</SELECT>';
			}
			
		}
	}
	
	function endDrop() {
		$this->koneksi->close();
	}		
}

?>
