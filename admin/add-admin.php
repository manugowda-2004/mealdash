<?php include('partials/menu.php');?>


<div class="main">
    <div class="wrapper">
        <h1>Add Admin</h1>
        
        <br><br>

        <?php
            if(isset($_SESSION['add']))//to check weather the  session is set opr not
            {
                echo $_SESSION['add'];//display session msg if set
                unset($_SESSION['add']);//remove session msg
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                    <input type="password" name="password" placeholder="Password">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>

    </div>
</div>



<?php include('partials/footer.php');?>

<?php 
    //value from form and save it in Database

    //check wheather the button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button clicked";

        //get data from form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //sql queries to save the data to database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";


        //for executing queries and save data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //to check wheather the query is executed or not
        if($res==TRUE)
        {
            //echo "data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully..</div>";
            //to redirect page for manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //echo "data not inserted";
            //echo "data inserted";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed To Add Admin..</div>";
            //to redirect page for manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        
        
    }

?>