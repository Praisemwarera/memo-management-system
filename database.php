<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE","memo_management_system");

$connection= mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
// var_dump($connection);
if(!$connection){
    die("connection failed");
}





return $connection;



?>