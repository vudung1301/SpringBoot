<?php 
	include_once '../config/config.php';
	session_start();
	// include '../classes/customer.php';
?>
<div class="header">
	<div class="container_header">
		<div class="logo">
			<a href="index.php"><img src="../images/logo1.png"></a>
			<a href="../layout/index.php"><img src="../images//logo2.png"></a>
			<div class="turn_light">
				<a href="">SO TURN THE LIGHT </a>
			</div>
		</div>
		<div class="menu_header">
			<ul>
				<li>
				<?php
					if (isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
				?>
					<a href="wishlist.php">
					WISH LIST(
					<?php
								$query = mysqli_query($con, "SELECT id, user_id, COUNT(id) as 'dem' FROM tbl_wishlist WHERE user_id = '".$_SESSION['customer_id']."'");
								$result = mysqli_fetch_assoc($query);
								echo $result['dem'];
					?>
							)
						</a>
					<?php
					} else {
						echo '<a href="login.php" onclick="alert("Login to add wishlist!")">WISH LIST</a>'	;	
					}
					?>
				</li>
				<li style="flex: 1; position: relative;">
					<a href="cart.php">SHOPPING CART
						<i class="header_cart-icon fas fa-cart-plus">
							<span class="header_cart-noti">
								<?php 
								if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1 && !empty($_SESSION['cart'])) {
									$dem = 0;
									foreach($_SESSION['cart'] as $id => $value){
										$dem++;
									}
									echo $dem;
								} else {
									echo 0;
								}
								?>
							</span>
						</i>
					</a>
					<ul class="header_cart-submenu">
					<?php 
						if (!empty($_SESSION['cart'])) {
						echo '<h5 style="font-size: 16px;margin: 0;padding-bottom: 8px;">Product on cart</h5>';
						$sql = "SELECT * FROM tbl_product WHERE product_id IN(";
						foreach($_SESSION['cart'] as $id => $value){
							$sql .=$id. ",";
							}
							$sql=substr($sql,0,-1) . ") ORDER BY product_id ASC";
							$query = mysqli_query($con,$sql);
							while($result = mysqli_fetch_array($query)){
							  $quantity=$_SESSION['cart'][$result['product_id']]['quantity'];
						?>
						<li style="display:flex; align-items: center;">
							<a class="dropdown-item" href="../layout/my_account.php">
								<img src="../uploads/<?php echo $result['image'] ?>" alt="kitten" />
								<p style="flex: 1;font-weight: 540;font-size: 16px;"><?php echo $result['productName'] ?></p>		
								<span style="font: bold 16px helvetica; color: #8a8a8a;">£<?php echo $result['price'] ?></span>
								<span style="font-weight: 500;font-size: 16px"><p style="display: inline; margin: 0 4px;font-weight: 540;font-size: 10px;">x</p><?php echo $quantity ?></span>
							</a>
							<a style="font-weight: 600;margin-left: 8px;font-size: 14px;text-decoration: none;color: black;" href="?productid=<?php echo $result['product_id']; ?>">Remove</a>
						</li>
					</ul>
					<?php
						}
					} else {
						?>
						<li>
							<img style="min-width: max-content;border-radius:2px;width: 100%;overflow: hidden;" src="../images/no-cart.png" alt="">
						</li>
					</ul>
					<?php
					}
					?>
				</li>
				<?php 
				if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
				?>
				<li style="position: relative;">
					<a href="my_account.php"><i class="fas fa-user-circle" style="margin-right: 8px;"></i><?php echo '<span style="font-size: 1.1em;">'.$_SESSION['customer_user'].'</span>';?></a>
					<ul class="submenu">
						<li><a class="dropdown-item" href="../layout/my_account.php">My Account</a></li>
						<li><a class="dropdown-item" href="../layout/logout.php">Logout</a></li>
					</ul>
				</li>	
				<?php
					} else {
				?>
					<li><a href="login.php">Login</a></li>
				<?php 
					}
				?>
			</ul>
		</div>
	</div>
</div>