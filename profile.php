<?php
require('db.php');
require('session_checker.php');

// Get the logged-in user ID
$loggedInUserId = $_SESSION['userid'];

// Retrieve the user details from the database
$queryUser = "SELECT * FROM user WHERE userid = '$loggedInUserId'";
$resultUser = mysqli_query($conn, $queryUser);
$user = mysqli_fetch_assoc($resultUser);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form values
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $background = $_POST['background'];
  $password = $_POST['password'];

  // Check if the username has changed and if it already exists
  if ($username != $user['username']) {
    $queryCheckUsername = "SELECT * FROM user WHERE username = '$username'";
    $resultCheckUsername = mysqli_query($conn, $queryCheckUsername);
    if (mysqli_num_rows($resultCheckUsername) > 0) {
      echo '<script>alert("This username has already been used. Pick another one"); window.location.href = "profile.php";</script>';
      exit();
    } else {
      // Update the username in the database
      $queryUpdateUsername = "UPDATE user SET username = '$username' WHERE userid = '$loggedInUserId'";
      mysqli_query($conn, $queryUpdateUsername);
    }
  }

  // Check if the email has changed and if it already exists
  if ($email != $user['email']) {
    $queryCheckEmail = "SELECT * FROM user WHERE email = '$email'";
    $resultCheckEmail = mysqli_query($conn, $queryCheckEmail);
    if (mysqli_num_rows($resultCheckEmail) > 0) {
      echo '<script>alert("This email has already been used. Pick another one"); window.location.href = "profile.php";</script>';
      exit();
    } else {
      // Update the email in the database
      $queryUpdateEmail = "UPDATE user SET email = '$email' WHERE userid = '$loggedInUserId'";
      mysqli_query($conn, $queryUpdateEmail);

      // Redirect to the verify_email.php page for email verification
      header("Location: verify_email.php?email=$email");
      exit();
    }
  }

  // Check if the password field is not empty and update the password in the database
  if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $queryUpdatePassword = "UPDATE user SET userpass = '$hashedPassword' WHERE userid = '$loggedInUserId'";
    mysqli_query($conn, $queryUpdatePassword);
  }

  // Update the other profile information in the database
  $queryUpdateProfile = "UPDATE user SET name = '$name', background = '$background' WHERE userid = '$loggedInUserId'";
  mysqli_query($conn, $queryUpdateProfile);

  // Redirect to the profile page after updating the profile
  header("Location: profile.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Profile</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <?php if (isset($error)) : ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <h1>Your Profile</h1>
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
      </div>
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
      </div>
      <?php if ($authority !== 'reader') : ?>
    <div>
      <label for="background">Something about yourself:</label>
      <textarea id="background" name="background"><?php echo $user['background']; ?></textarea>
    </div>
  <?php endif; ?>
      <button type="submit">Save</button>
    </form>
  </main>
</body>
</html>
