<?php
	include 'include/db_connr.php';
	include 'include/classes/user.php';
	
	mysql_connect(localhost,$mysql_username,$mysql_password);
	@mysql_select_db($mysql_database) or die( "Unable to select database");
	$sql="SELECT * FROM users;";
	$result=mysql_query($sql);
	$num=mysql_numrows($result);
	
	while ($row = mysql_fetch_object($result, 'User')) {
		$row->printResult();
		$oddrow = $oddrow*(-1);
	}
	mysql_free_result($result);
?>