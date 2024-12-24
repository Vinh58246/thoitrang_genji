<?php
require_once "model/user.php";
class ProfileController{
    private $model = null;
    function __construct()
    {
        $this->model = new user();

    }
    function index(){
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[3]; 
        $view_content = "view/admin/profile.php";
        include_once "view/admin/layout.php";
    }

    function edit(){
        $name_file = $_FILES['avatar']['name'];
        $temp_file = $_FILES['avatar']['tmp_name'];
        $fullname = ($_POST['fullname'] != '') ? $_POST['fullname'] : $_SESSION['user']['fullname'];
        $phone = ($_POST['phone'] != '') ? $_POST['phone'] : $_SESSION['user']['phone'];

        if($name_file != ''){
            move_uploaded_file($temp_file, "public/assets/images/users/$name_file");
            $this->model->update_profile($_SESSION['user']['id'], $fullname, $name_file, $phone);
        }else{
            $this->model->update_profile($_SESSION['user']['id'], $fullname, $_SESSION['user']['avatar'], $phone);
        }

        $_SESSION['user'] = $this->model->user_id($_SESSION['user']['id']);
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[3]; 
        $view_content = "view/admin/profile.php";
        include_once "view/admin/layout.php";
    }
}
?>