<?php
  if ($_SERVER['REQUEST_METHOD'] == "GET"){
    header("Location: /profile.php");
    die();
}

session_start();
// employee info

$dapartment_id = $_SESSION['department_id'];
$employee_id = $_SESSION['userid'];
$entity_id = $_SESSION["entityid"];

//for add method
if($_POST['type'] == "add"){ 

    $taskdate = $insertdate = date("Y-m-d", strtotime($_POST['date']));
        
    $description = filter_var($_POST['description'], 513);

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        exit;
    }
    else {
        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];
        $tmp1 = explode('.',$file_name);
        $tmp2 = end($tmp1);
        $file_ext=strtolower($tmp2);
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           echo("image, please choose a JPEG or PNG file.");
           exit;
        }
        
        if($file_size > 1000000){
            echo("File size must be less than 1 MB Size");
            exit;
         }
        move_uploaded_file($file_tmp,"Assets/task/".$file_name);
           

    }
    require('dbconfig.php');

    $query = $conn->prepare("INSERT INTO tasks (dates, employee_id, entity_id, department_id, task_image, task_description) VALUES ('$taskdate',$employee_id,$entity_id,$dapartment_id,'$file_name',?)");
    $query->bind_param("s",$description);
    $query->execute();
    $query->store_result();

    echo "success";
    exit;
}
//for delete method
if($_POST['type'] == "delete"){

    require('dbconfig.php');
    $taskid = $_POST['taskid'];
    $sql = "DELETE FROM tasks WHERE task_id=$taskid ";
    $result3 = mysqli_query($conn, $sql); 
    echo "success";
    exit;

 }

//for edit method
if($_POST['type'] == "edit"){ 
require('dbconfig.php'); 


    

}
  
exit;
 
?>