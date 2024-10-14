<?php

class CartModel {
    private $__conn;

    public function __construct($conn) {
        $this->__conn = $conn;
    }

    // Lấy thông tin đơn hàng theo người dùng
    public function getOrderByUser($userId) {
        $sql = "SELECT * FROM sale_order WHERE user_id = ?";
        $stmt = $this->__conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy các sản phẩm trong giỏ hàng dựa trên order_id
    public function getOrderItems($orderId) {
        $sql = "SELECT sol.*, p.name, p.image_url
                FROM sale_order_line sol
                INNER JOIN products p ON sol.product_id = p.id
                WHERE sol.order_id = ?";
        $stmt = $this->__conn->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($orderId, $productId, $price, $quantity) {
        $priceSubtotal = $price * $quantity;
        $query = "INSERT INTO sale_order_line (order_id, product_id, price, quantity, price_subtotal) 
                  VALUES (:order_id, :product_id, :price, :quantity, :price_subtotal)";
        $stmt = $this->__conn->prepare($query);
        $stmt->bindParam(":order_id", $orderId);
        $stmt->bindParam(":product_id", $productId);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":price_subtotal", $priceSubtotal);
        return $stmt->execute();
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($orderId, $productId) {
        $query = "DELETE FROM sale_order_line WHERE order_id = :order_id AND product_id = :product_id";
        $stmt = $this->__conn->prepare($query);
        $stmt->bindParam(":order_id", $orderId);
        $stmt->bindParam(":product_id", $productId);
        return $stmt->execute();
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCartItem($orderId, $productId, $quantity) {
        $query = "UPDATE sale_order_line 
                  SET quantity = :quantity, price_subtotal = price * :quantity 
                  WHERE order_id = :order_id AND product_id = :product_id";
        $stmt = $this->__conn->prepare($query);
        $stmt->bindParam(":order_id", $orderId);
        $stmt->bindParam(":product_id", $productId);
        $stmt->bindParam(":quantity", $quantity);
        return $stmt->execute();
    }
}
