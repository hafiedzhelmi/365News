<?php
require('db.php');
require('session_checker.php');

// Retrieve the category ID from the URL parameter
if (isset($_GET['category'])) {
    $categoryID = $_GET['category'];
} else {
    // Redirect to a default page or display an error message
    header("Location: error.php");
    exit();
}

// Retrieve the category name based on the category ID
$queryCategory = "SELECT categorytype FROM category WHERE categoryid = $categoryID";
$resultCategory = mysqli_query($conn, $queryCategory);

// Check if the category exists
if ($resultCategory && mysqli_num_rows($resultCategory) > 0) {
    $category = mysqli_fetch_assoc($resultCategory);
    $categoryName = $category['categorytype'];
} else {
    // Handle the case where the category doesn't exist
    $categoryName = "Unknown Category";
}

// Retrieve articles from the database based on the category ID
$queryArticles = "SELECT article.*, user.name AS author_name
                 FROM article
                 INNER JOIN user ON article.userid = user.userid
                 WHERE article.categoryid = $categoryID
                 ORDER BY article.timestamp DESC";
$resultArticles = mysqli_query($conn, $queryArticles);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Articles</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
      <style>
    /* Default styles */
    body {
      display: flex;
      justify-content: space-between;
    }

    main {
      display: flex;
      flex: 1;
    }

    .left-container {
      flex: 8;
    }

    .right-container {
      flex: 2;
      border: 2px solid black;
    }
  .left-container a,
    .right-container ul li a {
      color: black;
      text-decoration: none;
      transition: opacity 0.3s;
    }

    .left-container a:hover,
    .right-container ul li a:hover {
      opacity: 0.6;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      border: none;
      padding: 10px;
    }

    .article-cell {
      width: 25%;
      text-align: left;
      vertical-align: top;
    }

    /* Media query for portrait mode */
    @media (orientation: portrait) {
      body {
        display: block;
      }

      main {
        display: block;
      }

      .left-container,
      .right-container {
        flex: none;
        width: auto;
      }

    }
    h3 a{
        text-decoration: none;
        color: black;
      }
  </style>
</head>
<body>
        <?php require('navbar.php'); ?>
    <main>
        
    <div class="container">
        <h2>Articles in <?php echo $categoryName; ?></h2>
        <ul>
            <?php
            // Check if there are articles available
            if (mysqli_num_rows($resultArticles) > 0) {
                // Display each article
                while ($row = mysqli_fetch_assoc($resultArticles)) {
                    echo '<li>';
                    echo '<h3><a href="read_article.php?articleid=' . $row['id'] . '">' . $row['title'] . '</a></h3>';
                    echo '<p>Author: ' . $row['author_name'] . '</p>';
                    echo '<p>Date: ' . $row['timestamp'] . '</p>';
                    // You can display additional article information here
                    echo '</li><br>';
                }
            } else {
                // No articles found for the category
                echo '<p>No articles found.</p>';
            }
            ?>
        </ul>
    </div>
</main>
    <div>
  <?php include('footer_page.html'); ?>
</div>
</body>



</html>
