<?php
class ARecoverPw{
    function index(){
        $view_content = "view/auth/recover_pw.php";
        include_once "view/auth/layout.php";
    }

    function store(){
        // lấy email từ input
        $email = $_POST['mail'];
        
        // sau đó gửi code đên mail người dùng
        $_SESSION['emailcode'] = rand(10000000, 99999999);
        $noti = send_mail($email, mail_confim($_SESSION['emailcode']));
        if($noti == true){
            // sau khi gửi xong sẽ chuyển đến xác thực email, lưu 2 giá trị
            // email vừa mới nhập và session chuyển hướng, để có thể biết được từ đâu đến
            $_SESSION['user']['email'] = $email;
            $_SESSION['url']['changepw'] = 'lock_screen';
            header("location:". ROOT_URL. "confim_email");
        }
    }
}
?>