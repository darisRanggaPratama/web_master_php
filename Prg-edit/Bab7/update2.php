<html><head><title>Pembaharuan Data Pegawai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
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
   $NIPH= $_POST['NIPH'];

   $NAMA= $_POST['txtnama'];
   $UMUR= $_POST['txtumur'];
   $SEX= $_POST['rdoseks'];

   $SQL = "UPDATE pegawai SET Nama='$NAMA', Umur='$UMUR', Seks='$SEX' WHERE Nip='$NIPH'";
   mysql_query($SQL, $koneksi) or die ("Proses pembaharuan data GAGAL! <br> [<a href=index.php>Lihat Data Pegawai</a>]");
   
   echo "Pegawai dengan NIP = $NIPH BERHASIL DIPERBAHARUI!";
   echo "<br>";
   echo "[<a href=view2.php>Lihat Data Pegawai</a>]";
}

?>
</body>
</html>