<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Get the logged-in user ID and authority
$userid = $_SESSION['userid'];
$authority = $_SESSION['authority'];

// Check if the logged-in user has admin authority
$isAdmin = ($authority == 'admin');
if ($authority!='admin')
  header("Location: dashboard.php");
// Retrieve the user ID from the query parameters
if (isset($_GET['userid'])) {
  $editUserId = $_GET['userid'];
} else {
  // Redirect to the manage_user page if no user ID is provided
  header("Location: manage_users.php");
  exit();
}

// Retrieve the user from the database
$queryUser = "SELECT * FROM user WHERE userid = $editUserId";
$resultUser = mysqli_query($conn, $queryUser);

// Redirect to the manage_user page if the user does not exist
if (mysqli_num_rows($resultUser) == 0) {
  header("Location: manage_users.php");
  exit();
}

// Fetch the user data
$userData = mysqli_fetch_assoc($resultUser);

// Process form submission for updating the user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin) {
  // Retrieve the form data
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $authority = $_POST['authority'];

  // Perform input validation
  $errors = array();

  // Check if the username is already taken by another user
  $queryUsernameCheck = "SELECT * FROM user WHERE username = '$username' AND userid != $editUserId";
  $resultUsernameCheck = mysqli_query($conn, $queryUsernameCheck);
  if (mysqli_num_rows($resultUsernameCheck) > 0) {
    $errors[] = "Username already exists. Please choose a different username.";
  }

  // Check if the email is already in use by another user
  $queryEmailCheck = "SELECT * FROM user WHERE email = '$email' AND userid != $editUserId";
  $resultEmailCheck = mysqli_query($conn, $queryEmailCheck);
  if (mysqli_num_rows($resultEmailCheck) > 0) {
    $errors[] = "Email already exists. Please choose a different email.";
  }

  // If there are no validation errors, update the user in the database
  if (empty($errors)) {
    $queryUpdateUser = "UPDATE user SET name = '$name', username = '$username', email = '$email', authority = '$authority' WHERE userid = $editUserId";
    mysqli_query($conn, $queryUpdateUser);

    // Redirect to the manage_user page to display the updated user list
    header("Location: manage_users.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Edit User</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <h1>Edit User</h1>

    <?php if ($isAdmin) : ?>
      <!-- Edit User Form -->
      <form method="POST" action="">
        <input type="hidden" name="userid" value="<?php echo $userData['userid']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $userData['name']; ?>">
<label for="username">Username:</label>
<input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>">
<label for="email">Email:</label>
<input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>">
<label for="authority">Authority:</label>
<select id="authority" name="authority">
<option value="admin" <?php echo ($userData['authority'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
<option value="staff" <?php echo ($userData['authority'] == 'user') ? 'selected' : ''; ?>>Staff</option>
<option value="reader" <?php echo ($userData['authority'] == 'user') ? 'selected' : ''; ?>>Reader</option>
</select>
<button type="submit">Update</button>
</form>
<?php if (!empty($errors)) : ?>
<div class="errors">
<ul>
<?php foreach ($errors as $error) : ?>
<li><?php echo $error; ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
<?php endif; ?>

  </main>
</body>
</html>
