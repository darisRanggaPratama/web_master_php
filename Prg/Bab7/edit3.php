<html><head><title>Ubah Data Nilai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: white;
}
-->
</style></head>
<body>
<form method="post" action="update3.php">
     <table border="1" cellpadding="5" cellspacing="0">
       <tr bgcolor="silver">
         <td Colspan="3" align="center"><H3><?php
include "koneksi.php";

$IDNILAI = $_GET['IDNILAI'];
$perintah_sql = "select * from nilai where IDNILAI=$IDNILAI";

mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");

$hasil_query = mysql_query($perintah_sql, $koneksi) or die ("Gagal memproses query!");

$row=mysql_fetch_array($hasil_query);

$IDNILAI = $row['IDNILAI'];
$NIP = $row['Nip'];
$NIS = $row['Nis'];
$MK = $row['mk'];
$NILAI = $row['nilai'];
$TGLUJIAN = $row['tglujian'];
$KETUJIAN = $row['ketujian'];

if ($KETUJIAN=="UTS") {
   $uts = " checked";       
   $uas = "";
} else {
   $uts = "";       
   $uas = " checked";
}         


?>
   <form method="post" action="update3.php">
     <table border="1" cellpadding="5" cellspacing="0">
       <tr bgcolor="silver">
         <td Colspan="3" align="center"><H3>DATA NILAI</H3></td>
       </tr>
       <tr>
         <td>ID NILAI</td>
         <td>:</td>
         <td>
           <input type="text" name="txtidnilai" size="9" value="<?php echo "$IDNILAI"; ?>" disabled>
           <input type="hidden" name="IDNILAIH" value="<?php echo "$IDNILAI"; ?>">
         </td>
       </tr>
          <tr>
             <td>NAMA PEGAWAI</td>
             <td>:</td>
             <td>
<?php
                    include "koneksi.php";
					echo "<select name=\"nip\" id=\"nip\">";
                    $myquery="select nip,nama from pegawai";
					$daftarpegawai=mysql_query($myquery) or die (mysql_error());
					while ($datapegawai=mysql_fetch_object($daftarpegawai))
					{
					  echo "<option value=\"$datapegawai->nip\">$datapegawai->nama</option>";
					}  
                 
                 echo "</select>";
?>             </td>
		 <tr>
             <td>NAMA SISWA</td>
             <td>:</td>
             <td>
<?php
                    include "koneksi.php";
					echo "<select name=\"nis\" id=\"nis\">";
                    $myquery="select nis,nama from siswa";
					$daftarsiswa=mysql_query($myquery) or die (mysql_error());
					while ($datasiswa=mysql_fetch_object($daftarsiswa))
					{
					  echo "<option value=\"$datasiswa->nis\">$datasiswa->nama</option>";
					}  
                 
                 echo "</select>";
?>	         </td>
         </tr>   
		 <tr>
         <td>MATA KULIAH</td>
         <td>:</td>
         <td><input type="text" name="txtmk" size="30" value="<?php echo "$MK"; ?>"></td>
         </tr> 
         <tr>
             <td>NILAI</td>
             <td>:</td> 
			 <td><input type="text" name="txtnilai" size="5" value="<?php echo "$NILAI"; ?>"></td>
         </tr>   
		 <tr>
             <td>TGL UJIAN</td>
             <td>:</td> 
             <td><input type="text" name="txttglujian" size="10" value="<?php echo "$TGLUJIAN"; ?>"></td>
         </tr>   
		 <tr>
         <td>KETERANGAN UJIAN</td>
         <td>:</td>
         <td>
           <input type="radio" name="rdoketujian" value="UTS" <?php echo "$uts"; ?>>UTS
           <input type="radio" name="rdoketujian" value="UAS" <?php echo "$uas"; ?>>UAS         </td>
       </tr>
       <tr align=center>
         <td colspan=3>
           <input type="submit" value="UPDATE">
           [<a href=view3.php>Lihat Data Nilai</a>]         </td>
       </tr>
     </table>
</form>
</body>
</html>
