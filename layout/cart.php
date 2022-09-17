<?php
  include_once '../inc/header.php';
	include '../classes/order.php';
  include '../classes/customer.php';
	//Session::init();
?>
<?php
 	include_once '../lib/database.php';
	include_once '../helper/format.php';

	/*sql_autoload_register(function($className){
		include_once "classes/".$className."php";
	});*/

	$db= new Database();
	$fm= new Format();
  $order = new order();
  $us= new customer();
  if(isset($_GET['productid'])){
    $productId = $_GET['productid'];
    unset($_SESSION['cart'][$productId]);
    echo "<script>alert('Xóa thành công!');</script>";
  }
  
  if(isset($_POST['update'])){
    if(!empty($_SESSION['cart'])){
      foreach($_POST['quantity'] as $key => $val){
          $_SESSION['cart'][$key]['quantity']=$val;
      }
        echo "<script>alert('Your Cart has been Updated!');</script>";
      }
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
  if(isset($_POST['checkOut'])) {
    if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {  
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $_SESSION['date']=date( 'd-m-Y h:i:s A', time() );
      foreach($_SESSION['cart'] as $id=> $value){
        mysqli_query($con,"insert into tbl_order(userId,product_id,quantity,status,orderDate) values('".$_SESSION['customer_id']."','$id','". $_SESSION['cart'][$id]['quantity']."','pending','". $_SESSION['date']."')");
      }
      header('location:pay_method.php');
    } else {
    echo "<script>alert('Login to check out!')</script>";
		echo "<script type='text/javascript'> document.location ='login.php'; </script>";
    }  
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../css/cart.css">
  <link rel="stylesheet" type="text/css" href="../css/style1.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <script type="text/javascript" src="../js/cart.js"></script>

</head>
<body>
  <div class="container">
  <!-- <div class="heading">
    <h1>
      <span class="shopper">s</span> Shopping Cart
    </h1>
    
    <a href="#" class="visibility-cart transition is-open">X</a>    
  </div> -->

    <form action="" method="post">
      <div class="cart transition is-open">
        <button type="submit" class="btn btn-update" name="update">Update cart</button>
        <div class="table">
          <div class="layout-inline row th">
            <div class="col col-pro">Product</div>
            <div class="col col-price align-center"> Price</div>
            <div class="col col-qty align-center">QTY</div>
            <div class="col">Total</div>
          </div>
          <?php
            if(!empty($_SESSION['cart'])){
              $sql = "SELECT * FROM tbl_product WHERE product_id IN(";
                foreach($_SESSION['cart'] as $id => $value){
                $sql .=$id. ",";
                }
              $sql=substr($sql,0,-1) . ") ORDER BY product_id ASC";
              $query = mysqli_query($con,$sql);
              $sutotal = 0;
              while($result = mysqli_fetch_array($query)){
                $quantity=$_SESSION['cart'][$result['product_id']]['quantity'];
          ?>
          <div class="layout-inline row"> 
            <div class="col col-pro layout-inline">
              <img src="../uploads/<?php echo $result['image'] ?>" alt="kitten" />
              <p><?php echo $result['productName'] ?></p>
            </div>
            
            <div class="col col-price col-numeric align-center ">
                <span style="font: bold 1.8em helvetica; color: #8a8a8a;">£</span><p><?php echo $result['price'] ?></p>
            </div>

            <div class="col col-qty layout-inline">
              <input type="number" value="<?php echo $quantity ?>" name="quantity[<?php echo $result['product_id']?>]" min="1"/>
            </div>
            <div class="col col-total col-numeric">               
                <span style="font: bold 1.8em helvetica; color: #8a8a8a;">£</span><p><?php echo $result['price']*$quantity ?></p>
            </div>
            <div class="col layout-inline">
                <a class="delBtn" href="?productid=<?php echo $result['product_id']; ?>">
                    <span>Remove</span>
                </a>
            </div>
            <?php
              $sutotal += $result['price']*$quantity;
            }
              ?>
              
            <div class="tf" style="width: 100%;">
              <div class="row layout-inline">
                  <div class="col"><p>SubTotal</p></div>
                  <div class="col total-value"><?php echo $subtotal; ?></div>
              </div>
              <div class="row layout-inline">
                  <div class="col"><p>VAT</p></div>
                  <div class="col VAT-value" style="font: bold 1.8em helvetica;color:#fff;">10%</div>
              </div>
              <div class="row layout-inline">
                  <div class="col"><p>GrandTotal</p></div>
                  <div class="col subtotal-value"><?php echo $subtotal*0.1; ?></div>
              </div>
            </div>  
            <?php
                } else {
                  echo "<h3>Không có sản phẩm trong giỏ hàng!</h3>";
                }
            ?> 
          </div>            
        </div>
      <div class="contain-info">
          <h2 style="font-size: 2.5em;margin-left: 1em;">Thông tin khách hàng</h2>
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
          <button type="submit" name="updateInfo" class="btn btn-update-info">Update</button>
        <?php 
            }
          }
        ?>
      </div>
      <button type="submit" name="checkOut" class="btn btn-checkout">Check Out</button>
    </form>
  </div>

<script>
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const removeBtns = $$('.delBtn');

    var totalVlaue = $('.total-value');

    
    function cost() {

      const prices = $$('.col-total p');
      var total = 0;
      prices.forEach((price,index) => {
        total += Number(price.innerText)
      })
      totalVlaue.innerHTML = '<span style="font: bold 1.8em helvetica;color:#fff;">£</span><p style = "display: inline;font: bold 1.8em helvetica;">'+total.toFixed(2)+'</p>'
      $('.subtotal-value').innerHTML = '<span style="font: bold 1.8em helvetica;color:#fff;">£</span><p style = "display: inline;font: bold 1.8em helvetica;">'+(total + total*0.1).toFixed(2)+'</p>'
    }
    
    cost()
    removeBtns.forEach(removeBtn => {
        removeBtn.onclick = function (e) {
            e.target.parentElement.parentElement.parentElement.innerHTML = "";
            cost();
        }
    })
</script>
</body>
</html>