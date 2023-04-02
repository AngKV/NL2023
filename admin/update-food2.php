<?php include('partials/menu.php')?>
<?php
    if (isset($_GET['id'])) {
        $id= $_GET['id'];

        $sql1= "SELECT * from tbl_food where id=$id";

        $res1= mysqli_query($conn, $sql1);
        $row1= mysqli_fetch_assoc($res1);

        $title= $row1['title'];
        $description= $row1['description'];
        $price= $row1['price'];
        $current_image= $row1['image'];
        $current_category= $row1['category_id'];
        $featured= $row1['featured'];
        $active= $row1['active'];
    }
    else {
        header('location:'.SITEURL.'admin/manage-foods.php');
    }
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if ($current_image=="") {
                                    echo "<div class='error'>Image not Available.</div>";
                                }
                                else {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="200px">
                                    <?php
                                }
                                
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select new Image: </td>
                        <td>
                            <input type="file" name="image" >
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category" >
                                <?php
                                    $sql= "SELECT *from tbl_category where active='Yes'";

                                    $res=mysqli_query($conn, $sql);
                                    $count= mysqli_num_rows($res);

                                    if ($count>0) {
                                        while ($row=mysqli_fetch_assoc($res)) {
                                            $category_title= $row['title'];
                                            $category_id= $row['id'];

                                            ?>
                                            <option <?php if ($current_category==$category_id) {echo "Selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                            <?php
                                        }
                                    }
                                    else {
                                        echo "<option value='0'>Category not Available.</option>";
                                    }
                                    
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if ($featured=="yes") {echo "checked";}?> type="radio" name="featured" value="yes">Yes
                            <input <?php if ($featured=="no") {echo "checked";}?> type="radio" name="featured" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if ($active=="yes") {echo "checked";}?> type="radio" name="active" value="yes">Yes
                            <input <?php if ($active=="no") {echo "checked";}?> type="radio" name="active" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-second">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if (isset($_POST['submit'])) {
                    $id= $_POST['id'];
                    $title= $_POST['title'];
                    $description= $_POST['description'];
                    $price= $_POST['price'];
                    $current_image= $_POST['current_image'];
                    $category= $_POST['category'];
                    $featured= $_POST['featured'];
                    $active= $_POST['active'];

                    if (isset($_FILES['image']['name'])) {
                        $image1= $_FILES['image']['name'];

                        if ($image1 != "") {

                            $ext = end(explode('.', $image1));
                            
                            $image1= "Food-Name-".rand(0000, 9999).'.'.$ext;

                            $src_path= $_FILES['image']['tmp_name'];
                            $dest_path= "../images/food/".$image1;

                            $upload= move_uploaded_file($src_path, $dest_path);
                            if ($upload==false) {
                                $_SESSION['upload']= "<div class='error'>Failed to Upload New Image.</div>";
                                header('location:'.SITEURL.'admin/manage-foods.php');
                                die();
                            }
                            if ($current_image!="") {
                                $remove_path= "../images/food/".$current_image;
                                $remove= unlink($remove_path);

                                if ($remove==false) {
                                    $_SESSION['re-failed']= "<div class='error'>Failed to Remove Current Image.</div>";
                                    header('location:'.SITEURL.'admin/manage-foods.php');
                                    die();

                                }
                            }
                        }
                    }
                    else {
                        $image1= $current_image;
                    }
                    
                    $sql2= "UPDATE tbl_food set
                        title= '$title',
                        description= '$description',
                        price= '$price',
                        image= '$image1',
                        category_id= '$category',
                        featured= '$featured',
                        active= '$active'
                    where id= $id
                    ";

                    $res2= mysqli_query($conn, $sql2);

                    if ($res2==true) {
                        $_SESSION['update']= "<div class='success'>Food Update Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-foods.php');
                    }
                    else {
                        $_SESSION['update']= "<div class='error'>Failed to Upda te Food.</div>";
                        header('location:'.SITEURL.'admin/manage-foods.php');
                    }

                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php')?>