<?php
	$event_id = $_GET['id'];
	
	date_default_timezone_set('America/Los_Angeles');
	
	include '../include/db_connr.php';
	include '../include/classes/event.php';
	
	try {
		//pdo connect mysql
		$conn = new PDO("mysql:host=localhost;dbname=$mysql_database", $mysql_username, $mysql_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // default is PDO::ERRMODE_SILENT
		 
		//pdo prepared statement
		$stmt = $conn->prepare('SELECT * FROM events WHERE event_id=:id');
		$stmt->bindParam(':id', $event_id);
		$stmt->execute();
		//Set fetch mode with class
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
		 
		$event = $stmt->fetch();
	}
	catch (PDOException $e){
		echo 'Error: ' . $e->getMessage();
	}
	$conn = null;
?>

<form id="editForm" action="javascript:sendRequest('events/event_update.php', formData2QueryString('editForm'), 'POST', 'eventid_<?= $event->event_id ?>');" method="post">
	<input type="hidden" id="event_id" value="<?=$event->event_id;?>" />
	<p>
		<input type="date" id="event_date" name="event_date" value="<?= $event->event_date ?>" required/>
		<label for="event_date">Date: </label>
	</p>
	<p>
		<input type="text" id="event_title" name="event_title" value="<?=$event->event_title; ?>" maxlength="30" required/>
		<label for="event_title">Title: </label>
	</p>
	<p>

		<textarea rows="2" cols="20" id="event_description" name="event_description" required ><?=$event->event_description;?></textarea>
		<label for="event_description">Description: </label>
	</p>
	<? /*<p>
		<input type="date" id="date" name="date" value="" maxlength="20" required/>
		<label for="date">date</label>
	</p> */ ?>
	<? /*<p>
		<input type="file" id="image" name="image" value="" maxlength="60" />
		<label for="image">image</label>
	</p>*/ ?>
	<p>
		<input type="submit" value="Update" />
		<input type="button" value="Cancel" onclick="" />
	</p>
</form>
