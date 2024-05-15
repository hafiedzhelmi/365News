<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Get the logged-in user ID
$userid = $_SESSION['userid'];

// Check if the logged-in user has admin authority
$queryAdminCheck = "SELECT authority FROM user WHERE userid = $userid";
$resultAdminCheck = mysqli_query($conn, $queryAdminCheck);
$rowAdminCheck = mysqli_fetch_assoc($resultAdminCheck);
$isAdmin = ($rowAdminCheck['authority'] == 'admin');

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

// Process deletion of a user
if ($isAdmin && isset($_GET['delete'])) {
  $deleteUserId = $_GET['delete'];
  $deleteArticles = isset($_POST['delete_articles']) ? $_POST['delete_articles'] : false;

  if ($deleteArticles) {
    // Display a confirmation form to enter the admin's password
    echo '
    <h2>Confirm Deletion</h2>
    <p>Are you sure you want to delete this user and their articles?</p>
    <form method="post" action="delete_user.php?delete=' . $deleteUserId . '">
      <label for="password">Enter Admin Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Confirm</button>
    </form>
    ';
  } else {
    // Delete the user without deleting articles
    $queryDeleteUser = "DELETE FROM user WHERE userid = $deleteUserId";
    mysqli_query($conn, $queryDeleteUser);

    // Redirect to the users page to display the updated user list
    header("Location: users.php");
    exit();
  }
}

// Process form submission for deleting a user and their articles
if ($isAdmin && isset($_POST['password'])) {
  $deleteUserId = $_GET['delete'];
  $password = $_POST['password'];

  // Retrieve the admin user's password
  $queryAdminPassword = "SELECT userpass FROM user WHERE userid = $userid";
  $resultAdminPassword = mysqli_query($conn, $queryAdminPassword);
  $rowAdminPassword = mysqli_fetch_assoc($resultAdminPassword);
  $adminPassword = $rowAdminPassword['userpass'];

  // Verify if the entered admin password matches
  if (password_verify($password, $adminPassword)) {
    // Delete the user and their articles
    $queryDeleteUser = "DELETE user, article FROM user LEFT JOIN article ON user.userid = article.userid WHERE user.userid = $deleteUserId";
    mysqli_query($conn, $queryDeleteUser);

    // Redirect to the users page to display the updated user list
    header("Location: users.php");
    exit();
  } else {
    // Incorrect admin password, display error message
    echo '<p>Incorrect admin password. Please try again.</p>';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Users</title>
</head>
<body>
<!-- Navigation menu -->
<?php include('navbar.php') ?>
<main>
  <h1>Manage Users</h1>

  <?php if ($isAdmin) : ?>
    <!-- User creation form -->
    <h2>Create New User</h2>
    <?php if (!empty($errors)) : ?>
      <div class="error">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
        <option value="user">User</option>
      </select>

      <button type="submit">Create User</button>
    </form>
  <?php endif; ?>

  <!-- User list -->
  <h2>User List</h2>
  <table class="user-table">
    <thead>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Authority</th>
        <?php if ($isAdmin) : ?>
          <th>Actions</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php
      // Retrieve all users from the database
      $queryUsers = "SELECT * FROM user";
      $resultUsers = mysqli_query($conn, $queryUsers);

      // Display user data in the table
      while ($rowUser = mysqli_fetch_assoc($resultUsers)) {
        echo '<tr>';
        echo '<td>' . $rowUser['userid'] . '</td>';
        echo '<td>' . $rowUser['name'] . '</td>';
        echo '<td>' . $rowUser['username'] . '</td>';
        echo '<td>' . $rowUser['email'] . '</td>';
        echo '<td>' . $rowUser['authority'] . '</td>';
        if ($isAdmin) {
          echo '<td><a href="edit_user.php?userid=' . $rowUser['userid'] . '">Edit</a> | <a href="users.php?delete=' . $rowUser['userid'] . '">Delete</a></td>';
        }
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</main>
</body>
</html>


