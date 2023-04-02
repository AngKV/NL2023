<?php require_once('partials-fe/menu.php') ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql="SELECT * from tbl_category where active='yes'";

                $res= mysqli_query($conn, $sql);

                $count= mysqli_num_rows($res);
                if ($count>0) {
                    while ($row= mysqli_fetch_assoc($res)) {
                        $id= $row['id'];
                        $title= $row['title'];
                        $image= $row['image'];
                        ?>
                        <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php
                                    if ($image=="") {
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image;?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else {
                    echo "<div class='error'>Category not found.</div>";
                }
                
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php require_once('partials-fe/footer.php') ?>