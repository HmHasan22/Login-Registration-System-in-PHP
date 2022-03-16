<?php
include_once "Session.php";
include "Database.php";
class User
{
    public  $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function userRegistration($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $emailCheck = $this->mailCheck($email);
        $password = md5($data['password']);

        if ($name == "" || $email == "" || $password == "") {
            $msg = "<div class='alert alert-danger'>Field must not be empty</div>";
            return $msg;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $msg = "<div class='alert alert-danger'>Email not valid</div>";
            return $msg;
        }

        // check email exist or not

        if ($emailCheck == true) {
            $msg = "<div class='alert alert-danger'>Email already exists</div>";
            return $msg;
        }

        // insert data

        $sql = "INSERT INTO register (name,email,password) VALUES(:name,:email,:password)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $result = $query->execute();
        if ($result) {
            $msg = "<div class='alert alert-success'>Data Insert Successfully!</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-success'>Something went wrong!</div>";
            return $msg;
        }
    }
    // login

    public function userLogin($data)
    {
        $email = $data['email'];
        $password = $_POST['password'];
        $emailCheck = $this->mailCheck($email);
        if ($email == "" || $password == "") {
            $msg = "<div class='alert alert-danger'>Field must not be empty</div>";
            return $msg;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "<div class='alert alert-danger'>Email is not valid</div>";
            return $msg;
        }

        if (!$emailCheck) {
            $msg = "<div class='alert alert-danger'>Email not found</div>";
            return $msg;
        }

        $result = $this->getLoginUser($email, $password);
        if($result){
            $msg = "<div class='alert alert-danger'>Login Success</div>";
            return $msg;
        }else {
            $msg = "<div class='alert alert-danger'>User not found</div>";
            return $msg; 
        }
    }

    // get login user
    public function getLoginUser($email, $password)
    {
        $sql = "SELECT * FROM register WHERE email=:email AND password=:password";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(":email",$email);
        $query->bindValue(":password",md5($password));
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }else {
            return false;
        }
    }
    public function mailCheck($email)
    {
        $sql = "SELECT email FROM register WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}