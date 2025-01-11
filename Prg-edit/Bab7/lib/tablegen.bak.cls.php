<?php

class generatorTable {
	
	private $cekbok = false;
	private $action = null;
	private $name = null;
	private $rs;
	private $num;
	private $numRow = true;
	private $rowColor = true;
	private $fieldColor = false;
	private $edit;
	private $delete;
	private $idkolom;
	private $detail;
	private $detailview = false;
	private $detail2;
	private $detail2view = false;
	private $detaiWidth = 100;
	private $detaiHeight = 100;
	private $lebarEdit = '400';
	private $tinggiEdit = '250';
	private $lebarDetail = '400';
	private $tinggiDetail = '250';
	private $addparam;
	
	public function __construct($rs,$edit,$delete,$addparam = null) {
		$this->rs = $rs;
		$this->delete = $delete;
		is_null($addparam) ? $this->addparam=$addparam : $this->addparam='&'.$addparam;
		if (is_array($edit)) {
			$this->edit = $edit['url'];
			$this->lebarEdit = $edit['lebar'];
			$this->tinggiEdit = $edit['tinggi']; 
		} else {
			$this->edit = $edit;
		}
	}
	
	public function addCekbok($action,$name) {
		$this->cekbok = true;
		$this->action = $action;
		$this->name = $name;
	}
	
	public function showDetail($detailview,$detail) {
		$this->detailview = $detailview;
		if ($this->detailview == true) {
			if (is_array($detail)) {
				$this->detail = $detail['url'];
				$this->lebarDetail = $detail['lebar'];
				$this->tinggiDetail = $detail['tinggi'];
			} else {
				$this->detail = $detail;
			}
		} else {
			$detail = '#';
		}
	}
	
	public function showDetail2($detai2view,$detail2) {
		$this->detail2view = $detai2view;
		if ($this->detail2view == true) {
			$this->detail2 = $detail2;
		} else {
			$this->detail2 = '#';
		}
	}
	
	public function setData($rs,$edit,$delete) {
		$this->rs = $rs;
		$this->edit = $edit;
		$this->delete = $delete;
		
	}
	
	public function showNumber($numRow, $num = 1) {
		$this->numRow = $numRow;
		$this->num = $num;
	}
	
	public function showRowColor($rowColor) {
		$this->rowColor = $rowColor;
		$this->fieldColor = 0;
	}
	
	public function showFieldColor($fieldColor) {
		$this->fieldColor = $fieldColor;
	}
	
	
	public function showTable() { ?> 
		<?php 
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
			
			Data Belum tersedia
			
			</div>
			
			<?php
		}else{
		
		?>
		
		<!-- ThicBOx Plugin -->
		<script language="javascript" src="lib/js/jquery.js"></script>
		<script language="javascript" src="lib/js/thickbox.js"></script>
		<link href="themes/thickbox.css" rel="stylesheet" type="text/css" />
		<!-- ThicBOx Plugin -->
		<?php
			if ($this->cekbok) {
				echo '<form method="POST" action="'.$this->action.'">';
			}
		?>
		<style>
		a.tombol:visited {
			text-decoration:none;
			color:white;
		}
		a.tombol:link {
			text-decoration:none;
			color: white;
		}
		</style>
		<table
		 cellpadding=1 cellspacing=1
		style="border:solid 1px #999" 
		>
		    <tr align="center">
		    	<!-- Ini adalah header cekbox -->
				<?php
		    		if ($this->cekbok) {
						echo '<th height="25px" bgcolor=#000000 style="color:white"></th>';
					}
				?>
		        <th height="25px" bgcolor=#000000 style="color:white;padding:0 5px;" width="20px">
		        <?php echo $this->numRow ? 'No' : ''; ?>
		        </th>
		        
		        <?php 
		        /*while ($nameField = $this->rs->fetch_field()) {*/ 
		        $jumfield = $this->rs->field_count; 
		        for ($i=1;$i < $jumfield;$i++) {
		        	$nameField = $this->rs->fetch_field_direct($i);
		        ?>
				
				<th bgcolor=#000000 style="color:white; text-transform:titlecase;padding:0 5px;">
				<?php 
				$space = ' ';
				$nf = ereg_replace('_',$space,$nameField->name);
				
				echo $nf;
				
				?>
				</th>
				
				<?php 
				};
				
				if (($this->detailview == true) XOR ($this->detail2view == true)) {
					?>
					<th bgcolor=#000000 style="color:white; text-transform:uppercase" width="30px">
					
					</th>
					<?php 
				}
				
		        ?>
		        <?php if ($this->edit !== '<none>') { ?>
		        <th bgcolor=#000000 style="color:white; text-transform:uppercase" width="30px">
				 
				</th>
				<?php } ?>
		        <?php if ($this->delete !== '<none>') { ?>
		        <th bgcolor=#000000 style="color:white; text-transform:uppercase" width="30px">
				  
				</th>
		        <?php } ?>
		    </tr>
		    
		    <?php
		    while ($row = $this->rs->fetch_array()) { 
		    	if ($this->rowColor) {
					//(($this->num % 2) != 0) ? $bgR='#DCEDFF' : $bgR='#F3F6FF';
					(($this->num % 2) != 0) ? $bgR='#EBEBEB' : $bgR='#F8F8F8';
				}
		    	
		    ?>
			
			<tr align="center" height="25px" bgcolor="<?php echo $bgR; ?>" onmouseover="this.style.backgroundColor='#4E74DB';this.style.color='#ffffff'" onmouseout="this.style.backgroundColor='<?php echo $bgR; ?>';this.style.color='#000000'">
				
					<?php
						//untuk penambahan cekbok 
						if ($this->cekbok) {
							echo '<td align="center">';
							echo '<input type="checkbox" name="data[]" value="'.$row[0].'">';
							echo '</td>';
						}
					?>
				
				<td>
				<?php echo $this->numRow ? $this->num : ''; ?>
				</td>
				
				<?php
				for ($i=0; $i < $jumfield; $i++) { 
					if ($this->fieldColor) {
						($i % 2 != 0) ? $bgF='#DAEBFF' : $bgF='#FFFFFF';
					}
					$this->idkolom = $row[0];
					if ($i+1 < $jumfield) {
						?>
						
						<td bgcolor = "<?php echo $bgF; ?>">
						<?php echo $row[$i+1]; ?>
						</td>
				<?php 
					}
					
				}
				
				if ($this->detailview == true) {
					?>
					<td bgcolor = "<?php echo $bgF; ?>">
					<a href="<?php echo $this->detail; ?>?id=<?php echo $this->idkolom.$this->addparam ?>&height=<?php echo $this->tinggiDetail; ?>&width=<?php echo $this->lebarDetail; ?>" class="thickbox"><IMG src="images/publish_g.png" alt="detail"></a>
					</td>	
					<?php 
				}
				
				if ($this->detail2view == true) {
					?>
					<td bgcolor = "<?php echo $bgF; ?>">
					<a href="<?php echo $this->detail2; ?>&id=<?php echo $this->idkolom.$this->addparam ?>" ><IMG src="images/publish_g.png" alt="detail"></a>
					</td>	
					<?php 
				}
				
				?>
				<?php if ($this->edit !== '<none>') { ?>	
				<td bgcolor = "<?php echo $bgF; ?>">
				<a href="<?php echo $this->edit; ?>?id=<?php echo $this->idkolom.$this->addparam ?>&height=<?php echo $this->tinggiEdit; ?>&width=<?php echo $this->lebarEdit; ?>" class="thickbox"><IMG src="images/publish_y.png" alt="edit"></a>
				</td>
				<?php } ?>
				
				<?php if ($this->delete !== '<none>') { ?>		
				<td bgcolor = "<?php echo $bgF; ?>">
				
				<?php if (is_array($this->delete)) {
					?><a href="<?php echo $this->delete['url']; ?>?id=<?php echo $this->idkolom.$this->addparam ?>&height=<?php echo $this->tinggiEdit; ?>&width=<?php echo $this->lebarEdit; ?>" class="thickbox"><IMG src="images/publish_y.png" alt="edit"></a><?php
				} else {
					?><a href="<?php echo $this->delete; ?>?id=<?php echo $this->idkolom.$this->addparam ?>"><IMG src="images/publish_x.png" alt="delete"></a><?php
				}
				?>
				
				</td>
				<?php } ?>
				
			</tr>
			
			<?php $this->num++;
			}
		    ?>
		</table><br><br>
		
	<?php 
			if ($this->cekbok) {
				if (is_array ($this->name)) {
					foreach ($this->name as $key => $value) {
						echo '<input type="submit" name="'.$key.'" value="'.strtoupper($value).'"> ';
					}	
				}
				//echo '<br><br><input type="submit" name="tombol" value="'.strtoupper($this->name).'"><br><br>';
				echo '</form>';
			}
		}
	}

}

?>
