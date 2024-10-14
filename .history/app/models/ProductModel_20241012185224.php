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
                $sql = "select p.id,
                                p.name,
                                p.code,
                                p.watt,
                                p.socket,
                                p.color,
                                p.purchase_price,
                                p.sale_price,
                                p.quantity,
                                p.image_url,
                                t.type_name,
                                b.brand_name
                from products as p
                inner join type_lights as t on p.type_id = t.id
                inner join brand_lights as b on p.brand_id = b.id
                order by p.id desc LIMIT :limit OFFSET :offset";
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

    public function getImg()
    {
        try {
            if ($this->__conn) {
                $sql = "select image_url from products";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getProductById($id)
    {
        try {
            if ($this->__conn) {
                // Join bảng products với bảng type_lights và brand_lights
                $sql = "SELECT p.id,
                                p.name,
                                p.code,
                                p.watt,
                                p.socket,
                                p.color,
                                p.purchase_price,
                                p.sale_price,
                                p.quantity,
                                p.image_url,
                                p.type_id,
                                p.brand_id,
                                t.type_name , 
                                b.brand_name 
                    FROM products p
                    INNER JOIN type_lights t ON p.type_id = t.id
                    INNER JOIN brand_lights b ON p.brand_id = b.id
                    WHERE p.id = :id";

                $stmt = $this->__conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);  // Gán giá trị cho tham số :id
                $stmt->execute();

                // Trả về dữ liệu sản phẩm cùng với tên loại và tên nhãn hiệu
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    // The saveProduct function is commonly used for editing and adding new products
    public function saveProduct($name, $code, $type_id, $watt, $socket, $color, $purchase_price, $sale_price, $quantity, $brand_id, $image_url)
    {
        try {
            if (isset($this->__conn)) {
                // Câu lệnh gọi stored procedure
                $sql = "CALL insert_product(:prod_name, :prod_type_id, :prod_watt, :prod_socket, :prod_color, :prod_purchase_price, :prod_sale_price, :prod_quantity, :prod_brand_id, :prod_image_url)";

                // Chuẩn bị câu lệnh
                $stmt = $this->__conn->prepare($sql);

                // Gán giá trị cho các tham số
                $stmt->bindParam(":prod_name", $name, PDO::PARAM_STR);
                // $stmt->bindParam(":code", $code, PDO::PARAM_STR); // Nếu bạn cần sử dụng mã sản phẩm thì bỏ comment dòng này
                $stmt->bindParam(":prod_type_id", $type_id, PDO::PARAM_INT);
                $stmt->bindParam(":prod_watt", $watt, PDO::PARAM_INT);
                $stmt->bindParam(":prod_socket", $socket, PDO::PARAM_STR);
                $stmt->bindParam(":prod_color", $color, PDO::PARAM_STR);
                $stmt->bindParam(":prod_purchase_price", $purchase_price, PDO::PARAM_STR);
                $stmt->bindParam(":prod_sale_price", $sale_price, PDO::PARAM_STR);
                $stmt->bindParam(":prod_quantity", $quantity, PDO::PARAM_INT);
                $stmt->bindParam(":prod_brand_id", $brand_id, PDO::PARAM_INT);
                $stmt->bindParam(":prod_image_url", $image_url, PDO::PARAM_STR);

                // Thực thi câu lệnh
                return $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function editProduct($id, $name, $code, $type_id, $watt, $socket, $color, $purchase_price, $sale_price, $quantity, $brand_id, $image_url)
    {
        try {
            if (isset($this->__conn)) {
                // This query uses on DUPLICATE to both add new product values ​​and edit product values.
                $sql = "update products set name= :name, code = :code, type_id=:type_id, watt=:watt, socket=:socket, color=:color, purchase_price=:purchase_price, sale_price =:sale_price,quantity=:quantity, brand_id=:brand_id, image_url=:image_url
                where id=:id";
                // This line is used to Prepare statement
                $stmt = $this->__conn->prepare($sql);
                // This line is used to assign values ​​to parameters
                $stmt->bindParam("name", $name, PDO::PARAM_STR);
                $stmt->bindParam("code", $code, PDO::PARAM_STR);
                $stmt->bindParam("type_id", $type_id, PDO::PARAM_INT);
                $stmt->bindParam("watt", $watt, PDO::PARAM_INT);
                $stmt->bindParam("socket", $socket, PDO::PARAM_STR);
                $stmt->bindParam("color", $color, PDO::PARAM_STR);
                $stmt->bindParam("purchase_price", $purchase_price, PDO::PARAM_INT);
                $stmt->bindParam("sale_price", $sale_price, PDO::PARAM_INT);
                $stmt->bindParam("quantity", $quantity, PDO::PARAM_INT);
                $stmt->bindParam("brand_id", $brand_id, PDO::PARAM_INT);
                $stmt->bindParam("image_url", $image_url, PDO::PARAM_STR);
                $stmt->bindParam("id", $id, PDO::PARAM_INT);
                // Execute the query
                return $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    // Function to delete products
    public function deleteProductById($id)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "delete from products where id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
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

    public function searchProduct($name, $limit = 10, $offset = 0){
        try {
            $sql = "SELECT * FROM products 
                    -- WHERE (name LIKE :name OR :name = '')
                    WHERE case when :name != '' then name 
                    ";
            $stmt = $this->__conn->prepare($sql);
            $stmt->bindValue(":name", '%' . $name . '%');
            // $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
            // $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return [];
        }
    }

    public function countProducts($name)
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM products WHERE (name LIKE :name OR :name = '') ";
            $stmt = $this->__conn->prepare($sql);
            $stmt->bindValue(":name", '%' . $name . '%');
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ)->total;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return 0;
        }
    }
    
}
