<?php include('partials/menu.php')?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>

            <br/><br>
            <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if (isset($_SESSION['remove'])) {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if (isset($_SESSION['no-found'])) {
                    echo $_SESSION['no-found'];
                    unset($_SESSION['no-found']);
                }
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if (isset($_SESSION['failed'])) {
                    echo $_SESSION['failed'];
                    unset($_SESSION['failed']);
                }
            ?>
            <br><br>

            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br/><br/><br/><br>

            <table class="tbl-full text-center">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * from tbl_category";
                    $res= mysqli_query($conn, $sql);

                    $count=mysqli_num_rows($res);

                    $n=1;

                    if ($count>0) {
                        while ($row=mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $title= $row['title'];
                            $image= $row['image'];
                            $featured= $row['featured'];
                            $active=$row['active'];
                            ?>

                                <tr>
                                    <td><?php echo $n++ ?>. </td>
                                    <td><?php echo $title ?></td>
                                    <td>
                                        <?php
                                            if ($image!="") {
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image; ?>" width="100px">
                                                <?php
                                            }
                                            else {
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-second">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image=<?php echo $image;?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>
                        <?php

                    }
                    
                ?>

                
                
            </table>
           
        </div>
    </div>
<?php include('partials/footer.php') ?>