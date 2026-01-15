<?php include('partials/menu.php');?>

<div class="main">
    <div class="wrapper">
        <h1>Change password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-50">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>
    </div>
</div>

<?php
    //check wheather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "clicked";

        //get the data from form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);


        //check weather the user with current id and passwprd exists or not
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute query
        $res=mysqli_query($conn,$sql); 

        if($res==TRUE)
        {
            //check if data is available or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //user exists and the password can be change
                //echo "User Found";
                //check wheather the new password and confirm pass match or not 
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2="UPDATE tbl_admin SET
                    password='$new_password' 
                    WHERE id=$id
                    ";

                    //to execute the query
                    $res2=mysqli_query($conn,$sql2);

                    //check if the query is executed or not
                    if($res2==TRUE)
                    {
                        //display msg
                        //redirect to the manage admin page with success msg
                        $_SESSION['change-password'] = "<div class='success'>Password Changed Successfully..</div>";
                        //redirect the user
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //display error msg
                        //redirect to the manage admin page with error msg
                        $_SESSION['change-password'] = "<div class='error'>Failed To Change Password..</div>";
                        //redirect the user
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to the manage admin page
                    $_SESSION['password-not-match'] = "<div class='error'>Password Did Not Match..</div>";
                    //redirect the user
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //user not exists msg and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found..</div>";
                //redirect the user
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        }

        //check wheather the new password and confirm password same or not


        //change password if all above steps is true
    }
?>


<?php include('partials/footer.php'); ?>