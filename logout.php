<?php 
    //include constants.php
    include('partials-front/constant.php');
    //to destroy the session
    session_destroy();//unsets $_SESSION['user']
    //redirect to login page
    header("location:".SITEURL.'login.php');
?>