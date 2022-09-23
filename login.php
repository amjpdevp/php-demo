<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Page</title>
</head>

<body class="d-flex justify-content-center">
    <div class="m-5 w-50 border rounded">
        <h2 class="my-3 m-5">Login</h2>
        <form method="post" action="login.php" class="m-5">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form2Example1" name="email" class="form-control" />
                <label class="form-label" for="form2Example1">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" name="password" class="form-control" />
                <label class="form-label" for="form2Example2">Password</label>
            </div>


            <!-- Submit button -->
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            <div class="mb-3 text-danger" id="nof"></div>
            <!-- Register buttons -->

        </form>
    </div>
</body>

</html>
<?php
function error($message)
{
    echo "<script> 
  var e1 = document.createElement('p');
  e1.innerText = '$message';
  nof.appendChild(e1);
  </script>";
}
?>

<?php
if (isset($_POST['submit'])) :
    if ($_POST['email'] == "" || $_POST['password'] == "") {
        error("email or password can\'t be blank");
        die();
    }
    require('dbconfig.php');

    $res1 = $conn->prepare("SELECT email,passwords FROM users WHERE email=? AND passwords=?");
    $res1->bind_param("ss", $email, $password);
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $res1->execute();





    if ($res1->fetch()) {

        //Fetch related data from user table

        $res1->close();
        $sql = "SELECT * FROM users WHERE email='$email' ";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_row($result);

        //Session Starting

        session_start();
        $_SESSION["email"] = $data[6];
        $_SESSION['userid'] = $data[0];
        $_SESSION['username'] = $data[1];
        $_SESSION['isadmin'] = $data[3];

         //Fetch related data from entities table

        $result->close();
        $sql = "SELECT * FROM entities WHERE user_id='$data[0]' ";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_row($result);
        $_SESSION["entityid"] = $data[0];
        $_SESSION['entityname'] = $data[1];

        header("Location: /dashboard.php");

    } else {
        unset($res1);
        $res2 = $conn->prepare("SELECT email,passwords FROM employees WHERE email=? AND passwords=?");
        $res2->bind_param("ss", $email, $password);
        $res2->execute();
        

        if ($res2->fetch()) {
            $res2->close();
        $sql = "SELECT * FROM employees WHERE email='$email' ";
        $result = mysqli_query($conn,$sql);
        $data = mysqli_fetch_row($result);
        
        if(!$data[13]){
            error("Your Account is Deactivated");
            die();
        }

        session_start();
       // Array ( [0] => 25 [1] => 7 [2] => Jeff [3] => Bezos [4] => jeff@amazon.com [5] => 7440da479f6533e79ab58fc153307c3b [6] => male [7] => 2004-01-10 [8] => {"add":true,"edit":true,"delete":true} [9] => jeffprofile.png [10] => 2022-09-20 16:05:33 [11] => 2022-09-22 09:33:46 [12] => 8 )
       
       $_SESSION['userid'] = $data[0];
       $_SESSION['isadmin'] = false;      
       $_SESSION['profile'] = $data[9];
       $_SESSION["entityid"] = $data[1];
       $_SESSION["username"] = $data[2];
       $_SESSION["department_id"] = $data[12];     

       header("Location: /profile.php");
    
        die;
        
       

        } else {
            error("Login fail");
        }
    }


endif;
?>