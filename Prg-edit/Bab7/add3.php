<?php
session_start();
//periksa apakah user telah login atau memiliki session
if(!isset($_SESSION['user']) || !isset($_SESSION['passwd'])) {
?><script language=’javascript’>alert('Anda belum login. Please login dulu' );
document.location='login.php'</script><?php
} else {
?>
<htm><head><title>Insert Data Nilai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: white;
}
-->
</style></head>
<body>
   <form method="post" action="insert3.php">
      <table border=1 cellpadding="5" cellspacing="0">
         <tr bgcolor="silver">
             <td Colspan="3" align="center"><H3>DATA NILAI</H3></td>
         </tr>   
		   <tr>
         <td>ID NILAI</td>
         <td>:</td>
         <td>
           <input type="text" name="txtidnilai" size="9" hidden>
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
		 </tr>
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
             <td>MATAKULIAH</td>
             <td>:</td> 
             <td><input type="text" name="txtmk" size="30"></td>
         </tr>   
         <tr>
             <td>NILAI</td>
             <td>:</td> 
             <td><input type="text" name="txtnilai" size="5"></td>
         </tr>   
		 <tr>
             <td>TGL UJIAN</td>
             <td>:</td> 
             <td><input type="text" name="txttglujian" size="10"></td>
         </tr>   
	     <tr>
             <td>KETERANGAN UJIAN</td>
             <td>:</td> 
             <td>
                <input type="radio" name="rdoket" value="UTS">UTS
                <input type="radio" name="rdoket" value="UAS">UAS
             </td>
         </tr>   
         <tr align="center">
           <td colspan="3">
                <input type="submit" value="INSERT">
                <input type="reset" value="BATAL">
             <?php echo "\t [<a href=view3.php>Lihat Data Nilai</a>]"; ?></td>
         </tr>   
      </table>
   </form>
</body>
</html>
<?php } ?>