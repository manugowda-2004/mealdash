<?php
    //authorization 
    //check wheather the user is logged in or not
    if(!isset($_SESSION['email']))//if user session is not set
    {
        //user is not logged in
        //redirect to login
        $_SESSION['no-login-msg'] = "<div class='error'>Please login first..</div>";
        //redirect to login page
        header("location:".SITEURL.'login.php');

    }
?>