<?php
require_once "connectDB.php";
class product extends connectDB {
    function count_products(){
        $sql ="SELECT count(id) as dem FROM products";
        $row = $this->queryOne($sql);
        return $row['dem'];
    }
    function all_products() {
        $sql = "SELECT *
        FROM products";
        return $this ->query($sql);
    }
    function cate_products($idcategory) {
        $sql = "SELECT * FROM products WHERE idcategory = $idcategory";
        return $this ->query($sql);
    }
    function detail_product($id){
        $sql = "SELECT * FROM products WHERE id = $id";
        return $this ->queryOne($sql);
    }
    function detail_product_slug($slug){
        $sql = "SELECT * FROM products WHERE slug = '$slug'";
        return $this ->queryOne($sql);
    }
    function save_product($idcategory, $name, $image, $detailed_description, $product_summary, $price, $quantity, $hot, $status, $slug){
        $sql = "INSERT INTO products SET idcategory=:idcategory, name=:name, image=:image, detailed_description=:detailed_description,  product_summary=:product_summary, price=:price, quantity=:quantity, hot=:hot, status=:status, slug=:slug";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idcategory", $idcategory, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":detailed_description", $detailed_description, PDO::PARAM_STR);
        $stmt->bindParam(":product_summary", $product_summary, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":hot", $hot, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function update_product($id, $idcategory, $name, $image, $detailed_description, $product_summary, $price, $quantity, $hot, $status, $slug){
        $sql = "UPDATE products SET idcategory=:idcategory, name=:name, image=:image, detailed_description=:detailed_description,  product_summary=:product_summary, price=:price, quantity=:quantity, hot=:hot, status=:status, slug=:slug WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":idcategory", $idcategory, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":detailed_description", $detailed_description, PDO::PARAM_STR);
        $stmt->bindParam(":product_summary", $product_summary, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindParam(":hot", $hot, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function delete_product($id){
        $sql = "DELETE FROM products WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO:: PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}