<html>
<head><title>Pembaharuan Data Siswa</title></head>
<body>

<?php
include "koneksi.php";

if($koneksi){
   $NISH= $_POST['NISH'];

   $NAMA= $_POST['txtnama'];
   $UMUR= $_POST['txtumur'];
   $SEX= $_POST['rdoseks'];

   $SQL = "UPDATE Siswa SET Nama='$NAMA', Umur='$UMUR', Seks='$SEX' WHERE NIS='$NISH'";
   mysql_query($SQL, $koneksi) or die ("Proses pembaharuan data GAGAL! <br> [<a href=view.php>Lihat Data Siswa</a>]");
   
   echo "Siswa dengan NIS = $NISH BERHASIL DIPERBAHARUI!";
   echo "<br>";
   echo "[<a href=view.php>Lihat Data Siswa</a>]";
}

?>
</body>
</html>
