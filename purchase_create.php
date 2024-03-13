<?php

// database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";     //

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$product = "";
$quantity = "";
$supplier = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){      // POST - data transmit
	$id = $_POST["id"];
	$product = $_POST["product"];
    $quantity = $_POST["quantity"];
	$supplier = $_POST["supplier"];

	do{
       if (empty($id) || empty($product) || empty($quantity) || empty($supplier)){
		  $errorMessage = "All the fields are required";
		  break;
	   }

	   // add new product to database
       $sql = "INSERT INTO purchase (id, product, quantity, supplier)" .
              "VALUES ('$id', '$product', '$quantity', '$supplier')";
       $result = $connection->query($sql);

	   if (!$result){
		 $errorMessage = "Invalid query: " . $connection->error;
		 break;
	   }
       
	   $id = "";
	   $product = "";
	   $quantity = "";
	   $supplier = "";

	   $successMessage = "Purchase item added correctly";

	   header("location: /inventory/purchase.php");
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
        <h2>Add New Purchased Item</h2>

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
                <label for="" class="col-sm-3 col-form-label">Product id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Product</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="product" value="<?php echo $product; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Supplier</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="supplier" value="<?php echo $supplier; ?>">
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
                <div class="col-sm-3 d-grid">
                    <button class="btn btn-primary" type="submit">submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/inventory/purchase.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>