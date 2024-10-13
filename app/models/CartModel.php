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
        // Tính tổng tiền (price_subtotal)
        $priceSubtotal = $price * $quantity;

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
        $sql = "SELECT * FROM sale_order_line WHERE order_id = ? AND product_id = ?";
        $stmt = $this->__conn->prepare($sql);
        $stmt->execute([$orderId, $productId]);
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng và tổng tiền
            $newQuantity = $existingItem['quantity'] + $quantity;
            $newSubtotal = $existingItem['price_subtotal'] + $priceSubtotal;

            $sql = "UPDATE sale_order_line 
                    SET quantity = ?, price_subtotal = ? 
                    WHERE order_id = ? AND product_id = ?";
            $stmt = $this->__conn->prepare($sql);
            $stmt->execute([$newQuantity, $newSubtotal, $orderId, $productId]);
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm sản phẩm vào giỏ hàng
            $sql = "INSERT INTO sale_order_line (order_id, product_id, price, quantity, price_subtotal) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->__conn->prepare($sql);
            $stmt->execute([$orderId, $productId, $price, $quantity, $priceSubtotal]);
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($orderId, $productId) {
        $sql = "DELETE FROM sale_order_line WHERE order_id = ? AND product_id = ?";
        $stmt = $this->__conn->prepare($sql);
        $stmt->execute([$orderId, $productId]);
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCartItem($orderId, $productId, $quantity) {
        $sql = "UPDATE sale_order_line 
                SET quantity = ?, price_subtotal = price * ?
                WHERE order_id = ? AND product_id = ?";
        $stmt = $this->__conn->prepare($sql);
        $stmt->execute([$quantity, $quantity, $orderId, $productId]);
    }
}
