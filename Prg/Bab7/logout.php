<?php
session_start();
//periksa apakah user telah login atau memiliki session
if(!isset($_SESSION['user']) || !isset($_SESSION['passwd'])) {
?>	<script language='javascript'>	document.location='login.php'</script><?	
} else {
unset($_SESSION);
session_destroy();
?>	
<script language='javascript'> document.location='login.php'</script>
<?php
}
?>
