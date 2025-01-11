<?php
mysql_connect("localhost", "root", "");
mysql_select_db("akademik");
$bagianWhere = "";
if (isset($_POST['nipCat']))
{
   $nip = $_POST['Nip'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Nip = '$nip'";
   }
}

if (isset($_POST['namaCat']))
{
   $nama = $_POST['Nama'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Nama LIKE '%$nama%'";
   }
   else
   {
        $bagianWhere .= " AND Nama LIKE '%$nama%'";
   }
}

if (isset($_POST['umurCat']))
{
   $umur = $_POST['Umur'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Umur LIKE '%$umur%'";
   }
   else
   {
        $bagianWhere .= " AND Umur LIKE '%$umur%'";
   }
}

if (isset($_POST['SexCat']))
{
   $Seks = $_POST['Seks'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Seks = '$Seks'";
   }
   else
   {
        $bagianWhere .= " AND Seks = '$Seks'";
   }
}

$query = "SELECT * FROM pegawai WHERE ".$bagianWhere;
$hasil = mysql_query($query);
echo "<table border='1'>";
echo "<tr><td>NIP</td><td>Nama Pegawai</td><td>Umur</td><td>Jenis Kelamin</td></tr>";
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>".$data['Nip']."</td><td>".$data['Nama']."</td><td>".$data['Umur']."</td><td>".$data['Seks']."</td></tr>";
}
echo "</table>";
echo "<a href='form_cari2.php' >Kembali</a>";
?>
