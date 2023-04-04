<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
            <br><br>

            <div class="col-4 text-center">
                <?php
                    //truy van DL
                    $sql= "SELECT * from tbl_category";
                    //thuc thi 
                    $res= mysqli_query($conn, $sql);
                    //dem cot trong truong DL
                    $count= mysqli_num_rows($res);

                ?>

                <h1><?php echo $count;?></h1>    
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <?php
                    //truy van DL
                    $sql1= "SELECT * from tbl_food";
                    //thuc thi 
                    $res1= mysqli_query($conn, $sql1);
                    //dem cot trong truong DL
                    $count1= mysqli_num_rows($res1);

                ?>
                
                <h1><?php echo $count1;?></h1>
                Foods
            </div>
            <div class="col-4 text-center">
                <?php
                    //truy van DL
                    $sql2= "SELECT * from tbl_orders where status='Delivered'";
                    //thuc thi 
                    $res2= mysqli_query($conn, $sql2);
                    //dem cot trong truong DL
                    $count2= mysqli_num_rows($res2);

                ?>
            
                <h1><?php echo $count2;?></h1>
                Total Orders
            </div>
            <div class="col-4 text-center">
                <?php
                    $sql3= "SELECT SUM(total) as total from tbl_orders";

                    $res3= mysqli_query($conn, $sql3);

                    $row3= mysqli_fetch_assoc($res3);

                    $total_revenue= $row3['Total'];
                ?>

                <h1> $ <?php echo $total_revenue;?></h1>
                Revenue Generated
            </div>
            <br/>
        </div>
    </div>
<?php include('partials/footer.php') ?>