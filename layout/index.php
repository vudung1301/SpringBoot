<?php
	include_once '../inc/header.php';
	include '../classes/category.php';
	include '../classes/product.php';
	include '../classes/user.php';
	include '../classes/order.php';
	// session_start();
?>
<?php
 	include_once '../lib/database.php';
	include_once '../helper/format.php';

	/*sql_autoload_register(function($className){
		include_once "classes/".$className."php";
	});*/

	$db= new Database();
	$fm= new Format();
	$order= new order();
	$us= new user();
	$cat= new category();
	$product= new product();
	

	if(isset($_GET['action']) && $_GET['action']=="add"){
		$id=intval($_GET['id']);
		if(isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id]['quantity']++;
		}else{
			$sql_p="SELECT * FROM tbl_product WHERE product_id = '$id'";
			$query_p=mysqli_query($con,$sql_p);
			if(mysqli_num_rows($query_p)!=0){
				$row_p=mysqli_fetch_array($query_p);
				$_SESSION['cart'][$row_p['product_id']]['quantity'] = 1;
			
			}else{
				echo "<script>alert('Error!')</script>";;
			}
		}
			echo "<script>alert('Product has been added to the cart')</script>";
			echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
	}

	if(isset($_GET['action']) && $_GET['action']=="like"){
		if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
			$proId=intval($_GET['product_id']);
			$checkQue = mysqli_query($con, "SELECT * FROM tbl_wishlist WHERE product_id = '$proId'");
			if(mysqli_num_rows($checkQue) > 0) {
				mysqli_query($con, "DELETE FROM tbl_wishlist WHERE product_id = '$proId'");
				header("location:index.php");
			} else {
				mysqli_query($con, "INSERT INTO tbl_wishlist(user_id, product_id) VALUES('".$_SESSION['customer_id']."', '$proId')");
				header("location:index.php");
			}
		}
	}
?>
<?php 
		$con = mysqli_connect("localhost","root","","mvcwebsite");
		if(isset($_GET['tukhoa']) &&!empty($_GET['tukhoa']))
		{
			$key= $_GET['tukhoa'];
			$query= "SELECT *FROM tbl_product where productName like '%$key%' OR price like '%$key%' OR brand like '%$key%' ";
		}else{
			$query="SELECT * FROM tbl_product order by product_id";
		}
		$resultlooking=mysqli_query($con,$query);
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tổng kết</title>
	<link rel="stylesheet" type="text/css" href="../css/style1.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body>
	<div class="menu">
		<ul>
			<li><a href=""><i class="fas fa-home"></i>Desktops</a></li>
			<li><a href="">Categories</a>
				<ul class="sub_menu">
					<?php 
						$getall_category= $cat->show_category_frontend();
						if($getall_category){
							while($result_allcat= $getall_category->fetch_assoc()){

					 ?>
					 <li><a href="productByCat.php?catid=<?php echo $result_allcat['category_id'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
					<!-- <li><a href="">LV</a></li>
					<li><a href="">Gucci</a></li>
					<li><a href="">Hermes</a></li>
					<li><a href="">H&M</a></li> -->
					<?php 
						}
					}
					 ?>
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
				<form action="" method="GET">
					<input type="text" name="tukhoa" placeholder="search...">
               		<input type="submit" name="timkiem"  class="btn-search" value="Tìm Kiếm" >
				</form>
			</div>
		</div>
	</div>
	<div class="banner">
		<div class="shop">
			<a href="#" class="btn-default">shop now</a>
		</div>
		<div class="img">
			<img src="../images/banner.png" width="100%">
		</div>
	</div>
		<!-- TIM KIEM SAN PHAM -->
		<?php
			if(isset($_GET['timkiem'])){
		?>
	<div class="featured">
		<div class="text_featured">
			<i>LOOKING</i>
		</div>
		<div class="ruler">
			<img src="../images/ruler.png">
		</div>
	</div>
	<div class="list_product">
		<?php 
				while($result = $resultlooking->fetch_assoc()){
		 ?>
		<div class="product">
			<div class="img">
				<img width="260px" height="340px" src="../uploads/<?php echo $result['image'] ?>" >
			</div>
			<div class="title"><a href="product_details.php?product_id=<?php echo $result['product_id']?>"><?php echo $result['productName'] ?></a></div>
			<?php
				if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
					?>
					<a style="color: black" href="?action=like&product_id=<?php echo $result['product_id']?>">
				<?php
					$query_like = mysqli_query($con, "SELECT * FROM tbl_wishlist WHERE product_id = '".$result['product_id']."'");
					if (mysqli_num_rows($query_like) > 0) {
				?>
				<span class="home-product-item__like <?php echo 'home-product-item__like--liked'?>">
					<?php 
					}
				}
				?>
					<i class="home-product-item__like-icon far fa-heart"></i>	
					<i class="home-product-item__liked-icon fas fa-heart"></i>
				</span>
			</a>
			<div class="button">
					<div class="add"><button><a href="index.php?page=product&action=add&id=<?php echo $result['product_id'];?>"> ADD TO CARD</a></button></div>
				<div class="price"><i class="fas fa-dollar-sign"></i><?php echo $result['price']; ?></div>
			</div>
		</div>

		<?php 
		}
		?>
	</div>
	<?php
			} else {
		?>
	<div class="featured">
		<div class="text_featured">
			<i>FEATURED</i>
		</div>
		<div class="ruler">
			<img src="../images/ruler.png">
		</div>
	</div>
	<div class="list_product">
		<?php 
			$getallproduct= $product->getproduct();
			if($getallproduct){
				while($result = $getallproduct->fetch_assoc()){
		 ?>
		<div class="product">
			<div class="img">
				<img width="260px" height="340px" src="../uploads/<?php echo $result['image'] ?>" >
			</div>
			<div class="title"><a href="product_details.php?product_id=<?php echo $result['product_id']?>"><?php echo $result['productName'] ?></a></div>
			<?php
				if(isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == 1) {
			?>
			<a style="color: black" href="?action=like&product_id=<?php echo $result['product_id']?>">
				<?php
					$query_like = mysqli_query($con, "SELECT * FROM tbl_wishlist WHERE product_id = '".$result['product_id']."'");
					if (mysqli_num_rows($query_like) > 0) {
				?>
				<span class="home-product-item__like <?php echo 'home-product-item__like--liked'?>">
					<?php 
					}
				}
				?>
					<i class="home-product-item__like-icon far fa-heart"></i>	
					<i class="home-product-item__liked-icon fas fa-heart"></i>
				</span>
			</a>
			<div class="button">
				<div class="add"><button> <a href="index.php?page=product&action=add&id=<?php echo $result['product_id'];?>"> ADD TO CARD</a></button></div>				</form>
				<div class="price"><i class="fas fa-dollar-sign"></i><?php echo $result['price']; ?></div>
			</div>
		</div>

		<?php 
			}
		}
		?>
	</div>
	<div class="page1"><?php 
			$product_all= $product->getproduct();
			$product_count= mysqli_num_rows($product_all);
			$product_button= ($product_count/4)+1;
			//echo ceil($product_button);
			$i=1;
			for($i; $i<=$product_button; $i++){
				echo '<a style="margin:0 5px" href="index.php?trang='.$i.' ">'. $i .'</a>';
			}
		 ?>
	</div>
	<?php 
		}
		?>


	<div class="featured">
		<div class="text_featured">
			<i>BRANDS</i>
		</div>
		<div class="ruler">
			<img src="../images/ruler.png">
		</div>
	</div>
	<div class="brands">
		<div class="img">
			<img src="../images/brand.png">
		</div>
		<div class="right">
			<a href=""><i class="fas fa-chevron-right"></i></a>
		</div>
	</div>
	<div class="featured">
		<div class="text_featured">
			<i>LATEST</i>
		</div>
		<div class="ruler">
			<img src="../images/ruler.png">
		</div>
	</div>
	<div class="popular">
		<div class="product_popular">
			<img src="../images/1.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
		<div class="product_popular">
			<img src="../images/2.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
		<div class="product_popular">
			<img src="../images/3.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
		<div class="product_popular">
			<img src="../images/4.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
	</div>
	<div class="popular">
		<div class="product_popular">
			<img src="../images/5.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
		<div class="product_popular">
			<img src="../images/6.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
		<div class="product_popular">
			<img src="../images/7.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
		<div class="product_popular">
			<img src="../images/8.jpg">
			<div class="title"><a href="product_details.php">Hello Kitty-Baby</a></div>
			<div class="icon">
				<a><i class="fab fa-instagram"></i></a>
				<a><i class="far fa-heart"></i></a>
				<a><i class="fal fa-cart-plus"></i></a>
			</div>
		</div>
	</div>
	<div class="number">
		<div class="page">
			<a href=""><</a>
			<a href="">1</a>
			<a href="">2</a>
			<a href="">3</a>
			<a href="">4</a>
			<a href="">5</a>
			<a href="">></a>
		</div>
	</div>

	<?php
		include'../inc/footer.php';
		
	?>

</body>
</html>