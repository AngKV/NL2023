<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="yes">Yes
                            <input type="radio" name="featured" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="yes">Yes
                            <input type="radio" name="active" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-second">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if (isset($_POST['submit'])) {
                    
                    $title = $_POST['title'];
                    if (isset($_POST['featured'])) {
                        $featured=$_POST['featured'];
                    }
                    else {
                        $featured="No";
                    }

                    if (isset($_POST['active'])) {
                        $active=$_POST['active'];
                    } else {
                        $active= "No";
                    }

                    if(isset($_FILES['image']['name'])){
                        
                        $image= $_FILES['image']['name'];
                        if ($image !="") {
                            
                            $ext = end(explode('.',$image));

                            $image = "Food_Category_".rand(000, 999).'.'.$ext;

                            $source_path= $_FILES['image']['tmp_name'];
                            $destination_path="../images/category/".$image;

                            $upload = move_uploaded_file($source_path, $destination_path);
                            if ($upload==false) {
                                $_SESSION['upload']= "<div class='error'>Failed to Upload Image.</div>";
                                header('location:'.SITEURL.'admin/add-category.php');
                                die();
                            }
                        }
                    }
                    else {
                        $image="";
                    }

                    $sql ="INSERT into tbl_category set
                        title='$title',
                        image='$image',
                        featured='$featured',
                        active='$active'
                    ";

                    $res= mysqli_query($conn, $sql);
                    if ($res==true) {
                        $_SESSION['add']= "<div class='success'>Add Category Successfuly.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    } else {
                        $_SESSION['add']= "<div class='error'>Failed to Add Category.</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                    
                    
                }
            ?>

        </div>
    </div>

<?php include('partials/footer.php') ?>