<?php
	include_once '../lib/database.php';
	include_once '../helper/format.php';
?>

<?php 
	class order{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
			
		}

		public function get_all_order(){
			$query = "SELECT * FROM tbl_order";
			$result = $this->db->select($query);
			return $result;
		}

		public function get_order_checkout($userID){
			$query = "SELECT * FROM tbl_order WHERE userID = '$userID'";
			$result = $this->db->select($query);
			return $result;
		}

		public function delivered_order($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "UPDATE tbl_order SET status = 'Delivered' WHERE id = '$id'";
			$result = $this->db->update($query);
			date_default_timezone_set('Asia/Ho_Chi_Minh');
      		$_SESSION['date']=date( 'd-m-Y h:i:s A', time() );
			$query2 = "UPDATE tbl_ordertrackhistory SET status = 'Delivered', updateTime = '".$_SESSION['date']."'
			WHERE order_id = '$id'";
			$result2 = $this->db->update($query2);
			if ($result && $result2){
				unset($_SESSION['date']);
				echo "<script> alert('Order is delivered!')</script>";
				header("Location:order.php");
			} else {
				echo "<script> alert('Lỗi!')</script>";
			}
		}

		public function acp_order($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "UPDATE tbl_order SET status = 'On Way' WHERE id = '$id'";
			$result = $this->db->update($query);
			date_default_timezone_set('Asia/Ho_Chi_Minh');
      		$_SESSION['date']=date( 'd-m-Y h:i:s A', time() );
			$query2 = "UPDATE tbl_ordertrackhistory SET status = 'On Way', updateTime = '".$_SESSION['date']."'
			WHERE order_id = '$id'";
			$result2 = $this->db->update($query2);
			if ($result && $result2){
				unset($_SESSION['date']);
				echo "<script> alert('Taking Order Successfully!')</script>";
				header("Location:order.php");
			}
		}
		public function deny_order($id){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "UPDATE tbl_order SET status = 'Deny' WHERE id = '$id'";
			$result = $this->db->update($query);
			date_default_timezone_set('Asia/Ho_Chi_Minh');
      		$_SESSION['date']=date( 'd-m-Y h:i:s A', time() );
			$query2 = "UPDATE tbl_ordertrackhistory SET status = 'Deny', updateTime = '".$_SESSION['date']."'
			WHERE order_id = '$id'";
			$result2 = $this->db->update($query2);
			if ($result && $result2){
				unset($_SESSION['date']);
				echo "<script> alert('Deny Order Successfully!')</script>";
				header("Location:order.php");
			}
		}
		
}
?>