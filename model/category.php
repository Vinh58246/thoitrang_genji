<?php 
require_once "connectDB.php";
class category extends connectDB {
    function count_categories(){
        $sql ="SELECT count(id) as dem FROM categories";
        $row = $this->queryOne($sql);
        return $row['dem'];
    }
    function all_categories() {
        $sql = "SELECT *
        FROM categories";
        return $this ->query($sql);
    }
    function detail_category($id){
        $sql = "SELECT * FROM categories WHERE id = $id";
        return $this ->queryOne($sql);
    }
    function detail_category_slug($slug){
        $sql = "SELECT slug, id FROM categories WHERE slug = '$slug'";
        return $this ->queryOne($sql);
    }
    function save_category($image, $name, $status, $display_order, $slug){
        $sql = "INSERT INTO categories SET name=:name,  image=:image, status=:status, display_order=:display_order, slug=:slug";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":display_order", $display_order, PDO::PARAM_INT);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function update_category($id, $image, $name, $status, $display_order, $slug){
        $sql ="UPDATE categories SET name=:name,  image=:image, status=:status, display_order=:display_order, slug=:slug WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":display_order", $display_order, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    function delete_category($id){
        $sql = "DELETE FROM categories WHERE id=:id";
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