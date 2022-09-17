<?php
    include '../lib/session.php';
    include '../lib/database.php';
    include '../helper/format.php';
?>
<?php
    class adminlogin
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminUser, $adminPass)
        {
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass))
            {
                $alert = "Không được để trống user hoặc pass";
                return $alert;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
                $result = $this->db->select($query);
                $count = mysqli_num_rows($result);
                if($count > 0){
                    $value = $result->fetch_assoc();
                    Session::set('checkLoginAdmin',true);
                    Session::set('adminid',$value['adminid']);
                    Session::set('adminUser',$value['adminUser']);
                    Session::set('adminName',$value['adminName']);
                    header('Location:admin.php');
                }else{
                    $alert = "Không tồn tại tài khoản";
                    return $alert;
                    header('Location:adminlogin.php');
                }
            }

        }
    }
    
    
?>