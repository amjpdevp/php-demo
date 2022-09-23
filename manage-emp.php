<?php

session_start();    
if (isset($_SESSION["userid"])) {
    if (!boolval($_SESSION["isadmin"])) {
        header("Location: /login.php");
    }
   
}else {
    header("Location: /login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <style>
        .paginate_button{
            border-radius: 8px!important;
            background-color: yellowgreen!important;
            color: white!important;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Assets/css/manageemp.css">
</head>

<body>

    
    <header>

        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <?php echo $_SESSION["entityname"];  ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="emp-new.php">Add Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active">manage Employee</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item text-white dropdown mx-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="true">
                                <i class="fa-solid fa-user mx-3"></i>
                                <?php echo ($_SESSION["username"]); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a id="logout" class="dropdown-item" href="#">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <?php ?>
    <div class="main d-flex justify-content-center">

        <div class="container ">
            <h2 class="text-center my-2">Employees Of
                <?php echo $_SESSION["entityname"];  ?>
            </h2>
            <table class="table rounded border" id="employeetable">
                <thead class="thead-dark bg-dark text-white">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Salary</th>
                        <th scope="col">No. Of task</th>
                        <th scope="col">Action</th>
                        <th scope="col">stat</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //lopp for Orginal Data
                    require('dbconfig.php');
                    $conn2 = $conn;
                    $entityid = (int)$_SESSION['entityid'];

                    $sql = "SELECT * FROM employees WHERE entity_id=$entityid ";
                    $result = mysqli_query($conn, $sql);        
                    if(mysqli_num_rows($result) > 0) {
                    $sn=1;
                    while($data = mysqli_fetch_assoc($result)){
                       ?>
                
                    <tr id="row<?php echo $data['employee_id'];?>">
                        <th scope="row"><?php echo $sn;?></th>

                        <td><?php echo $data['first_name'];?></td>
                        <td><?php echo $data['last_name'];?></td>
                        <?php 
                        //Department From Department table <==>
                            
                            $dep_id = (int)$data['department_id'];
                            $sql = "SELECT department_name FROM departments WHERE department_id=$dep_id ";
                            $result2 = mysqli_query($conn2, $sql);
                            $table = mysqli_fetch_row($result2);
                            $department_name = $table[0];
                        
                        ?>
                        <td><?php echo $department_name;?></td>
                        <td><?php echo $data['email'];?></td>
                        <td><?php echo $data['gender'];?></td>
                        <td><?php echo date("d/m/Y",strtotime($data['DOB']))?></td>
                        <?php 
                        //Salary  From salaries table <==>
                            
                            $emp_id = (int)$data['employee_id'];
                            $sql = "SELECT amount FROM salaries WHERE employee_id=$emp_id";
                            $result2 = mysqli_query($conn2, $sql);
                            $table = mysqli_fetch_row($result2);
                            $sal_amount = $table[0];
                        
                        ?>
                        <td><?php echo "$".$sal_amount;?></td>
                        <?php 
                        $sql = "SELECT COUNT(task_id)
                        FROM tasks
                        WHERE employee_id=$emp_id GROUP BY employee_id ";
                        $result2 = mysqli_query($conn2, $sql);
                        $table = mysqli_fetch_row($result2);
                        if(isset($table[0])){
                            $no_Task = $table[0];
                        }else{
                       $no_Task = 0;
                        }

                        ?>
                        <td><?php echo $no_Task;?></td>
                        <td id="td<?php echo $data['employee_id'];?>"><a href="editemployee.php?id=<?php echo $data['employee_id'];?>" id="anchor<?php echo $data['employee_id'];?>" ><button type="button" class="btn btn-primary me-2">Edit</button></a><button type="button"
                        onClick="checkId(this)"   class="btn btn-danger">Delete</button></td>
                        <td>
                            <!-- Default checked -->
                            <label class="switch">
                            <input type="checkbox" onchange="toggle(this);" <?php if($data['active']){ echo "checked"; } ?>>
                            <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
    <?php
                   $sn++;
                     }
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#employeetable ').DataTable();
        });
    </script>
    <script>

$(document).ready(function () {

    $("#logout").click(function () {

        $.ajax({
            type: "POST",
            url: "logout.php",
            data: {
              logout : "true"
            },
            cache: false,
            success: function (data) {
                console.log("Log out Done")
              window.location.href = "/login.php";
            },
            error: function () {
                console.log("Error Found")
            }
        });
    });
});

</script>
    <script src="Assets/script.js"></script>
    <script src="Assets/task.js"></script>

</body>

</html>