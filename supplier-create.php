<?php

// database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";     //

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$s_id = "";
$s_name = "";
$s_mobile = "";
$s_address = "";
$s_email = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){      // POST - data transmit
	$s_id = $_POST["s_id"];
	$s_name = $_POST["s_name"];
    $s_mobile = $_POST["s_mobile"];
	$s_address = $_POST["s_address"];
	$s_email = $_POST["s_email"];

	do{
       if (empty($s_id) || empty($s_name) || empty($s_mobile) || empty($s_address) || empty($s_email) ){
		  $errorMessage = "All the fields are required";
		  break;
	   }

	   // add new product to database
       $sql = "INSERT INTO supplier (s_id, s_name, s_mobile, s_address, s_email)" .
              "VALUES ('$s_id', '$s_name', '$s_mobile', '$s_address', '$s_email')";
       $result = $connection->query($sql);

	   if (!$result){
		 $errorMessage = "Invalid query: " . $connection->error;
		 break;
	   }
       
	   $s_id = "";
	   $s_name = "";
	   $s_mobile = "";
	   $s_address = "";
	   $s_email = "";

	   $successMessage = "Supplier added correctly";

	   header("location: /inventory/supplier.php");
	   exit;
	   
	} while(false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Control System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>

</head>

<body>
    <div class="container my-5">
        <h2>Add New Supplier</h2>

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
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Supplier ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="s_id" value="<?php echo $s_id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="s_name" value="<?php echo $s_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="s_mobile" value="<?php echo $s_mobile; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="s_address" value="<?php echo $s_address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="s_email" value="<?php echo $s_email; ?>">
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
                    <a class="btn btn-outline-primary" href="/inventory/supplier.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>