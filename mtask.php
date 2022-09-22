<?php
session_start();
if (isset($_SESSION["userid"])) {
    if (boolval($_SESSION["isadmin"])) {
        header("Location: /dashboard.php");
        die;
    }


}
else
{
    header("Location: /login.php");
    die;
}

require('dbconfig.php');

$entity_id = $_SESSION["entityid"];
$sql = "SELECT entity_name FROM entities WHERE entity_id=$entity_id";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_row($result);
$enityname = $data[0];
$username = $_SESSION["username"];
$picture = $_SESSION["profile"];
$employee_id = $_SESSION["userid"];


$sql = "SELECT permissions FROM employees WHERE employee_id=$employee_id";
$result = mysqli_query($conn,$sql);
$data1 = mysqli_fetch_row($result);
$permissions = $data1[0];

$permission_json = json_decode($permissions);



                     //   if(isset($permission_json->add)){  
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>

    <nav id="main-navbar" class="navbar navbar-expand-lg  text-dark " style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php echo $enityname;?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="profile.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Tasks</a>
                    </li>

                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item text-white dropdown mx-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="Assets/Profile/<?php echo $picture; ?>" height="25" width="25"
                                class="rounded-circle mx-3" alt="" srcset="">
                            <?php echo $username;?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a id="logout" class="dropdown-item">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="main d-flex justify-content-center">

        <div class="container m-5 ">
            <div class="d-flex justify-content-between  align-items-center">
                <h2 class="text-center my-2">Your Tasks</h2>
                <?php if(isset($permission_json->add)){  
?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="fa-solid fa-plus me-3"></i>Add</button>
                <?php } ?>
            </div>

            <table class="table rounded border" id="employeetable">
                <thead class="thead-dark bg-dark text-white">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Image</th>
                        <th scope="col">Task Detail</th>

                        <?php if(isset($permission_json->edit) || isset($permission_json->delete)){ ?>
                        <th scope="col">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php 
               
                 
                    $conn2 = $conn;
                    

                    $sql = "SELECT * FROM tasks WHERE employee_id=$employee_id ";
                    $result = mysqli_query($conn, $sql);        
                    if(mysqli_num_rows($result) > 0) {
                    $sn=1;
                    while($data = mysqli_fetch_assoc($result)){
                       ?>
                    <tr id="row<?php echo $data['task_id']; ?> ">
                        <!-- Sr. No. -->
                        <th scope="row">
                            <?php echo $sn; ?>
                        </th>
                        <!-- Date -->
                        <td class="date">
                            <?php echo date("d/m/Y",strtotime($data['dates']))?>
                        </td>
                        <!-- Task Image -->
                        <td><img src="Assets/task/<?php echo $data['task_image']; ?>" class="image" alt="task1" height="100"
                                width="100"></td>
                        <!-- Task Description  -->
                        <td class="desc">
                            <?php echo $data['task_description']; ?>
                        </td>
                        <!-- Action Button  backend check-->
                        <?php if(isset($permission_json->edit) || isset($permission_json->delete)){ ?>
                        <td id="td">

                            <?php if(isset($permission_json->edit)){ ?>

                            <button type="button" id="taskedit" onclick="getedittask(this)" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <?php } if(isset($permission_json->delete)){?>
                            <button type="button" onclick="deletetask(this)" class="btn btn-danger">Delete</button>
                            <?php } ?>
                        </td>
                        <?php } ?>

                    </tr>
                    <?php $sn++;} }
                    else {
                      echo  " <tr id='row'>
                        <th scope='row'>No Tasks Found</th></tr>";
                    }
                     ?>
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-floating">
                            <div class="mb-3">
                                <label for="#dateinput" class="form-label">Date</label>
                                <input type="date" class="form-control" id="newtaskdate">
                            </div>
                            <div class="mb-3">
                                <label for="#fileinput" class="form-label">Image</label>
                                <input type="file" class="form-control" name="addtaskimage" id="addtaskimage">
                            </div>
                            <div class="mb-3">
                                <label for="#floatingTextarea2" class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Describe Your Tasks Here . . . . "
                                    id="newtaskdescribe" style="height: 100px"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addtask" class="btn btn-primary">Add Task</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-floating">
                            <div class="mb-3">
                                <label for="#dateinput" class="form-label">Date</label>
                                <input type="date" class="form-control" id="edittaskdate">
                            </div>
                            <div class="d-flex justify-content-center align-center"><img src="Assets/task/task1.png" height="200" width="200" id="editimg" alt="" srcset=""></div>
                            <div class="mb-3">
                            
                                <label for="#fileinput" class="form-label">Image</label>                                
                                <input type="file" class="form-control" name="edittaskimage" id="edittaskimage">
                            </div>
                            <div class="mb-3">
                                <label for="#floatingTextarea2" class="form-label">Description</label>
                                <textarea class="form-control" placeholder="Describe Your Tasks Here . . . . "
                                    id="edittaskdescribe" style="height: 100px"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <button type="button" id="editsave" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>            

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="Assets/task.js"></script>
</body>

</html>

<?php 