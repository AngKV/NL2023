<?php include('../config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order Systems</title>

    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br>

        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter your username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter password"><br>
            <br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>


        <p class="text-center">Create by - <a href="https://www.facebook.com/kyanh.vu.54">AngKV</a></p>
    </div>
</body>
</html>

<?php

    if (isset($_POST['submit'])) {
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);
        $a= md5($_POST['password']);

        $username =mysqli_real_escape_string($conn, $_POST['username']);
        $password =mysqli_real_escape_string($conn, $a);

        $sql="SELECT * from tbl_admin where username='$username' and password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count==1) {
            $_SESSION['login']= "<div class='success '>Login Successful.</div>";
            $_SESSION['user']= $username;

            header('location:'.SITEURL.'admin/');
        }
        else {
            $_SESSION['login']= "<div class='error text-center'>Username or Password didn't match.</div>";

            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>