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

    $sql = "SELECT * FROM supplier WHERE s_id=$s_id";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $s_name = $row["s_name"];
        $s_mobile = $row["s_mobile"];
        $s_address = $row["s_address"];
        $s_email = $row["s_email"];
    } else {
        echo "Supplier not found";
    }

    $connection->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_name = $_POST["s_name"];
    $s_mobile = $_POST["s_mobile"];
    $s_address = $_POST["s_address"];
    $s_email = $_POST["s_email"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inventory";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "UPDATE supplier SET s_name='$s_name', s_mobile='$s_mobile', s_address='$s_address', s_email='$s_email' WHERE s_id=$s_id";

    if ($connection->query($sql) === TRUE) {
        echo "Supplier updated successfully";
        header("Location: /inventory/supplier.php");
        exit;
    } else {
        echo "Error updating supplier: " . $connection->error;
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="container my-5">
        <h2>Edit Supplier</h2>
        <form method="post">
            <div class="mb-3">
                <label for="s_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="s_name" name="s_name" value="<?php echo $s_name; ?>">
            </div>
            <div class="mb-3">
                <label for="s_mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="s_mobile" name="s_mobile" value="<?php echo $s_mobile; ?>">
            </div>
            <div class="mb-3">
                <label for="s_address" class="form-label">Address</label>
                <input type="text" class="form-control" id="s_address" name="s_address"
                    value="<?php echo $s_address; ?>">
            </div>
            <div class="mb-3">
                <label for="s_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="s_email" name="s_email" value="<?php echo $s_email; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>