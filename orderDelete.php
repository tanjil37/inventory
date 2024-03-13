<?php 
if ( isset($_GET["id"]) ) {
    $order_id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inventory";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "DELETE FROM orderitem WHERE order_id=$order_id";
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    $connection->close();
} else {
    echo "Error: ID is not provided.";
}

header("location: /inventory/orderitem.php");   
exit;
?>