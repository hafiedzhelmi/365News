<?php 
if ($_SESSION['authority'] == 'reader') {
  header("Location: readers_landing_page.php");
  exit();}
   ?>