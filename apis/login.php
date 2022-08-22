<?php

// simple login funtion for testing API
${basename(__FILE__, '.php')}=function ($uname='manoj',$passwd='manoj'){
        
        $con=Database::getConnection();
        $result = mysqli_query($con,"SELECT `username`, `password` FROM `auth` WHERE `username` = '$uname' AND `password` = '$passwd'");
        $row = mysqli_fetch_array($result);  

        if($row){  
            echo "<h1><center> Login successful </center></h1>";  
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     


    };