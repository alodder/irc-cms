<?php
/*** database info ***/
(strcmp($_SERVER['SERVER_NAME'], "admin.immanuelsreformed.org") == 0 ) ? require '/home/lnlodder/include/db_conn.php' : require '../include/db_conn.php';

/*** collect POST data ***/
//$in_date=$_POST["year"].'-'.$_POST["month"].'-'.$_POST["day"].' '.$_POST["hour"];
$in_date=$_POST["datetime"];
$in_preacher=trim($_POST["preacher"]);
$in_scripred=trim($_POST["scripred"]);
$in_scriptxt=trim($_POST["scriptxt"]);
$in_catred=trim($_POST["catred"]);
$in_theme=trim($_POST["theme"]);
$in_series=trim($_POST["series"]);
$in_dload=trim($_POST["url"]);

try
{
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
	/*** $message = a message saying we have connected ***/

	/*** set the error mode to excptions ***/
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/*** prepare the insert ***/
	$stmt = $dbh->prepare("INSERT INTO sermons (date, preacher, scripred, scriptxt, catred, theme, series, dload) VALUES (:date, :preacher, :scripred, :scriptxt, :catred, :theme, :series, :url)");

	/*** bind the parameters ***/
	$stmt->bindParam(':date', $in_date, PDO::PARAM_STR);
	$stmt->bindParam(':preacher', $in_preacher, PDO::PARAM_STR);
	$stmt->bindParam(':scripred', $in_scripred, PDO::PARAM_STR);
	$stmt->bindParam(':scriptxt', $in_scriptxt, PDO::PARAM_STR);
	$stmt->bindParam(':catred', $in_catred, PDO::PARAM_STR);
	$stmt->bindParam(':theme', $in_theme, PDO::PARAM_STR);
	$stmt->bindParam(':series', $in_series, PDO::PARAM_STR);
	$stmt->bindParam(':url', $in_dload, PDO::PARAM_STR);

	/*** execute the prepared statement ***/
	$stmt->execute();

	/*** unset the form token session variable ***/
	//unset( $_SESSION['form_token'] );

	/*** if all is done, say thanks ***/
	$message = "Sermon \"$in_theme\" added";
}
catch(Exception $e)
{
	/*** check if the username already exists ***/
	if( $e->getCode() == 23000)
	{
		$message = 'Something unique already exists??';
	}
	else
	{
		/*** if we are here, something has gone wrong with the database ***/
		//$message = 'We are unable to process your request. Please try again later';
		$message = $e->getMessage();
	}
}

//close connection
$dbh = null;

//echo "<p>".$message."</p>";

/*
 * //$queryi = "INSERT INTO sermons VALUES ('$in_id','$in_date','$in_preacher','$in_scripred','$in_scriptxt','$in_catred','$in_theme','$in_series','$in_dload')";
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
*/
?>

<div style="background-color:#efefef; display:inline-block; padding:1em; border:1px solid #ccc;">
	<?= $message; ?><br />
	<input type="submit" value="Ok" onClick="sendRequest('sermons/sermons.php', 'null', 'GET', 'content'); display(' ', 'palette2');" />
</div>
