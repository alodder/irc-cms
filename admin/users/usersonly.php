<?php

/*** begin the session ***/
session_start();

if(!isset($_SESSION['id']))
{
    $message = 'You must be logged in to access this page';
}
else
{
    try
    {
        /*** connect to database ***/
        include '../include/db_connr.php';


        /*** select the users name from the database ***/
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT username FROM users 
        WHERE id = :id");

        /*** bind the parameters ***/
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $username = $stmt->fetchColumn();

        /*** if we have no something is wrong ***/
        if($username == false)
        {
            $message = 'Access Error';
        }
        else
        {
            $message = 'Welcome '.$username;
        }
    }
    catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $message = "We are unable to process your request. Please try again later\n".$e->__toString();
    }
}

?>

<html>
<head>
<title>Members Only Page</title>
</head>
<body>
<h2><?php echo $message; ?></h2>
</body>
</html>