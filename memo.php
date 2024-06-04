<?php
require_once("database.php");

session_start();

$page = 1;

if (isset($_GET['page'])) {
  $page = (int) $_GET['page'];
  if ($page < 1) {
    $page = 1;
  }
}

$results_per_page = 10;

$offset = ($page - 1) * $results_per_page;

$sql = "SELECT memo.department_id, memo.id, memo.to, memo.from, memo.category, memo.ref, memo.date, memo.content, memo.status, department.department
        FROM memo
        INNER JOIN department ON memo.department_id = department.department_id";
$result = mysqli_query($connection, $sql);

if (!$result) {
  echo "Error retrieving memos: " . mysqli_error($connection);
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Memos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0svjQEgQWgOLaXXp6ghvsgCSNeQyVjJ4uHKgombijyYic/QxqwLf/cuHDGUf6mogv" crossorigin="anonymous">

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ddd;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
    }
  </style>
</head>
<body>
  <h1>All Memos</h1>
  <?php var_dump($_SESSION); ?>
  
  <?php if (isset($_SESSION['user_id'])) : ?>
    <form method="post">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
      <button type="submit">Filter Memos</button>
    </form>
    

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
      <?php
        $loggedInUserId = $_POST['user_id'];
        $stmt = $connection->prepare("SELECT * FROM memo WHERE `to` = ? ORDER BY id DESC");
        $stmt->bind_param("i", $loggedInUserId);
        $stmt->execute();
        $filtered_results = $stmt->get_result();
      ?>

      <?php if ($filtered_results->num_rows > 0) : ?>
        <table>
          <tr>
            <th>ID</th>
            <th>Category</th>
            <th>To</th>
            <th>From</th>
            <th>Date</th>
            <th>Ref</th>
            <th>Content</th>
            <th>Status</th>
            <th>Department</th>
          </tr>
          <?php while ($row = $filtered_results->fetch_assoc()) : ?>
            <tr>
              <td><?php echo $row["id"]; ?></td>
              <td><?php echo $row["category"]; ?></td>
              <td><?php echo $row["to"]; ?></td>
              <td><?php echo $row["from"]; ?></td>
              <td><?php echo $row["date"]; ?></td>
              <td><?php echo $row["ref"]; ?></td>
              <td><?php echo substr($row["content"], 0, 50) . "..."; ?></td>
              <td><?php echo $row["status"]; ?></td>
              <td><?php echo $row["department"]; ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      <?php else : ?>
        <p>No memos found for this user.</p>
      <?php endif; ?>

    <?php endif; ?>

  <?php else : ?>
    <p>Please log in to view your memos.</p>
  <?php endif; ?>

  <?php mysqli_close($connection) ?>
</body>
</html>
