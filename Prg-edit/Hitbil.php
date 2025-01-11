<html>
<body>
<?php
$bil1=$_POST["bil1"];
?>
<h1>Bil Genap Dan Ganjil</h1>
<hr>
bilangan :<? echo $bil1 ?><br>
<?php
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
