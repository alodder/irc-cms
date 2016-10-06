<?php
// Make a MySQL Connection
mysql_connect("localhost", "lnlodder_usrsrmn", "reformed") or die(mysql_error());
mysql_select_db("lnlodder_sermon") or die(mysql_error());

// Create a MySQL table in the selected database
mysql_query("CREATE TABLE announcements(
ann_id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(ann_id),
 date DATETIME,
 ann_heading VARCHAR(60), 
 ann_content TEXT,
 image_id tinyint(3))")
 or die(mysql_error());  

echo "Table Created!";

?>
