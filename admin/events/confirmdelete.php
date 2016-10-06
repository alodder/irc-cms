<?php
	$id = $_GET['id'];
	
	include '../include/db_connr.php';
	include '../include/classes/event.php';
	
	try {
		//pdo connect mysql
		$conn = new PDO("mysql:host=localhost;dbname=$mysql_database", $mysql_username, $mysql_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // default is PDO::ERRMODE_SILENT
		 
		//pdo prepared statement
		$stmt = $conn->prepare('SELECT * FROM events WHERE event_id=:id');
		//Bind parameters
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		
		$stmt->execute();
		
		//Set fetch mode with class
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
		 
		 $event = $stmt->fetch();
	}
		catch (PDOException $e){
			echo 'Error: ' . $e->getMessage();
	}
	
	echo "<h2>Delete this Event?</h2>";
	echo "<div style=\"background-color:#ececec; padding:1em; \">";
	echo "<h3>".$event->getTitle()."</h3>";
	echo "<h4>".$event->event_date."</h4>";
	echo "<p>".$event->printResult()."</p>";
	echo "</div>";
	echo "<input type=\"button\" value=\"Confirm Delete\" onClick=\"sendRequest('events/event_delete.php?id=".$event->getID()."', null, 'GET', 'palette');\">";
	echo "<input type=\"button\" value=\"Cancel\" onClick=\"sendRequest('null.php', null, 'GET', 'palette');\">";
?>
