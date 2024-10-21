<?php
    class ContactModel {
        private $__conn;
        public function __construct($conn){
            $this->__conn = $conn;
        }

        public function getAllContact($limit, $offset){
            try{
                if(isset($this->__conn)){
                    $sql = "SELECT * FROM contacts ORDER BY id DESC LIMIT :limit OFFSET :offset";
                    $stmt = $this->__conn->prepare($sql);
                    $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
                    $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_OBJ);
                }
                return null;
            }catch(PDOException $ex){
                echo "ERROR". $ex->getMessage();
            }
        }

        public function addContact($name, $phone_number, $email, $company,$title, $question){
            try {
                if (isset($this->__conn)) {
                    // The statement inserts data into the customer table
                    $sql = "INSERT INTO contacts (`name`, `phone_number`, `email`, `company`, `title`, `question`) VALUES (:name, :phone_number, :email, :company, :title, :question)";
    
                    // Prepare the command
                    $stmt = $this->__conn->prepare($sql);
    
                    // Assign values ​​to parameters
                    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                    $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":company", $company, PDO::PARAM_STR);
                    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
                    $stmt->bindParam(":question", $question, PDO::PARAM_STR);
                    // Execute the command
                    return $stmt->execute();
                }
                return null;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function countAllPContacts()
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT COUNT(*) FROM customers";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchColumn();
            }
            return 0;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    }