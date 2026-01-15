<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            //check if the id is set or not
            if(isset($_GET['id']))
            {
                //get the id and all other details
                //echo "Getting the data";
                $id=$_GET['id'];
                //create sql to get all other details
                $sql="SELECT * FROM tbl_category WHERE id=$id";

                //to nexecute th3e query
                $res=mysqli_query($conn,$sql);

                //to count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else
                {
                    //redirect to manage category with session msg
                    $_SESSION['no-category-found']="<div class='error'>Category Not Found...</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //display image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //display msg
                                echo "<div class='error'>Image Not Added...</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";
                    //to get all values from the form
                    $id=$_POST['id'];
                    $title=mysqli_real_escape_string($conn, $_POST['title']);
                    $current_image=$_POST['current_image'];
                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    //updating new image if selected 
                    //check wheather the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name=$_FILES['image']['name'];

                        //check wheather the image is available or not
                        if($image_name!= "")
                        {
                            //image is available
                            //upload the new image
                                //auto rename image
                                //get the extension of image(jpg,png,etc)
                                $ext=end(explode('.',$image_name));

                                //rename image
                                $image_name="Food_Category_".rand(000,999).'.'.$ext; //Food_Category_856.jpg/png..etc


                                $source_path=$_FILES['image']['tmp_name'];

                                $destination_path="../images/category/".$image_name;

                                //upload image
                                $upload=move_uploaded_file($source_path,$destination_path);

                                //to check if the image is uploaded or not
                                //if the image is not uploaded then will stop process and redirect with a msg
                                if($upload==false)
                                {
                                    //set msg
                                    $_SESSION['upload']="<div class='error'>Failed To Upload Image...</div>";
                                    //to redirect to add-category page
                                    header('location:'.SITEURL."admin/manage-category.php");
                                    //stop the process
                                    die();
                                }
                            //remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path="../images/category/".$current_image;

                                $remove=unlink($remove_path);

                                //check wheather the image is removed or not 
                                //if failed to remove them display message and stop process

                                if($remove==false)
                                {
                                    //failed to remove image
                                    $_SESSION['failed-remove']="<div class='error'>Failed To Remove Current Image...</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();//to stop process
                                }
                            }
                            
                        }
                        else
                        {
                            $image_name=$current_image;
                        }
                    }
                    else
                    {
                        $image_name=$current_image;
                    }

                    //update the database
                    $sql2="UPDATE tbl_category SET
                        title= '$title',
                        image_name='$image_name',
                        featured= '$featured',
                        active= '$active'
                        WHERE id=$id
                        ";

                    //to execute query
                    $res2 = mysqli_query($conn,$sql2);
                    
                    //redirect to manage category with message
                    //check wheather query executed or not
                    if($res2==true)
                    {
                        //category updated
                        $_SESSION['update']="<div class='success'>Category Updated Successfully...</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //failed to update category
                        $_SESSION['update']="<div class='error'>Failed To Update Category...</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }

                }
            ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>