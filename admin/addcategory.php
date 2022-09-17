<?php
include_once "../classes/category.php";
include_once "../lib/session.php";

?>

<?php 
    $cat= new category();
    if( $_SERVER['REQUEST_METHOD']=='POST'){
        $catName= $_POST['catName'];
        $insertcat = $cat->insert_category($catName);
    }
?>
<!Doctype HTML>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../css/add_product.css" type="text/css"/>
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
<span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >&#9776; Product</span>
<span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >&#9776; Product</span>
</div>
    
    <div class="col-div-6">
</div>
    <div class="clearfix"></div>
  
    <form action="addcategory.php" method="post">
    <div class="addproduct">
        <div class="title">
              <?php
                if(isset($insertcat)){
                    echo $insertcat;
                }
                ?>
            <p>Category</p>
            <input type="text" name="catName" placeholder="category">
        </div>
        <div class="button">
            <input class="button-41" type="submit" name="submit" value="SAVE"/>
        </div>
    </div>
    </form>
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
