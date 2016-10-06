<?php
	include '../include/db_conn.php';

	if(isset($_GET['id'])){
	   $id = $_GET['id'];
	}
	
	try
	{
		$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
		/*** $message = a message saying we have connected ***/
	
		/*** set the error mode to excptions ***/
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		/*** prepare the deletion ***/
		$stmt = $dbh->prepare("DELETE FROM announcements WHERE ann_id=:id");
	
		/*** bind the parameters ***/
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	
		/*** execute the prepared statement ***/
		$stmt->execute();
	
		/*** unset the form token session variable ***/
		//unset( $_SESSION['form_token'] );
	
		/*** if all is done, say thanks ***/
		$message = 'Post removed';
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
	
	echo "<p>".$message."</p>";
	echo "<script type=\"text/javascript\">";
	echo "	removeElement('ann_id-$id');";
	echo "</script>";
?>
