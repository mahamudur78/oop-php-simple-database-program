<?php
include_once 'Session.php';
include 'Database.php';

class User
{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function userRegistration($data){
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = md5($data['password']);
        //Check Email Exist or Not
        $check_Email = $this->checkEmail($email);
        if ($name == "" || $username == "" || $email == "" || $password == "") {
            return "<div class='alert alert-danger'><strong>Error! </strong>Field mush not be Empty</div>";
        }

        if (strlen($username) < 3) {
            return "<div class='alert alert-danger'><strong>Username too short</strong></div>";
        } elseif (preg_match('/[^a-z0-9_-]+i/',$username)) {
            return "<div class='alert alert-danger'><strong>Error! </strong>Username must only contain alphanumerical, dashes and underscores!</div>";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            return "<div class='alert alert-danger'><strong>Error! </strong>Email address not veladate.</div>";
        }

        if($check_Email == true){
            return "<div class='alert alert-danger'><strong>Error! </strong>Email address already Exist!</div>";
        }

        $sql = "INSERT INTO tbl_user(name, username, email, password) VALUES(:name, :username, :email, :password)";
        $quary = $this->db->pdo->prepare($sql);
        $quary->bindvalue(':name', $name);
        $quary->bindvalue(':username', $username);
        $quary->bindvalue(':email', $email);
        $quary->bindvalue(':password', $password);
        $result = $quary->execute();

        if(isset($result)){
            return "<div class='alert alert-success'><strong>Success! </strong>Thank you, You have been Registered.</div>";
        }else{
            return "<div class='alert alert-danger'><strong>Error! </strong>Sorry, There has been problem inserting your details.</div>"; 
        }

    }

    public function checkEmail($email){
        $sql = "SELECT email FROM tbl_user WHERE email = :email";
        $quary = $this->db->pdo->prepare($sql);
        $quary->bindValue(':email', $email);
        $quary->execute();
        if($quary->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function userLogin($data){
        $email = $data['email'];
        $password = md5($data['password']);

        if ($email == "" || $password == "") {
            return "<div class='alert alert-danger'><strong>Error! </strong>Field mush not be Empty</div>";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            return "<div class='alert alert-danger'><strong>Error! </strong>Email address not veladate.</div>";
        }

        $result = $this->getLoginUser($email, $password);

        if($result){
            Session::init();
            Session::set("login", true);
            Session::set("id", $result->id);
            Session::set("name", $result->name);
            Session::set("username", $result->username);
            Session::set("loginMsg", "<div class='alert alert-success'><strong>Success! </strong>You are loggedIn!</div>" );
            header("Location: index.php");
        }else{
            return "<div class='alert alert-danger'><strong>Error! </strong>Email and Password Incorrect!</div>";
        }

    }

    private function getLoginUser($email, $password){
        $sql = "SELECT * FROM `tbl_user` WHERE email= :email AND password= :password LIMIT 1";
        $quary = $this->db->pdo->prepare($sql);
        $quary->bindValue(":email", $email);
        $quary->bindValue(":password", $password);
        $quary->execute();
        return $quary->fetch(PDO::FETCH_OBJ);

    }

    public function getUserData(){
        $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
        $quary = $this->db->pdo->prepare($sql);
        $quary->execute();
        return $quary->fetchAll();
    }

    public function getUserById($id){
        $sql = "SELECT * FROM `tbl_user` WHERE id = :id LIMIT 1";
        $quary = $this->db->pdo->prepare($sql);
        $quary->bindValue( ":id", $id );
        $quary->execute();
        return $quary->fetch(PDO::FETCH_ASSOC);



    }

    public function updateUserData($id, $data){
        $sql = "UPDATE tbl_user SET name = :name, username= :username, email= :email WHERE id= :id";
        $quary = $this->db->pdo->prepare($sql);
        $quary->bindValue( ":name", $data['name'] );
        $quary->bindValue( ":username", $data['username'] );
        $quary->bindValue( ":email", $data['email'] );
        $quary->bindValue( ":id", $id );
        $quary->execute();
        return "<div class='alert alert-success'><strong>Success! </strong>User Data updated.</div>";
    }

    public function setNewPassword($id, $data){
        $sql = "SELECT * FROM `tbl_user` WHERE id = :id LIMIT 1";
        $quary = $this->db->pdo->prepare($sql);
        $quary->bindValue( ":id", $id );
        $quary->execute();
        $userData =$quary->fetch(PDO::FETCH_ASSOC);
        
        if($userData['password'] == md5($data['cPassword'])){
            if($data['nPassword'] == $data['rNPassword'] && $data['nPassword'] != ""){
                $sql = "UPDATE tbl_user SET password = :password WHERE id= :id";
                $quary = $this->db->pdo->prepare($sql);
                $quary->bindValue( ":password", md5($data['nPassword']) );
                $quary->bindValue( ":id", $id );
                $quary->execute();
                return "<div class='alert alert-success'><strong>Success! </strong>Password Change Successfully</div>";
            }else{
                return "<div class='alert alert-danger'><strong>Error! </strong>Your New Password and Renew Password not Match!</div>";
            }
        }else{
            return "<div class='alert alert-danger'><strong>Error! </strong>Current Password Incorrect!</div>";
        }

    }
}

$test = new User();

print_r($test-> getUserById(30));


