<html><head><title>Insert Data Pegawai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
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
   $NIP= $_POST['txtnip'];
   $NAMA= $_POST['txtnama'];
   $UMUR= $_POST['txtumur'];
   $SEX= $_POST['rdoseks'];
   $SQL = "INSERT INTO Pegawai Values('$NIP','$NAMA','$UMUR','$SEX')";
   mysql_query($SQL, $koneksi) or die ("Proses insert data GAGAL! <br> [<a href=view2.php>Lihat Data Pegawai</a>]");
   echo "Proses insert data BERHASIL!";
   echo "<br>";
   echo "[<a href=view2.php>Lihat Data Pegawai</a>]";
}
?>
</body>
</html>