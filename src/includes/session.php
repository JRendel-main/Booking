<?php
// check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    echo "
    <script>
    alert('You are not logged in. Please log in to continue.');
    </script>
    ";
  header("Location: ../../index.php");
  exit();
}