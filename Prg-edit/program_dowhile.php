<HTML>
<HEAD>
<TITLE>
Pengulangan do..while Faktorial
</TITLE>
</HEAD>
<BODY>
<?php
$i=1;
$jml=1;
$bil=4;
if ($bil<0)
 {
   print("bilangan salah");
 }
elseif ($bil==0 or $bil==1)
      {
	 $jml=1;
         print("jumlah faktorial=$jml");
      } 
else 
   {
     do
       {
        $jml=$jml*$i;
        $i++;
       } 
     while ($i<=$bil);
     print("jumlah faktorial=$jml");
   }
?>
</BODY>
</HTML>
