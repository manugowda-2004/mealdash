<?php 
    //to include constants.php file
    include('../configuration/constant.php');

    //to get the id of admin to deleted
    $id = $_GET['id'];

    //sql query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";

    //execute query
    $res=mysqli_query($conn, $sql);

    //check wheathe the query is executed or not
    if($res==true)
    {
        //echo 'Admin deleted';
        //session variable to display a msg
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully..</div>";
        //to redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo 'failed to delete admin';
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Admin,Try Again Later..</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //redirect to manage admin page with a msg


?>