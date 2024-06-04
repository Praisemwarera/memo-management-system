<?php

include('database.php');
session_start();

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


$first_name = $_POST["first_name"];
$password = $_POST["password"];

echo "Retrieved first_name: " . $first_name . "<br>";
echo "Retrieved password: " . $password . "<br>";

$stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $first_name);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["password_hash"];


    if (password_verify($password, $hashed_password)) {
        
        $_SESSION["first_name"] = $row["first_name"] . " " .$row['last_name'];
        $_SESSION["user_id"] = $row["user_id"];
        header("Location: dashboard.php"); 
        exit();
    } else {

        header("Location: login.php?error=Invalid+credentials");
        exit();
    }
} else {
    
    header("Location: login.php?error=Invalid+credentials");
    exit();
}

$connection->close();

?>
