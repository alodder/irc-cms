<?php
	include 'include/db_connr.php';	//read-only db user
	//include 'include/classes/announcement.php'; // This is in /admin/index.php
	
	try {
		//pdo connect mysql
		$conn = new PDO("mysql:host=localhost;dbname=$mysql_database", $mysql_username, $mysql_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // default is PDO::ERRMODE_SILENT
		 
		//pdo prepared statement
		$stmt = $conn->prepare('SELECT * FROM announcements ORDER BY date DESC');
		$stmt->execute();
		//Set fetch mode with class
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Announcement');
		
		echo "<ul>";
		while($row = $stmt->fetch() ) {
			echo "<li id=\"ann_id-$row->ann_id\">";
			echo $row->printResult();
			echo $row->printControls();
			echo "</li>";
		}
		echo "</ul>";
	}
	catch (PDOException $e){
		echo 'Error: ' . $e->getMessage();
	}
	$conn = null;
?>
