<?php 

// database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";   ///

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$name = "";
$mobile = "";
$address = "";
$email = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET'){    // why GET used not POST ?
	// Get Method: show the data of the client
	if (!isset($_GET['id'])){
		header("location: /inventory/customer.php");    ///
		exit; 
	}
	$id = $_GET["id"];

	// read the row of the selected client from database table
	$sql = "SELECT * FROM customer WHERE id=$id";   ///
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();   ///

	if (!$row){
		header("location: /inventory/customer.php");
		exit;
	}
	
	$id = $_POST["id"];
	$name = $_POST["name"];
    $mobile = $_POST["mobile"];
	$address = $_POST["address"];
	$email = $_POST["email"];
}
else{
	// POST method: update the data of the client
	$id = $_POST["id"];
	$name = $_POST["name"];
    $mobile = $_POST["mobile"];
	$address = $_POST["address"];
	$email = $_POST["email"];

	do{
        if (empty($id) || empty($name) || empty($mobile) || empty($address) || empty($email) ){
            $errorMessage = "All the fields are required";
            break;
         }
  
         $sql = "INSERT INTO customer (id, name, mobile, address, email)" .
         "VALUES ('$id', '$name', '$mobile', '$address', '$email')";
         $result = $connection->query($sql);

		$result = $connection->query($sql);

		if (!$result){
		  $errorMessage = "Invalid query: " . $connection->error;
		  break;
		}
 
		$successMessage = "Customer updated correctly";

		header("location: /inventory/customer.php");    ///
		exit; 

    } while(false);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>

</head>

<body>
    <div class="container my-5">
        <h2>New Customer</h2>

        <?php  
		 if (!empty($errorMessage)){
			echo "
			<div class='alert alert-warning alert-dismissable fade show' role='alert'>
			   <strong>$errorMessage</strong>
			   <button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='close'></button>
			</div>
			";
		 }
		 ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Customer ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <?php 
			if (!empty($successMessage)){
				echo "
				<div class='row mb-3'>
					<div class='offset-sm-3 col-sm-6'>
					   <div class='alert alert-success alert-dismissable fade show' role='alert'>
					       <strong>$successMessage</strong>
					       <button type = 'button' class = 'btn-close' data-bs-dismiss='alert' aria-label='close'></button>
				       </div>
					</div>
				</div>
				";
			 }
			?>

            <div class="row mb-3">
                <div class="offset-sm-3 d-grid">
                    <button class="btn btn-primary" type="submit">submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/inventory/customer.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>