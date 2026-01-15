<?php include('partials/menu.php');?> 
    <div class="main">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php
            
                //get the i d of selected admin
                $id=$_GET['id'];
                //sql for get details
                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                //execute query
                $res=mysqli_query($conn,$sql);

                //to check if the query is executed or not
                if($res==true)
                {
                    //check if data is available or not
                    $count=mysqli_num_rows($res);
                    //check wheather we have admin data or not
                    if($count==1)
                    {
                        //get details
                        //echo "admin available";
                        $row=mysqli_fetch_assoc($res);

                        $full_name=$row['full_name'];
                        $username=$row['username'];
                    }
                    else
                    {
                        //redirect to manage admin page
                        header('location'.SITEURL.'admin/manage-admin.php');
                    }
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary"> 
                        </td>
                    </tr>

                </table>


            </form>
        </div>
    </div>

    <?php

        //check if submit is click or not
        if(isset($_POST['submit']))
        {
            //echo "Button Clicked";
            //get all the values from form
            $id = $_POST['id'];
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);

            //sql query to update admin
            $sql="UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username' 
            WHERE id='$id'
            ";
            //execute query
            $res = mysqli_query($conn, $sql);

            //check wheqther query is executed or not
            if($res==true)
            {
                //query executed
                $_SESSION['update'] ="<div class='success'>Admin Updated Successfully..</div>";
                //to redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                //query not executed
                $_SESSION['update'] ="<div class='error'>Failed To Udate Admin..</div>";
                //to redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
                

            }

        }
?>

<?php include('partials/footer.php');?>