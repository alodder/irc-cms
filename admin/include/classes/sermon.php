<?php
$orders=array("DESC" => "Descending", "ASC" => "Ascending");
$fielders=array("id" => "id#", "date" => "Date", "preacher" => "Preacher", "scripred" => "Reading", "scriptxt" => "Text", "catred" => "Catechism", "theme" => "Theme",);

class Sermon
{
   var $id;
   var $date;
   var $preacher;
   var $scripred;
   var $scriptxt;
   var $catred;
   var $theme;
   var $series;
   var $dload;
   
   /*function setBar ($bar)
   {
      $this->bar = $bar;  
   }*/
   
   function getDate ()
   {
      return $this->date;  
   }
   
   function getPHPDate ()
   {
      return strtotime( $this->date);  
   }
   
   function printDate ()
   {
      echo strtotime( $this->date);  
   }
   
   function getAudioLink (){
   	  return $this->dload;
   }
   
   // printResult displays div for sermonlist in search results page
   function printResult ($pageNum, $search, $sort, $order)
   {
		echo "<div id=\"sermonid$this->id\" class=\"sermonResult\" >\n";
		
		echo "<div class=\"sermonTitle\">\n";
		//make sermon profile link,should send id, pageNum, search, sort date
		
		echo "<h3>id:".$this->id." &quot;";
		if($this->series) { echo $this->series.": ";}
		if($this->theme) { echo $this->theme;}
		echo "&quot;</h3>\n";
		
		if ( $this->scripred) 
		{
			echo '<p><span class="scripTitle">Scripture reading: </span>'.$this->scripred.'</p>';
		}
		if ( $this->scriptxt&&($this->scripred!==$this->scriptxt)) 
		{
			echo '<p><span class="scripTitle">Scripture text: </span>'.$this->scriptxt.'</p>';
		}
		if ($this->catred) {
			echo '<p><span class="scripTitle">Catechism reading:</span> '.$this->catred.'</p>';
		}
		echo "</div>";
		
		echo "<div class=\"sermonDate\">";
		echo "<p>Delivered on:<br />";
		if($this->date) { echo date("M d, Y", $this->getPHPDate()).' '.date("a", $this->getPHPDate()); }
		if($this->preacher) { echo "<br /> by $this->preacher";}
		echo "</div>";
		
		echo "<div class=\"sermonLinks\">";
		if (isset($this->listen)){
			?><a href="javascript:;" onclick="window.open('scripts/sermonstream.php?id=<? echo $this->itemid; ?>', 'popup', 'width=480,height=80,scrollbars=no'); return false" class="imglink">Listen Now: <img src="/images/run-copy-32x32.png" width="32" height="32" alt="Listen" /></a><br /><? } ?>
		<?
		if ($this->dload){
			?><a href="<? echo $this->dload; ?>" class="imglink">Download: <img src="images/icons/cset/32/download.png" width="32" height="32" alt="Download" /></a><? } ?>
		<?
		echo "<form>";
		echo "	<input type=\"hidden\" name=\"id\" value=\"";
		echo (isset($id))?$id:"";
		echo "\">";
		echo "	<input type = \"button\" value=\"Edit\" onclick=\"sendRequest('sermons/updateform.php\?id=$this->id', null, 'GET', 'sermonid$this->id');\">";
		//echo "	<input type = \"button\" value=\"Edit\" onclick=\"sendRequest('sermons/updateform.php\?id=$this->id', null, 'GET', 'palette');\">";
		echo "	<input type = \"button\" value = \"Delete\" onclick= \"sendRequest('sermons/delete.php\?id=$this->id', null, 'GET', 'sermonid$this->id');\">";
		echo "</form>";
		
		echo "</div>";
		
		
		echo "</div>"; 
   }

	function printEditMode ($pageNum, $search, $sort, $order){
		//
	}
	
	function printDeleteMode (){
		echo "<div id=\"sermonid$this->id\" class=\"sermonResult delete\" >\n";
		
		echo "<div class=\"sermonTitle\">\n";
		echo "<p>Are you sure you want to delete this listing: </p>";
		//make sermon profile link,should send id, pageNum, search, sort date
		
		echo "<h3>id:".$this->id." &quot;";
		if($this->series) { echo $this->series.": ";}
		if($this->theme) { echo $this->theme;}
		echo "&quot;</h3>\n";
		
		if ( $this->scripred) 
		{
			echo '<p><span class="scripTitle">Scripture reading: </span>'.$this->scripred.'</p>';
		}
		if ( $this->scriptxt&&($this->scripred!==$this->scriptxt)) 
		{
			echo '<p><span class="scripTitle">Scripture text: </span>'.$this->scriptxt.'</p>';
		}
		if ($this->catred) {
			echo '<p><span class="scripTitle">Catechism reading:</span> '.$this->catred.'</p>';
		}
		echo "</div>";
		
		echo "<div class=\"sermonDate\">";
		echo "<p>Delivered on:<br />";
		if($this->date) { echo date("M d, Y", $this->getPHPDate()).' '.date("a", $this->getPHPDate()); }
		if($this->preacher) { echo "<br /> by $this->preacher";}
		echo "</div>";
		
		echo "<div class=\"sermonLinks\">";
		if ($this->listen){
			?><a href="javascript:;" onclick="window.open('scripts/sermonstream.php?id=<? echo $this->itemid; ?>', 'popup', 'width=480,height=80,scrollbars=no'); return false" class="imglink">Listen Now: <img src="/images/run-copy-32x32.png" width="32" height="32" alt="Listen" /></a><br /><? } ?>
		<?
		if ($this->dload){
			?><a href="<? echo $this->dload; ?>" class="imglink">Download: <img src="images/icons/cset/32/download.png" width="32" height="32" alt="Download" /></a><? } ?>
		<?
		echo "</div>";
		echo "</div>";
	}
}
?>