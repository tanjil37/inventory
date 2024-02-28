<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Control System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="container my-5">
        <h2>Order</h2>
        <a href="/inventory/order-create.php" role="button" class="btn btn-primary">new order</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Total Item</th>
                    <th>customer</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";  //

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// read all row from database table
$sql="SELECT *FROM order";  //
$result = $connection->query($sql);

if (!$result){
	die("Invalid query: " . $connection->connection->error);
}

// read data of each row
while($row = $result->fetch_assoc()){
	echo "
	<tr>
	 <td>$row[o_id]</td>    
	 <td>$row[o_name]</td>
	 <td>$row[t_item]</td>
	 <td>$row[customer]</td>
	 <td>$row[order_date]</td>
	 <td>
		<a class='btn btn-primary btn-sm' href='/inventory/order-edit.php?id=$row[o_id]' >Edit</a>
		<a class='btn btn-danger btn-sm' href='/inventory/order-delete.php?id=$row[o_id]' >Delete</a>
	 </td>
    </tr>
	";
}

?>
            </tbody>
        </table>
    </div>
</body>

</html>