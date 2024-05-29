<?php

include('database.php'); 

if (empty($_POST["first_name"])){
    die("Name is required");
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8){
    die("Password must be at least 8 characters");
    
}

if (! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/i", $_POST["password"])){
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]){
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// $mysqli = require __DIR__."/database.php";


$sql = "INSERT INTO users (first_name, last_name, gender, email, password_hash, position_id, department_id, role) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// var_dump($mysqli);
$stmt = $connection->stmt_init();
if (! $stmt->prepare($sql)) { die("SQL error: " .
$mysqli->error); }; 
$email = $_POST["email"]; 
$stmt->bind_param("ssssssss",
$_POST["first_name"], $_POST["last_name"], $_POST["Gender"], $email,
$password_hash, $_POST["Position"], $_POST["Department"], $_POST["Role"]);
 if
($stmt->execute()) { header("Location: login.php"); 
    exit;
 } 
else{ if
($mysqli->errno === 1062) { die("email already taken");
}die($mysqli->error . "" . $mysqli->errno);
 } $stmt->close();
  ?>

