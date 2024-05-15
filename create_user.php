<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');
$authority = $_SESSION['authority'];
if ($authority!='admin')
  header("Location: dashboard.php");
// Check if the logged-in user has admin authority
$isAdmin = false; // Set it to true or false based on the authority check

// Process form submission for creating a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $authority = $_POST['authority'];

  // Perform input validation
  $errors = array();

  // Check if the username is already taken
  $queryUsernameCheck = "SELECT * FROM user WHERE username = '$username'";
  $resultUsernameCheck = mysqli_query($conn, $queryUsernameCheck);
  if (mysqli_num_rows($resultUsernameCheck) > 0) {
    $errors[] = "Username already exists. Please choose a different username.";
  }

  // Check if the email is already in use
  $queryEmailCheck = "SELECT * FROM user WHERE email = '$email'";
  $resultEmailCheck = mysqli_query($conn, $queryEmailCheck);
  if (mysqli_num_rows($resultEmailCheck) > 0) {
    $errors[] = "Email already exists. Please choose a different email.";
  }

  // If there are no validation errors, insert the new user into the database
  if (empty($errors)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $queryInsertUser = "INSERT INTO user (userpass, name, username, email, authority) VALUES ('$hashedPassword', '$name', '$username', '$email', '$authority')";
    mysqli_query($conn, $queryInsertUser);

    // Redirect to the users page to display the updated user list
    header("Location: users.php");
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
  <style type="text/css">

  </style>
  <title>Create User</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>
  <main>
    

    <?php if (!empty($errors)) : ?>
      <div class="error">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <h1>Create New User</h1>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="authority">Authority:</label>
      <select id="authority" name="authority">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        <option value="staff">Reader</option>
      </select>

      <button type="submit">Create User</button>
    </form>
  </main>
</body>
</html>

