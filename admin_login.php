<?php 
session_start();
if (isset($_SESSION["manager"])) {
    header("location: admin_index.php"); 
    exit();
}
?>

<?php 
if (isset($_POST["username"]) && isset($_POST["password"])){
	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); 

    include "../storescripts/connect_to_mysql.php"; 

    $mysql = mysql_query("SELECT id 
						FROM admin WHERE username='$manager' AND password='$password' LIMIT 1"); 
	
    $existCount = mysql_num_rows($mysql); 

    if ($existCount == 1){
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;

		 header("location: admin_index.php");
         exit();

    } else{
		echo 'Input information is wrong! <a href="http://localhost/DBproj/index.php">Go Back to HOME</a>';
		exit();
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>E.CHO Store Admin Login Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
		<div align="left" style="margin-left:24px;">
      		<h2>Please Log In To Manage the Store</h2>
      		<form id="form1" name="form1" method="post" action="admin_login.php">
        		Username:<br />
          		<input name="username" type="text" id="username" size="30" />
        		<br /><br />
        		Password:<br />
       			<input name="password" type="password" id="password" size="30" />
       			<br />
       			<br />
      	 		<br />
       			<input type="submit" name="button" id="button" value="LOGIN" />
      		</form>
	      <p>&nbsp; </p>
   		</div>
   	<br />
	<br />
	<br />
	</div>
	<?php include_once("../template_footer.php");?>
</div>
</body>
</html>