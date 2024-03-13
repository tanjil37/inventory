<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    input[type="text"],
    input[type="password"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .form-divider {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }

    .form-divider::before,
    .form-divider::after {
        content: "";
        width: 45%;
        height: 1px;
        background-color: #ccc;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .form-divider::before {
        right: 100%;
        margin-right: 15px;
    }

    .form-divider::after {
        left: 100%;
        margin-left: 15px;
    }

    .ims {
        color: green;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="ims">Inventory Control System</h2>
        <h2>Login</h2>
        <form action="#">
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <div class="form-divider">or</div>
        <h2>Sign Up</h2>
        <form action="#">
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
            <input type="submit" value="Sign Up" href="index.php">
            <button class="btn btn-primary" href="index.php">Sign Up</button>

        </form>
    </div>

</body>

</html>