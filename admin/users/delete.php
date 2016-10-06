<?php
if(isset($_GET['id'])){
   $id = $_GET['id'];
}
/*** connect to database ***/
/*** mysql hostname ***/
$mysql_hostname = 'localhost';

/*** mysql username ***/
$mysql_username = 'lnlodder_usrsrmn';

/*** mysql password ***/
$mysql_password = 'reformed';

/*** database name ***/
$mysql_dbname = 'lnlodder_sermon';

try
{
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
	/*** $message = a message saying we have connected ***/

	/*** set the error mode to excptions ***/
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/*** prepare the insert ***/
	$stmt = $dbh->prepare("DELETE FROM users WHERE id=:id");

	/*** bind the parameters ***/
	$stmt->bindParam(':id', $id, PDO::PARAM_STR);

	/*** execute the prepared statement ***/
	$stmt->execute();

	/*** unset the form token session variable ***/
	unset( $_SESSION['form_token'] );

	/*** if all is done, say thanks ***/
	$message = "User $id removed";
}
catch(Exception $e)
{
	/*** check if the username already exists ***/
	if( $e->getCode() == 23000)
	{
		$message = 'Username error';
	}
	else
	{
		/*** if we are here, something has gone wrong with the database ***/
		//$message = 'We are unable to process your request. Please try again later';
		$message = $e->getMessage();
	}
}

echo "<div class=\"actionMessage\">".$message."</div>";
?>