<?php

class genTabCetak {
	private $rs;
	private $num =1;
	private $numRow = true;
	private $rowColor = true;
	private $fieldColor = false;
	
	public function __construct($rs) {
		$this->rs = $rs;
	}
	
	public function setData($rs) {
		$this->rs = $rs;
	}
	
	public function showNumber($numRow, $num = 1) {
		$this->numRow = $numRow;
		$this->num = $num;
	}
	
	public function showRowColor($rowColor) {
		$this->rowColor = $rowColor;
		$this->fldColor = 0;
	}
	
	public function showFieldColor($fldColor) {
		$this->fldColor = $fldColor;
	}
	
	public function showTable() {
		$page = $_GET['pages'];
		if (!isset($page)){
			$this->num = 1;
		}else{
			$this->num = (10*($page-1)) + 1;
		}
		
		if ($this->rs->num_rows == 0) {
			?> 
			
			<div id="noconten" style="
				width:636px;
				background-color:#FFE8E8;
				border:solid 1px #FF8B8B;
				color:red;
				font-size:20px;
				text-align:center;
				padding:20px 0;
			">
			
			Data Tidak Ditemukan
			
			</div>
			
			<?php
		}else{
		?>
		<table
		cellspacing="0" border="1em" style="font-size:12px;"
		>
		<tr align="center" bgcolor="#000000">
			<th bgcolor="#000000" style="color:#FFFFFF;padding:0 5px;">
			<?php echo $this->numRow ? 'No' : ''; ?>
			</th>
		
		<?php
		$numFld = $this->rs->field_count;
		while ($fld = $this->rs->fetch_field()) {
			?>
			<th bgcolor="#000000" style="color:#FFFFFF;padding:0 5px;">
			<?php echo ucwords($fld->name); ?>
			</th>
			<?php
		}
		?>
		</tr>
		
		<?php
		while ($row = $this->rs->fetch_row()) {
			if ($this->rowColor) {
				(($this->num % 2) != 0) ? $bgr = '#C4DEF2' : $bgr='#FFFFFF'; ?>
				<tr bgcolor="<?php echo $bgr; ?>">
				<?php 
			}
			?>
					<td align="center" style="padding:0 10px;">
						<?php echo $this->numRow ? $this->num : ''; ?>
					</td>
			<?php
			for ($i=0;$i<$numFld;$i++) {
				if ($this->fieldColor) {
					(($i % 2) != 0) ? $bgf='#cccccc' : $bgf='#ffffff';
					?>
					<td align="center" bgcolor="<?php echo $bgf; ?>"  style="padding:0 10px;">
					<?php
						echo $row[$i];
					?>
					</td>
					<?php
				} else {
					?>
					<td align="center"><?php echo $row[$i]; ?></td>
					<?php
				}
			}
			?>
				</tr>
		<?php $this->num++;
		}
		?>
		</table><br><br>
		<?php
	}
	}
}


?>
