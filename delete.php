<?php 
if ( isset($_GET["id"]) ) {   // check it receive the id or not
	$id = $_GET["id"];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "inventory";

	// create connection
	$connection = new mysqli($servername, $username, $password, $database);

	$sql = "DELETE FROM product WHERE id=$id";
	$connection->query($sql);

}

header("location: /inventory/index.php");   
exit;

?>