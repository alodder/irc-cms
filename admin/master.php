<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>IRCWebAdmin v2.2 - <?php echo $sectionname ?></title>
<meta http-equiv="pragma" content="nocache" />
<link rel="stylesheet" type="text/css" media="screen" href="css/master.css"  />
<link rel="shortcut icon" type="image/ico" href="../testing/images/favicon.ico" />
<script type="text/javascript" language="javascript" src="include/jsfuncs.js"> </script>
<script type="text/javascript" language="javascript" src="include/fadeEffects.js"> </script>
</head>

<body>
    <div id="container">
        <div id="toolbar">
        	<div id="sessionMessage"><?= $message ?></div>
        	<h1 class="title">IRCWebAdmin</h1>
            <ul>
                <li<?= ($_GET["articles"] == "announcements") ? " class=\"current\"":" ";?>><a href="index.php?articles=announcements" 
                style="background: url('images/icons/cset/32/comments.png') no-repeat; background-position:left; padding:32px; padding-right:0;">Announcements </a></li>
                <li<?= ($_GET["articles"] == "sermons") ? " class=\"current\"":" ";?>>
                <a href="index.php?articles=sermons" 
                style="background: url('images/icons/drf/Podcast.png') no-repeat; background-position:left; padding:32px; padding-right:0;">Sermons </a></li>
                <li<?= ($_GET["articles"] == "events") ? " class=\"current\"":" ";?>>
                <a href="index.php?articles=events">
                <span style="background: url('images/icons/cset/32/calendar_empty.png') no-repeat; background-position:left; padding:8px; padding-top:14px; color:#000;"><?= date('d') ?></span>
                Events </a></li>
                <li<?= ($_GET["articles"] == "users") ? " class=\"current\"":" ";?>><a href="index.php?articles=users" 
                style="background: url('images/icons/cset/32/users.png') no-repeat; background-position:left; padding:32px; padding-right:0;">Users </a></li>
            </ul>
            <div id="sessionManageControl">
            	<img id="userImage" src="<?= $userImage ?>" />
		        Welcome <?= $username ?>
		        <a href="users/logout.php" class="sessionKill">Logout</a>
            </div>
        </div>
        <div id="sidebar">
            <?php echo $sidebar; ?>
        </div>
        <div id="content">
            <?php echo $content; ?>
        </div>
        <div id="footer">
            <ul>
                <li><?= 'Updated ' . date('F j, Y',filemtime($_SERVER['SCRIPT_FILENAME'])) . '' ?> </li>
            </ul>
        </div>
    </div>
</body>
</html>
