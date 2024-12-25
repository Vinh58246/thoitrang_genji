<?php
require_once "model/category.php";
class CategoryController{
    private $model = null;
    function __construct()
    {
        $this->model = new category();

    }
    function index(){
        $this->checkusernot();

        $allCategories = $this->model->all_categories();
        
        $datatable_js = '<script src="public/assets/js/pages/list_category.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_categories.php";
        include_once "view/admin/layout.php";
    }
    function create(){
        $this->checkusernot();

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4];
        $view_content = "view/admin/add_category.php";
        include_once "view/admin/layout.php";
        
    }
    function store(){
        $this->checkusernot();

        $name_file = $_FILES['image']['name'];
        $temp_file = $_FILES['image']['tmp_name'];
        $name = trim(strip_tags($_POST['name']));
        $name_slug = $this->name_slug($name);
        $status = (int) $_POST['status'];
        $display_order = ($_POST['display_order'] == '') ? $this->model->count_categories() + 1 : $_POST['display_order'];
        
        
        if($name_file == '' || $name == '' || strlen($name) >= 255 || strlen($display_order) >= 11){
            $notification = false;
        }
        else{
            move_uploaded_file($temp_file, "public/assets/image_category/$name_file");
            $this->model->save_category($name_file, $name, $status, $display_order, $name_slug);
            $notification = true;
        }

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4];
        $view_content = "view/admin/add_category.php";
        include_once "view/admin/layout.php";
    }
    function show(){
        $this->checkusernot();

        global $params;
        $id = $params['id'];
        $detail = $this->model->detail_category($id);

        $link_css = Linkfile::LINKCSS[1];
        $link_js = Linkfile::LINKJS[4];
        $view_content = "view/admin/edit_category.php";
        include_once "view/admin/layout.php";
       
    }
    function edit(){
        $this->checkusernot();

        $id = $_POST['id'];
        
        $detail = $this->model->detail_category($id);
        
        $name_file = $_FILES['image']['name'];
        $temp_file = $_FILES['image']['tmp_name'];
        $name = trim(strip_tags($_POST['name']));
        $name_slug = $this->name_slug($name);
        $status = (int) $_POST['status'];
        $display_order = ($_POST['display_order'] == '') ? $this->model->count_categories() : $_POST['display_order'];
        
        
        if($name == '' || strlen($name) >= 255 || strlen($display_order) >= 11){
            $notification = false;
        }
        elseif($name_file == ''){
            $name_file = $detail['image'];
            $this->model->update_category($id, $name_file, $name, $status, $display_order, $name_slug);
            $notification = true;
        }
        else{
            move_uploaded_file($temp_file, "public/assets/image_category/$name_file");
            $this->model->update_category($id, $name_file, $name, $status, $display_order, $name_slug);
            $notification = true;
        }
        $detail = $this->model->detail_category($id);
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4];
        $view_content = "view/admin/edit_category.php";
        include_once "view/admin/layout.php";
    }
    function destroy(){
        $this->checkusernot();

        try{
            global $params;
            $id = $params['id'];
            $detail = $this->model->detail_category($id);
            $notification = $this->model->delete_category($id);

            if($notification == true){
                $_SESSION['notification']['destroy_list'] = 1;
                $link_image = "public/assets/image_category/".$detail['image'];
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
        header("location:". ROOT_URL. "categories");
    }
    function destroy_list(){
        $this->checkusernot();

        try{
            // kiểm tra check list có tồn tại không
            if(isset($_POST['check_list'])){
                for ($i=0; $i < count($_POST['check_list']); $i++) { 

                    $id = $_POST['check_list'][$i];
                    $detail = $this->model->detail_category($id);
                    $notification = $this->model->delete_category($id);

                    if($notification == true){
                        $_SESSION['notification']['destroy_list'] = 1;
                        $link_image = "public/assets/image_category/".$detail['image'];
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
        header("location:". ROOT_URL. "categories");
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