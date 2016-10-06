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

$row = mysql_fetch_object($result, 'User');
$row->deleteForm();
mysql_free_result($result);
?>