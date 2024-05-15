<?php
session_start();
require('db.php');

// Check if the user is already logged in
if (isset($_SESSION['userid'])) {
  // Redirect to the dashboard or homepage
  header("Location: dashboard.php");
  exit();
}

// Check if the registration form is submitted
if (isset($_POST['register'])) {
  // Get form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Check for duplicate email or username
  $duplicateQuery = "SELECT * FROM User WHERE username = '$username' OR email = '$email'";
  $duplicateResult = mysqli_query($conn, $duplicateQuery);

  if (mysqli_num_rows($duplicateResult) > 0) {
    // Duplicate email or username found
    echo '<script>alert("Email or username already exists. Please choose a different one."); window.location.href = "register.php";</script>';
    exit();
  } else {
    // Generate a random 4-digit code
    $verificationCode = rand(1000, 9999);

    // Store user data in session variables
    $_SESSION['temp_username'] = $username;
    $_SESSION['temp_password'] = $password;
    $_SESSION['temp_name'] = $name;
    $_SESSION['temp_email'] = $email;
    $_SESSION['verification_code'] = $verificationCode;

    // Redirect to verify_email.php
    header("Location: verify_email.php");
    exit();
  }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Page</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .content-container {
      background-color: white;
      margin: auto;
      padding: 20px;
      max-width: 600px;
      width: 100%;
    }

    img {
      display: block;
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    table {
      width: 100%;
      border: none;
    }

    table td {
      padding: 20px;
      vertical-align: top;
      border: none;
    }

    h1, h2 {
      margin-top: 0;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="content-container">
      <form action="register.php" method="post">
        <h1>ThreeSixFiveNews</h1>
        <h2>MEDIA GROUP</h2>
        <br>
        <h3>Welcome aboard! </h3>
        <p>Sign up for a readers account by entering your details below</p>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit" name="register">Register</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
    <img src="image/4206.jpg" alt="news doodle">
  </div>
</body>
</html>

