<?php 
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Get the logged-in user ID
$userid = $_SESSION['userid'];

// Check if the form is submitted
if (isset($_POST['add_article'])) {
  // Get form data
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = nl2br(mysqli_real_escape_string($conn, $_POST['content']));
  $category = $_POST['category'];

  // Get the current timestamp
  $timestamp = date('Y-m-d H:i:s');

  // Image upload handling
  $targetDir = "Uploads/";
  $image = $_FILES['image']['name'];
  $targetFile = $targetDir . basename($image);
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if the file is a valid image
  $validImageTypes = array('jpg', 'jpeg', 'png', 'gif');
  if (in_array($imageFileType, $validImageTypes)) {
    // Move the uploaded image to the desired directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      // Insert the article data into the database
      $query = "INSERT INTO article (title, image, content, timestamp, userid, categoryid) VALUES ('$title', '$targetFile', '$content', '$timestamp', $userid, '$category')";
      $result = mysqli_query($conn, $query);

      if ($result) {
        echo "Article added successfully.";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    } else {
      echo "Error uploading the image.";
    }
  } else {
    echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add New Article</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
  /* CSS styles for the select element */
  select {
    padding: 10px;
    border: none;
    background-color: #f1f1f1;
    color: #333;
    font-size: 14px;
    cursor: pointer;
  }

  /* CSS styles for the select element when hovered */
  select:hover {
    background-color: #ddd;
  }
</style>
<body>

  <!-- Navigation menu -->
 <?php include('navbar.php') ?>
<main>

<form action="add_article.php" method="post" enctype="multipart/form-data">
  <h1>Publish Article</h1>
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" required>
  
  <label for="image">Image:</label>
  <input type="file" id="image" name="image" accept="image/*" required>
  
  <label for="content">Content:</label>
  <textarea id="content" name="content" required></textarea>
  
  <label for="category">Category:</label>
  <select id="category" name="category" required>
    <option value="">Select a category</option>
    <?php
      // Fetch categories from the database
      $query = "SELECT categoryid, categorytype FROM category";
      $result = $conn->query($query);

      // Generate category options
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $categoryid = $row['categoryid'];
          $categorytype = $row['categorytype'];
          echo "<option value=\"$categoryid\">$categorytype</option>";
        }
      }
    ?>
  </select>
  
  <button type="submit" name="add_article" id="add_article">Add Article</button>
</form>
</main>


</body>
</html>
