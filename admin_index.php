<?php
session_start();
if(isset($_SESSION["manager"])!=""){
	header("location: admin_index.php");
	exit();
}

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>E.CHO Store Admin Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align="center">
		  <p><strong><em>Hello E.CHO STORE manager. What would you like to do today?</em></strong></p>
		  <p><a href="inventory_list.php">Manage inventory</a></p>
		  <p><a href="user_view_list.php">View users</a></p>
		  <p><a href="try_out.php">Try out JOIN and TRANSACTION</a></p> 
		</div>
		<br />
	<br />
	</div>
	<?php include_once("../template_footer.php");?>
</div>
</body>
</html>