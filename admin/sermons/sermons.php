<?php
//initialize variables
include '../include/db_connr.php';
include '../include/classes/sermon.php';

$orders=array("ASC" => "Ascending", "DESC" => "Descending");
$fielders=array("id" => "id#", "date" => "Date", "preacher" => "Preacher", "scripred" => "Reading", "scriptxt" => "Text", "catred" => "Catechism", "theme" => "Theme",);

if(isset($_GET['page'])){
	$pageNum = $_GET['page'];
}
if(isset($_GET['sort'])){
   $sort = $_GET['sort'];
} else {
	$sort='id';
}
if(isset($_GET['order'])){
   $order= $_GET['order'];
} else {
	$order='DESC';
}

if(isset($_GET['search'])){
   $search= $_GET['search'];
}

//multipaging
$rowsPerPage = 10;							//how many sermons to show per page
$pageNum = 1;								// by default we show first page
$offset = ($pageNum - 1) * $rowsPerPage;	//calculate offset

//mysql connect
//mysql_connect('localhost',$mysql_username,$mysql_password);
//@mysql_select_db($mysql_database) or die( "Unable to select database");
$mysqli = mysqli_connect('localhost',$mysql_username,$mysql_password,$mysql_database);
if (!$mysqli) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

if (!isset($search)) {
	$querypage="SELECT COUNT(id) AS numrows FROM sermons";
	$sql="SELECT * FROM sermons ORDER BY ".$sort." $order LIMIT $offset, $rowsPerPage";
} else {
	$search = strip_tags($search);
	//$search=trim ($search);
	$split = split(" ",$search);
	foreach ($split as $array => $value) {
		$new_string .= ''.$value.' ';
	}
	$new_string=substr($new_string,0,(strLen($new_string)-1));
	$split_stemmed = split(" ",$new_string);
	$sql = "SELECT DISTINCT * FROM sermons WHERE (";

	$querypage ="SELECT COUNT(id) AS numrows FROM sermons WHERE (";
	while(list($key,$val)=each($split_stemmed)){
		if($val<>" " and strlen($val) > 0){
			$sql .= "(date LIKE '%$val%' OR preacher LIKE '%$val%' OR scripred LIKE '%$val%' OR scriptxt LIKE '%$val%' OR catred LIKE '%$val%' OR theme LIKE '%$val%') AND";
			$querypage .= "(date LIKE '%$val%' OR preacher LIKE '%$val%' OR scripred LIKE '%$val%' OR scriptxt LIKE '%$val%' OR catred LIKE '%$val%' OR theme LIKE '%$val%') AND";
		}
	}
	$sql=substr($sql,0,(strLen($sql)-4));//this will eat the last OR
	$sql .= ") ORDER BY ".$sort." $order"." LIMIT $offset, $rowsPerPage";
	$querypage=substr($querypage,0,(strLen($querypage)-4));//this will eat the last OR
	$querypage .= ") ORDER BY ".$sort." $order";
	}
//$result=mysql_query($sql);
$result=mysqli_query($mysqli, $sql);
//$num=mysql_numrows($result);
$num=$result->num_rows;

function makeLink($page, $sort, $order, $search)
{
	//$link = $_SERVER['PHP_SELF']."?articles=sermons&amp;page=$page";
	$link = "index.php?articles=sermons&amp;page=$page";
	if ($sort&&($sort!="date")){
		$link .= "&amp;sort=$sort";
	}
	if ($order&&($order!="DESC")){
		$link .= "&amp;order=$order";
	}
	if ($search){
		$link .= "&amp;search=$search";
	}
	return $link;
}

//make multi page links
//$querypage    = "SELECT COUNT(id) AS numrows FROM sermons";

$pageresult   = mysqli_query($mysqli, $querypage) or die('Error, query failed');
$row      = mysqli_fetch_array($pageresult, MYSQL_ASSOC);
$numrows  = $row['numrows'];
$maxPage  = ceil($numrows/$rowsPerPage);
$nextLink = '';
if($maxPage > 1)
{
   $self = $_SERVER['PHP_SELF'];
   $nextLink = array();

   if(!isset($search)){
   	$search = "";
   }
   
   if ($pageNum > 1)
	{
	   $page  = $pageNum - 1;
	   $prev  = " &laquo; <a href=\"".makeLink($page, $sort, $order, $search)."\">Prev</a> ";
	
	   $first = " &laquo; <a href=\"".makeLink(1, $sort, $order, $search)."\">First Page</a> ";
	} 
	else
	{
	   $prev  = '&nbsp;'; // we're on page one, don't print previous link
	   $first = '&nbsp;'; // nor the first page link
	}
	
	if ($pageNum < $maxPage)
	{
	   $page = $pageNum + 1;
	   $next = " <a href=\"".makeLink($page, $sort, $order, $search)."\">Next</a> &raquo; ";
	
	   $last = " <a href=\"".makeLink($maxPage, $sort, $order, $search)."\">Last Page</a> &raquo; ";
	}
	else
	{
	   $next = '&nbsp;'; // we're on the last page, don't print next link
	   $last = '&nbsp;'; // nor the last page link
	}
   
   $nextLink = $first.$prev." Page ".$pageNum." of $maxPage".$next.$last;
}
//end mke pagelinks
//mysql_close();
	
if (!isset($sermonId)||(($sermonId)&&($num == 0))){
	?>
	<div class="sermonlist">
		<?
		if ($num == 0) {
		   echo '<div class="searchmessage">Your search for &#8220;'.$search.'&#8221; returned no results. <h4>Suggestions:</h4><ul><li>Make sure all words are spelled correctly.</li><li>Try different keywords.</li></ul></div>';
		} else {
			if( $search){
				echo "<p>Your search for $search produced $numrows results</p>";
			}
			echo "<div class=\"pageLinks\">";
			echo $nextLink;
			echo "</div>";
			while ($row = mysqli_fetch_object( $result, 'Sermon')) {
				$row->printResult($pageNum, $search, $sort, $order);
				//$oddrow = $oddrow*(-1);
			}
			mysqli_free_result($result);
		}
		echo "<div class=\"pageLinks\">";
		echo $nextLink;
		echo "</div>";
		?>
	</div>
	<?
} else {
	while ($row = mysqli_fetch_object($result, 'Sermon')) {
		$row->printProfile( $pageNum, $search, $sort, $order);
	}
	mysqli_free_result($result);
}

mysqli_close($mysqli);
 ?>