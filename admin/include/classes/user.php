<?php
class User
{
   var $id;
   var $username;
   var $password;
   var $email;
   var $lastlogin;
   
   /*function setBar ($bar)
   {
      $this->bar = $bar;  
   }*/
   
   function getID ()
   {
      return $this->id;  
   }
   
   function getUsername ()
   {
      return $this->username; 
   }
   
   function getPasswordHash ()
   {
      return $this->password; 
   }
   
   function getLastLogin (){
	   return $this->lastlogin;
   }
   
   function getUserEmail (){
	   return $this->email;
   }
   
   // printResult displays results page
   function printResult ()
   {
		echo "<div id=\"userdiv$this->id\" class=\"userResult\">";
		echo "<h3>".$this->getUserName()."</h3>";
		echo "<dl>";
		echo "<dt>uid: </dt>";
		echo "<dd>".$this->getID()."</dt>";
		echo "<dt>User email: </dt>";
		echo "<dd>".$this->getUserEmail()."</dt>";
		echo "<dt>Last Login: </dt>";
		echo "<dd>".$this->getLastLogin()."</dt>";
		echo "<a href=\"javascript:;\" onclick=\"sendRequest('users/updateForm.php\?id=$this->id', null, 'GET', 'userdiv$this->id');\" style=\"background: url('images/icons/pencil_24.png') no-repeat; background-position:left; padding:24px\">Edit</a>";
		echo "<a href=\"javascript:;\" onclick=\"sendRequest('users/deleteForm.php\?id=$this->id', null, 'GET', 'userdiv$this->id');window.location.hash='palette';\" style=\"background: url('images/icons/cset/24/delete.png') no-repeat; background-position:left; padding:24px\">Drop</a>";
		echo "</div>"; 
   }
   
   function printEdit ()
   {
		echo "<form id=\"updateForm\" action=\"javascript:sendRequest('users/updateSubmit.php', formData2QueryString('updateForm'), 'POST', 'userdiv$this->id');\" method=\"post\">";
		
		echo "<fieldset class=\"userid\">";
		echo "<h3>uid: $this->id</h3>";
		echo "<input type=\"hidden\" id=\"id\" name=\"id\" value=\"$this->id\" />";
		echo "</fieldset>";
		
		echo "<fieldset class=\"username\">";
		echo "<label for=\"username\">Username: </label>";
		echo "<input type=\"text\" id=\"username\" name=\"username\" value=\"$this->username\" maxlength=\"20\" />";
		echo "</fieldset>";
		
		echo "<fieldset class=\"password\">";
		echo "<label for=\"password\">Password: </label>";
		echo "<input type=\"password\" id=\"password\" name=\"password\" value=\"\" maxlength=\"20\"/> <br />";
		echo "<label for=\"password\">Confirm Password: </label>";
		echo "<input type=\"password\" id=\"cpassword\" name=\"cpassword\" value=\"\" maxlength=\"20\"/><br />";
		echo "</fieldset>";
		
		echo "<fieldset class=\"password\">";
		echo "<label for=\"password\">Email: </label>";
		echo "<input type=\"text\" id=\"email\" name=\"email\" value=\"$this->email\" maxlength=\"20\" />";
		echo "</fieldset>";
		
		echo "<input type=\"submit\" value=\"Update\" />";
		
		echo "</form>";
   }

	function deleteForm(){
		echo "<div class=\"delete\">";
		echo "<h2>Delete this user?</h2>";
		echo "<h3>".$this->getUserName()."</h3>";
		echo "<dl>";
		echo "<dt>uid: </dt>";
		echo "<dd>".$this->getID()."</dt>";
		echo "<dt>User email: </dt>";
		echo "<dd>".$this->getUserEmail()."</dt>";
		echo "<dt>Last Login: </dt>";
		echo "<dd>".$this->getLastLogin()."</dt>";
		echo "<a href=\"javascript:;\" onclick=\"sendRequest('users/delete.php?id=$this->id', null, 'GET', 'palette');\" style=\"background: url('images/icons/accepted_24.png') no-repeat; background-position:left; padding-left:24px; margin: .5em\"> Delete</a><br />";
		echo "<a href=\"javascript:;\" onclick=\"display(' ', 'palette');\" style=\"background: url('images/icons/cancel_24.png') no-repeat; background-position:left; padding-left:24px; margin:.5em\"> Cancel</a>";
		echo "</div>";
	}
}
?>