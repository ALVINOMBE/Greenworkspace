<?php 
    define('host', 'localhost');
    define('user', 'root');
    define('password', 'root');
    define('db_name', 'performance');

    $conn = mysqli_connect(host,user,password,db_name);
        if(mysqli_connect_errno()){
            echo 'Failed connection'. mysqli_connect_errno();
        }

    // echo 'connected';
?>