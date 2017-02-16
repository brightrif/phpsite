<?php

    $server     = "localhost";
    $dbusername   = "root";
    $dbpassword   = "indra2012";
    $db         = "techbro";
    
    // create connection 
    
    $conn = mysqli_connect($server,$dbusername,$dbpassword,$db);
    
    //check the connection 
    if (!$conn){
        die("connection failed:" .mysqli_connect_error());
    }
    //echo 'connected successfully';
    
?>

