<?php include('../configuration/constant.php'); ?>

<html>
    <head>
        <title>Login-Food Order Website</title>
        <link rel="stylesheet" href="../css/login.css" >
    </head>
    <body>

        <!--login form-->
        <div>
            <form action="" method="POST" class="container">
                <h1 class="login-title">Login</h1>
                <br>

                    <?php 
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }

                        if(isset($_SESSION['no-login-msg']))
                        {
                            echo $_SESSION['no-login-msg'];
                            unset($_SESSION['no-login-msg']); 
                        }
                    ?>
                
                    <section class="input-box">
                        <input type="text" name="username" placeholder="Username">
                        <i class="bx bxs-user"></i>
                    </section>
                
                        <section class="input-box">
                        <input type="password" name="password" placeholder="Password" class="bx bxs-lock-alt">
                        <i ></i>
                    </section>
                
                    <input class="login-button" type="submit" name="submit" value="Login">
                    </input>
                </form>
                    </div>
            <!--login form-->
    </body>
</html>
<?php
    //check if submit is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //to get data from login form
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        //$password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn,md5( $_POST['password']));
        //sql to check wheather the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //to count rows to check wheather user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login success
            $_SESSION['login']="<div class='success'>Login Is Successfull..</div>";
            $_SESSION['user'] = $username;//to check if the user is logged in or not and logout will unset it

            //redirect to hiome page
            header("location:".SITEURL.'admin/');

        }
        else
        {
            //user not available and login failed
            $_SESSION['login']="<div class='error'>Username or Password did not match..</div>";
            //redirect to hiome page
            header("location:".SITEURL.'admin/login.php');
        }

    }
    
?>