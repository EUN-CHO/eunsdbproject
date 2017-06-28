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


<?php 

if (isset($_POST['product_name'])) {
	$pid = mysqli_real_escape_string($con, $_POST['thisID']);
	$product_name = mysqli_real_escape_string($con, $_POST['product_name']);
	$price = mysqli_real_escape_string($con, $_POST['price']);
	$category = mysqli_real_escape_string($con, $_POST['category']);
	$subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
	$details = mysqli_real_escape_string($con, $_POST['details']);


	$sql = mysql_query("UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'");

	if ($_FILES['fileField']['tmp_name'] != "") {


	    $newname = "$pid.jpg";

	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");

	}

	header("location: inventory_list.php"); 
    exit();

}
?>

<?php 

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysqli_query($con, "SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = $sql->num_rows;

    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($sql)){              
			 $product_name = $row["product_name"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $details = $row["details"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			}
        }else {
	    echo "NO existance.";
		exit();
    }
}

?>

<<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title>E.CHO Store Inventory list EDIT</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("../template_header.php");?>
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a></div>
		<div align="left" style="margin-left:24px;">
	      <h2>Inventory list</h2>
	      <?php echo $product_list; ?>
	    </div>
    	<hr />
	    <a name="inventoryForm" id="inventoryForm"></a>
	    <h3>
	    	&darr; Add New Inventory Item Form &darr;
	    </h3>
	    <form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
	    <table width="90%" border="0" cellspacing="0" cellpadding="6">
		<tr>
	        <td width="20%" align="right">Product Name</td>
	       <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Product Price</td>
        <td><label>
          <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
			₩
        </label></td>
      </tr>
      <tr>
        <td align="right">Category</td>
        <td><label>
          <select name="category" id="category">
          <option value="Clothing">Clothing</option>
          <option value="Others">Others</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
          <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
          <option value="Tops">Tops</option>
          <option value="Bottoms">Bottoms</option>
          <option value="Accesories">Accesories</option>
          <option value="Shoes">Shoes</option>
          </select></td>
      </tr>
      <tr>
        <td align="right">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right">Product Image</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make Changes" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
  <?php include_once("../template_footer.php");?>
</div>
</body>
</html>