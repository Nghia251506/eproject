<?php
    class UserModel{
        private $__conn;
        public function __construct($conn)
        {
            $this->__conn = $conn;
        }

        public function login($username, $pass){
            try{
                if(isset($this->__conn)){
                    $sql = "select * from users where username = :username AND password = :pass";
                    $stmt = $this->__conn->prepare($sql);
                    $stmt->bindParam("username", $username, PDO::PARAM_STR);
                    $stmt->bindParam("pass", $pass, PDO::PARAM_STR);
                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_OBJ);
                }
                return null;
            }catch(PDOException $ex){
                echo $ex->getMessage();
            }
        }

        public function registerUser($name, $email,$phone,$address,$date_of_birth,$username, $password,$department_id, $role) {
            try {
                if (isset($this->__conn)) {
                    $sql = "insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`department_id`,`role`) values (:name,:email,:phone,:address,:date_of_birth,:username,:password,:department_id,:role)";
                    $stmt = $this->__conn->prepare($sql);
                    $stmt->bindParam("name", $name, PDO::PARAM_STR);
                    $stmt->bindParam("email", $email, PDO::PARAM_STR);
                    $stmt->bindParam("phone", $phone, PDO::PARAM_STR);
                    $stmt->bindParam("address", $address, PDO::PARAM_STR);
                    $stmt->bindParam("date_of_birth", $date_of_birth, PDO::PARAM_STR);
                    $stmt->bindParam("username", $username, PDO::PARAM_STR);
                    $stmt->bindParam("password", $password, PDO::PARAM_STR);
                    $stmt->bindParam("department_id", $department_id, PDO::PARAM_INT);
                    $stmt->bindParam("role", $role, PDO::PARAM_STR);
                    $stmt->execute();
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
        
    }

?>