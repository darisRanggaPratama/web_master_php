<?php

class loginx  {

	/* construct */
	function __construct($my_database,$my_host,$my_username,$my_password,$query_username,$query_password,$table_name,$table_username,$table_password,$redirect_accept,$redirect_denied, $redirect_opr) {
		
		$this->my_database 		= $my_database;
		$this->my_host 			= $my_host;
		$this->my_username		= $my_username;
		$this->my_password		= $my_password;
		
		$this->query_username 	= $query_username;
		$this->query_password	= $query_password;
		
		$this->table_name		= $table_name;
		$this->table_username	= $table_username;
		$this->table_password	= $table_password;	
		
		$this->redirect_accept	= $redirect_accept;
		$this->redirect_denied	= $redirect_denied;
           $this->redirect_opr	= $redirect_opr;
	}
		
	/* mysql function */
	function login_mysql() {
	
		mysql_connect($this->my_host,$this->my_username,$this->my_password);
		mysql_select_db($this->my_database);
		
	}
	
	/* login function */
	function login_check() {
		
		$raw = mysql_query("SELECT * FROM $this->table_name WHERE $this->table_username='$this->query_username' AND $this->table_password='$this->query_password' AND hak='ADMIN'") or die(mysql_error());
		$sqlopr = mysql_query("SELECT * FROM $this->table_name WHERE $this->table_username='$this->query_username' AND $this->table_password='$this->query_password' AND hak='OPERATOR'") or die(mysql_error());
		$checkadmin = mysql_fetch_row($raw);
	     $checkopr = mysql_fetch_row($sqlopr);
            
	 	session_start();
	 	
	 	if ($checkadmin[0] != "") {
	 		$_SESSION['loggedin'] = 1;
	 		if ($this->redirect_accept) header("Location: $this->redirect_accept");
	 	} else {
                if ($checkopr[0] != "") {
	 	 	    $_SESSION['loggedin'] = 1;
	 		    if ($this->redirect_opr) header("Location: $this->redirect_opr");
	 		} else {
                    $_SESSION['loggedin'] = 0;
	 		    if ($this->redirect_denied) header("Location: $this->redirect_denied");
	 		} 			 	
		}	
	}
}
?>
