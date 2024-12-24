<?php
require_once "connectDB.php";
class listImageProduct extends connectDB {
    function save_list_image_product($idproduct, $image, $display_order, $size_image) {
        $sql = "INSERT INTO list_image_product SET idproduct=:idproduct, image=:image, display_order=:display_order, size_image=:size_image";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idproduct", $idproduct, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":display_order", $display_order, PDO::PARAM_INT);
        $stmt->bindParam(":size_image", $size_image, PDO::PARAM_INT);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }


    function show_list_image_product($idproduct){
        $sql = "SELECT id, image, display_order, size_image FROM list_image_product WHERE idproduct = $idproduct";
        return $this ->query($sql);
    }
    
    function remove_list_image_product($idproduct){
        $sql = "DELETE FROM list_image_product WHERE idproduct=:idproduct";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idproduct", $idproduct, PDO:: PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

}