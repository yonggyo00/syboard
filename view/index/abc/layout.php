<!DOCTYPE html>
<html>
<head>
	<meta name="description" content="Default Layout" />
	<meta name="keywords" content="Default" />
	<meta charset='UTF-8' />
	<title>ABC</title>
	<?=css('css', 'layout')?>
</head>	
<body>	
<?php
	include_once 'top.php';
	include_once 'logo_search.php';
	echo $_contents;
	include_once 'footer.php';
?>
</body>
</html>