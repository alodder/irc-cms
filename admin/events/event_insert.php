<?php
	//POST[] = title, content, date, image?
	$date = trim($_POST['event_date']);
	$title = trim($_POST['event_title']);
	$description = trim($_POST['event_description']);
	$timeid = null;
	
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
        $stmt = $dbh->prepare("INSERT INTO events (event_date, event_title, event_description, event_timeid )
        								   VALUES (:date, :title, :description, :timeid )");

        /*** bind the parameters ***/
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':timeid', $timeid, PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        //unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = 'New event added';
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
?>
