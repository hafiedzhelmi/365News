<?php
    require('db.php');
    require('session_checker.php');
    $articleid = $_GET['articleid'];

    // Retrieve article data from the database
    $queryArticle = "SELECT article.*, category.categorytype, user.name AS author_name
                     FROM article
                     INNER JOIN category ON article.categoryid = category.categoryid
                     INNER JOIN user ON article.userid = user.userid
                     WHERE article.id = $articleid";
    $resultArticle = mysqli_query($conn, $queryArticle);
    $article = mysqli_fetch_assoc($resultArticle);

    // Retrieve the category type of the current article
    $currentCategory = $article['categorytype'];

    // Retrieve the latest articles related to the current category
    $queryLatestArticles = "SELECT article.id, article.title, article.image
                            FROM article
                            INNER JOIN category ON article.categoryid = category.categoryid
                            WHERE category.categorytype = '$currentCategory'
                            ORDER BY article.timestamp DESC
                            LIMIT 10";
    $resultLatestArticles = mysqli_query($conn, $queryLatestArticles);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Articles</title>
<style>
  /* Default styles */
  body {
    display: flex;
    justify-content: space-between;
  }

  main {
    display: flex;
    flex: 1;
    margin-left: 5%;
    margin-right: 5%;
  }

  .left-container {
    flex: 6;
  }

  .right-container {
    flex: none;
    width: 40%;
    padding-left: 0;
  }

  .left-container {
    max-width: 100%;
    margin-right: 3%;
  }

  .img-container {
    width: 100%;
    overflow: hidden;
  }

  .img-container img {
    width: 100%;
    object-fit: cover;
    height: 100%;
  }

  .content-article {
    white-space: pre-wrap;
    text-align: justify;
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
      width: auto;
    }
    .left-container{
        margin-right: 0;
    }
  }
 textarea {
  width: 100%;
  max-height: 20px;
  resize: vertical;
}

  form {
  margin: 0 0;
}

</style>


</head>
<body>
    <?php 
        require('navbar.php');
    ?>
    <main>
        <div class="left-container">
        <div>
            <h2 style="text-decoration: underline;"><?php echo $article['categorytype']; ?></h2>
            <h1><?php echo $article['title']; ?></h1>
            <h5>Author: <?php echo $article['author_name']; ?></h5>
            <h5><?php echo $article['timestamp']; ?></h5>
        </div><br>
        <div class="img-container">
            <img src="<?php echo $article['image']; ?>" alt="picture-error">
        </div><br>
        <div>
           <p class="content-article"><?php echo htmlspecialchars_decode($article['content']); ?></p><br><br>

           <div>
            <fieldset>
              <legend><h2>Comments</h2></legend>
    <?php
    
        echo '<form action="" method="POST">';
        echo '<textarea name="comment" placeholder="Write a comment..." rows="4" cols="50" required></textarea>';
        echo '<br>';
        echo '<button type="submit" name="submit_comment">Submit</button>';
        echo'<br>';
        echo '</form>';

        // Handle comment submission
        if (isset($_POST['submit_comment'])) {
            $comment = $_POST['comment'];
            $userid = $_SESSION['userid'];

            // Insert the comment into the database
            $queryInsertComment = "INSERT INTO comment (userid, articleid, comment) VALUES ('$userid', '$articleid', '$comment')";
            $resultInsertComment = mysqli_query($conn, $queryInsertComment);
        }
     
    ?>
<div class="comments" style="max-height: 200px; overflow-y: auto;">
    <?php
    // Retrieve the comments for the article from the database
    $queryComments = "SELECT comment.*, user.name AS commenter_name
                      FROM comment
                      INNER JOIN user ON comment.userid = user.userid
                      WHERE comment.articleid = $articleid
                      ORDER BY comment.timestamp DESC"; // Order comments by timestamp in descending order
    $resultComments = mysqli_query($conn, $queryComments);

    // Display the comments
    if (mysqli_num_rows($resultComments) > 0) {
        while ($row = mysqli_fetch_assoc($resultComments)) {
            echo '<div>';
            echo '<p>' . $row['commenter_name'] . ': ' . htmlspecialchars($row['comment']) . '</p>';

            // Format the timestamp as dd/mm/yy
            $commentTime = strtotime($row['timestamp']);
            $formattedTime = date('d/m/y', $commentTime);

            echo '<p>at ' . $formattedTime . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No comments yet.</p>';
    }
    ?>
</div>
            </fieldset>
    



</div>

</div>

        </div>
    </div>

     </div>


    <div class="right-container">
      <center><h2>Latest Articles Related to <?php echo $currentCategory; ?></h2></center>
      <ul style="list-style-type: none;">
        <?php
        // Check if the query execution was successful
        if ($resultLatestArticles) {
          // Display the list of latest articles
          while ($row = mysqli_fetch_assoc($resultLatestArticles)) {
            echo '<li>';
            echo '<a href="read_article.php?articleid=' . $row['id'] . '">';
            echo '<img src="' . $row['image'] . '" alt="picture-error" style="width: 100%;">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '</a>';
            echo '</li><br>';
          }
        } else {
          // Query execution failed, display the error message
          echo "Error: " . mysqli_error($conn);
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
