<?php
cek_status_login($_SESSION['idpelanggan']);
?>


<section class="main-content">
<a href='index.php?mod=chart&pg=invoice' class='btn btn-warning'>
		<i class='icon-arrow-left icon-white'></i>Back</a>
	<div class="row">
		<div class="span9">

	

	<h4 id="headings"> Detail Transaksi Dengan Kode Transaksi <?=$_GET['id']?></h4>
	<!--<a href='index.php?mod=produk&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped">
		<thead>
			<th>No<td><b>Nama </b></td>
			<td><b>Harga Satuan</b></td><td><b>Jumlah</b></td><td class='pull-right'><b>Subtotal</b></td></th>
		</thead>
		<tbody>
<?php
$id=$_GET['id'];
$query="SELECT produk.*,transaksi.* ,stok.harga_jual
from produk,transaksi,stok 
where produk.idproduk=transaksi.idproduk
and produk.idproduk=stok.idproduk
and transaksi.noinvoice='$id'";

$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
$total=0;
while($rows=mysql_fetch_object($result)){
$subtotal= $rows -> harga_jual* $rows -> jumlah;
$total=$total+$subtotal;
			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td>
			  <?php echo $rows -> nama_produk; ?></td>
			<td><?php echo format_rupiah($rows -> harga_jual); ?></td>
			<td><?php echo $rows -> jumlah; ?></td>
			<td class='pull-right'><? echo format_rupiah($subtotal); ?></td>
			
				
				
			</tr>
			
			<?php	$no++;
				}
			?>
<tr><td>Total</td><td  ></p></td>
  <td  >&nbsp;</td>
  <td  >&nbsp;</td>
  <td  ><?=format_rupiah($total);?></td>
  
  </tr>
			
		</tbody>
	</table>
</div>

<?php
include('inc/sidebar-front.php');
?>
	</div>
</section>	
