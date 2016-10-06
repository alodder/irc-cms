<?php
	//POST[] = title, content, date, image?
	$id = trim($_POST[id]);
	$title = trim($_POST[title]);
	$content = trim($_POST[content]);
	$image_id=0;//id#
	$date = trim($_POST[date]);
	
    /*** connect to database ***/
    include '../include/db_conn.php';
    include '../include/classes/announcement.php';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("UPDATE announcements SET ann_heading=:title, ann_content=:content, image_id=:image_id WHERE ann_id=:id");

        /*** bind the parameters ***/
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
		$stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** if all is done, say thanks ***/
        $message = 'Updated';
        
        //pdo prepared statement
        $stmt = $dbh->prepare('SELECT * FROM announcements WHERE ann_id=:id ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        //Set fetch mode with class
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Announcement');
        $object = $stmt->fetch();
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

echo $object->printResult();
echo "<p class=\"itemmessage\" style=\"font-weight:bold;color:#33cc33\">".$message."</p>";
echo $object->printControls();
?>
