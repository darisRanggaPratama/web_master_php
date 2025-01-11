<?php
mysql_connect("localhost", "root", "");
mysql_select_db("akademik");
$bagianWhere = "";
if (isset($_POST['nisCat']))
{
   $nis = $_POST['Nis'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Nis = '$nis'";
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

$query = "SELECT * FROM Siswa WHERE ".$bagianWhere;
$hasil = mysql_query($query);
echo "<table border='1'>";
echo "<tr><td>NIS</td><td>Nama Siswa</td><td>Umur</td><td>Jenis Kelamin</td></tr>";
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>".$data['Nis']."</td><td>".$data['Nama']."</td><td>".$data['Umur']."</td><td>".$data['Seks']."</td></tr>";
}
echo "</table>";
echo "<a href='form_cari.php' >Kembali</a>";
?>
