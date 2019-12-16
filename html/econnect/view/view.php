<!DOCTYPE html>
<html>
<head>
<meta HTTP-EQUIV="REFRESH" content="0; url=http://econnect.fr">
<link rel="stylesheet" type="text/css" href="./style.css">
<title><?php echo $pagetitle?></title>
</head>

<body >
	


		<?php
			$filepath = File::build_path(array("view", ucfirst(self::$object), "$view.php"));
			require $filepath;
			
		?>



	</body>

</html>
