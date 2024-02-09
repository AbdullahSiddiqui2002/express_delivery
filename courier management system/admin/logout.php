<head>
  <title>Logout - Express Delivery</title>
</head>
<?php
session_start();
session_unset();
session_destroy();

header("location: index.php");

?>