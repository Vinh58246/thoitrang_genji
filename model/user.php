<?php
require_once "connectDB.php";
class user extends connectDB {
    function save_user($fullname, $email, $password, $role, $avatar = 'user_default.jpg', $remember_token = null, $address = null, $phone = null){
        $sql = "INSERT INTO users SET fullname=:fullname,  email=:email, password=:password, avatar=:avatar, remember_token=:remember_token, address=:address, phone=:phone, role=:role";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindParam(":remember_token", $remember_token, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_INT);
        $stmt->bindParam(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function update_email_verified_at($email, $email_verified_at){
        $sql = "UPDATE users SET email_verified_at=:email_verified_at WHERE email=:email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":email_verified_at", $email_verified_at, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function update_change_password($id, $password){
        $sql = "UPDATE users SET password=:password WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function update_profile($id, $fullname, $avatar, $phone = null){
        $sql = "UPDATE users SET fullname=:fullname, avatar=:avatar, phone=:phone WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_INT);
        $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
        $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->conn->lastInsertId();
        return $id;
    }
    function detail_user($email, $password){
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        return $this ->queryOne($sql);
    }
    function check_user($email){
        $sql = "SELECT * FROM users WHERE email = '$email'";
        return $this ->queryOne($sql);
    }
    function user_id($id){
        $sql = "SELECT * FROM users WHERE id = $id";
        return $this ->queryOne($sql);
    }

    
}