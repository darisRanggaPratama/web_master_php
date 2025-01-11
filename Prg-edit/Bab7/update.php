<html><head><title>Pembaharuan Data Siswa</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
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
   $NISH= $_POST['NISH'];

   $NAMA= $_POST['txtnama'];
   $UMUR= $_POST['txtumur'];
   $SEX= $_POST['rdoseks'];

   $SQL = "UPDATE Siswa SET Nama='$NAMA', Umur='$UMUR', Seks='$SEX' WHERE NIS='$NISH'";
   mysql_query($SQL, $koneksi) or die ("Proses pembaharuan data GAGAL! <br> [<a href=index.php>Lihat Data Siswa</a>]");
   
   echo "Siswa dengan NIS = $NISH BERHASIL DIPERBAHARUI!";
   echo "<br>";
   echo "[<a href=index.php>Lihat Data Siswa</a>]";
}

?>
</body>
</html>