<?php
	include_once '../classes/category.php';
?>
<?php 

    $cat= new category();
     if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $deleteCat= $cat->del_category($id);
    }

?>
<!Doctype HTML>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/productManage.css" type="text/css"/>
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
<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Category</span>
<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Category</span>
</div>
	
	<div class="col-div-6">
</div>
	<div class="clearfix"></div>
	<div class="addproduct">
		<button class="button-41" type="submit"><a href="addcategory.php" >ADD CATEGORY</a></button>
	</div>
	<div class="listproduct">
		<table>
		 <?php
        if(isset($deleteCat)){
            echo $deleteCat;
        }
    	?>
			<tr>
				<td>No.</td>
				<td>Name</td>
				<td>action</td>
			</tr>
			<?php
			$show = $cat->show_category();
			if($show){
				$i=0;
				while($result=$show->fetch_assoc()){
					$i++;
				
			?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $result['catName']?></td>
				<td><button class="button-42"><a href="categoryedit.php?category_id=<?php echo $result['category_id']?>">edit </a></button> <button class="button-42"><a onclick="return confirm('Are you want delete ?')" href="?delete_id=<?php echo $result['category_id']?>"> delete</a></button></td>
			</tr>
			<?php
				}
			}
			?>
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
