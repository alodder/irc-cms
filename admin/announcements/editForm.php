<?php
	$id = $_GET['id'];
	
	include '../include/db_connr.php';
	include '../include/classes/announcement.php';
	
	mysql_connect(localhost,$mysql_username,$mysql_password);
	@mysql_select_db($mysql_database) or die( "Unable to select database");
	$sql="SELECT * FROM announcements WHERE ann_id='$id';";
	$result=mysql_query($sql);
	$num=mysql_numrows($result);
	
	$annObject = mysql_fetch_object($result, 'Announcement');

	mysql_free_result($result);
?>

<form id="editForm" action="javascript:sendRequest('announcements/announcement_update.php', formData2QueryString('editForm'), 'POST', '<?= "ann_id-".$annObject->ann_id ?>');" method="post">
	<input type="hidden" id="id" value="<?=$annObject->getID();?>" />
	<input type="hidden" id="date" value="<?=$annObject->date;?>" />
	<p>
		<input type="text" id="title" name="title" value="<?=$annObject->getTitle(); ?>" maxlength="30" required/>
		<label for="title">Title/Heading: </label>
	</p>
	<p>
		<textarea rows="2" cols="20" id="content" name="content" required >
		<?=$annObject->getContent();?>
		</textarea>
		<label for="content">Content: </label>
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
	</p>
</form>
