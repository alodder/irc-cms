<form id="insertForm" action="javascript:sendRequest('announcements/addannouncement_submit.php', formData2QueryString('insertForm'), 'POST', null);" method="post">
	<p>
		<input type="text" id="title" name="title" value="" maxlength="30" required/>
		<label for="title">Title/Heading: </label>
	</p>
	<p>
		
		<textarea rows="2" cols="20" id="content" name="content" required ></textarea>
		<label for="content">content: </label>
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
		<input type="submit" value="Announce!" />
	</p>
</form>
