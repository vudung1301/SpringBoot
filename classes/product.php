<?php
	include_once '../lib/database.php';
	include_once '../helper/format.php';
?>

<?php 
	class product{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			//$this->fm = new Format();
			
		}
		public function insert_product($data, $files){
		
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$title = mysqli_real_escape_string($this->db->link,  $data['title']);
			$description = mysqli_real_escape_string($this->db->link,  $data['description']);
			$price = mysqli_real_escape_string($this->db->link,  $data['price']);
			$price_sell = mysqli_real_escape_string($this->db->link,  $data['price_sell']);
			$brand = mysqli_real_escape_string($this->db->link,  $data['brand']);

			$permited= array('jpg', 'jpeg','png','gif');
			$file_name= $_FILES['image']['name'];
			$file_size= $_FILES['image']['size'];
			$file_temp= $_FILES['image']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image= substr(md5(time()),0,10).'.'.$file_ext;
			$uploaded_image = "../uploads/".$unique_image;



			if($category=="" || $title==""||$description==""|| $price=="" || $price=="" || $price_sell=="" || $brand=="" ||$file_name==""){
				$alert ="files not be not empty";
				return $alert;
			}
			else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_product(productName,category_id,price,description,price_sell,brand,image) VALUES('$title','$category','$price','$description','$price_sell','$brand','$unique_image')";
				$result=$this->db->insert($query);
				if($result){
					$alert ="<span class='success'>Insert product SuccessFully</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>INsert product not SuccessFully</span>";
					return $alert;
				}

			}
		}
		public function show_product(){
			/*$query = "SELECT * FROM tbl_product order by product_id desc";*/
			$query="SELECT tbl_product.*, tbl_category.catName FROM tbl_product INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id order by tbl_product.product_id desc";
				$result=$this->db->select($query);
				return 	$result;
			}
		
		public function getproductbyId($id){
			$query = "SELECT * FROM tbl_product where product_id ='$id'";
			$result=$this->db->select($query);
			return 	$result;
		}
		
		public function update_product($data, $files, $id){
			$alert ="<span class='success'>update category SuccessFully</span>"; 
			$category_id = mysqli_real_escape_string($this->db->link, $data['category']);
			$title = mysqli_real_escape_string($this->db->link,  $data['title']);
			$description = mysqli_real_escape_string($this->db->link,  $data['description']);
			$price = mysqli_real_escape_string($this->db->link,  $data['price']);
			$price_sell = mysqli_real_escape_string($this->db->link,  $data['price_sell']);
			$brand = mysqli_real_escape_string($this->db->link,  $data['brand']);
			$permited= array('jpg', 'jpeg','png','gif');
			$file_name= $_FILES['image']['name'];
			$file_size= $_FILES['image']['size'];
			$file_temp= $_FILES['image']['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image= substr(md5(time()),0,10).'.'.$file_ext;
			$uploaded_image = "../uploads/".$unique_image;


			if($category_id=="" || $title==""||$description==""|| $price=="" || $price=="" || $price_sell=="" || $brand=="" ||$file_name==""){
				$alert ="files not be not empty";
				return $alert;
			}
			else{
				if(!empty($file_name)){
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_product SET category_id ='$category_id',productName ='$title',description ='$description',price ='$price',price_sell ='$price_sell',brand ='$brand',image='$unique_image' WHERE product_id= '$id'";
					$result=$this->db->update($query);
					if($result){
					$alert ="<span class='success'>update category SuccessFully</span>";
					return $alert;
					}
					else{
						$alert ="<span class='success'>update category not SuccessFully</span>";
						return $alert;
					}
				}
			}
		}
		public function del_product($id){
		$query = "DELETE FROM tbl_product where product_id ='$id'";
		$result=$this->db->delete($query);
		if($result){
			$alert ="<span class='success'>delete product SuccessFully</span>";
			return $alert;
		}
		else{
			$alert ="<span class='error'>delete product not SuccessFully</span>";
			return $alert;
		}
	}


	public function getproduct(){
		$so_tungtrang=4;
		if(!isset($_GET['trang'])){
			$trang=1;
		}
		else{
			$trang =$_GET['trang'];
		}
		$tung_trang=($trang-1)*$so_tungtrang;

		$query = "SELECT * FROM tbl_product order by product_id desc LIMIT $tung_trang,$so_tungtrang";
				$result=$this->db->select($query);
				return 	$result;
	}

	public function get_detail($id){
	$query="SELECT tbl_product.*, tbl_category.catName FROM tbl_product INNER JOIN tbl_category
	 ON tbl_product.category_id = tbl_category.category_id where tbl_product.product_id='$id'";
		$result=$this->db->select($query);
		return 	$result;
	}
}
?>