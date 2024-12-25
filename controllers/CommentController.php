<?php
require_once "model/comment.php";
require_once "model/listImageComment.php";
class CommentController{
    private $modelcomment = null;
    private $modellist_c_image = null;
    function __construct()
    {
        $this->modelcomment = new comment();
        $this->modellist_c_image = new listImageComment();
    }
    function index(){
        $this->checkusernot();

        $all_comments = $this->modelcomment->all_comments();

        $datatable_js = '<script src="public/assets/js/pages/list_comments.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_comments.php";
        include_once "view/admin/layout.php";
    }
    function destroy(){
        $this->checkusernot();

        try{
            global $params;
            $id = $params['id'];
            $detail = $this->modellist_c_image->show_list_image_comment($id);
            $notification = $this->modelcomment->delete_comment($id);

            if($notification == true){
                foreach ($detail as $j) {
                    $link_image = "public/assets/image_comment/".$j['image'];
                    unlink($link_image);
                }
                $_SESSION['notification']['destroy_list'] = 1;
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
        header("location:". ROOT_URL. "comments");
    }
    function destroy_list(){
        $this->checkusernot();

        try{
            // kiểm tra check list có tồn tại không
            if(isset($_POST['check_list'])){
                for ($i=0; $i < count($_POST['check_list']); $i++) { 

                    $id = $_POST['check_list'][$i];
                    $detail = $this->modellist_c_image->show_list_image_comment($id);
                    $notification = $this->modelcomment->delete_comment($id);

                    if($notification == true){
                        foreach ($detail as $j) {
                            $link_image = "public/assets/image_comment/".$j['image'];
                            unlink($link_image);
                        }
                        $_SESSION['notification']['destroy_list'] = 1;
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
        header("location:". ROOT_URL. "comments");
    }
    function checkusernot(){
        if(!isset($_SESSION['user']) || empty($_SESSION['user']) || empty($_SESSION['user']['email_verified_at'])){
            header("location:". ROOT_URL. "login");
        }
    }
}
?>