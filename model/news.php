<?php
require_once "connectDB.php";
class news extends connectDB {
    function all_news() {
        $sql = "SELECT *
        FROM news";
        return $this ->query($sql);
    }
    function detail_news($id){
        $sql = "SELECT * FROM news WHERE id = $id";
        return $this ->queryOne($sql);
    }
    function save_news($avatar, $title, $content, $status, $display, $author, $slug){
        $sql = "INSERT INTO news SET avatar=:avatar,  title=:title, status=:status, content=:content, display=:display, author=:author, slug=:slug";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, PDO::PARAM_STR);
        $stmt->bindParam(":author", $author, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":display", $display, PDO::PARAM_INT);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }

    function update_news($id, $avatar, $title, $content, $status, $display, $author, $slug){
        $sql ="UPDATE news SET avatar=:avatar,  title=:title, status=:status, content=:content, display=:display, author=:author, slug=:slug WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, PDO::PARAM_STR);
        $stmt->bindParam(":author", $author, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":display", $display, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    function delete_news($id){
        $sql = "DELETE FROM news WHERE id=:id";
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