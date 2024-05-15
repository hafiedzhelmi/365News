<?php
session_start();
require('db.php');

// Check if the verification form is submitted
if (isset($_POST['verify'])) {
  $enteredCode = $_POST['verification_code'];

  if ($enteredCode == $_SESSION['verification_code']) {
    // Verification successful
    $username = $_SESSION['temp_username'];
    $password = $_SESSION['temp_password'];
    $name = $_SESSION['temp_name'];
    $email = $_SESSION['temp_email'];

    // Insert user data into the database
    $insertQuery = "INSERT INTO User (username, userpass, name, authority, email) VALUES ('$username', '$password', '$name', 'reader', '$email')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
      // Registration successful
      echo      '<script>alert("Registration successful. You can now login."); window.location.href = "login.php";</script>';
      exit();
    } else {
      // Registration failed
      echo '<script>alert("Failed to complete registration. Please try again later."); window.location.href = "register.php";</script>';
      exit();
    }
  } else {
    // Verification code does not match
    echo '<script>alert("Invalid verification code. Please try again."); window.location.href = "register.php";</script>';
    exit();
  }
}

// Generate a random verification code
$verificationCode = rand(1000, 9999);

// Store the verification code in the session
$_SESSION['verification_code'] = $verificationCode;

// Get the user's temporary username and email from the session
$username = $_SESSION['temp_username'];
$email = $_SESSION['temp_email'];
$name = $_SESSION['temp_name'];
require 'PHPMailer/PHPMailerAutoload.php';

// Send the verification code to the user's email
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'mhafiedzhelmi@gmail.com'; // Your Gmail email address
$mail->Password = 'gaztxtvogmtjgnpy'; // Your Gmail password
$mail->setFrom('mhafiedzhelmi@gmail.com', 'ThreeSixFiveNews'); // Your name and email address
$mail->addAddress($email); // Recipient email address
$mail->Subject = 'Email Verification';
$mail->Body = "Dear $name,\n\nThank you for registering with our news page. We are excited to have you as a reader!\n\nTo complete your registration, please enter the following verification code:\n\n$verificationCode\n\nIf you did not initiate this registration, please ignore this email.\n\nBest regards,\nThreeSixFiveNews";



if ($mail->send()) {
  // Email sent successfully
} else {
  // Failed to send email
  echo '<script>alert("Failed to send the verification code. Please try again later."); window.location.href = "register.php";</script>';
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Email Verification Page</title>
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
      <form action="verify_email.php" method="post">
        <h1>ThreeSixFiveNews</h1>
        <h2>MEDIA GROUP</h2>
        <br>
        <h3>One last step!</h3>
        <p>To complete your registration, a verification code has been sent to your email.</p>
        <p>Please enter the code below to verify your email:</p>
        <input type="text" id="verification_code" name="verification_code" required>

        <button type="submit" name="verify">Verify</button>
      </form>
    </div>
    <img src="image/4206.jpg" alt="news doodle">
  </div>
</body>
</html>

