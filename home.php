<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo 1</title>
    <link rel="stylesheet" href="Assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="main bg-primary m-5 text-white p-5 rounded" >
        <h2>Welcome To Task Management system</h2>
        <div class="d-flex flex-column">
        <button type="button" class="mt-5 btn btn-light" onclick='reg();'>Registre Yourself <i class="fa-solid fa-arrow-right"></i></button>
        <button type="button" class="my-2 btn btn-light" onclick='login();'>User login <i class="fa-solid fa-arrow-right"></i></button>
        <button type="button" class="btn btn-light" onclick='login();'>Employee login <i class="fa-solid fa-arrow-right"></i></button>        
        </div>
    </div>
    <script>
        function reg(){
            window.location.href = "/regform.php";
        }
        function login(){
            window.location.href = "/login.php";
        }
    </script>
</body>
</html>
