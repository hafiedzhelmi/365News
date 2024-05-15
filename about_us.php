<?php require('db.php');
require('session_checker.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>About Us</title>
  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
    /* Default styles */
    body {
      display: flex;
      justify-content: space-between;
      text-align: justify;
    }

    main {
      display: flex;
      flex: 1;
    }

   

    /* Media query for portrait mode */
    @media (orientation: portrait) {
      body {
        display: block;
      }

      main {
        display: block;
      }


    }

    /* Media query for landscape mode */
    @media (orientation: landscape) {
      .author-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
      }
      .author {
        width: 48%;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
    }
  </style>
</head>
<body>

  <?php include('navbar.php') ?>
  <main>
    <fieldset>
      <legend><h1>About Us</h1></legend>
      ThreeSixFiveNews is a leading news organization dedicated to providing reliable and up-to-date news coverage across a wide range of topics. We strive to deliver accurate and unbiased information to our readers, empowering them to stay informed and make informed decisions.
      <h2>Meet Our Authors</h2>
      <div class="author-container">
        <?php
        // Retrieve authors' information from the database
        $queryAuthors = "SELECT * FROM user WHERE authority = 'staff' OR authority = 'admin'";
        $resultAuthors = mysqli_query($conn, $queryAuthors);

        if (mysqli_num_rows($resultAuthors) > 0) {
          while ($rowAuthor = mysqli_fetch_assoc($resultAuthors)) {
            echo '<div class="author">';
            echo '<h3>' . $rowAuthor['name'] . '</h3>';
            echo '<p>' . $rowAuthor['background'] . '</p>';
            echo '</div>';
          }
        } else {
          echo '<p>No authors found.</p>';
        }
        ?>
      </div>
    </fieldset>
  </main>
  
  <script src="script.js"></script>
  <div>
  <?php include('footer_page.html'); ?>
</div>
</body>
</html>
