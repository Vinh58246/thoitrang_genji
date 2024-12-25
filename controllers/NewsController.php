<?php
require_once "model/news.php";
class NewsController{
    private $model = null;
    function __construct()
    {
        $this->model = new news();

    }
    function index(){
        $this->checkusernot();

        $allNews = $this->model->all_news();

        $datatable_js = '<script src="public/assets/js/pages/list_news.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_news.php";
        include_once "view/admin/layout.php";
    }
    function create(){
        $this->checkusernot();

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/add_news.php";
        include_once "view/admin/layout.php";
    }
    function store(){
        $this->checkusernot();

        // echo "<h1>xin chào</h1>";
        $name_file = $_FILES['avatar']['name'];
        $temp_file = $_FILES['avatar']['tmp_name'];
        $content = $_POST['content'];
        $title = trim(strip_tags($_POST['title']));
        $title_slug = $this->name_slug($title);
        $status = (int) $_POST['status'];
        $display = (int) $_POST['display'];
        $author = "Phước Vinh";


        
        if(strlen($content) <= 15 || $name_file == '' || $title == '' || strlen($title) >= 255){
            $notification = false;
        }
        else{
            move_uploaded_file($temp_file, "public/assets/images_news/$name_file");
            $this->model->save_news($name_file, $title, $content, $status, $display, $author, $title_slug);
            $notification = true;
        }

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/add_news.php";
        include_once "view/admin/layout.php";
    }
    function show(){
        $this->checkusernot();

        global $params;
        $id = $params['id'];
        $detail = $this->model->detail_news($id);

        $link_css = Linkfile::LINKCSS[1];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/edit_news.php";
        include_once "view/admin/layout.php";
    }
    function edit(){
        $this->checkusernot();

        $id = $_POST['id'];
        
        $detail = $this->model->detail_news($id);

        $name_file = $_FILES['avatar']['name'];
        $temp_file = $_FILES['avatar']['tmp_name'];
        $content = $_POST['content'];
        $title = trim(strip_tags($_POST['title']));
        $title_slug = $this->name_slug($title);
        $status = (int) $_POST['status'];
        $display = (int) $_POST['display'];
        $author = "Phước Vinh";

        if(strlen($content) <= 15 || $title == '' || strlen($title) >= 255){
            $notification = false;
        }
        elseif($name_file == ''){
            $name_file = $detail['avatar'];
            $this->model->update_news($id, $name_file, $title, $content, $status, $display, $author, $title_slug);
            $notification = true;
        }
        else{
            move_uploaded_file($temp_file, "public/assets/images_news/$name_file");
            $this->model->update_news($id, $name_file, $title, $content, $status, $display, $author, $title_slug);
            $notification = true;
        }
        $detail = $this->model->detail_news($id);
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/edit_news.php";
        include_once "view/admin/layout.php";
    }
    function destroy(){
        $this->checkusernot();

        try{
            global $params;
            $id = $params['id'];
            $detail = $this->model->detail_news($id);
            $notification = $this->model->delete_news($id);

            if($notification == true){
                $_SESSION['notification']['destroy_list'] = 1;
                $link_image = "public/assets/images_news/".$detail['avatar'];
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
        header("location:". ROOT_URL. "news");
        
    }
    function destroy_list(){
        $this->checkusernot();

        try{
            // kiểm tra check list có tồn tại không
            if(isset($_POST['check_list'])){
                for ($i=0; $i < count($_POST['check_list']); $i++) { 

                    $id = $_POST['check_list'][$i];
                    $detail = $this->model->detail_news($id);
                    $notification = $this->model->delete_news($id);
                    if($notification == true){
                        $_SESSION['notification']['destroy_list'] = 1;
                        $link_image = "public/assets/images_news/".$detail['avatar'];
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
        header("location:". ROOT_URL. "news");
    }

    function name_slug($string) {
        $char_map = array(
            // Chữ thường
            'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 
            'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
            'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
            'é' => 'e', 'è' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
            'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
            'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
            'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
            'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
            'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
            'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
            'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
            'đ' => 'd', 
        
            // Chữ hoa
            'Á' => 'a', 'À' => 'a', 'Ả' => 'a', 'Ã' => 'a', 'Ạ' => 'a', 
            'Ă' => 'a', 'Ắ' => 'a', 'Ằ' => 'a', 'Ẳ' => 'a', 'Ẵ' => 'a', 'Ặ' => 'a',
            'Â' => 'a', 'Ấ' => 'a', 'Ầ' => 'a', 'Ẩ' => 'a', 'Ẫ' => 'a', 'Ậ' => 'a',
            'É' => 'e', 'È' => 'e', 'Ẻ' => 'e', 'Ẽ' => 'e', 'Ẹ' => 'e',
            'Ê' => 'e', 'Ế' => 'e', 'Ề' => 'e', 'Ể' => 'e', 'Ễ' => 'e', 'Ệ' => 'e',
            'Í' => 'i', 'Ì' => 'i', 'Ỉ' => 'i', 'Ĩ' => 'i', 'Ị' => 'i',
            'Ó' => 'o', 'Ò' => 'o', 'Ỏ' => 'o', 'Õ' => 'o', 'Ọ' => 'o',
            'Ô' => 'o', 'Ố' => 'o', 'Ồ' => 'o', 'Ổ' => 'o', 'Ỗ' => 'o', 'Ộ' => 'o',
            'Ơ' => 'o', 'Ớ' => 'o', 'Ờ' => 'o', 'Ở' => 'o', 'Ỡ' => 'o', 'Ợ' => 'o',
            'Ú' => 'u', 'Ù' => 'u', 'Ủ' => 'u', 'Ũ' => 'u', 'Ụ' => 'u',
            'Ư' => 'u', 'Ứ' => 'u', 'Ừ' => 'u', 'Ử' => 'u', 'Ữ' => 'u', 'Ự' => 'u',
            'Ý' => 'y', 'Ỳ' => 'y', 'Ỷ' => 'y', 'Ỹ' => 'y', 'Ỵ' => 'y',
            'Đ' => 'd'
        );
      
        $string = strtr($string, $char_map);
        $string = preg_replace('/\s+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
    function checkusernot(){
        if(!isset($_SESSION['user']) || empty($_SESSION['user']) || empty($_SESSION['user']['email_verified_at'])){
            header("location:". ROOT_URL. "login");
        }
    }
}
?>