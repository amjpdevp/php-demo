<?php 
    require('dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Db Setup</title>
    <link rel="stylesheet" href="Assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<div class="main bg-primary m-5 text-white p-5 rounded" >
        <h2>Welcome To Database Migration Dashboard</h2>
        <div class="d-flex flex-column">
        <button type="button" class="my-2 btn btn-light" onclick='table();'>Create All Tables<i class="fa-solid fa-arrow-right"></i></button>
           
    </div>
    </div>
    <div class="main bg-success m-5 text-white rounded" id="s-div" ></div>
    <div class="main bg-danger m-5 text-white rounded" id="d-div" ></div>
    <script>
     function table(){


        <?php

        $sql = "CREATE TABLE users (user_id int AUTO_INCREMENT,name VARCHAR(255),passwords VARCHAR(255),is_Admin int,Created_at TIMESTAMP NOT NULL,Updated_at TIMESTAMP NOT NULL,PRIMARY KEY (`user_id`));";

         $result = mysqli_query($conn,$sql);

         if($conn->error){
            echo "document.getElementById('d-div').innerText = \"Error To Create Table : $conn->error\"";
         }
       


        $sql = "CREATE TABLE entities (id int NOT NULL,entity_name VARCHAR(255),email VARCHAR(255),updated_at DATE,created_at TIMESTAMP NOT NULL,PRIMARY KEY (id),user_id int,FOREIGN KEY(user_id) REFERENCES users(user_id))";

         $result = mysqli_query($conn,$sql);

         if($conn->error){
            echo "document.getElementById('d-div').innerText = \"Error To Create Table : $conn->error\"";
         }
         echo "document.getElementById('s-div').innerText = \"All Table Created sucessfully\""
        
        
        ?>
        
        }
    </script>
</body>
</html>