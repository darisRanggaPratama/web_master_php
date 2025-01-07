<html><head><title>Cari Data Nilai</title></head>
<body>
<h1>Cari Data Nilai</h1>

<p>Pilih kategori pencarian</p>

<form method="post" action="proses_cari3.php">
<table>
   <tr><td><input type="checkbox" name="idnilaiCat"> IDNILAI</td><td><input type="text" name="IDNILAI"></td></tr>
   <tr><td><input type="checkbox" name="nipCat"> NIP</td><td><input type="text" name="Nip"></td></tr>
   <tr><td><input type="checkbox" name="nisCat"> NIS</td><td><input type="text" name="Nis"></td></tr>
   <tr><td><input type="checkbox" name="mkCat"> Matakuliah</td><td><input type="text" name="mk"></td></tr>
   <tr><td><input type="checkbox" name="nilaiCat"> NILAI</td><td><input type="text" name="nilai"></td></tr>
   <tr><td><input type="checkbox" name="tglujianCat"> TGL UJIAN</td><td><input type="text" name="tglujian"></td></tr>
   <tr><td><input name="ketujian" type="checkbox" id="ketujianCat"> 
   KETERANGAN</td><td><input type="radio" name="ketujian" value="UTS"> 
   UTS <input type="radio" name="ketujian" value="UAS"> 
   UAS</td></tr>
   <tr><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>   
</table>
<a href="index.php" >Kembali</a>
</form>
</body>
</html>
