<?php
require_once "model/customer.php";
class UserController{
    private $model = null;
    function __construct()
    {
        $this->model = new customer();

    }
    function index(){
        $all_users = $this->model->all_users();

        $datatable_js = '<script src="public/assets/js/pages/list_users.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_users.php";
        include_once "view/admin/layout.php";
    }
    function destroy(){
        try{
            global $params;
            $id = $params['id'];
            $detail = $this->model->detail_user($id);
            $notification = $this->model->delete_user($id);

            if($notification == true){
                $_SESSION['notification']['destroy_list'] = 1;
                $link_image = "public/assets/images/users/".$detail['avatar'];
                unlink($link_image);
            }
            else{
                $_SESSION['notification']['destroy_list'] = 0;
            }
        }catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['notification']['destroy_list'] = 0;
            } else {
                echo "Lỗi: " . $e->getMessage();
            }
        }
        header("location:". ROOT_URL. "users");
    }

    function destroy_list(){
        try{
            // kiểm tra check list có tồn tại không
            if(isset($_POST['check_list'])){
                for ($i=0; $i < count($_POST['check_list']); $i++) { 

                    $id = $_POST['check_list'][$i];
                    $detail = $this->model->detail_user($id);
                    $notification = $this->model->delete_user($id);

                    if($notification == true){
                        $_SESSION['notification']['destroy_list'] = 1;
                        $link_image = "public/assets/images/users/".$detail['avatar'];
                        unlink($link_image);
                    }
                    else{
                        $_SESSION['notification']['destroy_list'] = 0;
                    }
                }
            }else{
                $_SESSION['notification']['destroy_list'] = 0;
            }
        }catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['notification']['destroy_list'] = 0;
            } else {
                echo "Lỗi: " . $e->getMessage();
            }
        }
        header("location:". ROOT_URL. "users");
    }
}
?>