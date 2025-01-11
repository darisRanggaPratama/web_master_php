<html><head><title>Cari Data Siswa</title></head>
<body>
<h1>Cari Data Siswa</h1>

<p>Pilih kategori pencarian</p>

<form method="post" action="proses_cari.php">
<table>
   <tr><td><input type="checkbox" name="nisCat"> NIS</td><td><input type="text" name="Nis"></td></tr>
   <tr><td><input type="checkbox" name="namaCat"> Nama Siswa</td><td><input type="text" name="Nama"></td></tr>
   <tr><td><input type="checkbox" name="umurCat"> Umur</td><td><input type="text" name="Umur"></td></tr>
   <tr><td><input name="SexCat" type="checkbox" id="SexCat"> 
   Jenis Kelamin</td><td><input type="radio" name="Seks" value="PRIA"> 
   PRIA <input type="radio" name="Seks" value="WANITA"> 
   WANITA</td></tr>
   <tr><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>   
</table>
<a href="index.php" >Kembali</a>
</form>
</body>
</html>