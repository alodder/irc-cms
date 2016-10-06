<?php

if(isset($_GET['id'])){
   $id = $_GET['id'];
}
include '../include/db_connr.php';
include '../include/classes/user.php';

mysql_connect(localhost,$mysql_username,$mysql_password);
@mysql_select_db($mysql_database) or die( "Unable to select database");
$sql="SELECT * FROM users WHERE id=$id;";
$result=mysql_query($sql);
$num=mysql_numrows($result);

if(!($num > 0)){
	echo "<p>User with id $id does not exist.</p>";
} else {

	$row = mysql_fetch_object($result, 'User');
	$row->printEdit();
	mysql_free_result($result);
}
?>