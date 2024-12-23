<?php
require_once "model/category.php";
require_once "model/product.php";
require_once "model/variantProduct.php";
require_once "model/listImageProduct.php";
class ProductController{
    private $modelcate = null;
    private $modelpro = null;
    private $modelcomm = null;
    private $modelvariant = null;
    private $modellist_p_image = null;
    function __construct()
    {
        $this->modelpro = new product();
        $this->modelcate = new category();
        $this->modelvariant = new variantProduct();
        $this->modellist_p_image = new listImageProduct();


    }
    function index(){
        global $params;
        if(isset($params['cate'])){
            $slug = $params['cate'];
            $idcategory = $this->modelcate->detail_category_slug($slug);
            $allProducts = $this->modelpro->cate_products($idcategory['id']);
        }else{
            $allProducts = $this->modelpro->all_products();
        }

        $allCategories = $this->modelcate->all_categories();

        $datatable_js = '<script src="public/assets/js/pages/list_product.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_products.php";
        include_once "view/admin/layout.php";
    }
    function create(){
        $allCategories = $this->modelcate->all_categories();

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/add_product.php";
        include_once "view/admin/layout.php";
    }
    function store(){

        $name_file = $_FILES['image']['name'];
        $temp_file = $_FILES['image']['tmp_name'];

        $name_file_son = $_FILES['list_image'];
        $name_file_valit_son = $_FILES['list_image']['name'][0];

        $idcategory = $_POST['idcategory'];
        $name = trim(strip_tags($_POST['name']));
        $name_slug = $this->name_slug($name);
        $detailed_description = (strlen($_POST['detailed_description']) <= 50) ? null : $_POST['detailed_description'];
        $product_summary = trim(strip_tags($_POST['product_summary']));
        $price = (int) $_POST['price'];
        $quantity = ($_POST['quantity'] == '') ?  999 : (int) $_POST['quantity'];
        $hot = (int) $_POST['hot'];
        $status = (int) $_POST['status'];


        if(strlen($name_file_valit_son) == '' || strlen($product_summary) <= 5 || $name_file == '' || $name == '' || strlen($name) >= 255 || $price == '' || $price >= 10000000000 || $idcategory == 0){
            $notification = false;
        }
        else{
            $idproduct = $this->modelpro->save_product($idcategory, $name, $name_file, $detailed_description, $product_summary, $price, $quantity, $hot, $status, $name_slug);

            for ($i=0; $i < count($_FILES['list_image']['name']); $i++) { 
                move_uploaded_file($name_file_son['tmp_name'][$i], "public/assets/images_product/".$name_file_son['name'][$i]);
                $this->modellist_p_image->save_list_image_product($idproduct, $name_file_son['name'][$i], $i);
            }

            move_uploaded_file($temp_file, "public/assets/images_product/$name_file");
            $notification = true;
        }

       
        // 
        // 
        // 
        // hiển thị gia diện
        // 
        // 

        $allCategories = $this->modelcate->all_categories();

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/add_product.php";
        include_once "view/admin/layout.php";


        // xử lý biến thể
        if(isset($idproduct) && !empty($idproduct)){
        
            if(isset($_POST['quantity_attribute'])){
                for ($i=0; $i < count($_POST['name_variant']); $i++) {
                    $idname = $this->modelvariant->save_variant_name($idproduct, $_POST['name_variant'][$i]);
                    $arrayname[$_POST['name_variant'][$i]] = $idname;

                    // $this->modelvariant->save_variant_attribute($idname, );
               }
               $countvariant = 0;

                for ($i=0; $i < count($_POST['quantity_attribute']); $i++) { 
                    
                   if($_POST['quantity_attribute'][$i] !== ''){
                        $countvariant++;
                   }
                }
                
                echo $countvariant.' có giá trị';
                if($countvariant > 0){
                    $name_attribute = $_POST['name_attribute'];
                    $value_attribute = $_POST['value_attribute'];
                    $tinhsolanlap = $countvariant * count($arrayname);

                    // $arrayvaluenotalike = array_unique($value_attribute);

                    // for ($i=0; $i < $tinhsolanlap; $i++) {
                    //     for ($j=0; $j < count($arrayvaluenotalike); $j++) { 
                    //         if($arrayvaluenotalike[$j] == $value_attribute[$i]){
                    //             $objectab[$arrayvaluenotalike[$j]] = 
                    //         }
                    //     }
                    // }
                    // echo '<pre>';
                    //     var_export(array_unique($value_attribute));
                    // echo '</pre>';

                    // echo $tinhsolanlap.' thuộc tính cần lấy</br>';
                    for ($i=0; $i < $tinhsolanlap; $i++) { 
                        foreach ($arrayname as $key => $value) {
                            // echo 'mảng arrayname có key = '.$key.' và giá trị = '.$value.'</br>';
                            if($name_attribute[$i] == $key){
                                $objvalue[$value_attribute[$i]] = $value;
                                // echo 'giá trị '.$value_attribute[$i].' có tên biến thể là '.$name_attribute[$i].' thuộc trong key ( '.$key.' ) và có id ( '.$value.' )</br>';
                                // $this->modelvariant->save_variant_attribute($value, $value_attribute[$i]);
                            }
                        }

                    }

                    // thêm giá trị bào bảng variant attribute và lấy id sau khi thêm
                    foreach ($objvalue as $key => $value) {
                        $idattribute = $this->modelvariant->save_variant_attribute($value, $key);
                        $objattri[$key] = $idattribute;
                    }
                    
                    $flag_name = 0;
                    $demarray = 0;
                    $array_link = [];
                    for ($i=0; $i < $tinhsolanlap; $i++) { 
                        
                        foreach ($objattri as $key => $value) {
                            if($value_attribute[$i] == $key){
                                $array_link[$demarray][$flag_name] = $value;
                                // $array_link[$demarray] += $value;
                            }
                        }
                        
                        
                        $flag_name++;
                        if($flag_name == count($arrayname)){
                            $flag_name = 0;
                            $demarray++;
                        }
    
                    }

                    $images_attribute = $_FILES['images_attribute'];
                    $price_attribute = $_POST['price_attribute'];
                    $quantity_attribute = $_POST['quantity_attribute'];
                    // echo '--------------------------------------</br>';
                    for ($i=0; $i < count($array_link); $i++) {
                        $linking = implode('-', $array_link[$i]);
                        // echo 'từ mảng thành chuỗi thứ '.$i.' ( '.$linking.' )</br>';
                        // echo 'hình ảnh thứ '.$i.' ( '.$images_attribute['name'][$i].' )</br>';
                        // echo 'giá tiền thứ '.$i.' ( '.$price_attribute[$i].' )</br>';
                        // echo 'số lượng thứ '.$i.' ( '.$quantity_attribute[$i].' )</br>';
                        // echo '--------------------------------------</br>';
                        $this->modelvariant->save_linking_variant_attributes($idproduct, $linking, $quantity_attribute[$i], $price_attribute[$i], $images_attribute['name'][$i]);
                    }

                    

                    // echo "mảng đếm array link";
                    // echo '<pre>';
                    //     var_export($array_link);
                    // echo '</pre>';


                }
            }
            // else{
            //     echo 'không có biến thể nào';
            // }

        }
        // echo '<pre>';
        //     var_export($objvalue);
        // echo '</pre>';
        // echo '<pre>';
        //     var_export($objattri);
        // echo '</pre>';

        // echo 'có '.count($arrayname).' tên biến thể</br>';


        // foreach ($arrayname as $key => $value) {
        //     echo 'mảng arrayname có key = '.$key.' và giá trị = '.$value.'</br>';
        //     // if($name_attribute[$i] == $key){
        //     //     $this->modelvariant->save_variant_attribute($value, $value_attribute[$i]);
        //     // }
        // }

        
        // for ($i=0; $i < count($images_attribute); $i++) { 
        //     # code...
        // }

    }

    function show(){
        $link_css = Linkfile::LINKCSS[1];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/edit_product.php";
        include_once "view/admin/layout.php";
    }
    function edit(){

    }
    function destroy(){
        try{
            global $params;
            $id = $params['id'];
            $detail = $this->modelpro->detail_product($id);
            $notification = $this->modelpro->delete_product($id);

            if($notification == true){
                $_SESSION['notification']['destroy_list'] = 1;
                $link_image = "public/assets/images_product/".$detail['image'];
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
        header("location:". ROOT_URL. "products");
    }
    function destroy_list(){
        try{
            // kiểm tra check list có tồn tại không
            if(isset($_POST['check_list'])){
                for ($i=0; $i < count($_POST['check_list']); $i++) { 

                    $id = $_POST['check_list'][$i];
                    $detail = $this->modelpro->detail_product($id);
                    $notification = $this->modelpro->delete_product($id);

                    if($notification == true){
                        $_SESSION['notification']['destroy_list'] = 1;
                        $link_image = "public/assets/images_product/".$detail['image'];
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
        header("location:". ROOT_URL. "products");
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
}
?>