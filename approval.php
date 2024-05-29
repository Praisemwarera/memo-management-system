<?php


include("database.php");

$sql = "SELECT * FROM memo WHERE `status` = 1";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Approved Memos</h2>";
    echo "<table>";
    echo "<tr><th>Title</th><th>Author</th><th>Date</th></tr>";
    
    echo "</table>";
} else {
    echo "No approved memos found.";
}



?>
