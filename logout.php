<?php
  if ($_SERVER['REQUEST_METHOD'] == "GET"){
    header("Location: /login.php");
    die();
}

session_start();

    session_unset();
    session_destroy();

  
exit;
 
?>