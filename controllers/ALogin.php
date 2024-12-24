<?php
require_once "model/user.php";
class ALogin{
    private $model = null;
    function __construct()
    {
        $this->model = new user();

    }
    function index(){
        $view_content = "view/auth/login.php";
        include_once "view/auth/layout.php";
    }
    // xử lý đăng nhập
    function show(){
        $email = $_POST['mail'];
        $password = $_POST['pass'];

        // lấy chi tiết user dựa vào email và password mã hóa
        $detail = $this->model->detail_user($email, md5($password));
        
        // nếu không có user nào trùng khớp hoặc user đó chưa xác nhận email thì sẽ báo lỗi
        if($detail == false || $detail['email_verified_at'] == ''){
            $_SESSION['notification']['auth'] = 2;
            header("location:". ROOT_URL. "login");
        }
        // nếu có user và user đó đã xác thực, thì đăng nhập và chuyển hướng dựa trên vai trò
        else{
            $_SESSION['user'] = $detail;
            if($detail['role'] == 'admin'){
                header("location:". ROOT_URL. "dashboard");
            }else{
                header("location:". ROOT_URL. "");
            }
        }
    }
    function logout(){
        unset($_SESSION['user']);
        header("location:". ROOT_URL. "login");
    }
}
?>