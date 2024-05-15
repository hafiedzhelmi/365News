<?php
// Start session
session_start();
// Connect to the database
require('db.php');

// Check if the user is already logged in
if (isset($_SESSION['userid'])) {
  // Redirect to the dashboard or homepage
  header("Location: dashboard.php");
  exit();
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
  // Get form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query to fetch the hashed password from the database
  $query = "SELECT * FROM User WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  // Check if the query returned a row
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['userpass'];

    // Verify the entered password with the hashed password
    if (password_verify($password, $hashedPassword)) {
      // User is authenticated
      $_SESSION['userid'] = $row['userid'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['authority'] = $row['authority'];

      // Check authority and redirect accordingly
      if ($row['authority'] === 'reader') {
        header("Location: readers_landing_page.php");
        exit();
      } else {
        header("Location: dashboard.php");
        exit();
      }
    } else {
      // Invalid password
      echo '<script>alert("Wrong Credential");</script>';
    }
  } else {
    // Invalid username
    echo '<script>alert("Wrong Credential");</script>';
  }

  // Close the database connection
  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
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
      object-fit: contain; /* Add this line */
    }

    @media (max-width: 600px) {
      img {
        display: none;
      }

      .content-container {
        padding: 10px;
      }
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
      <form action="login.php" method="post">
        <h1>ThreeSixFiveNews</h1>
        <h2>MEDIA GROUP</h2>
        <br>
        <h3>Welcome back!</h3>
        <p>To start reading, log in with your account</p>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" name="login">Login</button>
        <p>Forgot password? Click <a href="forgot_password.php">here</a></p>
        <p>Don't have an account? Register <a href="register.php">here</a></p>
      </form>
    </div>
    <img src="image/4206.jpg" alt="news doodle">
  </div>
</body>
</html>
