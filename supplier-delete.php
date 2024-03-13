<?php
if (isset($_GET["id"])) {
    $s_id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inventory";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "DELETE FROM supplier WHERE s_id=$s_id";

    if ($connection->query($sql) === TRUE) {
        echo "Supplier deleted successfully";
    } else {
        echo "Error deleting supplier: " . $connection->error;
    }

    $connection->close();
}

header("Location: /inventory/supplier.php");
exit;
?>