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
        <h2>list of Product</h2>
        <a href="/inventory/create.php" role="button" class="btn btn-primary">Add New Product</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Production Cost</th>
                    <th>Selling Price</th>
                    <th>Supplier</th>
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
$sql="SELECT *FROM product";  //
$result = $connection->query($sql);

if (!$result){
	die("Invalid query: " . $connection->connection->error);
}

// read data of each row
while($row = $result->fetch_assoc()){
	echo "
	<tr>
	 <td>$row[id]</td>    
	 <td>$row[category]</td>
	 <td>$row[name]</td>
	 <td>$row[productionCost]</td>
	 <td>$row[sellingPrice]</td>
	 <td>$row[supplier]</td>
	 <td>
		<a class='btn btn-primary btn-sm' href='/inventory/edit.php?id=$row[id]' >Edit</a>
		<a class='btn btn-danger btn-sm' href='/inventory/delete.php?id=$row[id]' >Delete</a>
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