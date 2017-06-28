<?php
include "../storescripts/connect_to_mysql.php";

mysqli_autocommit($con, FALSE);

mysqli_query($con, "CREATE TABLE 'randCart' (cid INT(11) AUTO INCREMENT, PRIMARY KEY('cid'))");
mysqli_query($con, "INSERT INTO 'randCart' (cid) VALUES (5");
mysqli_query($con, "INSERT INTO 'randCart' (cid) VALUES (rand())");
mysqli_query($con, "CREATE TABLE 'event'"."SELECT randCart.cid, products.product_name"."FROM randCart LEFT JOIN products"."ON randCart.cid = products.id");


mysqli_commit($con);
echo"committed!!!";

$r = mysqli_query($con, "SELECT * FROM event ORDER BY id") or die (mysqli_error());


			if ($r->num_rows > 0){
				echo "<table border='1' cellpadding='10'>";
				echo "<tr><th>ID</th><th>id</th><th>ProductName</th></th></th></tr>";
				while ($row = $r->fetch_object()){
					echo "<tr>";
					echo "<td>" . $row->randCart.cid . "</td>";
					echo "<td>" . $row->products.product_name . "</td>";
					echo "<td><a href='delete_user.php?id=" . $row->id . "'>Delete</a></td>";
					}		
					echo "</table>";
				} else{
				echo "No event available!";
			}

			mysqli_close($con);

mysqli_query($con, "DELETE FROM randCart");

if ($result = mysqli_query($con, "SELECT COUNT(*) FROM randCart")) {
    $row = mysqli_fetch_row($result);
    printf("%d rows in table randCart.\n", $row[0]);
    
    mysqli_free_result($result);
}

mysqli_rollback($con);

if ($result = mysqli_query($con, "SELECT COUNT(*) FROM randCart")) {
    $row = mysqli_fetch_row($result);
    printf("%d rows in table randCart (after rollback).\n", $row[0]);
    
    mysqli_free_result($result);
}


mysqli_query($con, "DROP TABLE randCart");

mysqli_close($con);
?>