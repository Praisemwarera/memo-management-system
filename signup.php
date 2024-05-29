
<!DOCTYPE html>

<html>
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="assets/js/just-validate.production.min.js" defer></script>
    <script src="assets/js/valiadtion.js" defer></script>
</head>
<body>
    
    <h1>Signup</h1>

    <form action="process-signup.php" method="post" id="signup" novalidate>
        <div>
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name">
    </div>

    <div>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name">
    </div>

    <div>
        <label for="gender">Gender</label><br>
        <input type="radio"  name="gender" value="female">
        female <br>
        <input type="radio" name="gender" value="male">
        male <br>
        
    </div>

    <div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
</div>

<div>
    <label for="Password">Password</label>
    <input type="password" id="password" name="password">
</div>

<div>
    <label for="password_confirmation"> Repeat password</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
</div>

<div>


<?php

include('database.php'); 

 
  $sql = "SELECT position_id, position FROM `positions`";
  $result = mysqli_query($connection, $sql);
  $position = array();
  $position_count=0;

  while ($row = $result->fetch_assoc()) { $position[] = $row["position"]; } if
($connection->connect_error) { die("Connection failed: " .
$connection->connect_error); } $sql = "SELECT * FROM `users`"; $result =
mysqli_query($connection, $sql); 
?>
    <label for="position">Position</label>
    <select id= "position" name="position">
    <?php while ($position_count < count($position)) { ?>
        <option><?php echo $position[$position_count]; ?></option>
        <?php
        $position_count++;

    }
    ?>
    </select>
      
</div>

<div>

<?php

 
  $sql = "SELECT department_id, department FROM `department`";
  $result = mysqli_query($connection, $sql);
  $department = array();
  $department_count = 0;

  while ($row = $result->fetch_assoc()) { $department[] = $row["department"]; } if
($connection->connect_error) { die("Connection failed: " .
$connection->connect_error); } $sql = "SELECT * FROM `users`"; $result =
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

<div>
    <label for="role">Role</label><br>
    <input type="radio"  name="role" value="Approver">
        Approver <br>
        <input type="radio" name="role" value="Initiator">
        Initiator <br>
</div>



<button type="submit">Signup</button>
    </form>
    
</body>
</html>
