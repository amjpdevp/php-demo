









<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
   
      <nav id="main-navbar" class="navbar navbar-expand-lg  text-dark " style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Comapny 
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
                            <i class="fa-solid fa-user mx-3"></i>
                            Username
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


    <div class="main d-flex justify-content-center">

        <div class="container m-5 "><div class="d-flex justify-content-between  align-items-center"> <h2 class="text-center my-2">Your Tasks</h2> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus me-3"></i>Add</button></div>
            
            <table class="table rounded border" id="employeetable">
                <thead class="thead-dark bg-dark text-white">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Image</th>
                        <th scope="col" >Task Detail</th>                        
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    
                
                    <tr id="row">
                        <th scope="row">1</th>
                        <td>21-09-2022</td>
                        <td><img src="Assets/task/task1.png" alt="task1" height="100" width="100"></td>                       
                        <td>Build Algorithm using this flow chart and report to your IT daprtment</td>
                        <td id="td"><a href="editemployee.php?id=1" id="anchor" ><button type="button" class="btn btn-primary me-2">Edit</button></a><button type="button"
                        onClick="checkId(this)"   class="btn btn-danger">Delete</button></td>
                    </tr>
                    <tr id="row">
                        <th scope="row">2</th>
                        <td>21-09-2022</td>
                        <td><img src="Assets/task/task2.png" alt="task1" height="100" width="100"></td>                       
                        <td>Build Algorithm using this flow chart and report to your IT daprtment</td>
                        <td id="td"><a href="editemployee.php?id=1" id="anchor" ><button type="button" class="btn btn-primary me-2">Edit</button></a><button type="button"
                        onClick="checkId(this)"   class="btn btn-danger">Delete</button></td>
                    </tr>
                    <tr id="row">
                        <th scope="row">3</th>
                        <td>21-09-2022</td>
                        <td><img src="Assets/task/task1.png" alt="task1" height="100" width="100"></td>                       
                        <td>Build Algorithm using this flow chart and report to your IT daprtment</td>
                        <td id="td"><a href="editemployee.php?id=1" id="anchor" ><button type="button" class="btn btn-primary me-2">Edit</button></a><button type="button"
                        onClick="checkId(this)"   class="btn btn-danger">Delete</button></td>
                    </tr>
                    <tr></tr>
                    
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
    <input type="date" class="form-control" id="dateinput" >
  </div>
  <div class="mb-3">
    <label for="#fileinput" class="form-label">Image</label>
    <input type="file" class="form-control" id="fileinput">
  </div>
  <div class="mb-3">
  <label for="#floatingTextarea2" class="form-label">Description</label>
  <textarea class="form-control" placeholder="Describe Your Tasks Here . . . . " id="floatingTextarea2" style="height: 100px"></textarea>
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>