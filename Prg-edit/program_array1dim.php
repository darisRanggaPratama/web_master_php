<HTML>
<HEAD>
<TITLE>
Mencetak Nilai Tertinggi
</TITLE>
</HEAD>
<BODY>
<?php
  $NILAI[1]=40;
  $NILAI[2]=56;
  $NILAI[3]=90;
  $NILAI[4]=70;
  $MAX=$NILAI[1];
for ($i=2;$i<=4;$i++)
{
  if ($MAX<$NILAI[$i])
  {
    ($MAX=$NILAI[$i]);
  }
}
echo "NILAI TERTINGGI=".$MAX; 
?>
</BODY>
</HTML>
