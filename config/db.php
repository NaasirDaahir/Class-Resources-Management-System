<?php

    $server="localhost";
    $user="root";
    $pass="";
    $db="crs";

    $conn =new mysqli($server,$user,$pass,$db);

    if($conn){
       
    }
    else{
        echo $conn->connect_error;
    }

?>