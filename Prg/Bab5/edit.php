<html>
<head><title>Ubah Data Siswa</title></head>
<body>

<?php
include "koneksi.php";

$NIS = $_GET['NIS'];

$perintah_sql = "select * from siswa where NIS=$NIS";

mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");

$hasil_query = mysql_query($perintah_sql, $koneksi) or die ("Gagal memproses query!");

$row=mysql_fetch_array($hasil_query);

$NIS = $row['Nis'];
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
   <form method="post" action="update.php">
     <table border="1" cellpadding="5" cellspacing="0">
       <tr bgcolor="silver">
         <td Colspan="3" align="center"><H3>DATA SISWA</H3></td>
       </tr>
       <tr>
         <td>NIS</td>
         <td>:</td>
         <td>
           <input type="text" name="txtnis" size="10" value="<?php echo "$NIS"; ?>" disabled>
           <input type="hidden" name="NISH" value="<?php echo "$NIS"; ?>">
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
           [<a href=view.php>Lihat Data Siswa</a>]
         </td>
       </tr>
     </table>
   </form>
</body>
</html>

