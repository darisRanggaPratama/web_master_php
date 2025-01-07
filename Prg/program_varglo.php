<Html>
<Head>
<Title>
Program Variabel Global
</Title>
<?php
Function Segi4()
{
global $C;
echo "\$C=$C";
}
?>
</Head>
<Body>
<h1>Variabel Global</h1>
<Br>
<?php
$A=10;
$B=20;
$C=$A*$B;
Segi4();
?>
</Body>
</Html>
