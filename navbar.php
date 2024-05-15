<?php
require('db.php');
$maxDisplayedCategories = 2;
$authority = isset($_SESSION['authority']) ? $_SESSION['authority'] : null;
?>


<nav>
  <ul>
    <li><h2><a href="readers_landing_page.php">365News</a></h2></li>
    <?php if ($authority == 'staff' || $authority == 'admin') : ?>
      <li><a href="dashboard.php">Home</a></li>
      <li class="dropdown">
        <a href="#" class="dropbtn">Articles</a>
        <div class="dropdown-content">
          <a href="add_article.php">Add Article</a>
          <a href="manage_article.php">Manage Articles</a>
        </div>
      </li>
    <?php endif; ?>

    <?php if ($authority === null || $authority == 'reader') : ?>
      <?php
      // Query to retrieve categories from the database
      $queryCategories = "SELECT * FROM category";
      $resultCategories = mysqli_query($conn, $queryCategories);

      // Check if there are categories in the database
      if (mysqli_num_rows($resultCategories) > 0) {
        $count = 0;
        $remainingCategories = array();

        // Loop through the categories
        while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
          // Build the URL with the selected category value
          $categoryURL = "display_article.php?category=" . $rowCategory['categoryid'];

          if ($count < $maxDisplayedCategories) {
            // Display the category in the navbar with the corresponding URL
            echo '<li><a href="' . $categoryURL . '">' . $rowCategory['categorytype'] . '</a></li>';
          } else {
            // Store the remaining categories in the array
            $remainingCategories[] = '<a href="' . $categoryURL . '">' . $rowCategory['categorytype'] . '</a>';
          }

          $count++;
        }

        // Check if there are more categories to display
        if (count($remainingCategories) > 0) {
          echo '<li class="dropdown">';
          echo '<a href="#" class="dropbtn">More</a>';
          echo '<div class="dropdown-content">';
          foreach ($remainingCategories as $category) {
            echo $category;
          }
          echo '</div>';
          echo '</li>';
        }
      }
      ?>
    <?php endif; ?>

    <?php if ($authority == 'reader'): ?>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="about_us.php">About Us</a></li>
      <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>

    <?php if ($authority === null): ?>
      <li><a href="about_us.php">About Us</a></li>
      <li><a href="login.php">Login</a></li>
    <?php endif; ?>

    <?php if ($authority == 'staff' || $authority == 'admin') : ?>
      <li class="dropdown">
        <a href="#" class="dropbtn">Categories</a>
        <div class="dropdown-content">
          <?php
          // Query to retrieve categories from the database
          $queryCategories = "SELECT * FROM category"; // Update the table name to 'category'
          $resultCategories = mysqli_query($conn, $queryCategories);

          // Check if there are categories in the database
          if (mysqli_num_rows($resultCategories) > 0) {
            $count = 0;

            // Loop through the categories
            while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
              // Build the URL with the selected category value
              $categoryURL = "category.php?category=" . $rowCategory['categoryid'];

              // Check if the current category ID matches the selected category ID
              $activeClass = '';
              if (isset($_GET['category']) && $_GET['category'] == $rowCategory['categoryid']) {
                $activeClass = 'active';
              }

              // Display the category in the navbar with the corresponding URL and active class
              echo '<a href="' . $categoryURL . '" class="' . $activeClass . '">' . $rowCategory['categorytype'] . '</a>';

              $count++;

              // Break the loop if the maximum number of displayed categories is reached
              if ($count == $maxDisplayedCategories) {
                break;
              }
            }

            // Check if there are more categories to display
            if (mysqli_num_rows($resultCategories) > $maxDisplayedCategories) {
              // Display the "More" link to redirect to a page with all categories
              echo '<a href="category.php" class="' . ($activeClass == 'active' ? 'active' : '') . '">More</a>';
            }
            if ($authority == 'admin') {
              echo '<a href="manage_categories.php" class="' . ($activeClass == 'active' ? 'active' : '') . '">Manage Categories</a>';
            }
          }
          ?>
        </div>
      </li>
    <?php endif; ?>

    <?php if ($authority == 'admin') : ?>
      <li class="dropdown">
        <a href="#" class="dropbtn">User</a>
        <div class="dropdown-content">
          <a href="create_user.php">Create Users</a>
          <a href="manage_users.php">Manage Users</a>
        </div>
      </li>
    <?php endif; ?>

    <?php if ($authority == 'staff' || $authority == 'admin') : ?>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>
  </ul>
</nav>

