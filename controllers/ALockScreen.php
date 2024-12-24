<?php
require_once "model/user.php";
class ALockScreen
{
    private $model = null;
    function __construct()
    {
        $this->model = new user();

    }
    function index()
    {

        $detail = $_SESSION['user'];

        $view_content = "view/auth/lock_screen.php";
        include_once "view/auth/layout.php";
    }

    // xử lý đổi mật khẩu
    function edit(){
        $password = $_POST['pass'];

        // dựa vào session['user'] để đổi mật khẩu
        $this->model->update_change_password($_SESSION['user']['id'], md5($password));
        if($_SESSION['user']['role'] == 'admin'){
            header("location:". ROOT_URL. "dashboard");
        }else{
            header("location:". ROOT_URL. "");
        }

    }
}
// array (
//     'id' => 17,
//     0 => 17,
//     'fullname' => 'anh mai',
//     1 => 'anh mai',
//     'email' => 'nguyenphuocvinh051204@gmail.com',
//     2 => 'nguyenphuocvinh051204@gmail.com',
//     'email_verified_at' => '2024-12-24 02:13:39',
//     3 => '2024-12-24 02:13:39',
//     'password' => 'c4ca4238a0b923820dcc509a6f75849b',
//     4 => 'c4ca4238a0b923820dcc509a6f75849b',
//     'avatar' => NULL,
//     5 => NULL,
//     'remember_token' => NULL,
//     6 => NULL,
//     'address' => NULL,
//     7 => NULL,
//     'phone' => NULL,
//     8 => NULL,
//     'created_at' => '2024-12-24 01:47:41',
//     9 => '2024-12-24 01:47:41',
//     'role' => 'user',
//     10 => 'user',
//   )
  