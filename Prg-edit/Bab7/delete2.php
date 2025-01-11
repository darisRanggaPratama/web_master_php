<html><head>
   <title>Hapus Data Pegawai</title>
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

if($koneksi){
   $NIP=$_GET['Nip'];
   $SQL = "DELETE FROM Pegawai WHERE NIP='$NIP'";
   $hasil_query = mysql_query($SQL, $koneksi) or die ("Proses hapus data GAGAL! <br> [<a href=view2.php>Lihat Data Pegawai</a>]");
   if ($hasil_query)
      echo "Pegawai dengan NIP = $NIP BERHASIL DIHAPUS!";

   echo "<br>";
   echo "[<a href=view2.php>Lihat Data Pegawai</a>]";

}

?>
</body>
</html>