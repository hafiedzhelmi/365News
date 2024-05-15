<?php
// Include the PHPMailer library
require 'PHPMailer/PHPMailerAutoload.php';

// Database connection
require 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the submitted email
  $email = $_POST['email'];

  // Check if the email exists in the user table
  $query = "SELECT * FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // Fetch the user's data
    $user = mysqli_fetch_assoc($result);

    // Get the username and generate a new password
    $username = $user['username'];
    $newPassword = generateRandomPassword();

    // Update the password in the database
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateQuery = "UPDATE user SET userpass = '$hashedPassword' WHERE email = '$email'";
    mysqli_query($conn, $updateQuery);

    // Send the email with the username and new password
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
    $mail->Subject = 'Password Retrieval Information';
    $mail->Body = 'Hello ' . $user['name'] . ',' . "\r\n\r\n" .
                  'We received a request to retrieve your account information. Here are your updated login credentials:' . "\r\n\r\n" .
                  'Username: ' . $username . "\r\n" .
                  'Password: ' . $newPassword . "\r\n\r\n" .
                  'Please ensure that you keep this information secure and update your password after logging in. If you did not initiate this request or have any concerns about the security of your account, please contact our support team immediately.' . "\r\n\r\n" .
                  'Thank you,' . "\r\n" .
                  'ThreeSixFiveNews';

    if ($mail->send()) {
      // Email sent successfully
      echo '<script>alert("Username and password sent to your email. Please check your inbox."); window.location.href = "login.php";</script>';
      exit();
    } else {
      // Failed to send email
      echo '<script>alert("Failed to send the email. Please try again later."); window.location.href = "forgot_password.php";</script>';
      exit();
    }
  } else {
    // Email does not exist in the database
    echo '<script>alert("Sorry, but the email you have entered is not found in our records, please check and try again. If you need help, do contact our support team via threesixfivenews@gmail.com"); window.location.href = "forgot_password.php";</script>';
    exit();
  }
}

// Function to generate a random password
function generateRandomPassword($length = 8) {
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $password = '';

  for ($i = 0; $i < $length; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $password .= $characters[$index];
  }

  return $password;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
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
      <form method="post" action="forgot_password.php">
              <h1>ThreeSixFiveNews</h1>
              <h2>MEDIA GROUP</h2>
              <br><h3>Forgot your password? No worries!</h3>
              <p>Enter your email below to retreive your account</p>
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
              <button type="submit">Submit</button>
            </form>
    </div>
    <img src="image/4206.jpg" alt="news doodle">
  </div>
</body>
</html>
