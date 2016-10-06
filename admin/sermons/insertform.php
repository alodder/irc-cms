<?php
//include '../include/getid3/getid3.php';
//echo $_SERVER['SERVER_NAME'];

if(isset($_POST['folder'])){
   $folder = $_POST['folder'];
}

$dload = "http://www.immanuelsreformed.org/SermonArchive/";

if(isset($_POST['file'])){
  (strcmp($_SERVER['SERVER_NAME'], "admin.immanuelsreformed.org") == 0 ) ? include '/home/lnlodder/include/getid3/getid3.php' : include '../include/getid3/getid3.php';
   $file = $_POST['file'];
   $dload = $dload.$folder."/".$file;
   $dload = str_replace(" ", "%20", $dload);
   echo "<h2>File: ".$file."</h2>";
   echo "<h3>Folder: ".$folder."</h3";
   $getID3 = new getID3;
  $ThisFileInfo = $getID3->analyze("/home/lnlodder/public_html/SermonArchive/".$folder."/".$file);
} else {
	$dload = $dload.date("Y")."%20sermons/";
}


if (isset($ThisFileInfo)){
  if($ThisFileInfo['tags']['id3v2']['year'][0]){
    $date = $ThisFileInfo['tags']['id3v2']['year'][0];
    $date = strtotime($date.date("-m-d"));
  } else if($ThisFileInfo['tags']['id3v1']['year'][0]){
    $date = $ThisFileInfo['tags']['id3v1']['year'][0];
    $date = strtotime($date);
  }
  if($ThisFileInfo['tags']['id3v2']['title'][0]){
   $theme = $ThisFileInfo['tags']['id3v2']['title'][0];
  } else if($ThisFileInfo['tags']['id3v1']['title'][0]){
    $theme = $ThisFileInfo['tags']['id3v1']['title'][0];
  }

  if($ThisFileInfo['tags']['id3v2']['album'][0]){
    $series = $ThisFileInfo['tags']['id3v2']['album'][0];
  } else if($ThisFileInfo['tags']['id3v1']['album'][0]){
    $series = $ThisFileInfo['tags']['id3v1']['album'][0];
  }

  if($ThisFileInfo['tags']['id3v2']['artist'][0]){
    $preacher = $ThisFileInfo['tags']['id3v2']['artist'][0];
  } else if($ThisFileInfo['tags']['id3v1']['artist'][0]){
    $preacher = $ThisFileInfo['tags']['id3v1']['artist'][0];
  }
} else {
  $date = time();
  $preacher = "Rev. Ed Marcusse";
}


?>

<div class="insertpage">
  <form name="inserter" id="inserter" action="javascript:sendRequest('sermons/insert.php', formData2QueryString('inserter'), 'POST', 'palette2');">
    <fieldset class="fieldadder">
      <input type="hidden" id="id" name="id" value="<? echo "$id"; ?>">
      <label for="year">Date: </label>
      <input name="datetime" id="datetime" type="datetime-local" value="<?= date("Y-m-d\TH:i", $date)?>">
      <br />
      <label for="preacher">Preacher: </label><input type="text" name="preacher" id="preacher" value="<?= $preacher?>" size=50><br />
      <label for="theme">Title: </label><input type="text" name="theme" id="theme" value="<?= (isset($theme))?$theme:"" ?>" size=50><br />
      <label for="series">Series: </label><input type="text" name="series" id="series" value="<?= (isset($series))?$series:"" ?>" size=50><br />
      <label for="scripred">Scripture read: </label><input type="text" name="scripred" id="scripred" value="" size=50><br />
      <label for="scriptxt">Scripture text: </label><input type="text" name="scriptxt" id="scriptxt" value="" size=50><br />
      <label for="catred">Catechism read: </label><input type="text" name="catred" id="catred" value=""size=50><br />
      <label for="url">File URL: </label><input type="url" name="url" id="url" value="<?= (isset($dload))?$dload:"" ?>" size=100><br />
      <input type="submit" value="Insert" >
    </fieldset>
  </form>
</div>
<?

?>