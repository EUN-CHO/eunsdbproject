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

if (isset($_GET['deleteid'])) {
	echo 'Will you delete product ID: ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
	exit();
}

if (isset($_GET['yesdelete'])) {
	
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($con, "DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysqli_error());

    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }

	header("location: inventory_list.php"); 
    exit();
}

?>
<?php 
include("../storescripts/connect_to_mysql.php"); 

if (isset($_POST['product_name'])) {	
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
	$price = mysqli_real_escape_string($con, $_POST['price']);
	$category = mysqli_real_escape_string($con, $_POST['category']);
	$subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
	$details = mysqli_real_escape_string($con, $_POST['details']);

	

	$sql = mysqli_query($con, "SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");

	$productMatch = $sql->num_rows; 
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
		exit();
	}

	

	$sql = mysqli_query($con, "INSERT INTO products (product_name, price, details, category, subcategory, date_added) 
    VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die (mysqli_error());

    $pid = mysqli_insert_id();

	$newname = "$pid.jpg";

	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");

	header("location: inventory_list.php"); 
    exit();
}
?>

<?php 
include("../storescripts/connect_to_mysql.php"); 
$product_list = "";
$sql = mysqli_query($con, "SELECT * FROM products ORDER BY date_added ASC");
$productCount = $sql->num_rows;

if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "Product ID: $id - <strong>$product_name</strong> - ₩$price - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory_list.php?deleteid=$id'>delete</a><br />";
    }
} else{
	$product_list = "No products listed in E.CHO STORE.";
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title>E.CHO Store Inventory list</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
	<?php include_once("../template_header.php");?>
	<div id="pageContent"><br />
	  <div align = 'right' style="margin-left:24px;"></div>
		<div align="left" style="margin-left:24px;">
 		  <h2>Inventory list</h2>
	      	<?php echo $product_list; ?>
		</div>
    	<hr />
		<a name="inventoryForm" id="inventoryForm"></a>
		<h3>
    	&darr; Add New Inventory Item Form &darr;	
    	</h3>
	    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			<table width="90%" border="0" cellspacing="0" cellpadding="6">
	      	<tr>
				<td width="20%" align="right">Product Name</td>
			<td width="80%"><label>
	          	<input name="product_name" type="text" id="product_name" size="64" />
        	</label></td>
	      	</tr>
      	<tr>
	        <td align="right">Product Price</td>
        <td><label>
              <input name="price" type="text" id="price" size="12" />
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
        <option value=""></option>
          <option value="Tops">Tops</option>
          <option value="Bottoms">Bottoms</option>
          <option value="Accesories">Accesories</option>
          <option value="Shoes">Shoes</option>
          </select></td> 
      </tr>
      <tr>
        <td align="right">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
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
          <input type="submit" name="button" id="button" value="Add This Item Now" />
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