<?php
	include '../inc/header.php';
?>
<?php
 	include_once '../lib/database.php';
	include_once '../helper/format.php';

	/*sql_autoload_register(function($className){
		include_once "classes/".$className."php";
	});*/

	
  
 	if(isset($_POST['submit'])) {
    	mysqli_query($con,"update tbl_order set payMethod='".$_POST['paymethod']."' where userID='".$_SESSION['customer_id']."' and payMethod is null ");
		unset($_SESSION['cart']);
		$sql="SELECT * FROM tbl_order WHERE status = 'pending' AND orderDate = '".$_SESSION['date']."' ORDER BY id ASC";
		$query = mysqli_query($con,$sql);
		$sutotal = 0;
		while($result = mysqli_fetch_array($query)){
			$id = $result['id'];
			$date = $result['orderDate'];
			mysqli_query($con,"insert into tbl_ordertrackhistory(order_id,status,updateTime) values('$id','pending','$date')");
		}
		unset($_SESSION['date']);
		header('location:order_history.php');
  	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../css/cart.css">
  <script type="text/javascript" src="../js/cart.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/style1.css">
</head>
<body>
<div class="container">
    <div style="display: flex; margin-top: 28px;">
    <div style="flex: 1; margin-left:4px;">
      <h2>Thông tin khách hàng</h2>
      <form name="payment" method="post">
	      <input type="radio" name="paymethod" value="COD" checked="checked"> COD
	      <input type="radio" name="paymethod" value="Internet Banking"> Internet Banking
	      <input type="radio" name="paymethod" value="Debit / Credit card"> Debit / Credit card <br /><br />
	      <input type="submit" value="submit" name="submit" class="btn btn-primary">
       </form>		
</div>
</body>
</html>