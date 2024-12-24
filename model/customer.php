<?php
require_once "connectDB.php";
class customer extends connectDB {
    function all_users() {
        $sql = "SELECT * FROM users WHERE role != 'admin'";
        return $this ->query($sql);
    }
    function detail_user($id){
        $sql = "SELECT * FROM users WHERE id = $id";
        return $this ->queryOne($sql);
    }
    function delete_user($id){
        $sql = "DELETE FROM users WHERE id=:id";
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