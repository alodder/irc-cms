<?php

/*** begin our session ***/
session_start();

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<form id="insertForm" action="javascript:sendRequest('users/adduser_submit.php', formData2QueryString('insertForm'), 'POST', null);" method="post">
<p>
<input type="text" id="username" name="username" value="" maxlength="20" required/>
<label for="username">Username</label>
</p>
<p>
<input type="password" id="password" name="password" value="" maxlength="20" required/>
<label for="password">Password</label>
</p>
<p>
<input type="password" id="cpassword" name="cpassword" value="" maxlength="20" required/>
<label for="password">Confirm Password</label>
</p>
<p>
<input type="email" id="email" name="email" value="" maxlength="60" />
<label for="password">Email</label>
</p>
<p>
<input type="hidden" id="form_token" value="<?php echo $form_token; ?>" />
<input type="submit" value="Create" />
</p>
</form>
