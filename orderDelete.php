<?php 
if ( isset($_GET["id"]) ) {   // check it receive the id or not
	$order_id = $_GET["id"];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "inventory";

	// create connection
	$connection = new mysqli($servername, $username, $password, $database);

	$sql = "DELETE FROM orderitem WHERE id=$order_id";
	$connection->query($sql);

}

header("location: /inventory/orderitem.php");   
exit;

?>