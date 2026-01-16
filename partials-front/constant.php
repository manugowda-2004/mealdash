<?php
    //session
    session_start();


    //to create constants to store non repeating  values
    define('SITEURL','http://localhost/mealdash/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD' ,'');
    define('DB_NAME','mealdash');
    //execute query and save data in database
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));//to database connection
    $db_select = mysqli_select_db($conn, 'mealdash') or die(mysqli_error($conn));//to select database
?>