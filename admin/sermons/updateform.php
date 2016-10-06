<?php

if(isset($_GET['id'])){
   $id = $_GET['id'];
}

include '../include/db_connr.php';
include '../include/classes/sermon.php';

mysql_connect(localhost,$mysql_username,$mysql_password);
@mysql_select_db($mysql_database) or die( "Unable to select database");
$query="SELECT * FROM sermons WHERE id='$id' LIMIT 1";
$result=mysql_query($query);
$num=mysql_num_rows($result);
mysql_close();

if($num != 0){
	$row = mysql_fetch_object($result, 'Sermon');

?>
<form name="updater" id="updater" action="javascript:sendRequest('sermons/update.php', formData2QueryString('updater'), 'POST', 'sermonid<?= $id ?>');">
    <h3>Edit Sermon Data - <? echo "$row->id"; ?></h3>
    <input type="hidden" name="id" id="id" value="<? echo "$row->id"; ?>">
    
    <fieldset class="title">
    	<label for="theme">Title: </label><input name="theme" id="theme" type="text" value="<? echo "$row->theme"?>" size="50"><br />
        <label for="series">Series: </label><input name="series" id="series" type="text" value="<? echo "$row->series"?>" size="50"><br />
        <label for="scripred">Scripture read: </label><input name="scripred" id="scripred" type="text" value="<? echo "$row->scripred"?>" size="50"><br />
        <label for="scriptxt">Scripture text: </label><input name="scriptxt" id="scriptxt" type="text" value="<? echo "$row->scriptxt"?>" size="50"><br />
        <label for="catred">Catechism read: </label><input name="catred" id="catred" type="text" value="<? echo "$row->catred"?>" size="50"><br />
    </fieldset>
    <fieldset class="date">
    	<label class="date" for="datetime">Date: </label><input type="datetime-local" name="datetime" id="datetime" value="<?= date("Y-m-d\TH:i", strtotime( $row->date)) ?>"><br />
    	<label class="speaker" for="preacher">Speaker: </label><input type="text" name="preacher" id="preacher" value="<? echo "$row->preacher"?>"><br />
    </fieldset>
    
    <fieldset class="link">
    	<label class="download" for="url">Download: </label><input name="url" id="url" type="url" value="<? echo "$row->dload"?>" size="100"><br />
    </fieldset>

	<fieldset class="control">
		<input type="submit" value="Update">
	</fieldset>
	
</form>
<?
} else {
	echo "no entry for ";
}
mysql_free_result($result);
?>
