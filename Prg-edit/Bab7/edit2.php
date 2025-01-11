
<html><head><title>Ubah Data Pegawai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: white;
}
-->
</style></head>
<body>

<?php
include "koneksi.php";

$NIP = $_GET['Nip'];

$perintah_sql = "select * from pegawai where Nip=$NIP";

mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");

$hasil_query = mysql_query($perintah_sql, $koneksi) or die ("Gagal memproses query!");

$row=mysql_fetch_array($hasil_query);

$NIP = $row['Nip'];
$NAMA = $row['Nama'];
$UMUR = $row['Umur'];
$SEX = $row['Seks'];

if ($SEX=="PRIA") {
   $P = " checked";       
   $W = "";
} else {
   $P = "";       
   $W = " checked";
}         

?>
   <form method="post" action="update2.php">
     <table border="1" cellpadding="5" cellspacing="0">
       <tr bgcolor="silver">
         <td Colspan="3" align="center"><H3>DATA PEGAWAI</H3></td>
       </tr>
       <tr>
         <td>NIP</td>
         <td>:</td>
         <td>
           <input type="text" name="txtnip" size="7" value="<?php echo "$NIP"; ?>" disabled>
           <input type="hidden" name="NIPH" value="<?php echo "$NIP"; ?>">
         </td>
       </tr>
       <tr>
         <td>NAMA</td>
         <td>:</td>
         <td><input type="text" name="txtnama" size="50" value="<?php echo "$NAMA"; ?>"></td>
       </tr>
       <tr>
         <td>UMUR</td>
         <td>:</td>
         <td><input type="text" name="txtumur" size="5" value="<?php echo "$UMUR"; ?>"></td>
       </tr>
       <tr>
         <td>SEKS</td>
         <td>:</td>
         <td>
           <input type="radio" name="rdoseks" value="PRIA" <?php echo "$P"; ?>>PRIA
           <input type="radio" name="rdoseks" value="WANITA" <?php echo "$W"; ?>>WANITA
         </td>
       </tr>
       <tr align=center>
         <td colspan=3>
           <input type="submit" value="UPDATE">
           [<a href=view.php>Lihat Data Pegawai</a>]
         </td>
       </tr>
     </table>
   </form>
</body>
</html>