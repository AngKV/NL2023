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
                Categories
            </div>
            <div class="col-4 text-center">
                Categories
            </div>
            <div class="col-4 text-center">
                Categories
            </div>
            <div class="col-4 text-center">
                Categories
            </div>
            <br/>
        </div>
    </div>
<?php include('partials/footer.php') ?>