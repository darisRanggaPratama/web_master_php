<html>
<head>
<title>Login here</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!-- table {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 11px;
}
input {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 11px;
height: 20px;
}
body {
	background-color: white;
}
-->
</style>
</head>
<body>
<div align="center">
<form action="periksa.php" method="post" name="login">
<table width="286" border="0" cellpadding="0" cellspacing="0">
<!--DWLayoutTable-->
<?php
for ($i=1;$i<=12;$i++)
{
  echo "<br>";
}
?>
<tr bgcolor="#FF6633">
<td height="19" colspan="2" align="center" valign="middle" bgcolor="#000000">
<font color="#FFFFFF">LOGIN DI SINI</font></td>
</tr>
<tr>
<td width="106" height="47"><img src="images/lg.png" width="104" height="64" longdesc="images/lg.png"></td>
<td width="180">&nbsp;</td>
</tr>
<tr>
<td height="18" align="right" valign="middle">Username :&nbsp;</td>
<td valign="middle">
<input name="username" type="text" id="username" size="30"></td>
</tr>
<tr>
<td height="18" align="right" valign="middle">Password :&nbsp;</td>
<td valign="middle">
<input name="password" type="password" id="password" size="30"></td>
</tr>
<tr>
<td height="19">&nbsp;</td>
<td></td>
</tr>
<tr>
<td height="18" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
<td valign="middle">
<input name="login" type="submit" id="login" value=" Login "></td>
</tr>
<tr>
<td height="28">&nbsp;</td>
<td></td>
</tr>
<tr bgcolor="#FF6633">
<td height="18" colspan="2" valign="top" bgcolor="#000066"><!--DWLayoutEmptyCell-->&nbsp;</td>
</tr>
</table>
</form>
</div>
</body>
</html>
