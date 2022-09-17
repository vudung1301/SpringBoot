<?php
include_once "../classes/category.php";
include_once "../lib/session.php";
include_once "../classes/product.php";
?>
<?php
    $pd = new product();
    if(isset($_POST['btn-submit'])){
        $updateProduct = $pd->update_product($_POST,$_FILES,$_POST['product_id']);
        
    }
    
    if(!isset($_GET['product_id']) || empty($_GET['product_id'])){
        echo "<script> window.location = 'productManage.php'</script>";
        // die('loi');
    }else{
        $id = $_GET['product_id'];
    }
?>
<!Doctype HTML>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/productmanage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
    <?php
        if(isset($updateProduct)){
            echo $updateProduct;
        }
    ?>
    <?php 
        $get_product_by_id = $pd->getproductbyId($id);
        if($get_product_by_id){
            while($result_product = $get_product_by_id->fetch_assoc()){

    ?>
    <form action="productedit.php" method="post" enctype="multipart/form-data">
        <table class="form1">
            <tr>
                <td>Category</td>
                <td><select id="category" name="category">
                <option>Select Category</option>
                <?php
                $cat= new category();
                $catlist= $cat->show_category();
                if($catlist){
                    while($result= $catlist->fetch_assoc()){
                ?>
                <option

                <?php 
                    if($result['category_id']==$result_product['category_id']){echo 'selected' ;}
                 ?>
                 value="<?php echo $result['category_id']?>"><?php echo $result['catName']?> </option> 
                <?php
                  }
                }
                ?>
            </select></td>
            </tr>
            <tr>
                <td>Product Name</td>
                <td><input type="text" name="title" value="<?php echo $result_product['productName'] ?>"></td>
            </tr>
            <input type="hidden" name="product_id" value="<?php echo $id ?>">
            <tr>
                <td>Description</td>
                <td style="background:white;"><textarea style="color:white;" id="summernote" type="text" name="description" value="<?php echo $result_product['description'] ?>"><?php echo $result_product['description'] ?></textarea></td>
            </tr>

             <tr>
                <td>Choose image</td>
                <td><img src="../uploads/<?php echo $result_product['image']?>" width="50px"; height="80px";><input required type="file" id="image" name="image"></td>
                <td></td>
            </tr>

            <tr>
                <td>Price</td>
                <td><input type="text" name="price" placeholder="price" value="<?php echo $result_product['price'] ?>"></td>
            </tr>

            <tr>
                <td>Price-sell</td>
                <td><input type="text" name="price_sell" placeholder="price_sell"value="<?php echo $result_product['price_sell'] ?>"></td>
            </tr>
            
            <tr>
                <td>Brand</td>
                <td><input type="text" name="brand" placeholder="brand" value="<?php echo $result_product['brand'] ?>"></td>
            </tr>
            <tr>
                <td><input class="button-41" type="submit" name="btn-submit" value="update"></td>
            </tr>
        </table>
    </form>
    <?php 
        }
    }
     ?>
</div>
</div>
<script>
    $('#summernote').summernote({
        placeholder: 'description',
        tabsize: 1,
        height: 120,

        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
</script>

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
