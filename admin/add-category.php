<?php include('partials/menu.php'); ?>
<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!--Add category-->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        <!--Add category-->

        <?php
            //check if the submit is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //to get value from form
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                //to check if the radio button is weather selected or not
                if(isset($_POST['featured']))
                {
                    //to get value from form
                    $featured=$_POST['featured'];
                }
                else
                {
                    //to set defaukt value
                    $featured="No";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                //check if the image is selected or not aand set the value of image name
                //print_r($_FILES['image']);

                //die();//to break the code

                if(isset($_FILES['image']['name']))
                {
                    //upload image
                    //to upload image need image name ,path and destination
                    $image_name = $_FILES['image']['name'];

                    //upload image only if image is selected
                    if($image_name != "")
                    {
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
                            header('location:'.SITEURL."admin/add-category.php");
                            //stop the process
                            die();
                        }

                    }
                }
                else{
                    //do not upload image and set name blank
                    $image_name="";
                }
                //to create sql query to insert category into DB
                $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //to execute the sql query
                $res = mysqli_query($conn, $sql);

                //weather the query is execute or no and if data added or not
                if($res==true)
                {
                    //query executed and catagory added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully...</div>";
                    //to redirect to manage category page
                    header('location:'.SITEURL."admin/manage-category.php");
                }
                else
                {
                    //failed to add catagory
                     $_SESSION['add'] ="<div class='error'>Failed To Add Category...</div>";
                     //to redirect to manage category page
                     header('location:'.SITEURL."admin/add-category.php");
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>