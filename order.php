<?php require_once('partials-fe/menu.php') ?>

    <?php
        if (isset($_GET['food_id'])) {
            $food_id= $_GET['food_id'];

            $sql= "SELECT * from tbl_food where id= $food_id";

            $res= mysqli_query($conn, $sql);
            $count= mysqli_num_rows($res);

            if ($count==1) {
                $row= mysqli_fetch_assoc($res);
                $title= $row['title'];
                $price= $row['price'];
                $image= $row['image'];
            }
            else {
                header('location:'.SITEURL);
            }
            
        }
        else {
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if ($image=="") {
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            else {
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="0" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
                if (isset($_POST['submit'])) {
                    $food= $_POST['food'];
                    $price= $_POST['price'];
                    $quantity= $_POST['quantity'];
                    $total= $price * $quantity;

                    $order_date= date("Y-m-d h:i:sa");

                    $status= "Ordered"; //On Delivery, Delivered, Cancelled

                    $customer_name= $_POST['full-name'];
                    $customer_contact= $_POST['contact'];
                    $customer_email= $_POST['email'];
                    $customer_address= $_POST['address'];

                    $sql1= "INSERT into tbl_orders set
                        food= '$food',
                        price= '$price',
                        quantity= $quantity,
                        total= '$total',
                        order_date= '$order_date',
                        status= '$status',
                        customer_name= '$customer_name',
                        customer_contact= '$customer_contact',
                        customer_email= '$customer_email',
                        customer_address= '$customer_address'
                    ";

                    $res2= mysqli_query($conn, $sql1);

                    if ($res2==true) {
                        $_SESSION['order']= "<div class='success'>Food Order Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else {
                        $_SESSION['order']= "<div class='error'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php require_once('partials-fe/footer.php') ?>