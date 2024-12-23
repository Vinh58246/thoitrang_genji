<?php
require_once "connectDB.php";
class variantProduct extends connectDB {
    function save_variant_name($idproduct, $name){
        $sql = "INSERT INTO variant_name SET idproduct=:idproduct,  name=:name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idproduct", $idproduct, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function save_variant_attribute($idvariantname, $value_variant){
        $sql = "INSERT INTO variant_attribute SET idvariantname=:idvariantname, value_variant=:value_variant";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idvariantname", $idvariantname, PDO::PARAM_INT);
        $stmt->bindParam(":value_variant", $value_variant, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function save_linking_variant_attributes($idproduct, $linking, $quantity, $price = null, $image = null){
        $sql = "INSERT INTO linking_variant_attributes SET idproduct=:idproduct, linking=:linking, quantity=:quantity, price=:price, image=:image";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idproduct", $idproduct, PDO::PARAM_INT);
        $stmt->bindParam(":linking", $linking, PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }

    function update_linking_variant_attributes($id, $quantity, $price){
        $sql ="UPDATE linking_variant_attributes SET quantity=:quantity, price=:price WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    function show_variant_name($idproduct){
        $sql = "SELECT id, name FROM variant_name WHERE idproduct = $idproduct";
        return $this ->query($sql);
    }
    
    function show_variant_attribute($idvariantname){
        $sql = "SELECT * FROM variant_attribute WHERE idvariantname = $idvariantname";
        return $this ->query($sql);
    }
    
    function show_linking_variant_attributes($idproduct){
        $sql = "SELECT * FROM linking_variant_attributes WHERE idproduct = $idproduct";
        return $this ->query($sql);
    }


}