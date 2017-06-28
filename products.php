<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 


if (isset($_GET['id'])) {
	include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 

	$sql = mysqli_query($con, "SELECT * FROM products WHERE id='$id' LIMIT 1");

	$productCount = $sql->num_rows; 

    if ($productCount > 0) {
		while($row = mysqli_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
         }
	} else {

		echo "That item does not exist.";

	    exit();

	}

		

} else {

	echo "Data to render this page is missing.";

	exit();

}

mysqli_close($con);

?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>E.CHO Store Products Page</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	<div id="pageHeader"><table width="702" border="0">
  <tbody>
    <tr>
      <td width="199" height="46"><img src="http://localhost/DBproj/style/logo.jpeg" alt="Logo" width="271" height="110" alt=""/></td>
      <td width="493">&nbsp;</td>
    </tr>
    <tr>
      <td height="28" colspan="2"><a href="http://localhost/DBproj/index.php">HOME</a> &nbsp;<a href="http://localhost/DBproj/storeuser/user_logout.php">LOGOUT(user)</a> </td>
      </tr>
    <tr>
      <td height="28" colspan="2" align='right'><a href="http://localhost/DBproj/car.php">My Cart</a></td>
    </tr>
  </tbody>
</table>
</div>
  <div id="pageContent">
  <table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="19%" valign="top"><img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br />
      <a href="inventory_images/<?php echo $id; ?>.jpg">Enlarge Image</a></td>
    <td width="81%" valign="top"><h3><?php echo $product_name; ?></h3>
      <p><?php echo "₩".$price; ?><br />
        <br />
        <?php echo "$subcategory $category"; ?> <br />
<br />
        <?php echo $details; ?>
<br />
        </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="ADD to Cart" />
      </form>
      </td>
    </tr>
</table>
  </div>
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>