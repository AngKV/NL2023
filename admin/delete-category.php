<?php
    include('../config/constants.php');

    if (isset($_GET['id']) and isset($_GET['image'])) {
        $id= $_GET['id'];
        $image= $_GET['image'];

        if ($image !="") {
            $path= "../images/category/".$image;
            $remove= unlink($path);

            if ($remove==false) {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }

        $sql = "DELETE from tbl_category where id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res==true) {
            $_SESSION['delete']= "<div class='success'>Category Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {
            $_SESSION['delete']= "<div class='error'>Failed to Delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }
    else {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>