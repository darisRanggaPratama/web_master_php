<html><head><title>Cari Data Pegawai</title></head>
<body>
<h1>Cari Data Pegawai</h1>

<p>Pilih kategori pencarian</p>

<form method="post" action="proses_cari2.php">
<table>
   <tr><td><input type="checkbox" name="nipCat"> NIP</td><td><input type="text" name="Nip"></td></tr>
   <tr><td><input type="checkbox" name="namaCat"> Nama Pegawai</td><td><input type="text" name="Nama"></td></tr>
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
