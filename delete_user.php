<?php
require('db.php');
require('session_checker.php');

// Get the logged-in user ID and authority
$loggedInUserId = $_SESSION['userid'];
$authority = $_SESSION['authority'];

// Check if the user has admin authority
if ($authority !== 'admin') {
  // Redirect to an appropriate page if the user does not have admin authority
  header("Location: dashboard.php");
  exit();
}

// Process deletion of a user
if ($authority === 'admin' && isset($_GET['delete'])) {
  $deleteUserId = $_GET['delete'];

  // Check if the delete user is the logged-in user
  if ($deleteUserId == $loggedInUserId) {
    // Redirect back to the manage_user page with an error message in a pop-up
    echo "<script>alert('You cannot delete your own account.');</script>";
    echo "<script>window.location.href='manage_users.php';</script>";
    exit();
  }

  // Retrieve the user details
  $queryUser = "SELECT * FROM user WHERE userid = $deleteUserId";
  $resultUser = mysqli_query($conn, $queryUser);
  $rowUser = mysqli_fetch_assoc($resultUser);

  // Check if the user exists
  if (!$rowUser) {
    // Redirect back to the manage_user page with an error message in a pop-up
    echo "<script>alert('User not found.');</script>";
    echo "<script>window.location.href='manage_users.php';</script>";
    exit();
  }

  // Prompt the user for their account password
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    // Verify the password
    if (password_verify($password, $rowUser['password'])) {
      // Delete the user
      $queryDeleteUser = "DELETE FROM user WHERE userid = $deleteUserId";
      mysqli_query($conn, $queryDeleteUser);

      // Delete the user's articles if selected
      if (isset($_POST['delete_articles'])) {
        $queryDeleteArticles = "DELETE FROM article WHERE userid = $deleteUserId";
        mysqli_query($conn, $queryDeleteArticles);
      }

      // Show success message in a pop-up
      echo "<script>alert('User deleted successfully.');</script>";
      echo "<script>window.location.href='manage_users.php';</script>";
      exit();
    } else {
      // Redirect back to the delete_user page with an error message
      echo "<script>alert('Incorrect password.');</script>";
      echo "<script>window.location.href='manage_users.php';</script>";
      exit();
    }
  }
} else {
  // Redirect back to the manage_user page if delete parameter is not set or user doesn't have admin authority
  header("Location: manage_users.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Delete User</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <h1>Delete User</h1>

    <?php if ($rowUser) : ?>
      <form method="POST">
        <p>Are you sure you want to delete this user?</p>
        <p>User ID: <?php echo $rowUser['userid']; ?></p>
        <p>Name: <?php echo $rowUser['name']; ?></p>
        <p>Username: <?php echo $rowUser['username']; ?></p>
        <p>Email: <?php echo $rowUser['email']; ?></p>
        <p>Authority: <?php echo $rowUser['authority']; ?></p>

        <p>Delete options:</p>
        <input type="checkbox" name="delete_articles" id="delete_articles" value="1">
        <label for="delete_articles">Delete user's articles</label>

        <p>Enter your account password to confirm:</p>
        <input type="password" name="password" required>
        <button type="submit">Delete User</button>
      </form>
    <?php else : ?>
      <p>User not found.</p>
    <?php endif; ?>
  </main>
</body>
</html>
