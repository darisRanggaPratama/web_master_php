<Html>
<Head>
<Title>
Program Variabel Lokal
</Title>
<?php
Function Segi4($A,$B)
{
$C=$A*$B;
}
?>
</Head>
<Body>
<h1>Call Variabel Lokal</h1>
<Br>
<?php
Segi4(10,20);
echo "\$C=$C";
?>
</Body>
</Html>
