<!-- HTML / CSS /JS Frontend -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Assets/style-regfrom.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h2>Registration Form</h2>
    <form action="regform.php" method="post">
      <div class="form-group my-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="exampleInputfirstname" name="name">
      </div>
      <div class="form-group my-3">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="exampleInputlastname" aria-describedby="emailHelp" name="email">
      </div>
      <div class="form-group my-3">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="exampleInputphoneno" name="password">
      </div>
      <div class="form-group my-3">
        <label for="cpassword">Confirm-Password</label>
        <input type="password" class="form-control" id="exampleInputEmail1" name="cpassword">
      </div>
      <div class="form-group my-3">
        <label for="entity">Entity</label>
        <input type="tex" class="form-control" id="exampleInputPassword" name="entity">
      </div>
      <div class="form-group my-3">
        <label for="eemail">Entity e-mail</label>
        <input type="email" class="form-control" id="exampleInputlastname" aria-describedby="emailHelp" name="eemail">
      </div>
      <!-- <div class="form-check">
        <input class="form-check-input" type="radio" name="utype" value="admin" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
          Admin
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="utype" id="flexRadioDefault2" value="user" checked>
        <label class="form-check-label" for="flexRadioDefault2">
          User
        </label>
      </div> -->
      <button type="submit" class="my-2 btn btn-primary" value="submit" name="submit">Registration</button>
      <div class="mb-3 bg-danger text-white" id="nof"></div>
    </form>
  </div>
  <script>
    var nof = document.getElementById('nof');
  </script>
  <?php
  function error($message)
  {
    echo "<script> 
  nof.classList.add('p-2');
  var e1 = document.createElement('p');
  e1.innerText = '$message';
  nof.appendChild(e1);
  </script>";
  }
  ?>
</body>

</html>

<!-- PHP Bakcend -->
<?php
if (isset($_POST['submit'])) :
  require('dbconfig.php');
  $valid = 0;
  $name = filter_var($_POST['name'], 513);
  $entity = filter_var($_POST['entity'], 513);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $eemail = filter_var($_POST['eemail'], FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];
  // Validate e-mail
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $valid += 1;
  } else {
    error("Invalid Email");
    die();
  }

  if (!filter_var($eemail, FILTER_VALIDATE_EMAIL) === false) {
    $valid += 1;
  } else {
    error("Invalid Entity Email");
    die();
  }

  if ($password == $_POST['cpassword']) {

    echo "<br>";
    if (strlen($password) >= 6) {
      $password = md5($password);
      $valid += 1;
    } else {
      error("Password Must be at least 6 Character");
      die();
    }
  } else {
    error("Password Doest not match");
    die();
  }

  if ($_POST['entity'] != "") {

    $result = mysqli_query($conn, "SELECT entity_name FROM entities");

    $var1 = array();

    while ($table = mysqli_fetch_row($result)) {
      array_push($var1, $table[0]);
    }
    if (in_array($_POST['entity'], $var1)) {
      error("Entity is already Registred");
      die();
    } else {
      $valid += 1;
    }
  } else {
    error("Entity Cannot be Blank");
    die();
  }

  if ($_POST['email'] != "") {

    $result = mysqli_query($conn, "SELECT email FROM users");

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


  if ($_POST['email'] != "") {

    $result = mysqli_query($conn, "SELECT email FROM entities");

    $var1 = array();

    while ($table = mysqli_fetch_row($result)) {
      array_push($var1, $table[0]);
    }
    if (in_array($_POST['eemail'], $var1)) {
      error("Entity e-mail is already Registred");
      die();
    } else {
      $valid += 1;
    }
  } //end_if
  
  // Wihtout Error Valid Return here '6' ;  

  if($valid == 6){
    $isadmin = 1;
    $query1 = $conn->prepare("INSERT INTO users (name, passwords,is_Admin,email) VALUES (?, ?, ?, ?)");
    $query1->bind_param("ssis", $name, $password,$isadmin,$email);    
    $query1->execute();
    if($conn->error){
      error("Something Went Wrong");
      die();
    }
    $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
    $result = mysqli_query($conn,$sql);
    $table = mysqli_fetch_row($result);
    $query2 = $conn->prepare("INSERT INTO entities (entity_name, email,user_id) VALUES (?, ?, ?)");
    $query2->bind_param("ssi",$entity,$eemail,$table[0]);
    $query2->execute();
    
    if(mysqli_error($conn)){
      error("Something Went Wrong");
      die();
    }

    header("Location: /login.php");

  } else{
    error("Something Went Wrong");
    die();
  }

  

endif;






?>