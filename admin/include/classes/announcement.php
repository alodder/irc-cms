<?php
class Announcement
{
   var $ann_id;
   var $ann_heading;
   var $ann_content;
   var $image_id;
   var $date;
   
   /*function setBar ($bar)
   {
      $this->bar = $bar;  
   }*/
   
   /*function __construct( $id, $title, $content, $image_id, $indate){
   	  $this->ann_id = $id;
   	  $this->ann_heading = $title;
   	  $this->ann_content = $content;
   	  $this->image_id = $image_id;
   	  $this->date = $indate;
   }*/
   
   function getID ()
   {
      return $this->ann_id;
   }
   
   function getTitle ()
   {
      return $this->ann_heading;
   }
   
    function getDate ()
   {
      return $this->date;
   }
   
   function getPHPDate ()
   {
      return strtotime( $this->date);
   }
   
   function getContent ()
   {
      return $this->ann_content;
   }
   
   // printResult displays results page
   function printResult ()
   {
		echo "<div class=\"announcement\">";
		echo "<h2>".$this->getTitle()."</h2>";
		echo "<h3>".date("M d, Y", $this->getPHPDate())."</h3>";
		echo "<p>".$this->getContent()."</p>";
		echo "</div>";
   }
   
   function printResultListItem ()
   {
		echo "<li class=\"announcement\">";
		echo "<h2>".$this->getTitle()."</h2>";
		echo "<p>".$this->getContent()."</p>";
		echo "</li>"; 
   }
   
   function printControls ()
   {
		//echo "<form>";
		echo "<div class=\"controls\">";
		echo "<input type=\"submit\" value=\"Edit\" onClick=\"sendRequest('announcements/editForm.php?id=".$this->getID()."', null, 'GET', 'ann_id-$this->ann_id');\" />";
		echo "<input type=\"submit\" value=\"Delete\" onClick=\"sendRequest('announcements/confirmdelete.php?id=".$this->getID()."', null, 'GET', 'ann_id-$this->ann_id');\" />";
		echo "<input type=\"submit\" value=\"Post to Facebook\" />";
		echo "</div>";
		//echo "</form>";
   }
}
?>
