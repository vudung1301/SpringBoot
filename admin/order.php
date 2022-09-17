<?php
    include_once '../classes/order.php';
?>
<?php 

    $od= new order();
	if(isset($_GET['action']) && $_GET['action']=="delivered"){
		if(isset($_GET['order_id'])){
			$id = $_GET['order_id'];
			$deliverdOrder= $od-> delivered_order($id);
		}
    }

	if(isset($_GET['action']) && $_GET['action']=="take"){
		if(isset($_GET['order_id'])){
			$id = $_GET['order_id'];
			$acp_order= $od-> acp_order($id);
		}
    }
	
	if(isset($_GET['action']) && $_GET['action']=="deny"){
		if(isset($_GET['order_id'])){
			$id = $_GET['order_id'];
			$deny_order= $od-> deny_order($id);
		}
    }

	if(isset($_POST['submit'])) {
		if(isset($_POST['note'])) {
			date_default_timezone_set('Asia/Ho_Chi_Minh');
      		$_SESSION['date']=date( 'd-m-Y h:i:s A', time() );
			$query = mysqli_query($con, "UPDATE tbl_ordertrackhistory SET note ='".$_POST['note']."', updateTime = '".$_SESSION['date']."' WHERE order_id = '".$_POST['order_id']."'");
			unset($_SESSION['date']);
			echo "<script>alert('Sending note successfully!');</script>";
		} else {
			echo "<script>alert('Error!');</script>";
		}
	}
?>
<!Doctype HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="${pageContext.servletContext.contextPath}/css/admin.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link rel="stylesheet" href="../css/productmanage.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
	
	<div id="mySidenav" class="sidenav">
        <p class="logo"><span>Bon</span>-Fire</p>
        <a href="categoryList.php" class="icon-a"><i class="fa fa-dashboard icons"></i> &nbsp;&nbsp;Category</a>
        <a href="productManage.php"class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Product</a>
        <a href="order.php"class="icon-a"><i class="fa fa-list icons"></i> &nbsp;&nbsp;Orders</a>
        <a href="#"class="icon-a"><i class="fa fa-tasks icons"></i> &nbsp;&nbsp;Inventory</a>
        <a href="user.php"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts</a>
        <a href="userlog.php"class="icon-a"><i class="fa fa-user icons"></i> &nbsp;&nbsp;Accounts Log</a>
        <a href="#"class="icon-a"><i class="fa fa-list-alt icons"></i> &nbsp;&nbsp;Tasks</a>
    </div>

<div id="main">
	<div class="head">
		<div class="col-div-6">
			<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Orders</span>
			<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Orders</span>
		</div>
			
		<div class="col-div-6"></div>
		<div class="clearfix"></div>
	</div>

	<div class="clearfix"></div><br/>
	<div class="listproduct">
		<table>
			<tr>
				<td>No.</td>
				<td>User</td>
				<td>Product</td>
				<td>Quantity</td>
				<td>Paymend Method</td>
				<td>Order Date</td>
				<td>Update Time</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
			<?php
			$show = $od->get_all_order();
			if($show){
				while($result=$show->fetch_array()){			
					$query2 = mysqli_query($con, "SELECT * FROM tbl_ordertrackhistory WHERE order_id = '".$result['id']."'");
					$result2 = mysqli_fetch_assoc($query2);
			?>
			<tr>

				<td><?php echo $result['id'] ?></td>
				<td><?php echo $result['userID']?></td>
				<td><?php echo $result['product_id']?></td>
				<td><?php echo $result['quantity']?></td>
				<td><?php echo $result['payMethod']?></td>
				<td><?php echo $result['orderDate']?></td>
				<td><?php echo $result2['updateTime']?></td>
				<td><?php echo $result['status']?></td>
				<?php
					if($result['status'] == "pending") {
				?>
				<td>
					<button class="button-42"><a onclick="return confirm('Are you want take order?')" href="order.php?action=take&order_id=<?php echo $result['id']?>"> take</a></button>
					<button class="button-42"><a onclick="return confirm('Are you want deny order?')" href="order.php?action=deny&order_id=<?php echo $result['id']?>"> deny</a></button>
				</td>
				<?php
					} else if ($result['status'] == "On Way"){
						?>
				<td>
					<button class="button-42"><a onclick="return confirm('Is this order deliverd?')" href="order.php?action=delivered&order_id=<?php echo $result['id']?>">delivered</a></button>
				</td>
				<?php
					} else {
						if ($result2['note'] == NULL) {
							echo '
							<td>
								<form action="" method="post">
								<input type="hidden" value="'.$result['id'].'" name="order_id">
									<span>Note: </span>
									<input type="text" name="note" value="">
									<button class="button-42" type="submit" name="submit"> submit</button>
								</form>
							</td>
							';
						} else {
							echo '<td align="left">'.$result2['note'].'</td>';
						}
					}
				}
			}
			?>
			</tr>
		</table>
		</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(".nav").click(function(){
    $("#mySidenav").css('width','70px');
    $("#main").css('margin-left','70px');
    $(".logo").css('visibility', 'hidden');
    $(".logo span").css('visibility', 'visible');
     $(".logo span").css('margin-left', '-10px');
     $(".icon-a").css('visibility', 'hidden');
     $(".icons").css('visibility', 'visible');
     $(".icons").css('margin-left', '-8px');
      $(".nav").css('display','none');
      $(".nav2").css('display','block');
  });

$(".nav2").click(function(){
    $("#mySidenav").css('width','300px');
    $("#main").css('margin-left','300px');
    $(".logo").css('visibility', 'visible');
     $(".icon-a").css('visibility', 'visible');
     $(".icons").css('visibility', 'visible');
     $(".nav").css('display','block');
      $(".nav2").css('display','none');
 });

</script>

</body>


</html>
