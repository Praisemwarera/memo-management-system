<?php

$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $mysqli = require __DIR__ . "/database.php";


    $escaped_email = $mysqli->real_escape_string($_POST["first_name"]);


    $sql = sprintf("SELECT * FROM users
    WHERE first_name = '%s'", $escaped_first_name);

    $result = $mysqli->query($sql);

    $users = $result->fetch_assoc();

    if ($users) {

       if  (password_verify($_POST["password"], $users["password_hash"])) {
        
        session_start();

        session_regenerate_id();
        var_dump($users);
        $_SESSION["user_id"] = $users["user_id"];

        $_SESSION["user_role"] = $user_role;

        $_SESSION["first_name"] = $users["first_name"];

        header("location: dashboard.php");
        exit;
       }
    }

    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="assets/js/just-validate.production.min.js" defer></script>
    <script src="assets/js/valiadtion.js" defer></script>
    <title>Login Page</title>
</head>
<body>
    <h1>Welcome!</h1>

    <?php
        
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>".$_GET['error']."</p>";
        }
    ?>

    <form action="process_login.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    
    <?php
        
        session_start();
    ?>

</body>
</html>
