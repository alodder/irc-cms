<?php
	$params="";
	
	function addParam($params, $add){
		if( $params == "")
			$params = "?".$add;
		else
			$params = $params."&".$add;
		return $params;
	}
	
	if(isset($_GET['page'])){
		$pageNum = $_GET['page'];
		$params = addParam($params, "page=".$pageNum);
	}	
	if(isset($_GET['sort'])){
	   $sort = $_GET['sort'];
		$params = addParam($params, "sort=".$sort);
	}
	if(isset($_GET['order'])){
	   $order= $_GET['order'];
		$params = addParam($params, "order=".$order);
	}
	
	if(isset($_GET['search'])){
	   $search= $_GET['search'];
		$params = addParam($params, "search=".$search);
	}
	
	echo "<script type=\"text/javascript\" language=\"javascript\">";
	//echo "display(\"params: ".$params."\", 'palette');";\\debug parameter string
	echo "sendRequest(\"sermons/sermons.php".$params."\", \"null\", 'GET', \"content\");";
	echo "</script>";
?>