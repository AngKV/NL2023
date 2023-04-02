<?php require_once('partials-fe/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql="SELECT * from tbl_category where active='yes' and featured='yes'";
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
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    
                                ?>

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else {
                    echo "<div class='error'>Category Not Added.</div>";
                }
                
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql2= "SELECT * from tbl_food where active='yes' and featured='yes'";

                $res2= mysqli_query($conn, $sql2);

                $count2= mysqli_num_rows($res2);
                if ($count2>0) {
                    while ($row2= mysqli_fetch_assoc($res2)) {
                        $id=$row2['id'];
                        $title= $row2['title'];
                        $price= $row2['price'];
                        $description= $row2['description'];
                        $image= $row2['image'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if ($image=="") {
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="order.html" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else {
                    echo "<div class='error'>Food not available.</div>";
                }
                
            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -- Made with Italian Sauce, Chicken, and organice vegetables.


<?php require_once('partials-fe/footer.php') ?>