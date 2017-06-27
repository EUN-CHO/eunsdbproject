<?php
require "connect_to_mysql.php";

$mysqlCommand = "CREATE TABLE products (
			id int(11) NOT NULL auto_increment,
			product_name varchar(255) NOT NULL,
			price varchar(255) NOT NULL,
			details text NOT NULL,
			category varchar(16) NOT NULL,
			subcategory varchar(16) NOT NULL,
			date_added datetime NOT NULL,
			PRIMARY KEY (id),
			UNIQUE KEY product_name (product_name)
			)";
/*	
if (mysql_query($mysqlCommand)){
	echo"Admin table succeccfully created!";
} else{
	echo"ERROR! Admin table not created.";
}
*/

 if ($con->query($mysqlCommand) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$con->close();

?>