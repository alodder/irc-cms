<?php 
class Event
{
	var $event_id;
	var $event_date;
	var $event_title;
	var $event_description;
	var $event_timeid;
	
	function getID()
	{
		return $this->event_id;
	}
	
	function getTitle ()
	{
		return $this->event_title;
	}
	
	function getPHPDate ()
	{
		return strtotime( $this->event_date);
	}
	 
	function printResult ()
	{
		echo "<h2>".date('M j', $this->getPHPDate())."</h2>";
		echo "<h3>".$this->event_title."</h3>";
		echo "<p>".$this->event_description."</p>";
	}
	 
	function printControls ()
	{
		//echo "<form>";
		echo "<input type=\"submit\" value=\"Edit\" onClick=\"sendRequest('events/event_editForm.php?id=".$this->getID()."', null, 'GET', 'eventid_".$this->getID()."');\" />";
		echo "<input type=\"submit\" value=\"Delete\" onClick=\"sendRequest('events/confirmdelete.php?id=".$this->getID()."', null, 'GET', 'eventid_".$this->getID()."');\" />";
		echo "<input type=\"submit\" value=\"Post to Facebook\" />";
		//echo "</form>";
	}
}
?>