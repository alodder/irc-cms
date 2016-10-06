<?php
if (strcmp($_SERVER['SERVER_NAME'], "admin.immanuelsreformed.org") == 0) {
	include '/home/lnlodder/include/classes/sermon.php';
	include '/home/lnlodder/include/db_conn.php';
}
else {
	include '../include/classes/sermon.php';
	include '../include/db_conn.php';
}


if(isset($_GET['id'])){
   $id = $_GET['id'];
}

mysql_connect('localhost',$mysql_username,$mysql_password);
@mysql_select_db($mysql_database) or die( "Unable to select database"); 
$query="SELECT * FROM sermons WHERE id='$id' LIMIT 1";
$result=mysql_query($query);
$num=mysql_num_rows($result);
mysql_close();

$i=0;
if($num != 0){
	$row = mysql_fetch_object($result, 'Sermon');
	
	$date=$row->date;
	$preacher=$row->preacher;
	$scripred=mysql_result($result,$i,"scripred");
	$scriptxt=mysql_result($result,$i,"scriptxt");
	$catred=mysql_result($result,$i,"catred");
	$theme=mysql_result($result,$i,"theme");
	$dload=mysql_result($result,$i,"dload");
?>
<div class="deletepage" >
	<? $row->printDeleteMode(); ?>
	<input type=button onClick="sendRequest('sermons/deleter.php?id=<? echo "$id"; ?>', null, 'POST', 'palette'); closeWindow('sermonid<?= $id?>');" value="Delete" />
	<input type=button  onClick="sendRequest('sermons/sermons.php', null, null, 'content');" value="Cancel">
</div>
<?
} else {
	echo "Bad id: $id";
}
mysql_free_result($result);