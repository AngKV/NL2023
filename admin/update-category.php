<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>

            <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * from tbl_category where id =$id";

                    $res= mysqli_query($conn, $sql);
                    $count= mysqli_num_rows($res);
                    if ($count==1) {
                        $row= mysqli_fetch_assoc($res);
                        $title= $row['title'];
                        $current_image= $row['image'];
                        $featured= $row['featured'];
                        $active= $row['active'];

                    }
                    else {
                        $_SESSION['no-found']= "<div class='error'> Category not Found</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    
                }
                else {
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if ($current_image !="") {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image;?>" width="200px">
                                    <?php
                                }
                                else {
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                            <input <?php if($featured=="no") {echo "checked";} ?> type="radio" name="featured" value="no">No
                        </td>
                    </tr>

                    <tr>
                    <td>Active: </td>
                        <td>
                            <input <?php if($active=="yes") {echo "checked";} ?> type="radio" name="active" value="yes">Yes
                            <input <?php if($active=="no") {echo "checked";} ?> type="radio" name="active" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-second">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                if (isset($_POST['submit'])) {
                    $id= $_POST['id'];
                    $title=$_POST['title'];
                    $current_image= $_POST['current_image'];
                    $featured= $_POST['featured'];
                    $active= $_POST['active'];

                    if (isset($_FILES['image']['name'])) {
                        $image = $_FILES['image']['name'];
                        if ($image !="") {
                            $ext = end(explode('.',$image));

                            $image = "Food_Category_".rand(000, 999).'.'.$ext;

                            $source_path= $_FILES['image']['tmp_name'];
                            $destination_path="../images/category/".$image;

                            $upload = move_uploaded_file($source_path, $destination_path);
                            if ($upload==false) {
                                $_SESSION['upload']= "<div class='error'>Failed to Upload Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                            
                            //remove current image
                            if ($current_image!="") {
                                $remove_path= "../images/category/".$current_image;
                                $remove = unlink($remove_path);
                                if ($remove==false) {
                                    $_SESSION['failed']= "<div class='error'>Failed to Remove Current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }    
                            }
                            
                        }
                        else {
                            $image= $current_image;
                        }
                    }
                    else {
                        $image = $current_image;
                    }

                    $sql1 = "UPDATE tbl_category set
                        title= '$title',
                        image='$image',
                        featured= '$featured',
                        active= '$active'
                        where id=$id
                    ";

                    $res1= mysqli_query($conn, $sql1);

                    if ($res1==true) {
                        $_SESSION['update']= "<div class='success'>Category Update Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else {
                        $_SESSION['update']= "<div class='error'>Failed to Update Category.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            ?>
            
        </div>
    </div>

<?php include('partials/footer.php') ?>
