<?php
	include 'include/db_connr.php';
	//include 'include/classes/event.php';  //Doh! this is in index.php!
	echo "<ul>";
	try {
	  	//pdo connect mysql
	  	$conn = new PDO("mysql:host=localhost;dbname=$mysql_database", $mysql_username, $mysql_password);
	  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // default is PDO::ERRMODE_SILENT
	  
	  	//pdo prepared statement
	  	$stmt = $conn->prepare('SELECT * FROM events ORDER BY event_date DESC');
	  	$stmt->execute();
	  	//Set fetch mode with class
	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
	  
	  	while($row = $stmt->fetch() ) {
	  		echo "<li id=\"eventid_$row->event_id\">";
	  		echo $row->printResult();
	  		echo $row->printControls();
	  		echo "</li>";
	  		//var_dump($row);
	  	}
	  }
	  catch (PDOException $e){
	  	echo 'Error: ' . $e->getMessage();
	  }
	  echo "</ul>";
?>
