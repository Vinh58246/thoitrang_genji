<?php
require_once "connectDB.php";
class listImageComment extends connectDB {
    function save_list_image_comment($idcomment, $image) {
        $sql = "INSERT INTO list_image_comment SET idcomment=:idcomment, image=:image";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":idcomment", $idcomment, PDO::PARAM_INT);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }


    function show_list_image_comment($idcomment){
        $sql = "SELECT id, image FROM list_image_comment WHERE idcomment = $idcomment";
        return $this ->query($sql);
    }

}