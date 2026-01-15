<?php

    //inclde constants.php
    include("../configuration/constant.php");

    if(isset($_GET['id']) && isset($_GET['image_name']))//can use AND or &&
    {
        //proccess to delete
        
        
        //get id and image_name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the image if available
        //check whether the image is available or not and delete only if available
        if($image_name!= "")
        {
            //it has image and need to remove from the folders
            //get the image path
            $path="../images/food/".$image_name;
            
            //remove image file from folder
            $remove= unlink($path);

            //to check whether the image is removed or not
            if($remove==false)
            {
                //failed to remove
                $_SESSION['upload']="<div class='error'>Failed To Remove Image File...</div>";
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process of deleting the food
                die();
            }
        }

        //delete food from database
        $sql="DELETE FROM tbl_food WHERE id=$id";
        //to execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not and set the message 
        //redirect to manage food with session message
        if($res==true)
        {
            //food deleted
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully...</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed To Delete Food...</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    else
    {
        //redirect to manage food page
        //echo  "redirect";
        $_SESSION['unauthorize']="<div class='error'>Unauthorized Access...</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>