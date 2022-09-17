<?php
	include_once '../lib/database.php';
	include_once '../helper/format.php';
	include_once '../lib/session.php';
?>

<?php 
	class customer{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			//$this->fm = new Format();
			
		}
		public function insert_customer($data){
			$user = mysqli_real_escape_string($this->db->link, $data['user']);
			$address = mysqli_real_escape_string($this->db->link,  $data['address']);
			$email = mysqli_real_escape_string($this->db->link,  $data['email']);
			$phone= mysqli_real_escape_string($this->db->link, $data['phone']);
			$password= mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($user=="" || $address==""||$email==""|| $phone=="" || $password==""){
				$alert ="Not be not empty";
				return $alert;
			}else{
/*				$check_user="SELECT * FROM tbl_customer WHERE user='$user'";
				$result_check_user=$this->db->select($check_user);
				if ($result_check_user) {
					$alert="User exist";
					return $alert;
				}*/
				$query="INSERT INTO tbl_customer(user,address,email,phone,password) VALUES('$user','$address','$email','$phone','$password')";
				 header('Location: login.php');
				$result=$this->db->insert($query);
				if($result){
				$alert="Create Acount Success";
				return $alert;
				}
				else{
					$alert="Create Acount Success";
					return $alert;
				}
			}

		}
		public function login_customer($data){
			$user= mysqli_real_escape_string($this->db->link, $data['user']);
			$password= mysqli_real_escape_string($this->db->link, md5($data['password']));
			if($user=="" || $password==""){
				$alert ="Not be not empty";
				return $alert;
			}else{
				$check_login="SELECT * FROM tbl_customer WHERE user='$user' AND password='$password'" ;
				$result_check_user = $this->db->select($check_login);
				$count = mysqli_num_rows($result_check_user);
				if ($count > 0) {
					$value=	$result_check_user->fetch_assoc();
					Session::set('customer_login', 1);
					Session::set('customer_id', $value['id']);
					Session::set('customer_user', $value['user']);
					$uip=$_SERVER['REMOTE_ADDR'];
					$query = "INSERT into tbl_customerlog(user,userIp,status) values('".$_SESSION['customer_user']."','$uip','1')";
					$this->db->select($query);
					header('Location: index.php');
				}
				else{
					$alert="User or Password not match";
					return $alert;
				}
			}
		}

		public function getuser(){
		$query = "SELECT * FROM tbl_customer";
			$result=$this->db->select($query);
			return 	$result;
		}
		
		public function get_user_info($userID) {
		$sID = session_id();
		$query = "SELECT * FROM tbl_customer WHERE id = '$userID'";
		$result = $this->db->select($query);
		return $result;
	}	


}
?>