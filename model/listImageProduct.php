<?php
require_once "connectDB.php";
class listImageProduct extends connectDB {
    function save_list_image_product($idproduct, $image, $display_order) {
        $sql = "INSERT INTO list_image_product SET idproduct=:idproduct, image=:image, display_order=:display_order";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idproduct", $idproduct, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":display_order", $display_order, PDO::PARAM_INT);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
}