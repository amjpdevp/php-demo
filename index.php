<?php
    require('dbconfig.php');
    $result = mysqli_query($conn,"show tables");
    $var1= array();
    
    // run the query and assign the result to $result
    while($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result
        array_push($var1,$table[0]);  // print the table that was returned on that row.
    }
    
    if(array_search("users", $var1)){
        header("Location: /home.php");
    }
    else{
        header("Location: /dbsetup.php");
    }

    
?>