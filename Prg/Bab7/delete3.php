<html><head>
   <title>Hapus Data Nilai</title>
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
   $IDNILAI=$_GET['IDNILAI'];
   $SQL = "DELETE FROM nilai WHERE IDNILAI='$IDNILAI'";
   $hasil_query = mysql_query($SQL, $koneksi) or die ("Proses hapus data GAGAL! <br> [<a href=view3.php>Lihat Data Nilai</a>]");
   if ($hasil_query)
      echo "Nilai dengan IDNILAI = $IDNILAI BERHASIL DIHAPUS!";

   echo "<br>";
   echo "[<a href=view3.php>Lihat Data Nilai</a>]";

}

?>
</body>
</html>