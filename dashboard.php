<?php
session_start();
if (isset($_SESSION["userid"])) {
    if (!boolval($_SESSION["isadmin"])) {
        header("Location: /login.php");
    }

require('dbconfig.php');
?>
<?php       
            $entityid = $_SESSION["entityid"]; 
            $entityname = $_SESSION["entityname"];
            $sql = "SELECT COUNT(entity_id)
            FROM tasks
            WHERE entity_id=$entityid GROUP BY entity_id ";

            $result2 = mysqli_query($conn, $sql);
            $table = mysqli_fetch_row($result2);
            if(isset($table[0])){
            $no_Task = $table[0];
            }else{
            $no_Task = 0;
            }

            
            $sql = "SELECT COUNT(employee_id)
            FROM employees
            WHERE entity_id=$entityid GROUP BY entity_id ";

            $result2 = mysqli_query($conn, $sql);
            $table = mysqli_fetch_row($result2);
            if(isset($table[0])){
            $no_emp = $table[0];
            }else{
            $no_emp = 0;
            }


            $sql = "SELECT COUNT(department_id)
            FROM departments
            WHERE entity_id=$entityid GROUP BY entity_id ";

            $result2 = mysqli_query($conn, $sql);
            $table = mysqli_fetch_row($result2);
            if(isset($table[0])){
            $no_dep = $table[0];
            }else{
            $no_dep = 0;
            }

            $sql = "SELECT SUM(amount)
            FROM salaries
            WHERE entity_id=$entityid GROUP BY entity_id ";

            $result2 = mysqli_query($conn, $sql);
            $table = mysqli_fetch_row($result2);
            if(isset($table[0])){
            $sum_sal = $table[0];
            }else{
            $sum_sal = 0;
            }

 ?>

<!DOCTYPE html>
<html lang="en">

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
    <!-- <link rel="stylesheet" href="Assets/dashboard.css"> -->
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emp-new.php">Add Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-emp.php">manage Employee</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item text-white dropdown mx-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-user mx-3"></i>
                                <?php echo ($_SESSION["username"]); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a id="logout" class="dropdown-item" >Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


    </header>
    <div class="row m-5">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Employees </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $no_emp;  ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-user fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Task Assigned</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $no_Task;  ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Departments
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $no_dep;  ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total salaries</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sum_sal;  ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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



</body>

</html>


<?php
/*
    print_r($_SESSION["email"]);
    echo "<br>";
    print_r($_SESSION["userid"]);
    echo "<br>";
    print_r($_SESSION["username"]);
    echo "<br>";
    print_r($_SESSION["isadmin"]);
    echo "<br>";
    print_r($_SESSION["entityid"]);
    echo "<br>";
    print_r($_SESSION["entityname"]);
    echo "<br>";
*/

    ?>


<?php

} else {
    header("Location: /login.php");
}
?>