<?php
	include_once '../lib/database.php';
	include_once '../helper/format.php';
?>

<?php 
	class user{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
			
		}
		public function show_user(){
			$query = "SELECT * FROM tbl_customer order by id desc";
			$result=$this->db->select($query);
			return 	$result;
		}

		public function del_user($id){
			$query = "DELETE FROM tbl_customer where id ='$id'";
			$result=$this->db->delete($query);
			if($result){
				$alert ="<span class='success'>delete category SuccessFully</span>";
				return $alert;
			}
			else{
				$alert ="<span class='error'>delete category not SuccessFully</span>";
				return $alert;
			}
		}
	}
?>