<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Check if the user has admin authority
$authority = $_SESSION['authority'];
if ($authority !== 'admin') {
  // Redirect to an appropriate page if the user does not have admin authority
  header("Location: dashboard.php");
  exit();
}

// Check if the category ID is provided in the URL
if (!isset($_GET['categoryid'])) {
  // Redirect to an appropriate page if the category ID is missing
  header("Location: manage_categories.php");
  exit();
}

// Get the category ID from the URL
$categoryID = $_GET['categoryid'];

// Retrieve the category details from the database
$queryCategory = "SELECT * FROM category WHERE categoryid = '$categoryID'";
$resultCategory = mysqli_query($conn, $queryCategory);
$category = mysqli_fetch_assoc($resultCategory);

// Check if the category exists
if (!$category) {
  // Redirect to an appropriate page if the category does not exist
  header("Location: manage_categories.php");
  exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the user wants to delete the articles associated with the category
  $deleteArticles = isset($_POST['deletearticles']) && $_POST['deletearticles'] === 'yes';

  if ($deleteArticles) {
    // Delete the articles associated with the category
    $queryDeleteArticles = "DELETE FROM article WHERE categoryid = '$categoryID'";
    mysqli_query($conn, $queryDeleteArticles);
  }

  // Delete the category from the database
  $queryDeleteCategory = "DELETE FROM category WHERE categoryid = '$categoryID'";
  mysqli_query($conn, $queryDeleteCategory);

  // Redirect to the manage_categories.php page after deleting the category
  header("Location: manage_categories.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Delete Category</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <h1>Delete Category</h1>

    <p>Are you sure you want to delete the category "<?php echo $category['categorytype']; ?>"?</p>

    <form action="" method="POST">
      <div>
        <input type="checkbox" id="deletearticles" name="deletearticles" value="yes">
        <label for="deletearticles">Delete articles associated with this category</label>
      </div>
      <div>
        <button type="submit">Delete Category</button>
      </div>
    </form>
  </main>
</body>
</html>

