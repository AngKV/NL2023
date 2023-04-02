<?php require_once('partials-fe/menu.php') ?>

<?php
    if (isset($_GET['category_id'])) {
        $category_id= $_GET['category_id'];

        $sql1= "SELECT title from tbl_category where id= $category_id";

        $res1= mysqli_query($conn, $sql1);

        $row1= mysqli_fetch_assoc($res1);
        $category_title= $row1['title'];
    }
    else {
        header('loation:'.SITEURL.);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql= "SELECT * from tbl_food where category_id=$category_id";

                $res= mysqli_query($conn, $sql);

                $count= mysqli_num_rows($res);

                if ($count>0) {
                    while ($row= mysqli_fetch_assoc($res)) {
                        $title= $row['title'];
                        $price= $row['price'];
                        $description= $row['description'];
                        $image= $row['image'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if ($image=="") {
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                    else {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else {
                    echo "<div class='error'>Food not Available.</div>";
                }
                
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php require_once('partials-fe/footer.php') ?>