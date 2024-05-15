<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');
$authority = $_SESSION['authority'];
if ($authority !== 'admin') {
  // Redirect to an appropriate page if the user does not have admin authority
  header("Location: dashboard.php");
  exit();
}

// Retrieve categories with associated article count
$queryCategories = "SELECT c.categoryid, c.categorytype, c.categorydesc, COUNT(a.id) AS articleCount 
                    FROM category AS c 
                    LEFT JOIN article AS a ON c.categoryid = a.categoryid 
                    GROUP BY c.categoryid, c.categorytype, c.categorydesc";
$resultCategories = mysqli_query($conn, $queryCategories);

// Check if there are any categories
if (mysqli_num_rows($resultCategories) > 0) {
  $categories = mysqli_fetch_all($resultCategories, MYSQLI_ASSOC);
} else {
  $categories = [];
}

// Handle form submission
if (isset($_POST['addCategory'])) {
  $categoryType = $_POST['categoryType'];
  $categoryDesc = $_POST['categoryDesc'];

  // Check for duplicate category
  $duplicateQuery = "SELECT * FROM category WHERE categorytype = '$categoryType'";
  $duplicateResult = mysqli_query($conn, $duplicateQuery);

  if (mysqli_num_rows($duplicateResult) > 0) {
    // Duplicate category found
    echo '<script>alert("Category already exists. Please choose a different one.");</script>';
  } else {
    // Insert new category into the database
    $insertQuery = "INSERT INTO category (categorytype, categorydesc) VALUES ('$categoryType', '$categoryDesc')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
      // Category added successfully
      echo '<script>alert("Category added successfully.");</script>';
      header("Location: manage_categories.php");
      exit();
    } else {
      // Failed to add category
      echo '<script>alert("Failed to add category. Please try again later.");</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Manage Categories</title>
  <style type="text/css">
     main {
         margin: 80px 20px;
    }
  </style>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <main>
    <h1>Manage Categories</h1>

    <?php if ($authority == 'admin') : ?>
      <!-- Add Category Form -->
      <h2>Add Category</h2>
      <form action="" method="post">
        <label for="categoryType">Category Type:</label>
        <input type="text" id="categoryType" name="categoryType" required>

        <label for="categoryDesc">Category Description:</label>
        <input type="text" id="categoryDesc" name="categoryDesc" required>

        <button type="submit" name="addCategory">Add Category</button>
      </form>

      <!-- Category list -->
      <h2>Category List</h2>
      <?php if (!empty($categories)) : ?>
        <table class="category-table">
          <thead>
            <tr>
              <th>Category Type</th>
              <th>Description</th>
              <th>Article Count</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $category) : ?>
              <tr>
                <td><?php echo $category['categorytype']; ?></td>
                <td><?php echo $category['categorydesc']; ?></td>
                <td><?php echo $category['articleCount']; ?></td>
                <td>
                  <a href="edit_category.php?categoryid=<?php echo $category['categoryid']; ?>">Edit</a> |
                  <a href="delete_category.php?categoryid=<?php echo $category['categoryid']; ?>">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>No categories found.</p>
      <?php endif; ?>
    <?php endif; ?>
  </main>
</body>
</html>

