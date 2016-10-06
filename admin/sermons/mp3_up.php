<!doctype html>
<html lang="en">
<head>
<title>Mp3 Upload form</title>
<meta http-equiv="pragma" content="nocache" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/master.css"  />
<script type="text/javascript" language="javascript" src="../include/jsfuncs.js"> </script>

<script type="text/javascript" language="javascript">
function sendParentRequest(url, params, HttpMethod, elementId)
{
	if(!HttpMethod){
		HttpMethod="GET";
	}
	req = getXMLHTTPRequest();
	req.open(HttpMethod, url, true);
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	if (req){
		req.onreadystatechange = function()
		{
			var ready=req.readyState;
			var data=null;
			if(req.readyState == 4 && req.status == 200){
				data=req.responseText;
			} else{
				data="<img src=\"images/loading.gif\" />Loading...["+(4-ready)+"]";
			}
			parent.parent.document.getElementById(elementId).innerHTML = data;
		}
		req.send(params);
	}
}

function displayParent(text, elementId)
{
	if(!elementId){
		elementId="palette";
	}
	parent.document.getElementById(elementId).innerHTML = text;
}

displayParent("Loading...");
</script>
</head>

<?php
//------ pic upload script
if ((($_FILES["file"]["type"] == "audio/mp3")||($_FILES["file"]["type"] == "audio/mpeg"))
   && ($_FILES["file"]["size"] < 20000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    $message =  "Error: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    $message .= "Upload: " . $_FILES["file"]["name"] . "<br />";
    $message .= "Type: " . $_FILES["file"]["type"] . "<br />";
    $message .= "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    $message .= "Stored in: " . $_FILES["file"]["tmp_name"]."<br />";
	$message .= "Folder to save in: ".$_POST["folder"]."<br />";
	
	if (file_exists($_POST["folder"]."/". $_FILES["file"]["name"]))
      {
      $message .= $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $success = move_uploaded_file($_FILES["file"]["tmp_name"],
      "/home/lnlodder/public_html/SermonArchive/".$_POST["folder"]."/". $_FILES["file"]["name"]);
	  if($success){
	  	$folder= $_POST["folder"];
		$file=$_FILES["file"]["name"];
      	$message .= "Moved to:  public_html/SermonArchive/" . $_POST["folder"] ."/". $_FILES["file"]["name"];
	  }
      }
    }
  }
else
  {
  $message .= "Invalid file, must be .mp3 and less than 20,000 kb";
  $message .= $_FILES["file"]["type"]." ".$_FILES["file"]["size"]." ".$_FILES["file"]["name"];
  }
  $message .="<br />";
?>



<body>
<?php
echo "<script type=\"text/javascript\" language=\"javascript\">";
echo "displayParent(\"$message\", \"palette\");";
if ($success){
	//send filepath to insert form? 
	echo "sendParentRequest(\"insertform.php\", \"folder=$folder&file=$file\", \"POST\", \"palette2\");";
}
echo "</script>";
?>
</body>
</html>