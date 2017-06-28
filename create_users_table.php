<?php
require "connect_to_mysql.php";

$mysqlCommand = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";


 if ($con->query($mysqlCommand) == TRUE) {
    echo"Table created successfully";
} else {
    echo"Error creating table: " . $con->error;
}

$con->close();

?>