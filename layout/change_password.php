<?php
	include_once '../inc/header.php';
    include_once '../lib/database.php';
    include_once '../helper/format.php';
    include_once '../classes/customer.php';

    include_once '../lib/database.php';
	include_once '../helper/format.php';
    $us= new customer();

?>

<?php
    if(!isset($_SESSION['customer_login']) && $_SESSION['customer_login'] != 1) {
        header("location:login.php");
    }
    if(isset($_POST['changePass'])){
        if ($_POST['newPass'] == $_POST['confirmPass']) {
            $query = mysqli_query($con,"SELECT * FROM tbl_customer WHERE id = '".$_SESSION['customer_id']."' && password = '".md5($_POST['oldPass'])."'");
            if (mysqli_num_rows($query) > 0) {
                $query = mysqli_query($con,"UPDATE tbl_customer SET password = '".md5($_POST['newPass'])."' WHERE id = '".$_SESSION['customer_id']."'");
                echo "<script>alert('Change password successful!');</script>";
                echo "<script>document.location ='my_account.php';;</script>";
            } else {
                echo "<script>alert('Wrong old password!');</script>";
            }
        } else {
            echo "<script>alert('Wrong confirm password!');</script>";
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Product_details</title>
        <link rel="stylesheet" type="text/css" href="../css/my_account.css">
        <link rel="stylesheet" type="text/css" href="../css/style1.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    </head>
    <body>
        <div class="menu">
            <ul>
                <li><a href=""><i class="fas fa-home"></i>Desktops</a></li>
                <li><a href="">Brand</a>
                        <ul class="sub_menu">
                            <li><a href="">LV</a></li>
                            <li><a href="">Gucci</a></li>
                            <li><a href="">Hermes</a></li>
                            <li><a href="">H&M</a></li>
                        </ul>
                </li>
                <li><a href="">Design</a></li>
                <li><a href="">Material</a>
                        <ul class="sub_menu">
                            <li><a href="">Fetl</a></li>
                            <li><a href="">Skin</a></li>
                            <li><a href="">Cotton</a></li>
                            <li><a href="">Soft</a></li>
                            <li><a href="">Jean</a></li>
                        </ul>
                </li>
                <li><a href="">Bikini</a></li>
                <li><a href="">Jacket</a></li>
                <li><a href="">Hoodie</a></li>
                <li><a href="">Sweater</a></li>
            </ul>
        </div>
        <div class="navigation">
            <div class="slogan">
                <img src="../images/slogan.png">
            </div>
            <div class="container_navigation">
                <div class="icon">
                <a href=""><i class="fas fa-wifi"></i></a>
                <a href=""><i class="fab fa-facebook-square"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
                </div>
                <div class="money">
                    <select>
                        <option>DOLLAR</option>
                        <option>EURO</option>
                        <option>VND</option>
                    </select>
                </div>
                <div class="search">
                    <input type="text" name="keyword" placeholder="search...">
                    <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 style="text-align: center;">My Account</h1>
            <div style="display: flex; margin-left: -5px; margin-right: -5px;">
                <div class="content">
                    <h2 class="title-container">Change Password</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="info-title" for="oldPass">Old Password</label>
                            <input type="password" class="form-control unicase-form-control text-input" id="oldPass" name="oldPass" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="newPass ">New Password</label>
                            <input type="password" class="form-control unicase-form-control text-input" id="newPass" name="newPass" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="confirmPass">Confirm new Password</label>
                            <input type="password" class="form-control unicase-form-control text-input" id="confirmPass" name="confirmPass"  value="" required>
                        </div>
                        <button type="submit" name="changePass" class="btn btn-update">Update</button>
                    </form>
                </div>
                <div class="acc_menu">
                    <h2 class="title-container">Acc Menu</h2>
                    <ul>
                        <li><a href="my_account.php">My Account</a></li>
                        <li><a href="change_password.php">Change Password</a></li>
                        <li><a href="order_history.php">Order History</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <?php
            include '../inc/footer.php';
        ?>
    <script>
        const $ = document.querySelector.bind(document);
        const oldPass = $('#oldPass');
        const confirmPass = $('#confirmPass');
    </script>
    </body>
</html>