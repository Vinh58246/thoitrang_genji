<?php
require_once "connectDB.php";
class comment extends connectDB {
    function all_comments() {
        $sql = "SELECT 
        comments.*, 
        products.slug as slugproduct, 
        products.name as nameproduct, 
        users.fullname as nameuser, 
        users.avatar, 
        GROUP_CONCAT(list_image_comment.image SEPARATOR '@-@') as listimage 
        FROM comments 
        LEFT JOIN products 
        ON comments.idproduct = products.id 
        LEFT JOIN users 
        ON comments.iduser = users.id 
        LEFT JOIN list_image_comment 
        ON comments.id = list_image_comment.idcomment 
        GROUP BY comments.id";
        return $this ->query($sql);
    }
    function delete_comment($id){
        $sql = "DELETE FROM comments WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO:: PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>