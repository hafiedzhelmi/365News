<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Retrieve categories in alphabetical order
$query = "SELECT categoryid, categorytype FROM category ORDER BY categorytype ASC";
$result = mysqli_query($conn, $query);

// Check if a category ID is provided in the query parameter
if (isset($_GET['category'])) {
  $categoryID = $_GET['category'];

  // Query to retrieve articles based on category
  $query = "SELECT article.title, article.timestamp, user.name AS author
            FROM article
            INNER JOIN user ON article.userid = user.userid
            WHERE article.categoryid = $categoryID";
  $articlesResult = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Category Page</title>
  <style type="text/css">
     main {
         margin: 80px 20px;
    }
  </style>
</head>
<body>
  <?php include('navbar.php') ?>
  <main>
    <h1>Category Page</h1>

    <!-- Category Filter -->
    <form method="get">
      <label for="category">Select a Category:</label>
      <select id="category" name="category">
        <?php
        // Display categories in the dropdown filter
        while ($row = mysqli_fetch_assoc($result)) {
          $categoryID = $row['categoryid'];
          $categoryType = $row['categorytype'];

          // Query to get the total number of articles for each category
          $countQuery = "SELECT COUNT(*) AS articleCount FROM article WHERE categoryid = $categoryID";
          $countResult = mysqli_query($conn, $countQuery);
          $countRow = mysqli_fetch_assoc($countResult);
          $articleCount = $countRow['articleCount'];

          // Check if the current category ID matches the selected category ID
          $selected = '';
          if (isset($_GET['category']) && $_GET['category'] == $categoryID) {
            $selected = 'selected';
          }

          echo "<option value=\"$categoryID\" $selected>$categoryType ($articleCount)</option>";
        }
        ?>
      </select>
      <button type="submit">Filter</button>
    </form>

    <!-- Display Articles -->
    <?php if (isset($articlesResult)) : ?>
      <h2>Articles</h2>
      <table class="article-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Published Date</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($articlesResult)) : ?>
            <tr>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['author']; ?></td>
              <td><?php echo $row['timestamp']; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </main>
</body>
</html>
