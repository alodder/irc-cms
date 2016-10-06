<?php

include '../include/classes/sermon.php';
include '../include/db_conn.php';

if(isset($_GET['id'])){
   $id = $_GET['id'];
}

mysql_connect('localhost',$mysql_username,$mysql_password);
@mysql_select_db($mysql_database) or die( "Unable to select database");
$query="DELETE FROM sermons WHERE id='$id'";
mysql_query($query);
mysql_close();

?>

<div style="background-color:#efefef; display:inline-block; padding:1em; border:1px solid #ccc;">
	<?= "\"$id\" removed."; ?><br />
	<input type="submit" value="Ok" onClick="sendRequest('sermons/sermons.php', 'null', 'GET', 'content'); display(' ', 'palette');" />
</div>
