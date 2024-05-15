<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Get the logged-in user ID and authority
$userid = $_SESSION['userid'];
$authority = $_SESSION['authority'];

// Check if the logged-in user has admin authority
$isAdmin = ($authority == 'admin');
if ($authority !== 'admin') {
  // Redirect to an appropriate page if the user does not have admin authority
  header("Location: dashboard.php");
  exit();
}


// Retrieve all users from the database
$queryUsers = "SELECT * FROM user";
$resultUsers = mysqli_query($conn, $queryUsers);

// Retrieve the number of articles for each user
$articleCounts = array();
$queryArticleCounts = "SELECT userid, COUNT(*) AS count FROM article GROUP BY userid";
$resultArticleCounts = mysqli_query($conn, $queryArticleCounts);
while ($rowArticleCount = mysqli_fetch_assoc($resultArticleCounts)) {
  $articleCounts[$rowArticleCount['userid']] = $rowArticleCount['count'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">
     main {
         margin: 80px 20px;
    }
  </style>
  <title>Manage Users</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <h1>Manage Users</h1>

    <?php if ($isAdmin) : ?>
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
            <th>Articles</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($rowUser = mysqli_fetch_assoc($resultUsers)) : ?>
            <tr>
              <td><?php echo $rowUser['userid']; ?></td>
              <td><?php echo $rowUser['name']; ?></td>
              <td><?php echo $rowUser['username']; ?></td>
              <td><?php echo $rowUser['email']; ?></td>
              <td><?php echo $rowUser['authority']; ?></td>
              <td><?php echo isset($articleCounts[$rowUser['userid']]) ? $articleCounts[$rowUser['userid']] : 0; ?></td>
              <td>
                <a href="edit_user.php?userid=<?php echo $rowUser['userid']; ?>">Edit</a> |
                <a href="delete_user.php?delete=<?php echo $rowUser['userid']; ?>">Delete</a>

              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </main>
</body>
</html>

