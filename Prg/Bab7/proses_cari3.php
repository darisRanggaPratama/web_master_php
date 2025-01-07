<?php
mysql_connect("localhost", "root", "");
mysql_select_db("akademik");
$bagianWhere = "";
if (isset($_POST['idnilaiCat']))
{
   $idnilai = $_POST['IDNILAI'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "IDNILAI = '$idnilai'";
   }
}

if (isset($_POST['nipCat']))
{
   $nip = $_POST['Nip'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Nip LIKE '%$nip%'";
   }
   else
   {
        $bagianWhere .= " AND Nip LIKE '%$nip%'";
   }
}

if (isset($_POST['nisCat']))
{
   $nis = $_POST['Nis'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "Nis LIKE '%$nis%'";
   }
   else
   {
        $bagianWhere .= " AND Nis LIKE '%$nis%'";
   }
}

if (isset($_POST['mkCat']))
{
   $mk = $_POST['mk'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "mk LIKE '%$mk%'";
   }
   else
   {
        $bagianWhere .= " AND mk LIKE '%$mk%'";
   }
}

if (isset($_POST['nilaiCat']))
{
   $nilai = $_POST['nilai'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "nilai LIKE '%$nilai%'";
   }
   else
   {
        $bagianWhere .= " AND nilai LIKE '%$nilai%'";
   }
}

if (isset($_POST['tglujianCat']))
{
   $tglujian = $_POST['tglujian'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "tglujian LIKE '%$tglujian%'";
   }
   else
   {
        $bagianWhere .= " AND tglujian LIKE '%$tglujian%'";
   }
}


if (isset($_POST['ketujian']))
{
   $ketujian = $_POST['ketujian'];
   if (empty($bagianWhere))
   {
		$bagianWhere .= "ketujian = '$ketujian'";
   }
   else
   {
        $bagianWhere .= " AND ketujian = '$ketujian'";
   }
}

$query = "SELECT * FROM nilai WHERE ".$bagianWhere;
$hasil = mysql_query($query);
echo "<table border='1'>";
echo "<tr><td>ID NILAI</td><td>NIP</td><td>NIS</td><td>MATAKULIAH</td><td>NILAI</td><td>TGL UJIAN</td><td>KETERANGAN</td></tr>";
while ($data = mysql_fetch_array($hasil))
{
   echo "<tr><td>".$data['IDNILAI']."</td><td>".$data['Nip']."</td><td>".$data['Nis']."</td><td>".$data['mk']."</td><td>".$data['nilai']."</td><td>".$data['tglujian']."</td><td>".$data['ketujian']."</td></tr>";
}
echo "</table>";
echo "<a href='form_cari3.php' >Kembali</a>";
?>
