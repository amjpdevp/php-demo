<?php

session_start();
if (isset($_SESSION["userid"])) {
    if (!boolval($_SESSION["isadmin"])) {
        header("Location: /login.php");
    }


?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    </head>

    <body>
        <header>

            <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><?php echo $_SESSION["entityname"];  ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Add Employee</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manage-emp.php">manage Employee</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item text-white dropdown mx-3">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user mx-3"></i> <?php echo ($_SESSION["username"]); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" id="logout">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="alert alert-success d-none" id="add_green" role="alert">
                <strong>Success!</strong> Your Record has been Added Successfully

            </div>
        </header>
        <div class="container w-50 border my-5">
            <h2 class="my-3">Add new employee</h2>
            <form action="emp-new.php" method="post" enctype="multipart/form-data">
                <div class="form-group my-3">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="exampleInputfirstname" name="fname">
                </div>
                <div class="form-group my-3">
                    <label for="fname">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputlastname" name="lname">
                </div>
                <div class="form-group my-3">
                    <label for="exampleInputemail">E-mail</label>
                    <input type="email" class="form-control" id="exampleInputemail" aria-describedby="emailHelp" name="email">
                </div>
                <div class="form-group my-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="exampleInputphoneno" name="password">
                </div>
                <div class="d-flex my-3">
                    <p>Gender :</p>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Male
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Female
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault3" value="other">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Other
                        </label>
                    </div>
                </div> <!-- End of Gender div   -->
                <div class="form-group my-3">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob">
                </div>
                <div class="d-flex my-3">
                    <p>Permission :</p>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="checkbox" name="add" value="add" id="flexBoxDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Add
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="checkbox" name="edit" id="flexBoxDefault2" value="edit" checked>
                        <label class="form-check-label" for="flexBoxDefault2">
                            Edit
                        </label>
                    </div>
                    <div class="form-check mx-3">
                        <input class="form-check-input" type="checkbox" name="delete" id="flexBoxDefault3" value="delete" checked>
                        <label class="form-check-label" for="flexBoxDefault3">
                            Delete
                        </label>
                    </div>
                </div>

                <div class="input-group my-4 d-flex align-items-center">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Profile Picture</label>
                    </div>
                    <div class="custom-file mx-3">
                        <input type="file" class="custom-file-input" name="profilepicture" id="profilepicture">
                    </div>
                </div>
                <div class="input-group my-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Department</label>
                    </div>
                    <select class="form-control" id="inputGroupSelect01" name="department">
                        <option selected value="General">General Department</option>
                        <option value="Finance">Finance Department</option>
                        <option value="Marketing">Marketing Department</option>
                        <option value="HR">HR Department</option>
                        <option value="legal">legal Department</option>
                        <option value="Purchase">Purchase Department</option>
                        <option value="QC">QC Department</option>
                        <option value="IT">IT Department</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Salary : $</span>
                    </div>
                    <input type="number" class="form-control" name="salary" aria-label="Amount (to the nearest dollar)">

                </div>
                <button type="submit" class="my-2 btn btn-primary" value="submit" name="submit">Add</button>
                <div class="alert alert-danger" style="display: none;" id="nof"></div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
            var nof = document.getElementById('nof');
            var aleart = document.getElementById('add_green')
        </script>
        <script>



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


</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>


    <?php

    //Error Fucntion
    function error($message)
    {
        echo "<script> 
  nof.classList.add('d-block');
  var e1 = document.createElement('p');
  e1.innerText = '$message';
  nof.appendChild(e1);
  </script>";
    }

    ?>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") :
        require('dbconfig.php');
        //testing Area

       //profile Picture validation 

       
      


        $fname = filter_var($_POST['fname'], 513);
        $lname = filter_var($_POST['lname'], 513);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $valid = 0;

        //Name Validation

        if ($fname == "" || $lname == "") {
            error("Name is must Required");
            die();
        }

        //Email validation

        if ($email == "") {
            error("Email is must Required");
            die();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $valid += 1;
        } else {
            error("Invalid Email");
            die();
        }

        //Password Encrypt & Validate

        if (strlen($password) >= 6) {
            $password = md5($password);
            $valid += 1;
        } else {
            error("Password Must be at least 6 Character");
            die();
        }

        //Email check from database

        if ($_POST['email'] != "") {

            $result = mysqli_query($conn, "SELECT email FROM employees");

            $var1 = array();

            while ($table = mysqli_fetch_row($result)) {
                array_push($var1, $table[0]);
            }
            if (in_array($_POST['email'], $var1)) {
                error("E-mail is already Registred");
                die();
            } else {
                $valid += 1;
            }
        }

        //DOB valdiation

        date_default_timezone_set("Asia/Calcutta");
        $today = date("d/m/Y");
        $dob = date_create($_POST['dob']);

        $date = date_format($dob, "d/m/Y");

        if ($date < $today) {
        } else {
            error("Date Of Birth is Invalid");
            die();
        }

        //Permission convert Into JSON 

        $permission = array();

        if ($_POST['add'] != "") {
            $permission['add'] = true;
        }
        if ($_POST['edit'] != "") {
            $permission['edit'] = true;
        }
        if ($_POST['delete'] != "") {
            $permission['delete'] = true;
        }

        $permission = json_encode($permission);

 
        //end of profile validation

        if(isset($_FILES['profilepicture'])){
            $errors= array();
            $file_name = $_FILES['profilepicture']['name'];
            $file_size =$_FILES['profilepicture']['size'];
            $file_tmp =$_FILES['profilepicture']['tmp_name'];
            $file_type=$_FILES['profilepicture']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['profilepicture']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if(in_array($file_ext,$extensions)=== false){
               error("extension not allowed, please choose a JPEG or PNG file.");
               die;
            }
            
            if($file_size > 1000000){
               error("File size must be less than 1 MB Size");
               die();
            }
            
            if(empty($errors)==true){
               move_uploaded_file($file_tmp,"Assets/Profile/".$file_name);
              
            }else{
               error("Something Wrong");
               die();
            }
         }
         $profilepath = $file_name;

        //daprtment set

        $department = $_POST['department'];
        $entityid = $_SESSION['entityid'];
        $gender = $_POST['gender'];
        $amount = (int)$_POST['salary'];

       
    
        //Database uploading 
        $insertdate = date("Y-m-d", strtotime($_POST['dob']));
        
        // error($insertdate);
        $updated_at = date("Y-m-d H:i:s");


        //  $insertdate = DATE_FORMAT(,format);
        // die(gettype($_POST['dob']));    


        //Employee Data
        $query1 = $conn->prepare("INSERT INTO employees (entity_id,first_name,last_name,email,passwords,gender,DOB,permissions,picture,updated_at) VALUES ($entityid, ?, ?, ?,?,'$gender','$insertdate',?,'$profilepath','$updated_at')");
        $query1->bind_param("sssss", $fname, $lname, $email, $password, $permission);

        $query1->execute();


        if ($conn->error) {
            error("Something Went Wrong");
            die();
        }
        $query1->store_result();

        //Department Data
        $sql = "SELECT employee_id FROM employees ORDER BY employee_id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $table = mysqli_fetch_row($result);
        $result->close();
        $employee_id = $table[0];

        $result = mysqli_query($conn, "SELECT department_id FROM departments WHERE department_name='$department' AND entity_id=$entityid");


        if (mysqli_num_rows($result) > 0) {

            $table = mysqli_fetch_row($result);
            $department_id = $table[0];
        }
        // die(echo($table[0]));

        else {
            $query2 = "INSERT INTO departments (department_name, entity_id) VALUES ('$department', $entityid)";
            $result = mysqli_query($conn, $query2);

            $sql = "SELECT department_id FROM departments WHERE department_name='$department' AND entity_id=$entityid ";
            $result = mysqli_query($conn, $sql);
            $table = mysqli_fetch_row($result);
            $department_id = (int)$table[0];
        }
        // Dapeartment id Inserting into Emplotyee Table
        
        $sql = " UPDATE employees SET department_id=$department_id WHERE employee_id=$employee_id";
        $result = mysqli_query($conn, $sql);
       
        //Salaries insert 

        $query3 = "INSERT INTO salaries (amount,employee_id,department_id,updated_at) VALUES ($amount,$employee_id,$department_id,'$updated_at')";
        $result = mysqli_query($conn, $query3);

        echo "<script>aleart.classList.remove('d-none')</script>";



    endif;
    ?>

<?php

} else {
    header("Location: /login.php");
}
?>

    </html>