<?php
    include_once '../classes/customer.php';
    session_start();

?>
<?php
/*    $cs = new customer();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);

        $login_check = $class->login_admin($adminUser,$adminPass);
    }*/
?>
<?php 
    $cs= new customer();
    if( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
        $login_customer = $cs->login_customer($_POST);
    }

    if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1){
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Tạo Trang Login</title>
     <link rel="stylesheet" href="../css/login.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<section>
     <!--Bắt Đầu Phần Hình Ảnh-->
<!--      <div class="img-bg">
         <img src="https://niemvuilaptrinh.ams3.cdn.digitaloceanspaces.com/tao_trang_dang_nhap/hinh_anh_minh_hoa.jpg" alt="Hình Ảnh Minh Họa">
     </div> -->
     <!--Kết Thúc Phần Hình Ảnh-->
     <!--Bắt Đầu Phần Nội Dung-->
     <div class="noi-dung">
         <div class="form">
             <h2>Trang Đăng Nhập</h2>
             <form action="login.php" method="post">
                <span>
                         <?php
                            if(isset($login_customer))
                            {
                                echo $login_customer;
                            }
                         ?>
                     </span>
                 <div class="input-form">
                     <span>Tên Người Dùng</span>
                     <input type="text" name="user">
                 </div>
                 <div class="input-form">
                     <span>Mật Khẩu</span>
                     <input type="password" name="password">
                 </div>
                 <div class="nho-dang-nhap">
                     <label><input type="checkbox" name=""> Nhớ Đăng Nhập</label>
                 </div>
                 <div class="input-form">
                     <input type="submit" name="login" value="Đăng Nhập">
                 </div>
                 <div class="input-form">
                     <p>Bạn Chưa Có Tài Khoản? <a href="register.php">Đăng Ký</a></p>
                 </div>
             </form>
             <h3>Đăng Nhập Bằng Mạng Xã Hội</h3>
             <ul class="icon-dang-nhap">
                 <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
                 <li><i class="fa fa-google" aria-hidden="true"></i></li>
                 <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
             </ul>
         </div>
     </div>
     <!--Kết Thúc Phần Nội Dung-->
 </section>
</body>
</html>