<?php
  if ($_SERVER['REQUEST_METHOD'] == "GET"){
    header("Location: /profile.php");
    die();
}

session_start();

require('dbconfig.php');

$value = $_POST['value'];
$empid = (int)$_POST['employee'];

if($value == "active"){

  $sql = "UPDATE employees SET active=1  WHERE employee_id=$empid ";
  $reult = mysqli_query($conn,$sql);
  echo "Activated";
}
else{

  $sql = "UPDATE employees SET active=0  WHERE employee_id=$empid ";
  $reult = mysqli_query($conn,$sql);
  echo "Deactivated";
}

exit;
?>