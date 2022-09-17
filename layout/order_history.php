<?php
	include '../inc/header.php';
	include '../lib/session.php';
    include '../classes/product.php';
	//Session::init();
?>
<?php
 	include_once '../lib/database.php';
	include_once '../helper/format.php';

    $db= new Database();
	$fm= new Format();
    $pd = new product();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../css/order_history.css">
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
            <div class="table">
                <div class="layout-inline row th">
                <div class="col col-pro">Product</div>
                <div class="col col-price align-center "> Price</div>
                <div class="col align-center">QTY</div>
                <div class="col">Total</div>
                <div class="col col-med">Payment method</div>
                <div class="col col-med">Update Time</div>
                <div class="col">Status</div>
                <div class="col">Note</div>
            </div>
            <?php
                if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
                    $query = mysqli_query($con, "SELECT * FROM tbl_order WHERE userId = '".$_SESSION['customer_id']."'");
                    while($result = mysqli_fetch_array($query)){
                    $productID = $result['product_id'];
                    $get_product_by_Id = $pd->getproductbyId($productID);
                    $result2 = $get_product_by_Id->fetch_assoc();
                    $query2 = mysqli_query($con, "SELECT * FROM tbl_ordertrackhistory WHERE order_id = '".$result['id']."'");
                    $result3 = mysqli_fetch_assoc($query2);
            ?>
            <div class="layout-inline row"> 
                <div class="col col-pro layout-inline">
                    <img src="../uploads/<?php echo $result2['image'] ?>" alt="kitten" />
                    <p><?php echo $result2['productName'] ?></p>
                </div>
                
                <div class="col col-price col-numeric align-center ">
                    <span style="font: bold 1.8em helvetica; color: #8a8a8a;">£</span><p><?php echo $result2['price'] ?></p>
                </div>

                <div class="col align-center">
                    <p><?php echo $result['quantity'] ?></p>
                </div>
                <div class="col col-total col-numeric align-center">               
                    <span style="font: bold 1.8em helvetica; color: #8a8a8a;">£</span><p><?php echo $result2['price']*$result['quantity'] ?></p>
                </div>
                <div class="col col-med align-center ">
                    <p><?php echo $result['payMethod'] ?></p>
                </div>    
                <div class="col col-med align-center">
                    <p><?php echo $result3['updateTime'] ?></p>
                </div>    
                <div class="col align-center">
                    <p><?php echo $result3['status'] ?></p>
                </div>
                <div class="col col-pro">
                    <p><?php echo $result3['note'] ?></p>
                </div>      
            </div>
            <?php
                    }
                } else {
                    header('location:login.php');
                }
            ?>
        </form>
    </div>
</body>