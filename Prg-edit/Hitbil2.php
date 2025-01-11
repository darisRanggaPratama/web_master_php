<html>
<body>
<?
$bil1=$_GET["bil1"];
?>
<h1>Bil Genap Dan Ganjil</h1>
<hr>
bilangan :<? echo $bil1 ?><br>
<?
$HASIL=$bil1%2;
if ($HASIL==0) 
  {
    echo "$bil1 Adalah Bilangan Genap";
  } 
else 
  {
    echo "$bil1 Adalah Bilangan Ganjil";
  }
?>
</body>
</html>
