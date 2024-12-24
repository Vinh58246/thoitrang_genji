<?php
require_once "model/user.php";
class AConfimMail{
    private $model = null;
    function __construct()
    {
        $this->model = new user();

    }
    function index(){
        $view_content = "view/auth/confim_mail.php";
        include_once "view/auth/layout.php";
    }
    function store(){

        $timezone = date_default_timezone_set(SET_TIME_ZONE);
        $date = date('Y-m-d H:i:s');
        $ymd = date('Y-m-d');
        // lấy input confimcode
        $confimcode = $_POST['confimcode'];

        // xem có code email trước đó hay không thì mới cho phép tiếp tục thực thi, nếu không chuyển về đăng ký
        if(isset($_SESSION['emailcode']) && !empty($_SESSION['emailcode'])){
    
            // so sánh input nhập vào với mã email
            if($confimcode == $_SESSION['emailcode']){
                // sau khi đã so sánh đúng thì xóa mã đi, tránh việc nhập lại nhiều lần
                unset($_SESSION['emailcode']);

                // sau đó xác nhận tài khoản đã có xác thực
                $this->model->update_email_verified_at($_SESSION['user']['email'], $date);

                // đây sẽ chuyển hướng dựa theo người dùng đã đi từ đăng ký hay từ quên mật khẩu
                // nếu đi từ quên mật khẩu thì sẽ có session url này và được chuyển hướng đến đổi mật khẩu
                // còn nếu đi từ đăng ký thì sẽ được chuyển về login
                if(isset($_SESSION['url']['changepw']) && !empty($_SESSION['url']['changepw'])){
                    // sau khi xác thực thành công thì sẽ được lưu thông tin và chuyển hướng đén đổi pass
                    $profileuser = $this->model->check_user($_SESSION['user']['email']);
                    $_SESSION['user'] = $profileuser;
                    header("location:". ROOT_URL. "lock_screen");

                }
                else{
                    // xác thực thành công, chuyển hướng về login
                    $_SESSION['notification']['auth'] = 1;
                    header("location:". ROOT_URL. "login");
                }
    
            }else{
                $notification = false;
                $view_content = "view/auth/confim_mail.php";
                include_once "view/auth/layout.php";
            }
        }
        else{
            header("location:". ROOT_URL. "register");
        }
    }
    // gửi lại mã xác thực cho người dùng
    function resend_code(){
        $_SESSION['emailcode'] = rand(10000000, 99999999);
        $noti = send_mail($_SESSION['user']['email'], mail_confim($_SESSION['emailcode']));
        if($noti == true){
            $_SESSION['notification']['auth']  = 1;
            header("location:". ROOT_URL. "confim_email");
        }
        
    }
}
?>