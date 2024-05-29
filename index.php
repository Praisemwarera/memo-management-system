<!DOCTYPE html>
<html>
<head>
  <title>Memo Management System</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <script src="assets/js/script.js"></script>
  <script>
    function showLoginForm() {
      document.getElementById("login-form").style.display = "block";
      document.getElementById("signup-form").style.display = "none";
    }

    function showSignupForm() {
      document.getElementById("login-form").style.display = "none";
      document.getElementById("signup-form").style.display = "block";
    }
  </script>
</head>
<body>

<h1>Memo Management System</h1>

<?php
  session_start();
  require_once("database.php");
?>

<?php if (isset($_SESSION["user_id"])) : ?>

  <p>Hello, <?= htmlspecialchars($users["first_name"]) ?></p>

  <?php if ($_SESSION['user_role'] === 'initiator' || $_SESSION['user_role'] === 'approval') : ?>
    <a href="create_memo.php">Create Memo</a>
    <a href="view_memos.php">View All Memos</a>
  <?php endif; ?>

  <?php if ($_SESSION['user_role'] === 'employee') : ?>
    <a href="create_memo.php">Create Memo</a>
    <a href="view_memos.php">View Submitted Memos</a>
  <?php endif; ?>

  <a href="logout.php">Logout</a>  <a href="approval_queue.php">Approval Queue (for initiator/approver only)</a>

<?php else: ?>
  <?php endif; ?>

<?php
  // Logout functionality (assuming logout.php exists)
  if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
?>
  <h2>You have been logged out.</h2>
  <p><a href="login.php">Login Again</a></p>
<?php
  }
?>

</body>
</html>
