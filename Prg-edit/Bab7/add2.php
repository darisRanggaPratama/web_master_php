<?php
session_start();
//periksa apakah user telah login atau memiliki session
if(!isset($_SESSION['user']) || !isset($_SESSION['passwd'])) {
?><script language=’javascript’>alert('Anda belum login. Please login dulu' );
document.location='login.php'</script><?php
} else {
?>
<html><head><title>Insert Data Pegawai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: white;
}
-->
</style></head>
<body>
   <form method="post" action="insert2.php">
      <table border=1 cellpadding="5" cellspacing="0">
         <tr bgcolor="silver">
             <td Colspan="3" align="center"><H3>DATA PEGAWAI</H3></td>
         </tr>   
         <tr>
             <td>NIP</td>
             <td>:</td>
             <td><input type="text" name="txtnip" size="7"></td>
         </tr>   
         <tr>
             <td>NAMA</td>
             <td>:</td> 
             <td><input type="text" name="txtnama" size="50"></td>
         </tr>   
         <tr>
             <td>UMUR</td>
             <td>:</td> 
             <td><input type="text" name="txtumur" size="5"></td>
         </tr>   
         <tr>
             <td>SEKS</td>
             <td>:</td> 
             <td>
                <input type="radio" name="rdoseks" value="PRIA">PRIA
                <input type="radio" name="rdoseks" value="WANITA">WANITA
             </td>
         </tr>   
         <tr align="center">
           <td colspan="3">
                <input type="submit" value="INSERT">
                <input type="reset" value="BATAL">
             <?php echo "\t [<a href=view2.php>Lihat Data Pegawai</a>]"; ?></td>
         </tr>   
      </table>
   </form>
</body>
</html>
<?php } ?>