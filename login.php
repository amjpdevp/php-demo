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
if(isset($_POST['submit'])):
    if($_POST['email'] == "" || $_POST['password'] == ""){
        error("email or password can\'t be blank");
        die();
    }
require('dbconfig.php');

    $res1 = $conn->prepare("SELECT email,passwords FROM users WHERE email=? AND passwords=?");
    $res1->bind_param("ss",$email,$password);
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $res1->execute();


   
    

    if($res1->fetch()){
        error("Admin login");
    }
    else {
        unset($res1);
        $res2 = $conn->prepare("SELECT email,passwords FROM employees WHERE email=? AND passwords=?");
        $res2->bind_param("ss",$email,$password);
        $res2->execute();

        if($res2->fetch()){
            error("Employee login");
        }else{
            error("Login fail");
        }
    

    }


endif;
?>