<?php
    include('../config/constants.php');

    if (isset($_GET['id']) && isset($_GET['image'])) {
        $id = $_GET['id'];
        $image= $_GET['image'];

        if ($image !="") {
            $path="../images/food/".$image;

            $remove = unlink($path);
            if ($remove==false) {
                $_SESSION['upload']= "<div class='error'>Failed to Remove Image File.</div>";
                header('location:'.SITEURL.'admin/manage-foods.php');
                die();
            }
        }
        
        $sql= "DELETE from tbl_food where id=$id";

        $res=mysqli_query($conn, $sql);
        if ($res==true) {
            $_SESSION['delete']= "<div class='success'>Food Delete Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-foods.php');
        }
        else {
            $_SESSION['delete']= "<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-foods.php');
        }
        
    }
    else {
        $_SESSION['unauthorize']= "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-foods.php');
    }
?>