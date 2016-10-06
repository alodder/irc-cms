<form id="insertForm" action="javascript:sendRequest('events/event_insert.php', formData2QueryString('insertForm'), 'POST', null);" method="post">
	<p>
		<input type="date" id="event_date" name="event_date" value="" required/>
		<label for="event_date">Date: </label>
	</p>
	<p>
		<input type="text" id="event_title" name="event_title" value="" maxlength="30" required/>
		<label for="event_title">Title: </label>
	</p>
	<p>

		<textarea rows="2" cols="20" id="event_description" name="event_description" required ></textarea>
		<label for="event_description">Description: </label>
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
		<input type="submit" value="Add" />
		<input type="button" value="Cancel" />
	</p>
</form>
