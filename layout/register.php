<?php
    include '../classes/customer.php';
    session_start();
?>
<?php 
    $cs= new customer();
    if( $_SERVER['REQUEST_METHOD']=='POST' &&isset($_POST['submit'])){
        $insertCustomer = $cs->insert_customer($_POST);
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
     <div class="noi-dung">
         <div class="form">
            <form action="" method="post">

             <h2>Create New Account</h2>
             <?php
                if(isset($insertCustomer)){
                    echo $insertCustomer;
                    
                }
                ?>
                <div class="input-form">
                    <span>Email</span>
                    <input type="email" name="email">
                </div>
                 <div class="input-form">
                    <span>Address</span>
                    <input type="text" name="address">
                </div>
                <div class="input-form">    
                    <span>Phone Number</span>
                    <input type="text" name="phone">
                </div>
                <div class="input-form">
                     <span>User</span>
                     <input type="text" name="user">
                 </div>

                 <div class="input-form">
                     <span>Password</span>
                     <input type="password" name="password">
                 </div>
                 <div class="input-form">
                     <input type="submit" name="submit" value="Register">
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