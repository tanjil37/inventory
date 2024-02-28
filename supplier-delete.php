<?php 
if ( isset($_GET["s_id"]) ) {   // check it receive the id or not
	$s_id = $_GET["s_id"];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "inventory";

	// create connection
	$connection = new mysqli($servername, $username, $password, $database);

	$sql = "DELETE FROM supplier WHERE id=$s_id";
	$connection->query($sql);

}

header("location: /inventory/supplier.php");   
exit;

?>