<?php
session_start();
//periksa apakah user telah login atau memiliki session
if(!isset($_SESSION['user']) || !isset($_SESSION['passwd'])) {
?><script language=’javascript’>alert('Anda belum login. Please login dulu' );
document.location='login.php'</script><?
} else {
?>
<html><head>
   <title>Tampil Data Pegawai</title>
      <script language="JavaScript">
      function konfirmasi(NIP) {
        tanya = confirm('Anda yakin ingin menghapus Pegawai dengan NIP '+ NIP + '?');
        if (tanya == true) return true;
        else return false;
      }
   </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: white;
}
-->
</style></head>
<body>

<?php
include "koneksi.php";

$perintah_sql = "select * from pegawai order by NIP";

mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");
$hasil_query = mysql_query($perintah_sql, $koneksi) or die ("Gagal memproses query!");

$jumlah_data = mysql_num_rows($hasil_query);

echo "<H3>DATA PEGAWAI</H3>";

echo "<table border=1 cellpadding=2 cellspacing=0>";
echo "<tr bgcolor=silver align=center>";
echo "<td>NIP</td>";
echo "<td>NAMA PEGAWAI</td>";
echo "<td>UMUR</td>";
echo "<td>SEKS</td>";
echo "<td colspan=2>AKSI</td>";
echo "</tr>";

while ($row=mysql_fetch_array($hasil_query))
{
   echo "<tr>";
   echo "<td>$row[0]</td>";
   echo "<td>$row[1]</td>";
   echo "<td>$row[2]</td>";
   echo "<td>$row[3]</td>";
   echo "<td><a href=\"edit2.php?Nip=$row[0]\">Ubah</a></td>";
   echo "<td><a href=\"delete2.php?Nip=$row[0]\" onclick=\"return konfirmasi('".$row[0]."')\">Hapus</a>";
   echo "</tr>";
}
echo "</table>";
echo "Jumlah data : $jumlah_data \t [<a href=add2.php>Tambah Data</a>]\t [<a href=index.php>Back</a>]";
?>

</body>
</html>
<?php } ?>