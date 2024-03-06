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
        <h2>Customer List</h2>
        <a href="/inventory/customer-create.php" role="button" class="btn btn-primary">Add New Customer</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Email</th>
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
$sql="SELECT *FROM customer";  //
$result = $connection->query($sql);

if (!$result){
	die("Invalid query: " . $connection->connection->error);
}

// read data of each row
while($row = $result->fetch_assoc()){
	echo "
	<tr>
	 <td>$row[id]</td>    
	 <td>$row[name]</td>
	 <td>$row[mobile]</td>
	 <td>$row[address]</td>
	 <td>$row[email]</td>
	 <td>
		<a class='btn btn-primary btn-sm' href='/inventory/customer-edit.php?id=$row[id]' >Edit</a>
		<a class='btn btn-danger btn-sm' href='/inventory/customer-delete.php?id=$row[id]' >Delete</a>
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