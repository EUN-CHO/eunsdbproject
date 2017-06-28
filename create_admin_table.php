<?php
require "connect_to_mysql.php";

$mysqlCommand = "CREATE TABLE admin (
			id int(11) NOT NULL auto_increment,
			username varchar(255) NOT NULL,
			password varchar(255) NOT NULL,
			last_login_date datetime NOT NULL,
			PRIMARY KEY (id)
			)";


 if ($con->query($mysqlCommand) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $con->error;
}

$con->close();

?>