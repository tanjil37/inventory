<?php 

// database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$order_id = "";
$order_product = "";
$customer_name = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET Method: show the data of the order
    if (!isset($_GET['id'])) {
        header("location: /inventory/orderitem.php");
        exit; 
    }
    $order_id = $_GET["id"];

    // Read the row of the selected order from the database table
    $sql = "SELECT * FROM orderItem WHERE order_id=$order_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /inventory/orderitem.php");
        exit;
    }
    
    $order_id = $row["order_id"];
    $order_product = $row["order_product"];
    $customer_name = $row["customer_name"];
} else {
    // POST method: update the data of the order
    $order_id = $_POST["order_id"];
    $order_product = $_POST["order_product"];
    $customer_name = $_POST["customer_name"];

    if (empty($order_id) || empty($order_product) || empty($customer_name)) {
        $errorMessage = "All the fields are required";
    } else {
        $sql = "UPDATE orderItem SET order_product = '$order_product', customer_name = '$customer_name' WHERE order_id = $order_id";

        if ($connection->query($sql)) {
            $successMessage = "Order updated correctly";
            header("location: /inventory/orderitem.php");
            exit;
        } else {
            $errorMessage = "Invalid query: " . $connection->error;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container my-5">
        <h2>New Order</h2>

        <?php  
         if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissable fade show' role='alert'>
               <strong>$errorMessage</strong>
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
         }
         ?>

        <form method="post">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Order id</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="order_id" value="<?php echo $order_id; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Ordered Product</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="order_product" value="<?php echo $order_product; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Customer Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="customer_name" value="<?php echo $customer_name; ?>">
                </div>
            </div>

            <?php 
         if (!empty($successMessage)){
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                   <div class='alert alert-success alert-dismissable fade show' role='alert'>
                       <strong>$successMessage</strong>
                       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
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
                    <a class="btn btn-outline-primary" href="/inventory/orderitem.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>