<?php
	include '../include/db_conn.php';
	//include '../include/classes/event.php';
	
	if(isset($_GET['id'])){
	   $id = $_GET['id'];
	}
	
	try {
		//pdo connect mysql
		$conn = new PDO("mysql:host=localhost;dbname=$mysql_database", $mysql_username, $mysql_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // default is PDO::ERRMODE_SILENT
			
		//pdo prepared statement
		$stmt = $conn->prepare('DELETE FROM events WHERE event_id=:id');
		//Bind parameters
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	
		$stmt->execute();
		
		$message = "Deleted";
	}
	catch (PDOException $e){
		echo 'Error: ' . $e->getMessage();
	}
	
	echo $message;
?>
