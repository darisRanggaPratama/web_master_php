<html><head>
   <title>Hapus Data Siswa</title>
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
   $NIS=$_GET['NIS'];
   $SQL = "DELETE FROM Siswa WHERE NIS='$NIS'";
   $hasil_query = mysql_query($SQL, $koneksi) or die ("Proses hapus data GAGAL! <br> [<a href=view.php>Lihat Data Siswa</a>]");
   if ($hasil_query)
      echo "Siswa dengan NIS = $NIS BERHASIL DIHAPUS!";

   echo "<br>";
   echo "[<a href=view.php>Lihat Data Siswa</a>]";

}

?>
</body>
</html>