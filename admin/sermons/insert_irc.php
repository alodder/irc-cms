<?php
include '../include/db_conn.php';
mysql_connect('localhost',$mysql_username,$mysql_password);
@mysql_select_db($mysql_database) or die( "Unable to select database"); 

$in_date=$_POST["year"].'-'.$_POST["month"].'-'.$_POST["day"].' '.$_POST["hour"];
$in_preacher=trim($_POST["preacher"]);
$in_scripred=trim($_POST["scripred"]);
$in_scriptxt=trim($_POST["scriptxt"]);
$in_catred=trim($_POST["catred"]);
$in_theme=trim($_POST["theme"]);
$in_series=trim($_POST["series"]);
$in_dload=trim($_POST["dload"]);

//$queryi = "INSERT INTO sermons VALUES ('$in_id','$in_date','$in_preacher','$in_scripred','$in_scriptxt','$in_catred','$in_theme','$in_series','$in_dload')";
$queryi = sprintf("INSERT INTO sermons VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
mysql_real_escape_string(0),
mysql_real_escape_string($in_date),
mysql_real_escape_string($in_preacher),
mysql_real_escape_string($in_scripred),
mysql_real_escape_string($in_scriptxt),
mysql_real_escape_string($in_catred),
mysql_real_escape_string($in_theme),
mysql_real_escape_string($in_series),
mysql_real_escape_string($in_dload));

$result = mysql_query($queryi);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
mysql_close();
?>


<div style="background-color:#efefef; display:inline-block; padding:1em; border:1px solid #ccc;">
	<?= "\"$in_theme\" added."; ?><br />
	<input type="submit" value="Ok" onClick="sendRequest('sermons/sermons.php', 'null', 'GET', 'content'); display(' ', 'palette2');" />
</div>