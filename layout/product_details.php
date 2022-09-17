<?php
	include '../inc/header.php';
	include '../classes/category.php';
	include '../classes/product.php';
	include '../classes/user.php';
	include '../classes/order.php';
?>
<?php
 	include_once '../lib/database.php';
	include_once '../helper/format.php';

	/*sql_autoload_register(function($className){
		include_once "classes/".$className."php";
	});*/

	$db= new Database();
	$fm= new Format();
	$od= new order();
	$us= new user();
	$cat= new category();
	$product= new product();
?>
<?php
    if(!isset($_GET['product_id']) || empty($_GET['product_id'])){
    	echo "loi" ;
       // echo "<script> window.location = '404.php'</script>";
        // die('loi');
    }else{
        $id = $_GET['product_id'];
    }

	if(isset($_POST['submit'])){
		$id=intval($_GET['product_id']);
		if(isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id]['quantity']++;
		}else{
			$_SESSION['cart'][$id]['quantity'] = $_POST['quantity'];
		}
			echo "<script>alert('Product has been added to the cart')</script>";
			echo "<script type='text/javascript'> document.location ='cart.php'; </script>";			
	}


	if(isset($_POST['sendReview']))
	{
		$qty=$_POST['quality'];
		$price=$_POST['price'];
		$value=$_POST['value'];
		$summary=$_POST['summary'];
		$review=$_POST['review'];
		mysqli_query($con,"insert into tbl_review(product_id,quality,price,value,user_id,summary,review) values('$id','$qty','$price','$value','".$_SESSION['customer_user']."','$summary','$review')");
		header('location:#');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product_details</title>
	<link rel="stylesheet" type="text/css" href="../css/Product_Details.css">
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
	<?php 
		$get_product_detail = $product->get_detail($id);
		if ($get_product_detail){
			while($result_details = $get_product_detail->fetch_assoc()){
	 ?>
	<div class="product">
		<div class="img">
			<img  src="../uploads/<?php echo $result_details['image'] ?>" width="563px" height="638px">
		</div>
		<div class="details">
			<span><?php echo $result_details['productName'] ?></span>
			<div class="evaluate">
				<span>4.9/5 <i class="fas fa-star"></i><a href="">(xem 20 đánh giá)</a></span>
			</div>
			<div class="price">
				<div class="hai">
					<h3><?php echo $result_details['price_sell'] ?></h3>
				</div>
				<div class="ba">
					<strike><?php echo $result_details['price'] ?></strike>
				</div>
			</div>
			<div class="color">
				Màu sắc: Đen 
			</div>
			<div class="size">
				<span>Chọn Size áo:</span>
				<div class="choose_size">
					<input type="submit" value="S">
					<input type="submit" value="M">
					<input type="submit" value="L">
					<input type="submit" value="XL">
					<input type="submit" value="XXL">
				</div>
			</div>
			<div class="add_cart">
				<form action="" method="post">
					<div>
						<label for="quantity">So Luong:</label>
						<input type="number" name="quantity" value="1" min="1">
					</div>
					<div>
							<button type="submit" name="submit">Thêm vào giỏ hàng <i class="fas fa-cart-plus"></i></button>	
					</div>
				</form>		
			</div>
			<div class="characteristics">
				<div class="most_characteristics">
					Đặc điểm sản phẩm
				</div>
				<div class="feature_characteristics">
					<ul>
						<li><i class="far fa-check-square"></i> <?php echo $result_details['description'] ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<?php 
		}
	}
	 ?>

	<div class="comment">
	 	<div id="review" class="tab-pane">
			<div class="product-tab">															
				<div class="product-reviews">
						<h4 class="title">Customer Reviews</h4>
						<?php $qry=mysqli_query($con,"select * from tbl_review where product_id='$id'");
						while($rvw=mysqli_fetch_array($qry)){
						?>
					<div class="reviews">
						<div class="review">
							<div class="review-title"><span class="summary"><?php echo htmlentities($rvw['summary']);?></span><span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['reviewDate']);?></span></span></div>
							<div class="text">"<?php echo htmlentities($rvw['review']);?>"</div>
							<div class="text"><b>Quality :</b>  <?php echo htmlentities($rvw['quality']);?> Star</div>
							<div class="text"><b>Price :</b>  <?php echo htmlentities($rvw['price']);?> Star</div>
							<div class="text"><b>value :</b>  <?php echo htmlentities($rvw['value']);?> Star</div>
							<div class="author m-t-15">
								<i class="fa fa-pencil-square-o"></i>
								<span class="name">
									<?php
										$qry=mysqli_query($con,"select user from tbl_customer where id='".$rvw['user_id']."'");
										echo mysqli_fetch_assoc($qry);
									?>		
								</span>
							</div>													
						</div>					
					</div>
						<?php } ?><!-- /.reviews -->
					</div><!-- /.product-reviews -->
					<?php
						if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
					?>
					<div class="product-add-review">
						<h4 class="title">Write your own review</h4>
						<div class="review-table">
							<div class="table-responsive">
								<table class="table-bordered">	
									<thead>
										<tr>
											<td class="cell-label">&nbsp;</td>
											<td>1 star</td>
											<td>2 stars</td>
											<td>3 stars</td>
											<td>4 stars</td>
											<td>5 stars</td>
										</tr>
									</thead>	
									<tbody>
										<tr>
											<td class="cell-label">Quality</td>
											<td><input type="radio" name="quality" class="radio" value="1"></td>
											<td><input type="radio" name="quality" class="radio" value="2"></td>
											<td><input type="radio" name="quality" class="radio" value="3"></td>
											<td><input type="radio" name="quality" class="radio" value="4"></td>
											<td><input type="radio" name="quality" class="radio" value="5"></td>
										</tr>
										<tr>
											<td class="cell-label">Price</td>
											<td><input type="radio" name="price" class="radio" value="1"></td>
											<td><input type="radio" name="price" class="radio" value="2"></td>
											<td><input type="radio" name="price" class="radio" value="3"></td>
											<td><input type="radio" name="price" class="radio" value="4"></td>
											<td><input type="radio" name="price" class="radio" value="5"></td>
										</tr>
										<tr>
											<td class="cell-label">Value</td>
											<td><input type="radio" name="value" class="radio" value="1"></td>
											<td><input type="radio" name="value" class="radio" value="2"></td>
											<td><input type="radio" name="value" class="radio" value="3"></td>
											<td><input type="radio" name="value" class="radio" value="4"></td>
											<td><input type="radio" name="value" class="radio" value="5"></td>
										</tr>
									</tbody>
								</table><!-- /.table .table-bordered -->
							</div><!-- /.table-responsive -->
						</div><!-- /.review-table -->												
						<div class="review-form">
							<div class="form-container">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="exampleInputName">Your Name <span class="astk">*</span></label>
											<div><input type="text" class="form-control txt" id="exampleInputName" value="<?php echo $_SESSION['customer_user'];?>" placeholder="" name="name" required="required"></div>
										</div><!-- /.form-group -->
										<div class="form-group">
											<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
											<div><input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required"></div>
										</div><!-- /.form-group -->
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<label for="exampleInputReview">Review <span class="astk">*</span></label>
											<div><textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="" name="review" required="required"></textarea></div>
										</div><!-- /.form-group -->
									</div>
								</div><!-- /.row -->
								<div class="text-right">
									<button name="sendReview" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
								</div><!-- /.action -->
								<?php
								} else {
								?> 
									<div class="product-add-review">
										<h4 class="title">Write your own review</h4>
									</div>
								<?php
								}
								?>
							</div><!-- /.form-container -->
						</div><!-- /.review-form -->
					</div><!-- /.product-add-review -->	
				</div>															
			</div><!-- /.product-tab -->
		</div><!-- /.tab-pane -->
							
	</div>
	<div class="footer">
		<div class="contact">
                <div class="sub-contact">
                    <h3>INFORMATION</h3>
                    <ul>
                        <li><a href="">The brand</a></li>
                        <li><a href="">Local stories</a></li>
                        <li><a href="">Custumer service</a></li>
                        <li><a href="">Privacy & cookie</a></li>
                        <li><a href="">Site Map</a></li>
                    </ul>
                </div>
                <div class="sub-contact">
                    <h3>WHY BY FROM US</h3>
                    <ul>
                        <li><a href="">The brand</a></li>
                        <li><a href="">Local stories</a></li>
                        <li><a href="">Custumer service</a></li>
                        <li><a href="">Privacy & cookie</a></li>
                        <li><a href="">Site Map</a></li>
                    </ul>
                </div>
                <div class="sub-contact">
                    <h3>YOUR ACCOUNT</h3>
                    <ul>
                        <li><a href="">The brand</a></li>
                        <li><a href="">Local stories</a></li>
                        <li><a href="">Custumer service</a></li>
                        <li><a href="">Privacy & cookie</a></li>
                        <li><a href="">Site Map</a></li>
                        <li><a href="">Update information</a></li>
                    </ul>
                </div>
                <div class="sub-contact">
                    <h3>LOOKBOOK</h3>
                    <ul>
                        <li><a href="">The brand</a></li>
                        <li><a href="">Local stories</a></li>
                        <li><a href="">Custumer service</a></li>
                        <li><a href="">Privacy & cookie</a></li>
                        <li><a href="">Site Map</a></li>
                        <li><a href="">Update information</a></li>
                    </ul>
                </div>
                <div class="sub-contact">
                    <h3>CONTACT-DETAILS</h3>
                    <span>Head office. Aven fashion<br>
                    180-182 Regent Strees London<br>
                    <br>
                    TelePhone +12312356<br>
                    Email:Evem@gmail.com 
                    </span>
                </div>
            </div>
           <div class="follow">
           		<div class="title">
					<span>Follow Us</span>
				</div>
				<div class="icon">
					<a href=""><i class="fab fa-instagram"></i></a>
					<a href=""><i class="fab fa-facebook-f"></i></a>
					<a href=""><i class="fab fa-twitter"></i></a>
					<a href=""><i class="fab fa-snapchat-ghost"></i></a>
				</div>
           </div>
	</div>


</body>
</html>