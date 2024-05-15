<?php
require('session_checker.php');
require('db.php');

// Retrieve the search keyword from the GET request
$searchKeyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Fetch articles based on the keyword (title or content) if the search keyword is provided
$articleTitles = array(); // Initialize an empty array
if (!empty($searchKeyword)) {
  $querySearch = "SELECT id, title FROM article WHERE title LIKE '%$searchKeyword%' OR content LIKE '%$searchKeyword%' LIMIT 3";
  $resultSearch = mysqli_query($conn, $querySearch);

  while ($row = mysqli_fetch_assoc($resultSearch)) {
    $articleTitles[] = $row['title'];
    $id=$row['id'];
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>User Page</title>
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
    button{
      display: inline-block;
    }
  </style>
</head>
<body>
  <?php include('navbar.php') ?>
  <main>
    <div class="left-container">
      <div class="search_section">
        <form action="" method="get">
          <input type="text" name="keyword" placeholder="Search..." value="<?php echo $searchKeyword; ?>">
          <button type="submit" name="search">Search</button>
        </form>
        <?php if (!empty($searchKeyword)) : ?>
          <ul>
            <?php foreach ($articleTitles as $title) : ?>
              <li><?php echo "<a href='read_article.php?articleid=" . $id . "'>" . $title . "</a>" ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <table>
        <?php
        // Execute the query to fetch the 4 latest articles with author's name
        $queryFirstSection = "SELECT article.*, user.name AS author_name FROM article INNER JOIN user ON article.userid = user.userid ORDER BY article.timestamp DESC LIMIT 5";
        $resultFirstSection = mysqli_query($conn, $queryFirstSection);

        // Display the first section (4 latest articles)
        $counter = 1;
        while ($row = mysqli_fetch_assoc($resultFirstSection)) {
          if ($counter === 1) {
            echo "<tr>";
            echo "<td class='article-cell' rowspan='3'><a href='read_article.php?articleid=" . $row['id'] . "'><img src='" . $row['image'] . "' alt='Article Image' style='width: 100%;'></a></td>";
            echo "<td colspan='3'> <h1><a href='read_article.php?articleid=" . $row['id'] . "'>" . $row['title'] . "</a></h1></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $row['author_name'] . "</td>";
            echo "<td colspan='2'>" . $row['timestamp'] . "</td>";
            echo "</tr>";
            // Extract the first sentence from the content
            $firstSentence = strtok($row['content'], ".");
            echo "<tr><td colspan='3'>" . $firstSentence . ".</td></tr>";
          } else if ($counter == 2) {
            echo "<td class='article-cell'>";
            echo "<a href='read_article.php?articleid=" . $row['id'] . "'><img src='" . $row['image'] . "' alt='Article Image' style='width: 100%;'></a><br>";
            echo "<b><a href='read_article.php?articleid=" . $row['id'] . "'>" . $row['title'] . "</a></b>";
            echo "</td>";
          } else if ($counter == 5) {
            echo "<td class='article-cell'>";
            echo "<a href='read_article.php?articleid=" . $row['id'] . "'><img src='" . $row['image'] . "' alt='Article Image' style='width: 100%;'></a><br>";
            echo "<b><a href='read_article.php?articleid=" . $row['id'] . "'>" . $row['title'] . "</a></b>";
            echo "</td>";
            echo "</tr>";
          } else {
            echo "<td class='article-cell'>";
            echo "<a href='read_article.php?articleid=" . $row['id'] . "'><img src='" . $row['image'] . "' alt='Article Image' style='width: 100%;'></a><br>";
            echo '<b><a href="read_article.php?articleid=' . $row['id'] . '">' . $row['title'] . '</a></b>';
            echo "</td>";
          }

          $counter++;
        }
        ?>
      </table>
    </div>
    <div class="right-container">
      <center><h2>Latest Article</h2></center>
      <ul>
        <?php
        // Fetch the top 10 latest articles with their IDs and titles for the second section
        $querySecondSection = "SELECT id, title FROM article ORDER BY timestamp DESC LIMIT 10";
            $resultSecondSection = mysqli_query($conn, $querySecondSection);

    // Check if the query execution was successful
    if ($resultSecondSection) {
      // Display the list of top 10 latest article titles
      while ($row = mysqli_fetch_assoc($resultSecondSection)) {
        echo '<li><a href="read_article.php?articleid=' . $row['id'] . '">' . $row['title'] . '</a></li>';
      }
    } else {
      // Query execution failed, display the error message
      echo "Error: " . mysqli_error($conn);
    }
    ?>
  </ul>
</div>
</main>
<br>
<br>
<div>
  <?php include('footer_page.html'); ?>
</div>

</body>
</html>