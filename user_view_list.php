<?php
include("../storescripts/connect_to_mysql.php"); 

session_start();
if(isset($_SESSION["manager"])!=""){
	header("location: admin_index.php");
	exit();
}

?>
<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title>E.CHO Store User list</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
	  <div align = 'center' style="margin-left:24px;">
		<h1>View Records</h1>
		  <p><b>View All</b></p>
		  <?php
			$result = mysqli_query($con, "SELECT * FROM users ORDER BY id") or die (mysqli_error());


			if ($result->num_rows > 0){
				echo "<table border='1' cellpadding='10'>";
				echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th></th></th></tr>";
				while ($row = $result->fetch_object()){
					echo "<tr>";
					echo "<td>" . $row->id . "</td>";
					echo "<td>" . $row->name . "</td>";
					echo "<td>" . $row->email . "</td>";
					echo "<td><a href='delete_user.php?id=" . $row->id . "'>Delete</a></td>";
					}		
					echo "</table>";
				} else{
				echo "No users registered!";
			}

			mysqli_close($con);
		  	?>
  	</div>
  <?php include_once("../template_footer.php");?>
	</div>
</div>
</body>
</html>

