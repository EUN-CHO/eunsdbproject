<?php
session_start();
if(!isset($_SESSION["manager"])){
	header("location: admin_login.php");
	exit();
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Store Admin Area</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align="left" style="margin-left:24px;">
		  <p><strong><em>Hello E.CHO STORE manager. What would you like to do today?</em></strong></p>
		  <p><a href="inventory_list.php">Manage inventory</a></p>
		  <p><a href="#">Manage customers</a></p>
		  <p><a href="#">Manage payments</a></p> 
		</div>
		<br />
	<br />
	</div>
	<?php include_once("../template_footer.php");?>
</div>
</body>
</html>