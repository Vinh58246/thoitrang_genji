<?php
require_once "connectDB.php";
class order extends connectDB {
    function show_list_order(){
        $sql = "SELECT 
        product_order.id, 
        orders.id as idodr, 
        orders.order_code, 
        products.image, 
        orders.created_at as timetooder, 
        orders.payment_status, 
        orders.shipping_price, 
        orders.payment_method, 
        orders.order_status, 
        product_order.quantity, 
        product_order.price 
        FROM product_order 
        LEFT JOIN products 
        ON product_order.idproduct = products.id 
        LEFT JOIN orders 
        ON product_order.idorder = orders.id 
        ORDER BY product_order.idorder DESC";
        return $this ->query($sql);
    }
    function detail_product_order($idorder){
        $sql = "SELECT product_order.id 
        as idall, 
        product_order.idorder, 
        product_order.quantity, 
        product_order.price, 
        products.image, 
        products.name, 
        products.slug, 
        linking_variant_attributes.id, 
        linking_variant_attributes.linking 
        FROM product_order 
        LEFT JOIN products 
        ON product_order.idproduct = products.id 
        LEFT JOIN linking_variant_attributes 
        ON product_order.idlinkingvariant = linking_variant_attributes.id 
        LEFT JOIN users 
        ON product_order.iduser = users.id 
        LEFT JOIN orders 
        ON product_order.idorder = orders.id 
        WHERE product_order.idorder = $idorder";
        return $this ->query($sql);
    }
    function deltail_information_order($idorder){
        $sql = "SELECT 
        product_order.idorder, 
        product_order.iduser, 
        MAX(orders.id) AS order_id, 
        MAX(orders.order_code) AS order_code, 
        MAX(orders.created_at) AS created_at, 
        MAX(orders.payment_status) AS payment_status, 
        MAX(orders.shipping_price) AS shipping_price, 
        MAX(orders.payment_method) AS payment_method, 
        MAX(orders.order_status) AS order_status, 
        MAX(orders.address) AS order_address, 
        MAX(orders.phone) AS order_phone, 
        MAX(users.fullname) AS fullname, 
        MAX(users.email) AS email 
        FROM product_order 
        LEFT JOIN orders 
        ON product_order.idorder = orders.id 
        LEFT JOIN users 
        ON product_order.iduser = users.id 
        WHERE product_order.idorder = $idorder 
        GROUP BY product_order.idorder, product_order.iduser";
        return $this ->queryOne($sql);
    }
    function update_status_order($id, $order_status){
        $sql = "UPDATE orders SET order_status=:order_status WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":order_status", $order_status, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
}