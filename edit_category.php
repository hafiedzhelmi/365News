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
  // Get the updated category details from the form
  $categoryType = $_POST['categorytype'];
  $categoryDesc = $_POST['categorydesc'];

  // Update the category in the database
  $queryUpdateCategory = "UPDATE category SET categorytype = '$categoryType', categorydesc = '$categoryDesc' WHERE categoryid = '$categoryID'";
  mysqli_query($conn, $queryUpdateCategory);

  // Redirect to the manage_categories.php page after updating the category
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
  <title>Edit Category</title>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <h1>Edit Category</h1>

    <form action="" method="POST">
      <div>
        <label for="categorytype">Category Type:</label>
        <input type="text" id="categorytype" name="categorytype" value="<?php echo $category['categorytype']; ?>" required>
      </div>
      <div>
        <label for="categorydesc">Category Description:</label>
        <textarea id="categorydesc" name="categorydesc" required><?php echo $category['categorydesc']; ?></textarea>
      </div>
      <div>
        <button type="submit">Update Category</button>
      </div>
    </form>
  </main>
</body>
</html>
