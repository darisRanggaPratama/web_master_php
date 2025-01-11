<html><head><title>Pembaharuan Data Nilai</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
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
   $IDNILAIH= $_POST['IDNILAIH'];

   $NIP= $_POST['nip'];
   $NIS= $_POST['nis'];
   $MK= $_POST['txtmk'];
   $NILAI= $_POST['txtnilai'];
   $KETUJIAN= $_POST['rdoketujian'];

   $SQL = "UPDATE nilai SET NIP='$NIP', NIS='$NIS', mk='$MK', nilai='$NILAI', ketujian='$KETUJIAN' WHERE IDNILAI='$IDNILAIH'";
   mysql_query($SQL, $koneksi) or die ("Proses pembaharuan data GAGAL! <br> [<a href=view3.php>Lihat Data NILAI</a>]");
   
   echo "Nilai dengan IDNILAI = $IDNILAIH BERHASIL DIPERBAHARUI!";
   echo "<br>";
   echo "[<a href=view3.php>Lihat Data Nilai</a>]";
}

?>
</body>
</html>