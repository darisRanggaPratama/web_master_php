<html><head><title>Insert Data Nilai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
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
   $IDNILAI= $_POST['txtidnilai'];
   $NIP= $_POST['nip'];
   $NIS= $_POST['nis'];
   $MK= $_POST['txtmk'];
   $NILAI= $_POST['txtnilai'];
   $TGLUJIAN= $_POST['txttglujian'];
   $KETUJIAN= $_POST['rdoket'];
   $SQL = "INSERT INTO nilai Values('$IDNILAI','$NIP','$NIS','$MK','$NILAI','$TGLUJIAN','$KETUJIAN')";
   mysql_query($SQL, $koneksi) or die ("Proses insert data GAGAL! <br> [<a href=view3.php>Lihat Data Nilai</a>]");
   echo "Proses insert data BERHASIL!";
   echo "<br>";
   echo "[<a href=view3.php>Lihat Data Nilai</a>]";
}
?>
</body>
</html>