<?php
$dirpath = "/home/lnlodder/public_html/SermonArchive";
//echo $dirpath;

$dh = opendir($dirpath);
while (false !== ($file = readdir($dh))) {
	 if (is_dir("$dirpath/$file")) {
	 	if (("$file"!='.')&&("$file"!='..')) {
			$dir = $file;
			$dirs[] = $file;
			$subpath = "$dirpath/$dir";
			}
	  } else{
	  }
}
arsort($dirs);
closedir($dh);

?>