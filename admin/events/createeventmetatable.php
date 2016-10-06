<?php
$con = new PDO('mysql:host=localhost;dbname=lnlodder_sermon','lnlodder_usrsrmn','reformed');
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$q = "CREATE TABLE events_meta(
		meta_id int not null auto_increment,
		event_id int not null,
		event_date date not null,
		event_title varchar(100) not null,
		event_description text,
		event_timeid int,
		PRIMARY KEY (meta_id) );
";
try {
	$con->exec($q) or die(print_r($db->errorInfo(), true));;
	echo "table created?";

} catch (PDOException $e) {
	$e->getMessage();
}
?>