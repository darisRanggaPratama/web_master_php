<HTML>
<HEAD>
<TITLE>
Menentukan Bayar Makanan
</TITLE>
</HEAD>
<BODY>
<?php
$PORSI=3;
$HARGA=5000;
$DISKON[0][0]=0.1;
$DISKON[0][1]=0.2;
$DISKON[0][2]=0.3;
$DISKON[1][0]=0.2;
$DISKON[1][1]=0.3;
$DISKON[1][2]=0.4;
$BESAR=$PORSI*$HARGA*$DISKON[1][0];
$BAYAR=$PORSI*$HARGA-$BESAR;
print("Total Pembayaran=$BAYAR");
?>
</BODY>
</HTML>
