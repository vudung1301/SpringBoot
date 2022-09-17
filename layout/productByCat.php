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

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$productId = $_POST['productid'];
		$quantity = 1;
		$AddToCart = $ct->add_to_cart($quantity, $productId);
	}
?>

<?php
    $cat = new category();
    if(isset($_GET['catid']) && $_GET['catid']!=NULL){
        $id = $_GET['catid'];
    }


/*    if( $_SERVER['REQUEST_METHOD']=='POST'){
        $catName= $_POST['catName'];
        $updateCat = $cat->update_category($catName, $id);
    }*/
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
				<input type="text" name="keyword" placeholder="search...">
                <button type="submit" class="btn-search">
				<i class="fas fa-search"></i>
				</button>
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
	<div class="featured">
		<div class="text_featured">
		<?php 
			$getCatName= $cat->get_cat_name($id);
			if($getCatName){
				while($result = $getCatName->fetch_assoc()){
		 ?>
			<i><?php echo $result['catName'] ?></i>
			<?php 
				}}
			 ?>
		</div>
		<div class="ruler">
			<img src="../images/ruler.png">
		</div>
	</div>
	<div class="list_product">
		<?php 
			$getproductByCat= $cat->get_product_by_cat($id);
			if($getproductByCat){
				while($result = $getproductByCat->fetch_assoc()){
		 ?>
		<div class="product">
			<div class="img">
				<img width="260px" height="340px" src="../uploads/<?php echo $result['image'] ?>" >
			</div>
			<div class="title"><a href="product_details.php?product_id=<?php echo $result['product_id']?>"><?php echo $result['productName'] ?></a></div>
			<div class="button">
				<form action="" method="POST">
					<input type="hidden" name="productid" value="<?php echo $result['product_id']?>">
					<div class="add"><button type="submit" name="submit">ADD TO CARD</button></div>
				</form>
				<div class="price"><i class="fas fa-dollar-sign"></i><?php echo $result['price']; ?></div>
			</div>
		</div>

		<?php 
			}
		}
		?>
	</div>
<!-- 	<div class="page1"><?php 
			$product_all= $product->getproduct();
			$product_count= mysqli_num_rows($product_all);
			$product_button= ($product_count/4)+1;
			//echo ceil($product_button);
			$i=1;
			for($i; $i<=$product_button; $i++){
				echo '<a style="margin:0 5px" href="index.php?trang='.$i.' ">'. $i .'</a>';
			}
		 ?>
	</div> -->
	<?php
		include'../inc/footer.php';
		
	?>

</body>
</html>