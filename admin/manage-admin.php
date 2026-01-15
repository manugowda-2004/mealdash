<?php include('partials/menu.php'); ?>
        
<!--Main Content Section Starts-->
<div class="main">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br>

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];//to display the session message
                        unset($_SESSION['add']);//to remove session method
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['password-not-match']))
                    {
                        echo $_SESSION['password-not-match'];
                        unset($_SESSION['password-not-match']);
                    }

                    if(isset($_SESSION['change-password']))
                    {
                        echo $_SESSION['change-password'];
                        unset($_SESSION['change-password']);
                    }

                    
                
                ?>
                <br><br>

                <!--to add admin button-->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //query to get all admin info
                        $sql="SELECT * FROM tbl_admin";
                        //execute the query
                        $res=mysqli_query($conn,$sql);

                        //to check wheather the query is executed or not
                        if($res==TRUE)
                        {
                            //TO CHECK WHEATHER WE HAVE DATA IN DATABASE OR NOT
                            $count=mysqli_num_rows($res);

                            $sn=1;

                            //check the numbers of rows
                            if($count>0)
                            {
                                //we have data
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //while loop to get all data from database
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];


                                    //to display values in table
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin<a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin<a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                //we don't have data
                            }
                        }
                    
                    ?>
                </table>

            </div>
</div>
<!--Main Content Section Ends-->

<?php include('partials/footer.php'); ?>
