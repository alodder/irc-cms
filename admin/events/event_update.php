<?php
	//POST[] = title, content, date, image?
	$event_id = trim($_POST['event_id']);
	$event_title = trim($_POST['event_title']);
	$event_date =  trim($_POST['event_date']);
	$event_description = trim($_POST['event_description']);
	$image_id=0;//id#
	
    /*** connect to database ***/
    include '../include/db_conn.php';
	include '../include/classes/event.php';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("UPDATE events SET event_title=:title, event_date=:date, event_description=:description WHERE event_id=:id");

        /*** bind the parameters ***/
        $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $event_title, PDO::PARAM_STR);
        $stmt->bindParam(':date', $event_date, PDO::PARAM_STR);
        $stmt->bindParam(':description', $event_description, PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        //unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = 'Event Updated';
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'Something unique already exists??';
        }
        else
        {;
            /*** if we are here, something has gone wrong with the database ***/
            //$message = 'We are unable to process your request. Please try again later';
			$message = $e->getMessage();
        }
    }

echo "<p>".$message."</p>";
?>
