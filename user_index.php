<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 
include "../storescripts/connect_to_mysql.php"; 
$dynamicList = "";
$sql = mysqli_query($con, "SELECT * FROM products ORDER BY date_added DESC LIMIT 3");
$productCount = $sql->num_rows; // count the output amount

if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td width="20%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="../inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="80" height="100" border="1" /></a></td>
          <td width="83%" valign="top">' . $product_name . '<br />
            ₩' . $price . '<br />
            <a href="../products.php?id=' . $id . '">Details</a></td>
        </tr>
      </table>';
    }
} else {
	$dynamicList = "We have no products in E.CHO STORE yet";
}
mysqli_close($con);
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
	<div id="pageContent"><br />
		<div align="left" style="margin-left:24px;">
		  <p><strong><em>Hello E.CHO STORE user. What would you like to shop today?</em></strong></p>
		   
		</div>
		<br />
	<br />
	<table width="100%" border="0" cellspacing="0" cellpadding="10">

  <tr>
    <td width="35%" valign="top"><h3>New Items</h3>
      <p><?php echo $dynamicList; ?><br />
        </p>
      <p><br />
      </p></td>
  </tr>
</table>
  </div>
</div>
</body>
</html>