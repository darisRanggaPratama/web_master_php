<html><head><title>Insert Data Siswa</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
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
   $NIS= $_POST['txtnis'];
   $NAMA= $_POST['txtnama'];
   $UMUR= $_POST['txtumur'];
   $SEX= $_POST['rdoseks'];
   $SQL = "INSERT INTO Siswa Values('$NIS','$NAMA','$UMUR','$SEX')";
   mysql_query($SQL, $koneksi) or die ("Proses insert data GAGAL! <br> [<a href=view.php>Lihat Data Siswa</a>]");
   echo "Proses insert data BERHASIL!";
   echo "<br>";
   echo "[<a href=view.php>Lihat Data Siswa</a>]";
}
?>
</body>
</html>