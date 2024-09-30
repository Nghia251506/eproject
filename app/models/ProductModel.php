<?php
class ProductModel
{
    private $__conn;
    public function __construct($conn)
    {
        $this->__conn = $conn;
    }
    //This function is used to retrieve all products
    public function getAllProduct($limit = 10, $offset = 0)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "select * from products order by id desc LIMIT :limit OFFSET :offset";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
                $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            return null; //Returns null if there is no connection to the database
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getProductById($id)
    {
        try {
            if ($this->__conn) {
                $sql = "select * from products where id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    // The saveProduct function is commonly used for editing and adding new products
    public function saveProduct($data)
    {
        try {
            if (isset($his->__conn)) {
                // This query uses on DUPLICATE to both add new product values ​​and edit product values.
                $sql = "insert into products (`name`, `code`, `type_id`,`watt`, 
                `socket`,`color`,`purchase_price`,`sale_price`,`quantity`,`brand_id`,`image_url`) 
                values (:name, :code, :type_id, :watt, :socket, :color, :purchase_price, :sale_price,:quantity, :brand_id, :image_url)
                ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                code = VALUES(code),
                type_id = VALUES(type_id),
                watt = VALUES(watt),
                socket = VALUES(socket),
                color = VALUES(color),
                purchase_price = VALUES(purchase_price),
                sale_price = VALUES(sale_price),
                quantity = VALUES(quantity),
                brand_id = VALUES(brand_id)
                image_url = VALUES(image_url)";
                // This line is used to Prepare statement
                $stmt = $this->__conn->prepare($sql);
                // This line is used to assign values ​​to parameters
                $stmt->bindValue(':id', $data['id'] ?? null, PDO::PARAM_INT);
                $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
                $stmt->bindValue(':code', $data['code'] ?? null, PDO::PARAM_STR);
                $stmt->bindValue(':type_id', $data['type_id'], PDO::PARAM_INT);
                $stmt->bindValue(':watt', $data['watt'], PDO::PARAM_INT);
                $stmt->bindValue(':socket', $data['socket'], PDO::PARAM_STR);
                $stmt->bindValue(':color', $data['color'], PDO::PARAM_STR);
                $stmt->bindValue(':purchase_price', $data['purchase_price'], PDO::PARAM_STR);
                $stmt->bindValue(':sale_price', $data['sale_price'], PDO::PARAM_STR);
                $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);
                $stmt->bindValue(':brand_id', $data['brand_id'], PDO::PARAM_INT);
                // Execute the query
                return $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    // Function to delete products
    public function deleteProductById($id){
        try{
            if(isset($this->__conn)){
                $sql = "delete from products where id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
            return null;
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function countAllProducts()
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT COUNT(*) FROM products";
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
