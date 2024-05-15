<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');
  // Get the logged-in user ID
$userid = $_SESSION['userid'];

// Check if the delete button is clicked
if (isset($_POST['delete_article'])) {
  // Get the article ID to delete
  $articleId = $_POST['article_id'];

  // Delete the article from the database
  $queryDeleteArticle = "DELETE FROM Article WHERE id = $articleId";
  $resultDeleteArticle = mysqli_query($conn, $queryDeleteArticle);

  if ($resultDeleteArticle) {
    echo "Article deleted successfully.";
  } else {
    echo "Error deleting the article: " . mysqli_error($conn);
  }
}

// Check if a search is performed
if (isset($_POST['search'])) {
  $searchCriteria = $_POST['search_criteria'];
  $searchKeyword = $_POST['search_keyword'];

  // Modify the query based on the search criteria
  $queryUserArticles = "SELECT a.*, c.categorytype AS category_name FROM Article a LEFT JOIN Category c ON a.categoryid = c.categoryid WHERE a.userid = $userid AND ";

  switch ($searchCriteria) {
    case 'title':
      $queryUserArticles .= "a.title LIKE '%$searchKeyword%'";
      break;
    case 'date':
      $queryUserArticles .= "a.timestamp LIKE '%$searchKeyword%'";
      break;
    case 'category':
      $queryUserArticles .= "c.categorytype LIKE '%$searchKeyword%'";
      break;
    case 'content':
      $queryUserArticles .= "a.content LIKE '%$searchKeyword%'";
      break;
    default:
      $queryUserArticles .= "1"; // Default to retrieve all articles
      break;
  }
} else {
  // Retrieve all user's articles
  $queryUserArticles = "SELECT a.*, c.categorytype AS category_name FROM Article a LEFT JOIN Category c ON a.categoryid = c.categoryid WHERE a.userid = $userid";
}

$resultUserArticles = mysqli_query($conn, $queryUserArticles);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Articles</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style type="text/css">
    table{
      margin: 0 20px;
    }
  </style>
</head>
<body>
  <!-- Navigation menu -->
   <?php include('navbar.php') ?>

  <main>
    

    <form action="manage_article.php" method="post">
      <h1>Manage Articles</h1>
      <label for="search_criteria">Search Criteria:</label>
      <select name="search_criteria" id="search_criteria">
        <option value="title">Title</option>
        <option value="date">Date</option>
        <option value="category">Category</option>
        <option value="content">Content</option>
      </select>
      <input type="text" name="search_keyword" placeholder="Enter keyword">
      <button type="submit" name="search">Search</button>
    </form>
<?php if (mysqli_num_rows($resultUserArticles) > 0) : ?>
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Image</th>
        <th>Content</th>
        <th>Category</th>
        <th>Timestamp</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($resultUserArticles)) : ?>
        <tr>
          <td><?php echo $row['title']; ?></td>
          <td><img src="<?php echo $row['image']; ?>" alt="Article Image" width="100"></td>
          <td><?php echo $row['content']; ?></td>
          <td><?php echo $row['category_name']; ?></td>
          <td><?php echo $row['timestamp']; ?></td>
          <td>
            <form action="manage_article.php" method="post">
              <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
              <button type="submit" name="delete_article">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php else : ?>
  <p>No articles found.</p>
<?php endif; ?>
  </main>
</body>
</html>