<?php
require('db.php');

// Start session
session_start();

// Check if the user's last activity time is set
if (isset($_SESSION['last_activity'])) {
  // Calculate the time difference between the current time and the last activity time
  $inactive_time = time() - $_SESSION['last_activity'];

  // Check if the inactive time exceeds 20 minutes (1200 seconds)
  if ($inactive_time > 1200) {
    // User has been inactive for too long, destroy the session and redirect to the logout page
    header("Location: logout.php");
    exit();
  }
}

// Update the last activity time to the current time
$_SESSION['last_activity'] = time();

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);

// Pages to ignore for session check
$ignored_pages = array('readers_landing_page.php', 'display_article.php');

// Check if the user is logged in and not in the ignored pages
if (!isset($_SESSION['userid']) && !in_array($current_page, $ignored_pages)) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}

// Check if the 'authority' key is set in the session
$authority = isset($_SESSION['authority']) ? $_SESSION['authority'] : null;
?>
