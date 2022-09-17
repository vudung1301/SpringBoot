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

    if(isset($_POST['updateInfo'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $query=mysqli_query($con,"update tbl_customer set user='$name',phone='$phone',address='$address',email='$email' where id = '".$_SESSION['customer_id']."'");
        if($query)
        {
          echo "<script>alert('Your infomation has been Updated!');</script>";
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
                    <h2 class="title-container">Personal Infomation</h2>
                    <form action="" method="post">
                        <?php 
                            if(isset($_SESSION['customer_login'])){
                                $get_user_info = $us->get_user_info($_SESSION['customer_id']);
                                if($get_user_info){
                                    $resultID = $get_user_info->fetch_assoc();
                        ?>
                        <div class="form-group">
                            <label class="info-title" for="name">Họ tên<span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" value="<?php echo $resultID['user']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="phone ">SĐT<span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="phone" name="phone" value="<?php echo $resultID['phone']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="address">Địa chỉ <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="address" name="address"  value="<?php echo $resultID['address']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="email">Email <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="email" name="email" required="required" value="<?php echo $resultID['email']; ?>" required>
                        </div>
                        <button type="submit" name="updateInfo" class="btn btn-update">Update</button>
                        <?php   }
                            }
                        ?>
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
    </body>
</html>