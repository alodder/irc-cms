<?php
include 'dirs.php';
?>

    <form id="uploadForm" action="sermons/mp3_up.php" method="post" enctype="multipart/form-data" target="upload_target" >
	    <label class="file" for="file">Filename: </label>
	    <input type="file" name="file" id="file" required/><br />
	    
	    <label class="folder" for="folder">Folder: </label>
	    <select name="folder" id="folder">
	    <?
		foreach($dirs as $dir){
			echo "<option value =\"$dir\">$dir</option>";
		}
		?>
	    </select><br />
	    
	    <input type="submit" name="submit" value="Upload" onClick="display('Loading...', 'palette2')" />
    </form>
