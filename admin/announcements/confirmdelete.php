<?php
	$id = $_GET['id'];
	
	include '../include/db_connr.php';
	include '../include/classes/announcement.php';
	
	try
	{
		$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
		/*** $message = a message saying we have connected ***/
	
		/*** set the error mode to excptions ***/
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		/*** prepare the insert ***/
		$stmt = $dbh->prepare("SELECT * FROM announcements WHERE ann_id=:id");
	
		/*** bind the parameters ***/
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	
		/*** execute the prepared statement ***/
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Announcement');
		$annObject = $stmt->fetch();
	
		/*** unset the form token session variable ***/
		//unset( $_SESSION['form_token'] );
	
		/*** if all is done, say thanks ***/
		$message = 'Fetched';
	}
	catch(Exception $e)
	{
		$message = $e->getMessage();
	}
	
	//close connection
	$dbh = null;
	
	echo "<h2>Delete this announcement?</h2>";
	echo "<div style=\"background-color:#ececec; padding:1em; \">";
	echo "<h3>".$annObject->getTitle()."</h3>";
	echo "<h4>".$annObject->date."</h4>";
	echo "<p>".$annObject->getContent()."</p>";
	echo "</div>";
	echo "<input type=\"button\" value=\"Confirm Delete\" onClick=\"sendRequest('announcements/anndelete.php?id=".$annObject->getID()."', null, 'GET', 'ann_id-".$annObject->getID()."');\">";
	echo "<input type=\"button\" value=\"Cancel\" onClick=\"sendRequest('null.php', null, 'GET', 'palette');\">";
?>
