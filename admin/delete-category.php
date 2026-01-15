<?php 
    //include constants file
    include('../configuration/constant.php');
    //echo "Delete Page";
    //chevck weather the id and image name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get value and delete
        //echo "Get Value and Delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the physical image filr is available
        if($image_name !="")
        {
            //image is available.remove 
            $path="../images/category/".$image_name;
            //remove the image
            $remove=unlink($path);

            //if failed to remove image thnm add an error msg and stop the process
            if($remove==false)
            {
                //session msg 
                $_SESSION['remove']="<div class='error'>Failed To Remove Category Image...</div>";
                //rediract to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //to stop the process
                die();
            }
        }
        //Delete data from DB 
        //to delete dat fromn database
        $sql="DELETE FROM tbl_category WHERE id=$id";

        //to execute the query
        $res = mysqli_query($conn,$sql);

        //wheather the data is deleted from dat base or not
        if($res==true)
        {
            //set success msg and rediorect 
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully...</div>";
            //redirect to manage categiry
            header ('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail msg and redirect
            $_SESSION['delete']="<div class='error'>Failed To Delete Category...</div>";
            //redirect to manage categiry
            header ('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page with message

    }

    else
    {
        //redirecty to manage  category page
        header('location:'.SITEURL.'adim/manage-category.php');
    }
?>