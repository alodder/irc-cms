<?php
include 'login_submit.php';
?>
<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <title>IRCWebAdmin v2.1</title>
 <link rel="stylesheet" href="../css/login.css" type="text/css" />
</head>



<body>
  <form action="login_form.php" method="post">
    <fieldset>
      <p><label for="username">Username </label><input class="text" type="text" id="username" name="username" value="" maxlength="20" required/></p>
      <p><label for="password">Password </label> <input class="text" type="password" id="password" name="password" value="" maxlength="20" required/></p>
      <p><input id="button" type="submit" value="Login" /></p> 
    </fieldset>
    <div><?= $message ?></div>
  </form>
  
</body> 
</html>

