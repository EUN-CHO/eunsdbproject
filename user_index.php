<?php

session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: user_index.php");
	exit();
}

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>E.CHO Store User Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align="left" style="margin-left:24px;">
		  <p><strong><em>Hello E.CHO STORE user. What would you like to shop today?</em></strong></p>
		  <p><a href="#">Go to</a></p>
		  <p><a href="#">Go to</a></p>
		  <p><a href="#">Go to</a></p> 
		</div>
		<br />
	<br />
	</div>
	<?php include_once("../template_footer.php");?>
</div>
</body>
</html>