<?php
  if ($_SERVER['REQUEST_METHOD'] == "GET"){
    header("Location: /login.php");
    die();
}
session_start();
    
require('dbconfig.php');

 $emp_id = (int)$_POST['id'];


 

$sql = "DELETE FROM salaries WHERE employee_id=$emp_id ";
$result1 = mysqli_query($conn, $sql);   

$sql = "DELETE FROM tasks WHERE employee_id=$emp_id ";
$result2 = mysqli_query($conn, $sql); 

$sql = "DELETE FROM employees WHERE employee_id=$emp_id ";
$result3 = mysqli_query($conn, $sql); 
// DELETE FROM `demo`.`salaries` WHERE (`salary_id` = '9');

// salaries , task , employees 

//output
echo "Employee Deleted from database";


exit;
 
?>