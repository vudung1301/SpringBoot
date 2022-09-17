<?php
	include_once '../lib/database.php';
	include_once '../helper/format.php';
?>

<?php 
	class category{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
			
		}
		public function insert_category($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if(empty($catName)){
				$alert ="Category must be not empty";
				return $alert;
			}
			else{
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
				$result=$this->db->insert($query);
				if($result){
					$alert ="<span class='success'>Insert category SuccessFully</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>INsert category not SuccessFully</span>";
					return $alert;
				}

			}
		}
		public function show_category(){
			$query = "SELECT * FROM tbl_category order by category_id desc";
				$result=$this->db->select($query);
				return 	$result;
		}

		public function getcatbyId($id){
		$query = "SELECT * FROM tbl_category where category_id ='$id'";
		$result=$this->db->select($query);
		return 	$result;
		}
		public function update_category($catName, $id){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($catName)){
				$alert ="Category must be not empty";
				return $alert;
			}
			else{
				$query = "UPDATE tbl_category SET catName ='$catName' WHERE category_id='$id'";
				$result=$this->db->update($query);
				if($result){
					$alert ="<span class='success'>update category SuccessFully</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>update category not SuccessFully</span>";
					return $alert;
				}

			}
		}
		public function del_category($id){
		$query = "DELETE FROM tbl_category where category_id ='$id'";
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
		public function show_category_frontend(){
			$query = "SELECT * FROM tbl_category order by category_id desc";
			$result=$this->db->select($query);
			return 	$result;
		}
		public function get_product_by_cat($id){
			$query = "SELECT * FROM tbl_product where category_id='$id' order by category_id desc";
			$result=$this->db->select($query);
			return 	$result;
		}
		public function get_cat_name($id){
			$query = "SELECT * FROM tbl_category where category_id='$id' order by category_id desc";
			$result=$this->db->select($query);
			return 	$result;
		}
}
?>