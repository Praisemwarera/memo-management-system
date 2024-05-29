<?php 
include 'database.php' ;
session_start();


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

      <form action="add_memo.php" method="post" class="mb-3">

      <div class="form-group">
        <label for="to">To:</label>
        <select class="form-control" id="to" name="to" required>
          <?php
          $sql = "SELECT first_name FROM users";
          $user_result = mysqli_query($connection, $sql);
          $users = array();

          while ($row = $user_result->fetch_assoc()) {
            $users[] = $row;
            $sql = "SELECT * FROM `memo`"; $result =
            mysqli_query($connection, $sql); 
          }

        foreach ($users as $user): ?>
            <option value="<?php echo $user['first_name']; ?>">
              <?php echo $user['first_name'];  ?>
            </option>
          <?php endforeach; ?>
          
        </select>
        </div>
        
        <div class="form-group">
          <label for="category">Category:</label>
          <select class="form-control" id="category" name="category" required>
            <option value="Internal">Internal</option>
            <option value="External">External</option><br>
          </select>
        </div>
        <div class="form-group">
        <label for="from">From:</label>
        <select class="form-control" id="from" name="from" required>
          <?php
          $sql = "SELECT first_name FROM users";
          $user_result = mysqli_query($connection, $sql);
          $users = array();

          while ($row = $user_result->fetch_assoc()) {
            $users[] = $row;
            $sql = "SELECT * FROM `memo`"; $result =
            mysqli_query($connection, $sql); 
          }

          foreach ($users as $user): ?>
            <option value="<?php echo $user['first_name']; ?>">
              <?php echo $user['first_name']; ?>
            </option>
          <?php endforeach; ?>
        </select>
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
          </select>
        </div>
        <div class="form-group">

        <?php
  
 
  $sql = "SELECT department_id, department FROM `department`";
  $result = mysqli_query($connection, $sql);
  $department = array();
  $department_count = 0;

  while ($row = $result->fetch_assoc()) { $department[] = $row["department"]; } if
($connection->connect_error) { die("Connection failed: " .
$connection->connect_error); } $sql = "SELECT * FROM `memo`"; $result =
mysqli_query($connection, $sql); 
?>


    <label for="department">Department</label>
    <select id= "department" name="department">
    <?php while ($department_count < count($department)) { ?>
        <option><?php echo $department[$department_count]; ?></option>
        <?php
        $department_count++;

    }
    ?>
    </select>




        </div>
        <button type="submit" class="btn btn-primary">SAVE</button>
        
      </select>
      </form>

  

<script>
      document.getElementById('backButton').addEventListener('click', function() {
        var form = document.getElementById('memoForm');
        form.action = document.getElementById('dashboardUrl').value;
        form.submit();
      });
    </script>

    </div>
</body>
</html>