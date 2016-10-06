<?php

include("../include/db_conn.php");
mysql_connect(localhost,$mysql_username,$mysql_password);

$ud_id=$_POST["id"];
$ud_date=$_POST["datetime"];
$ud_preacher=trim($_POST["preacher"]);
$ud_scripred=trim($_POST["scripred"]);
$ud_scriptxt=trim($_POST["scriptxt"]);
$ud_catred=trim($_POST["catred"]);
$ud_theme=trim($_POST["theme"]);
$ud_series=trim($_POST["series"]);
$ud_dload=trim($_POST["url"]);

//$query= "UPDATE sermons SET date='$ud_date', preacher='$ud_preacher', scripred='$ud_scripred', scriptxt='$ud_scriptxt', catred='$ud_catred', theme='$ud_theme', series='$ud_series', dload='$ud_dload' WHERE id='$ud_id'";
$query = sprintf("UPDATE sermons SET date='%s', preacher='%s', scripred='%s', scriptxt='%s', catred='%s', theme='%s', series='%s', dload='%s' WHERE id='$ud_id'",
mysql_real_escape_string($ud_date),
mysql_real_escape_string($ud_preacher),
mysql_real_escape_string($ud_scripred),
mysql_real_escape_string($ud_scriptxt),
mysql_real_escape_string($ud_catred),
mysql_real_escape_string($ud_theme),
mysql_real_escape_string($ud_series),
mysql_real_escape_string($ud_dload));


@mysql_select_db($mysql_database) or die( "Unable to select database");
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
} else {
	echo "<script type=\"text/javascript\" language=\"javascript\">";
	echo "display('66', 'palette2');";
	echo "</script>";
	
	echo "<p><strong>$ud_id Successfully Updated</strong><br />";
	echo "Date: $ud_date<br />";
	echo "Title: $ud_theme<br />";
	echo "Series: $ud_series<br />";
	echo "Speaker: $ud_preacher<br />";
	echo "Scripture read: $ud_scripred<br />";
	echo "Scripture text: $ud_scriptxt<br />";
	echo "Catechism: $ud_catechism<br />";
	echo "mp3 URL: $ud_dload<br />";
}
mysql_close();
?>

<input type="submit" value="Ok" onClick="sendRequest('sermons/sermons.php', 'null', 'GET', 'content');" />