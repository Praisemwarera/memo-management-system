
<?php
$mysqli = require __DIR__ . "/database.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $category = $_POST['category'];
  $to = $_POST['to'];
  $from = $_POST['from'];
  $date = $_POST['date'];
  $ref = $_POST['ref'];
  $content = $_POST['content'];
  $status = $_POST['status'];
  $department = 1;
  $user_id = 1;


  var_dump([$category,$to,$from,$date,$ref,$content,$status,$department]);


  $sql = "INSERT INTO memo ( category, `to`, `from`, date, ref, content,  user_id, status,  department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($connection, $sql);

  
  mysqli_stmt_bind_param($stmt, "ssssssisi", $category, $to, $from,$date, $ref, $content,$user_id, $status, $department);
  
  if (mysqli_stmt_execute($stmt)) {
    header("Location: memo.php"); 
    exit;
  } else {
    echo "Error: " . mysqli_error($connection);
  }

  mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Memo Dashboard</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


  <div class="col-sm-9">
    <h2>Create Memo</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mb-3">
      <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="category" name="category" required>
          <option value="Internal">Internal</option>
          <option value="External">External</option>
        </select>
      </div>
      <div class="form-group">
        <label for="to">To:</label>
        <input type="text" class="form-control" id="to" name="to" required>
      </div>
      <div class="form-group">
        <label for="from">From:</label>
        <input type="text" class="form-control" id="from" name="from" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="ref">Ref:</label>
        <input type="text" class="form-control" id="ref" name="ref">
      </div>
      <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status" required>
          <option value="Draft">Draft</option>
          <option value="Pending">Pending</option>
          <option value="Approved">Approved</option>
        </select>
      </div>
      <div class="form-group">

      <?php


$sql = "SELECT department_id, department FROM `department`";
$result = mysqli_query($connection, $sql);
$department = array();
$department_count = 0;

while ($row = $result->fetch_assoc()) {
  $department[] = $row["department"];
}

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?>


<label for="department">Department</label>
<select id="department" name="department">
  <?php while ($department_count < count($department)) { ?>
    <option value="<?php echo $department[$department_count]; ?>"><?php echo $department[$department_count]; ?></option>
    <?php
      $department_count++;
    }
  ?>
</select>
</form>
