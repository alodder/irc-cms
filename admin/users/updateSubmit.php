<?php
/*** begin our session ***/
session_start();

/*** first check that both the username, password and form token have been sent ***/
if(!isset( $_POST['id']))
{
    $message = 'Please select a valid user';
}
elseif(!isset( $_POST['username']))
{
    $message = 'Please enter a valid username and password';
}
/*** check the form token is valid ***/
elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['username']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['password']) != true)
{
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
}
/*** check the password and confirm password match ***/
elseif (($_POST['password']) != ($_POST['cpassword']))
{
        /*** if there is no match ***/
        $message = "Passwords must match";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$id = $_POST['id'];

    /*** now we can encrypt the password ***/
    //$password = sha1( $password );
	$password = hash('sha256', $username . $password);
    
    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'lnlodder_usrsrmn';

    /*** mysql password ***/
    $mysql_password = 'reformed';

    /*** database name ***/
    $mysql_dbname = 'lnlodder_sermon';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("UPDATE users SET username=:username, password=:password WHERE id=:id");

        /*** bind the parameters ***/
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );

        /*** if all is done, say thanks ***/
        $message = 'User updated';
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
        }
        else
        {
            /*** if we are here, something has gone wrong with the database ***/
            //$message = 'We are unable to process your request. Please try again later';
			$message = $e->getMessage();
        }
    }
}

echo "<p>".$message."</p>";
?>