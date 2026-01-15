<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the Food">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the Food..."></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" >

                                <?php 
                                    //create php to display categories from the database
                                    //create sql to get all active categories from database
                                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                    //to execute query
                                    $res=mysqli_query($conn,$sql);

                                    //count row tom check whether we have categories or not
                                    $count=mysqli_num_rows($res);

                                    //if count is greater than 0 we have category esle we do not have categories
                                    if($count>0)
                                    {
                                        //we have category
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the details of category
                                            $id=$row['id'];
                                            $title=$row['title'];
                                            
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //we do not have category
                                        ?>
                                            <option value="0">No Category Found...</option>
                                        <?php
                                    }

                                    //display on dropdown
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

                //check if the button is clicked or not
                if(isset($_POST['submit']))
                {
                    //add the food in database
                    //echo "clicked";

                    //get the data from form
                    $title=mysqli_real_escape_string($conn, $_POST['title']);
                    $description=mysqli_real_escape_string($conn, $_POST['description']);
                    $price=mysqli_real_escape_string($conn, $_POST['price']);
                    $category=$_POST['category'];

                    //check whether the radio button for featured and active checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured=$_POST['featured'];

                    }
                    else
                    {
                        $featured= "No";//setting the default value
                    }

                    if(isset($_POST['active']))
                    {
                        $active=$_POST['active'];
                    }
                    else
                    {
                        $active="No";//default value
                    }
                    
                    //to upload the image if selected

                    //check whether the select image is clicked or not and upload image only if image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        //get the details of the selected image
                        $image_name=$_FILES['image']['name'];

                        //check whether the image is selected or not and upload image only if selected
                        if($image_name!= "")
                        {
                            //image is selected
                            //1. rename the image
                            //to get the extension of selected image (jpg,png,gif...)
                            $ext=end(explode('.',$image_name));

                            //create new name for image
                            $image_name="Food-Name-".rand(0000,9999).".".$ext;//new image name like "Food-Name-566.jpg"

                            //2. upload the image
                            //get the source path and destination path

                            //source path is the current location of the image 
                            $src=$_FILES['image']['tmp_name'];

                            //destination path for the image to be uploaded
                            $dst="../images/food/".$image_name;
                            
                            //upload the food image
                            $upload=move_uploaded_file($src,$dst);

                            //check whether imageuploaded or not
                            if($upload==false)
                            {
                                //failed to upload the image
                                //redirect to add food page with message
                                $_SESSION['upload']="<div class='error'>Failed To Upload Image...</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name="";//setting default value as blank
                    }

                    //to insert into database

                    //create a sql query to save or add food 
                    $sql2="INSERT INTO tbl_food SET
                        title='$title',
                        description='$description',
                        price='$price', 
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                    ";

                    //execute the query
                    $res2=mysqli_query($conn,$sql2);
                    //check whether the data is inserted or not
                    //redirect with message to manage food page

                    if($res2==true)
                    {
                        //data inserted successfully
                        $_SESSION['add']="<div class='success'>Food Added Successfully...</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to insert data
                        $_SESSION['add']="<div class='error'>Failed To Add Food...</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }

            ?>

    </div>

</div>

<?php include('partials/footer.php'); ?>