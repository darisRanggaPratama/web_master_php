<?php

class paginasi {
	private $conn;
	private $root;
	private $rows;
	private $total_rows;
	private $links;
	private $sql;
	private $pages;
	private $max;
	
	function __construct ($conn, $sql, $root, $rows, $links ) {
		$this->conn = $conn;
		$this->sql = $sql;
		$this->root = $root;
		$this->rows = $rows;
		$this->links = $links;
		if (isset($_GET['pages'])) {
			$this->pages = intval($_GET['pages']);
		}
	}
	
	function paging () {
		$rs1 = $this->conn->query($this->sql);
		if (!$rs1) {
			return false;
		}
		
		
		$this->total_rows = $rs1->num_rows;
		$rs1->close;
		
		$this->max = ceil($this->total_rows / $this->rows);
		
		if ($this->pages > $this->max || $this->pages <= 0) {
			$this->pages = 1;
		}
		
		//kalkulasi offset
		$offset = $this->rows * ($this->pages-1);
		
		$rs = $this->conn->query($this->sql.
		' LIMIT '.$offset.', '.$this->rows);
		
		if (!$rs) {
			return false;
		}
		return $rs;
	}
	
	public function showPaging() {
		$pager = '';
		
		if ($this->max > 1) {
			$pager .='<div class="pager">';
			
			//--------------PREV LINKS---------------
			if ($this->pages > 1) {
				$pager .='<a class="linkpage" href="'.$this->root.'&pages='.($this->pages - 1).'">Prev</a>-';
			}else{
				$pager .='<span class="off">Prev</span>';
			}
			
			//--------------Bagian yang membingungkan--------
			if ($this->max < 7 + ($this->links * 2)) {
				//tidak cukup mensplit link
				for ($i = 1;$i <= $this->max;$i++) {
					if ($i == $this->pages) {
						$pager .='<span class="on"> '.$i.'</span>';
					}else{
						$pager .='<a class="linkpage" href="'.$this->root.'&pages='.$i.'"> '.$i.'</a>';
					}
				}
			} elseif ($this->max > 5 + ($this->links * 2)) {
				//cukup untuk mensplit links 
				//split di belakang
				if ($this->pages < 1 + ($this->links * 2)) {
					for ($i = 1;$i < 4 + ($this->links * 2);$i++) {
						if ($i == $this->pages) {
							$pager .='<span class="on"> '.$$i.'</span>';
						}else{
							$pager .='<a class="linkpage" href="'.$this->root.'&pages='.$i.'"> '.$i.'</a>';
						}
					}
					$pager .='...';
					$pager .='<a class="linkpage" href="'.$this->root.'&pages='.($this->max - 1).'"> '.($this->max - 1).'</a>';
				
				//split bagian depan dan belakang
				} elseif ($this->max - ($this->links * 2) > $this->pages && $this->pages > ($this->links * 2)) {
					$pager .= '<a class="linkpage" href="'.$this->root.'&pages=2"> 2</a>';
					$pager .= '...';
					for ($i= $this->pages - $this->links;$i <= $this->pages + $this->links;$i++) {
						if ($i == $this->pages) {
							$pager .='<span class="on"> '.$i.'</span>';
						}else{
							$pager .='<a class="linkpage" href="'.$this->root.'&pages='.$i.'"> '.$i.'</a>';
						}
					}
					$pager .='...';
					$pager .='<a class="linkpage" href="'.$this->root.'&pages='.($this->max - 1).'"> '.($this->max - 1).'</a>';
				
				//split di depan
				} else {
					$pager .='<a class="linkpage" href="'.$this->root.'&pages=2"> 2</a>';
					$pager .='...';
					for ($i= $this->max - (2 + ($this->links * 2));$i <= $this->max;$i++) {
						if ($i == $this->pages) {
							$pager .='<span class="on"> '.$i.'</span>';
						}else{
							$pager .='<a class="linkpage" href="'.$this->root.'&pages='.$i.'"> '.$i.'</a>';
						}
					}
				}
			} 
			
			//---LINK NEXT------
			if ($this->pages < $i - 1) {
				$pager .='-<a class="linkpage" href="'.$this->root.'&pages='.($this->pages + 1).'"> Next</a>';
			}else{
				$pager .='<span class="off"> Next</span>';
			}
			
			
			$pager .='</div>';
		}
		
		echo $pager;
	}
	
}

?>
