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
        <h2>Ordered Item List</h2>
        <a href="/inventory/orderItem-create.php" role="button" class="btn btn-primary">New Supplier</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Ordered Product</th>
                    <th>Total Items</th>
                    <th>Customer Name</th>
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
$sql="SELECT *FROM orderitem";  //
$result = $connection->query($sql);

if (!$result){
	die("Invalid query: " . $connection->connection->error);
}

// read data of each row
while($row = $result->fetch_assoc()){
	echo "
	<tr>
	 <td>$row[order_id]</td>    
	 <td>$row[order_product]</td>
	 <td>$row[total_items]</td>
	 <td>$row[customer_name]</td>
	 <td>$row[order_date]</td>
	 <td>
		<a class='btn btn-primary btn-sm' href='/inventory/orderItem-edit.php?id=$row[order_id]' >Edit</a>
		<a class='btn btn-danger btn-sm' href='/inventory/orderItem-delete.php?id=$row[order_id]' >Delete</a>
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