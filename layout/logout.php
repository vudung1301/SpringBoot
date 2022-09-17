<?php
session_start();
include_once '../config/config.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$ldate=date( 'd-m-Y h:i:s A', time() );
mysqli_query($con,"UPDATE tbl_customerlog SET logoutTime = '$ldate' WHERE user = '".$_SESSION['customer_user']."' ORDER BY id DESC LIMIT 1");
session_unset();
?>
<script language="javascript">
    alert("You have successfully logout!");
    document.location="index.php";
</script>