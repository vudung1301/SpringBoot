<?php
	include '../inc/header.php';
    include_once '../lib/database.php';
    include_once '../helper/format.php';
?>

<?php
    if(isset($_GET['action']) && $_GET['action']=="add"){
		$id = intval($_GET['productid']);
		if(isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id]['quantity']++;
		}else{
			$sql_p="SELECT * FROM tbl_product WHERE product_id={$id}";
			$query_p=mysqli_query($con,$sql_p);
			if(mysqli_num_rows($query_p)!=0){
				$row_p=mysqli_fetch_array($query_p);
				$_SESSION['cart'][$row_p['product_id']]['quantity'] = 1;
			
			}else{
				$message="Product ID is invalid";
			}
		}
			echo "<script>alert('Product has been added to the cart')</script>";
			echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
	}

    if(isset($_GET['action']) && $_GET['action']=="delete"){
		$id = intval($_GET['productid']);
		$sql = "DELETE FROM tbl_wishlist WHERE product_id = '$id'";
		$query_p = mysqli_query($con,$sql);
        if($query_p){
            echo "<script>alert('Product has been delete from wishlist!')</script>";
            echo "<script type='text/javascript'> document.location ='wishlist.php'; </script>";		
        } else{
            echo "<script>alert('Error!')</script>";
        }
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Product_details</title>
        <link rel="stylesheet" type="text/css" href="../css/wishlist.css">
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
        <h1 style="text-align: center;">My Wishlist</h1>
        <div class="container">
            <div class="cart transition is-open">
                <div class="table">
                    <div class="layout-inline row th">
                        <div class="col">Image</div>
                        <div class="col  col-pro align-center">Product Name</div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                    <?php
                        $sql = "SELECT * FROM tbl_wishlist WHERE user_id = '".$_SESSION['customer_id']."' ORDER BY postDate ASC";
                        $query = mysqli_query($con,$sql);
                        $count = mysqli_num_rows($query);
                        if($count>0){
                            while($result = mysqli_fetch_array($query)){
                                $query2 = mysqli_query($con,"SELECT * FROM tbl_product WHERE product_id = '".$result['product_id']."'");
                                $result2 = mysqli_fetch_assoc($query2);
                    ?>
                    <form action="" method="post">
                        <div class="layout-inline row"> 
                            <div class="col layout-inline">
                            <a href="product_details.php?product_id=<?php echo $result2['product_id'];?>"><img src="../uploads/<?php echo $result2['image']; ?>" alt="kitten" /></a>
                            </div>
                            <div class="col col-pro align-center">
                                    <p><a href="product_details.php?product_id=<?php echo $result2['product_id'];?>"><?php echo $result2['productName']; ?></a></p>
                            </div>
                            <div class="col layout-inline">
                                <button class="btn btn-add" >
                                    <a href="?action=add&productid=<?php echo $result2['product_id']; ?>">
                                        Add
                                    </a>
                                </button>
                            </div>
                            <div class="col layout-inline">
                                <button class="btn btn-del">
                                    <a href="?action=delete&productid=<?php echo $result2['product_id']; ?>">
                                        Remove
                                    </a>
                                </button>
                            </div>
                        </div>
                    </form>
                            <?php
                            } 
                        }else {
                            echo "<h3>Không có sản phẩm trong wishlist!</h3>";
                        }

                        ?> 
                </div>
            </div>
        </div>
        <?php
            include '../inc/footer.php';
        ?>
    </body>
</html>