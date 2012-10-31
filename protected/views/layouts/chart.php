<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpChart - Bar Test</title>
<link rel="stylesheet" type="text/css" href="css/watch.css?date=5" />
</head>
<body>
	<div>
		<div id="watcherDiv" class="watcher">&nbsp;Watcher: &nbsp;<?=isset($_SESSION['watcherName']) ? $_SESSION['watcherName'] : 'invalid watcher'?></div>
		<div id="tools" style="" class='sideBar'>
			<div>
				<span class="toolTitle">A<a href="index.php?r=watch/dangerTable" class="tollName"> Danger Table</a></span>
			</div>
			<div>
				<span class="toolTitle">B<a href="index.php?r=watch/tableGrow" class="tollName"> Table Grow</a></span>
			</div>
		</div>
		<div id="chart" style="position:absolute;top:40px;left:250px">
			<?php echo $content;?>
		</div>
<<<<<<< HEAD
=======
		
		<div id="logoutDiv" style="position:absolute;top:40px;left:750px">
			<a href="index.php?r=site/logout">Logout</a>
		</div>
>>>>>>> WatchFunction2
	</div>

</body>
</html>