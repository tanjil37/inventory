<?php 

// database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";   ///

// Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$category = "";
$name = "";   ///
$productionCost = "";
$sellingPrice = "";
$supplier = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET'){    // why GET used not POST ?
	// Get Method: show the data of the client
	if (!isset($_GET['id'])){
		header("location: /inventory/index.php");    ///
		exit; 
	}
	$id = $_GET["id"];

	// read the row of the selected client from database table
	$sql = "SELECT * FROM product WHERE id=$id";   ///
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();   ///

	if (!$row){
		header("location: /inventory/index.php");
		exit;
	}
	
    $id = $row["id"];   
    $category = $row["category"];   
	$name = $row["name"];   ///
    $productionCost = $row["productionCost"];
    $sellingPrice = $row["sellingPrice"];
    $supplier = $row["supplier"];
}
else{
	// POST method: update the data of the client
	$id = $_POST["id"];
	$category = $_POST["category"];
    $name = $_POST["name"];
	$productionCost = $_POST["productionCost"];
	$sellingPrice = $_POST["sellingPrice"];
	$supplier = $_POST["supplier"];

	do{
        if (empty($id) || empty($category) || empty($name) || empty($productionCost) || empty($sellingPrice) || empty($supplier)){
        $errorMessage = "All the fields are required";
			break;
	    } 

        $sql = "UPDATE product " . 
		    "SET id = '$id', category = '$category', name = '$name', productionCost = '$productionCost', sellingPrice = '$sellingPrice', supplier='$supplier' " .
		    "WHERE id=$id";

		$result = $connection->query($sql);

		if (!$result){
		  $errorMessage = "Invalid query: " . $connection->error;
		  break;
		}
 
		$successMessage = "Product updated correctly";

		header("location: /inventory/index.php");    ///
		exit; 

    } while(false);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>

</head>

<body>
    <div class="container my-5">
        <h2>New Client</h2>

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
                <label for="" class="col-sm-3 col-form-label">Product id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="category" value="<?php echo $category; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Production Cost</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="productionCost"
                        value="<?php echo $productionCost; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Selling Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sellingPrice" value="<?php echo $sellingPrice; ?>">
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
                    <a class="btn btn-outline-primary" href="/inventory/index.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>