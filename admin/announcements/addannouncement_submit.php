<?php
	//POST[] = title, content, date, image?
	$title = trim($_POST[title]);
	$content = trim($_POST[content]);
	//$date = trim($_POST[date]);
	$image_id=0;//id#
	
    /*** connect to database ***/
	include '../include/db_conn.php';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO announcements (date, ann_heading, ann_content, image_id ) VALUES (NOW(), :title, :content, :image_id )");

        /*** bind the parameters ***/
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
		$stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        //unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = 'New announcement added';
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
