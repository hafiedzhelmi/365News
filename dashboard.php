<?php
require('db.php');
require('session_checker.php');
require('staff_session_checker.php');

// Get the logged-in user ID
$userid = $_SESSION['userid'];

// Query to retrieve the user's name
$query = "SELECT name FROM User WHERE userid = $userid";
$result = mysqli_query($conn, $query);

// Check if the query returned a row
if (mysqli_num_rows($result) == 1) {
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
} else {
  // Handle the case if the user is not found
  echo "User not found.";
}

// Query to retrieve the user's latest article
$queryLatestArticle = "SELECT * FROM Article WHERE userid = $userid ORDER BY `timestamp` DESC LIMIT 1";
$resultLatestArticle = mysqli_query($conn, $queryLatestArticle);
$latestArticle = mysqli_fetch_assoc($resultLatestArticle);

// Query to retrieve the user's total number of article contributions this week
$queryTotalContributions = "SELECT COUNT(*) AS totalContributions FROM Article WHERE userid = $userid AND WEEK(`timestamp`) = WEEK(CURDATE())";
$resultTotalContributions = mysqli_query($conn, $queryTotalContributions);
$totalContributions = mysqli_fetch_assoc($resultTotalContributions)['totalContributions'];

// Query to retrieve the user's total number of articles
$queryTotalArticles = "SELECT COUNT(*) AS totalArticles FROM Article WHERE userid = $userid";
$resultTotalArticles = mysqli_query($conn, $queryTotalArticles);
$totalArticles = mysqli_fetch_assoc($resultTotalArticles)['totalArticles'];

// Check if the user has a latest article
if ($latestArticle) {
  $latestArticleImage = $latestArticle['image'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Admin Page</title>
  <style type="text/css">
    main{
      margin: 80px 20px;
    }
    table, td{
      border: none;
    }
    .article-title {
      padding: 5px 0;
      margin: 0;
    }

    .article-heading {
      padding: 5px 0;
      margin: 0;
    }

    .article-content {
      padding: 10px 0;
      margin: 0;
      white-space: pre-wrap;
      text-align: justify;
    }

    .article-date {
      padding: 5px 0;
      margin: 0;
    }
    .article-image-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .article-image {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <!-- Navigation menu -->
  <?php include('navbar.php') ?>

  <!-- Main content -->
  <main>
    <h1>Welcome back, <?php echo $name; ?></h1>
    <fieldset>
      <legend><h2 class="article-title">Your latest article</h2></legend>
      <!-- Display user's latest article -->
      <?php if ($latestArticle) : ?>
        <table>
          <tr>
            <td style="width: 65%;">
              <h3 class="article-heading"><?php echo $latestArticle['title']; ?></h3>
              <p class="article-content"><?php echo htmlspecialchars_decode($latestArticle['content']); ?></p>
              <p class="article-date">Date published: <?php echo $latestArticle['timestamp']; ?></p>
            </td>
            <td style="width: 35%;">
              <div class="article-image-container">
                <img src="<?php echo $latestArticleImage; ?>" alt="Latest Article Image" class="article-image">
              </div>
            </td>
          </tr>
        </table>
      <?php else : ?>
        <p>No articles found.</p>
      <?php endif; ?>
    </fieldset>

    <fieldset>
      <legend><h2>Your article contributions</h2></legend>
      <table>
        <tr>
          <td><h3>This Week</h3></td>
          <td><h3>All Time </h3></td>
        </tr>
        <tr>
          <td><h3><?php echo $totalContributions; ?></h3></td>
          <td><h3><?php echo $totalArticles; ?></h3></td>
        </tr>
      </table>
    </fieldset>
  </main>
</body>
</html>
