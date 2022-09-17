<?php
	include'../inc/header.php';
	include '../lib/session.php';
	include '../classes/category.php';
	include '../classes/product.php';
	include '../classes/user.php';
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
	$ct= new category();
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product_details</title>
	<link rel="stylesheet" type="text/css" href="../css/Product_Details.css">
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
				<button type="submit"> <a class="delBtn" href="cart.php?product_id=<?php echo $result_details['product_id']; ?>">
                <span>Thêm vào giỏ  </span>
            </a><i class="fas fa-cart-plus"></i>
        </button>
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