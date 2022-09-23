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


    $taskdate = date("Y-m-d", strtotime($_POST['date']));
        
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

$taskid = $_POST['taskid'];
$sql = "SELECT * FROM tasks WHERE task_id=$taskid";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_row($result);

if(isset($_FILES['file']['name'])){
$new_pic = $_FILES['file']['name'];
}

$old_date = $data[1];
$old_desc = $data[6];
$old_pic = $data[5];


$taskid = $_POST['taskid'];
$taskdate = $insertdate = date("Y-m-d", strtotime($_POST['newdate']));
        
$description = filter_var($_POST['newdesc'], 513);


$updated_at = date("Y-m-d H:i:s");
$new_date = $_POST['newdate'];
$new_desc = filter_var($_POST['newdesc'], 513);


if(isset($_FILES['file']['name']) && $old_pic != $new_pic ){

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

    $query2 = $conn->prepare("UPDATE tasks SET task_image=? ,updated_at='$updated_at' WHERE (task_id=$taskid);");
    $query2->bind_param("s",$file_name);
    $query2->execute();
    $query2->store_result();   

}


}

if($new_date != $old_date){
    $taskdate = date("Y-m-d", strtotime($new_date));
    $query3 = $conn->prepare("UPDATE tasks SET dates='$taskdate' ,updated_at='$updated_at' WHERE (task_id=$taskid);");
    $query3->execute();
    $query3->store_result();  
}


if($new_desc != $old_desc){
    $query4 = $conn->prepare("UPDATE tasks SET task_description=? ,updated_at='$updated_at' WHERE (task_id=$taskid);");
    $query4->bind_param("s",$new_desc);
    $query4->execute();
    $query4->store_result();  
}

echo "success";


}
  
exit;
 
?>