<?php
	include_once "../config/config.php";
?>
<?php
	class Database{
		public $host= DB_HOST;
		public $user= DB_USER;
		public $pass = DB_PASS;	
		public $dbname = DB_NAME;

		public $link;
		public $error;
		public function __construct(){
			$this->connectDB();
		}
		public function connectDB(){
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if(!$this->link){
				$this->error="connection Fail".$this->link->connect_error;
				return false;	
			}

		}
		
		public function select($query){
			$result= $this->link->query($query)or
			die($this->link->error.__LINE__);
			//print_r($result->num_rows);
			if(!empty($result)){
				return $result;
			}else{
				return false;
			}
		}

		public function insert($query){
			$insert_row= $this->link->query($query) or
				die($this->link->error.__LINE__);
			if($insert_row){
				return $insert_row;
			}else{
				return false;
			}
		}

		public function update($query){
			$update_row= $this->link->query($query)or
				die($this->link->error.__LINE__);
			if($update_row){
				return $update_row;
			}else{
				return false;
			}
		}


		public function delete($query){
			$delete_row= $this->link->query($query)or
			die($this->link->error.__LINE__);
			if($delete_row){
				return $delete_row;
			}else{
				return false;
			}
		}
	}
?>