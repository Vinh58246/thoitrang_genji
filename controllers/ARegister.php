<?php
require_once "model/user.php";
include BASE_DIR."/view/email_template/confim_mail.php";
class ARegister{
    private $model = null;
    function __construct()
    {
        $this->model = new user();

    }
    function index(){
        $view_content = "view/auth/register.php";
        include_once "view/auth/layout.php";
    }
    
    function store(){


        $fullname = $_POST['name'];
        $email = $_POST['mail'];
        $password = $_POST['pass'];
        $passagain = $_POST['passagain'];

        

        // nếu password mà trống thì sẽ hiển thị thất bại
        if(!empty($password)){
            // sau khi vào được đây thì sẽ kiểm tra password và password again có giống nhau không
            // nếu không giống nhau sẽ thông báo lỗi
            if($password == $passagain){

                // sau khi check xong, sẽ tới kiểm tra email đã tồn tại chưa
                $check_user = $this->model->check_user($email);
                // nếu email đã tồn tại thì sẽ thông báo email đã tồn tại
                if($check_user == false){

                    // sau khi kiểm tra xong tất cả sẽ tới phần gửi mail và chuyển hướng
                    $_SESSION['emailcode'] = rand(10000000, 99999999);
                    $noti = send_mail($email, mail_confim($_SESSION['emailcode']));
                    if($noti == true){
                        if(isset($_SESSION['url']['changepw'])){
                            unset($_SESSION['url']['changepw']);
                        }
                        $iduser = $this->model->save_user($fullname, $email, md5($password), 'user');
                        $_SESSION['user']['id'] = $iduser;
                        $_SESSION['user']['email'] = $email;
                        
                        header("location:". ROOT_URL. "confim_email");
                    }
                    // gửi mail thất bại
                    else{
                        $_SESSION['notification']['auth'] = 1;
                        header("location:". ROOT_URL. "register");
                    }
                }
                // tài khoản đã tồn tại
                else{
                    $_SESSION['notification']['auth'] = 3;
                    header("location:". ROOT_URL. "register");
                }
            }
            // đăng ký thất bại
            else{
                $_SESSION['notification']['auth'] = 2;
                $view_content = "view/auth/register.php";
                include_once "view/auth/layout.php";
            }
        }
        // đăng ký thất bại
        else{
            $_SESSION['notification']['auth'] = 2;
            $view_content = "view/auth/register.php";
            include_once "view/auth/layout.php";
        }
    }
}
?>