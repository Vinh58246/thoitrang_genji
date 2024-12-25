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
        $this->checkusernot();

        global $params;
        if(isset($params['cate'])){
            $slug = $params['cate'];
            $idcategory = $this->modelcate->detail_category_slug($slug);
            $allProducts = $this->modelpro->cate_products($idcategory['id']);
        }else{
            $allProducts = $this->modelpro->list_all_product();
        }

        $allCategories = $this->modelcate->all_categories();

        $datatable_js = '<script src="public/assets/js/pages/list_product.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_products.php";
        include_once "view/admin/layout.php";
    }
    function create(){
        $this->checkusernot();

        $allCategories = $this->modelcate->all_categories();

        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/add_product.php";
        include_once "view/admin/layout.php";
    }
    function store(){
        $this->checkusernot();

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
        $hot = (int) $_POST['hot'];
        $status = (int) $_POST['status'];


        if(strlen($name_file_valit_son) == '' || strlen($product_summary) <= 5 || $name_file == '' || $name == '' || strlen($name) >= 255 || $price == '' || $price >= 10000000000 || $idcategory == 0){
            $notification = false;
        }
        else{
            $idproduct = $this->modelpro->save_product($idcategory, $name, $name_file, $detailed_description, $product_summary, $price, $hot, $status, $name_slug);

            for ($i=0; $i < count($_FILES['list_image']['name']); $i++) { 
                move_uploaded_file($name_file_son['tmp_name'][$i], "public/assets/images_product/".$name_file_son['name'][$i]);
                $this->modellist_p_image->save_list_image_product($idproduct, $name_file_son['name'][$i], $i, $name_file_son['size'][$i]);
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
            
            // nếu biến quantity_attribute có tồn tại
            if(isset($_POST['quantity_attribute'])){
                // echo '<pre>';
                //         var_export($_POST['name_variant']);
                //     echo '</pre>';


                
                // lấy tên biến thê và lưu
                for ($i=0; $i < count($_POST['name_variant']); $i++) {
                    $idname = $this->modelvariant->save_variant_name($idproduct, $_POST['name_variant'][$i]);
                    $arrayname[$_POST['name_variant'][$i]] = $idname;

                    // $this->modelvariant->save_variant_attribute($idname, );
               }


// echo '<pre>';
//                         var_export($arrayname);
//                     echo '</pre>';
                

                //    đếm có bao nhiêu quantity_attribute có giá trị
               $countvariant = 0;
               $listcogiatri = [];
               $listrong = [];
                for ($i=0; $i < count($_POST['quantity_attribute']); $i++) { 
                    
                   if(!empty($_POST['quantity_attribute'][$i])){
                        $listcogiatri[] = $i;
                        $countvariant++;
                   }else{
                        $listrong[] = $i;
                   }
                }
                // echo 'list rong';
                // echo '<pre>';
                //         var_export($listcogiatri);
                //     echo '</pre>';
                // echo '<pre>';
                //         var_export($listrong);
                //     echo '</pre>';
                // echo '<pre>';
                //         var_export($_POST['quantity_attribute']);
                //     echo '</pre>';
                // echo $countvariant.' có giá trị';
                // nếu các trường có giá trị lớn hơn 0
                if($countvariant > 0){
                    $name_attribute = $_POST['name_attribute'];
                    $value_attribute = $_POST['value_attribute'];

                    $arrvalue_attribute = [];
                    // echo '<pre>';
                    //     var_export($value_attribute);
                    // echo '</pre>';
                    foreach ($listrong as $key => $value) {
                        for ($i=0; $i < count($arrayname); $i++) { 
                            unset($value_attribute[$value * 2 + $i]);
                        }
                    }

                    // lọc các attribute không có giá trị, thay mảng mới
                    $newvalue_attriute_saukhixoa = array_values($value_attribute);

                    // echo '<pre>';
                    //     var_export($newvalue_attriute_saukhixoa);
                    // echo '</pre>';
                    $tinhsolanlap = $countvariant * count($arrayname);


                    // echo $tinhsolanlap.' thuộc tính cần lấy</br>';
                    for ($i=0; $i < $tinhsolanlap; $i++) { 
                        foreach ($arrayname as $key => $value) {
                            // echo 'mảng arrayname có key = ( '.$key.' ) và giá trị = ( '.$value.' )</br>';
                            if($name_attribute[$i] == $key){
                                $objvalue[$newvalue_attriute_saukhixoa[$i]] = $value;
                                // echo 'giá trị '.$newvalue_attriute_saukhixoa[$i].' có tên biến thể là '.$name_attribute[$i].' thuộc trong key ( '.$key.' ) và có id ( '.$value.' )</br>';
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
                            if($newvalue_attriute_saukhixoa[$i] == $key){
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

                    // echo "hình ảnh";
                    // echo '<pre>';
                    //     var_export($images_attribute['name']);
                    // echo '</pre>';
                    // echo "giá";
                    // echo '<pre>';
                    //     var_export($price_attribute);
                    // echo '</pre>';
                    // echo "số lượng";
                    // echo '<pre>';
                    //     var_export($quantity_attribute);
                    // echo '</pre>';
                    // echo "mảng link";
                    // echo '<pre>';
                    //     var_export($array_link);
                    // echo '</pre>';
                    // echo '--------------------------------------</br>';

                    foreach ($listcogiatri as $key => $value) {
                        $linking = implode('-', $array_link[$key]);
                        if(isset($images_attribute['name'][$value]) && !empty($images_attribute['name'][$value])){
                            move_uploaded_file($images_attribute['tmp_name'][$i], "public/assets/images_variant/".$images_attribute['name'][$i]);
                        }
                        $this->modelvariant->save_linking_variant_attributes($idproduct, $linking, $quantity_attribute[$value], $price_attribute[$value], $images_attribute['name'][$value]);
                    // echo $key."</br>";
                    // echo $value."</br>";
                    // echo "-----------------</br>";
                    }

                }
            }


            // else{
                //     echo 'không có biến thể nào';
                // }
                
            }
        // header("location:". ROOT_URL. "detail_product?id=".$idproduct);
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
        $this->checkusernot();

        global $params;
        $id = $params['id'];
        $allCategories = $this->modelcate->all_categories();
        $detail = $this->modelpro->detail_product($id);
        $list_image = $this->modellist_p_image->show_list_image_product($id);
        $show_variant_name = $this->modelvariant->show_variant_name($id);
        
        if(isset($show_variant_name) && !empty($show_variant_name)){
            $show_linking_variant_attributes = $this->modelvariant->show_linking_variant_attributes($id);

            //  echo "<pre>";
            // var_export($show_variant_name);
            // echo "</pre>";
            $namevarriant = [];
            $arrvalue = [];
            $flag_lapvalue = 0;
            foreach ($show_variant_name as $i) {
                $namevarriant[] = $i['name'];
                $show_variant_attribute = $this->modelvariant->show_variant_attribute($i['id']);
                foreach ($show_variant_attribute as $j) {

                    $arrvalue[$flag_lapvalue] = [$j['id'], $j['idvariantname'], $j['value_variant']];
                    // echo 'id '.$i['id'].'</br>';
                    // echo 'idvariantname '.$i['idvariantname'].'</br>';
                    // echo 'value_variant '.$i['value_variant'].'</br>';
                    // echo '-------------------------</br>';
                    $flag_lapvalue++;
                }
            }


            //  echo "<pre>";
            // var_export($namevarriant);
            // echo "</pre>";
            $arrlinking = [];
            $flag_linking = 0;
            foreach ($show_linking_variant_attributes as $i) {
                $arrplolinking = explode('-', $i['linking']);

                $arrlinking[$flag_linking] = [$i['id'], $i['idproduct'], $arrplolinking, $i['price'], $i['quantity'], $i['image']];
                // echo 'id '.$i['id'].'</br>';
                // echo 'idproduct '.$i['idproduct'].'</br>';
                // echo 'linking '.$i['linking'].'</br>';
                // echo 'price '.$i['price'].'</br>';
                // echo 'image '.$i['image'].'</br>';
                // echo '-------------------------</br>';
                $flag_linking++;
            }
            

            for ($i=0; $i < count($arrlinking); $i++) { 
                // echo "<pre>";
                // var_export($arrlinking);
                // echo "</pre>";
                

                for ($j=0; $j < count($arrlinking[$i][2]); $j++) { 
                    // echo "<pre>";
                    // var_export($arrlinking[$i][2][$j]);
                    // echo "</pre>";

                    for ($k=0; $k < count($arrvalue); $k++) { 
                        if($arrvalue[$k][0] == $arrlinking[$i][2][$j]){
                            // thay so sánh mảng linking sao đó thêm giá trị
                            $arrlinking[$i][2][$j] = $arrlinking[$i][2][$j].'%-%'.$arrvalue[$k][2];
                            // $arrlinking[$i] = $arrvalue[$k][2];
                        }
                    }
                }
            }

            // hiển thị show_variant_attribute
            // echo "<pre>";
            // var_export($show_variant_name);
            // echo "</pre>";
            // foreach ($show_variant_name as $i) {
            //     echo $i['name'];
            // }

            // hiển thị linking_variant_attributes
            // echo "<pre>";
            // var_export($arrlinking);
            // echo "</pre>";
        }
        // echo "<pre>";
        // var_export($arrlinking);
        // echo "</pre>";

        // array (
        //     0 => 80,
        //     1 => 92,
        //     2 => 
        //     array (
        //       0 => '147%-%vàng',
        //       1 => '148%-%S',
        //     ),
        //     3 => 0,
        //     4 => 30,
        //     5 => 'bong den.png',
        //   ),
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/edit_product.php";
        include_once "view/admin/layout.php";
    }





    function edit(){
        $this->checkusernot();

        $id = $_POST['id'];
        $allCategories = $this->modelcate->all_categories();
        $detail = $this->modelpro->detail_product($id);
        $list_image = $this->modellist_p_image->show_list_image_product($id);
        $show_variant_name = $this->modelvariant->show_variant_name($id);


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
        $hot = (int) $_POST['hot'];
        $status = (int) $_POST['status'];

        

        if(strlen($product_summary) <= 5 || $name == '' || strlen($name) >= 255 || $price == '' || $price >= 10000000000 || $idcategory == 0){
            $notification = false;
        }
        elseif($name_file == ''){
            $name_file = $detail['image'];
            $this->modelpro->update_product($id, $idcategory,$name,$name_file,$detailed_description,$product_summary,$price,$hot,$status,$name_slug);
            $notification = true;

            if(!empty($name_file_valit_son)){
                $idproduct = $this->modellist_p_image->remove_list_image_product($id);
                for ($i=0; $i < count($_FILES['list_image']['name']); $i++) { 
                    move_uploaded_file($name_file_son['tmp_name'][$i], "public/assets/images_product/".$name_file_son['name'][$i]);
                    $this->modellist_p_image->save_list_image_product($id, $name_file_son['name'][$i], $i, $name_file_son['size'][$i]);
                }
            }

            
            if(isset($_POST['quantity_attribute']) && !empty($_POST['quantity_attribute'])){
                $quantity_attribute = $_POST['quantity_attribute'];
                $id_linking_variant = $_POST['id_linking_variant'];
                $price_attribute = $_POST['price_attribute'];
                for ($i=0; $i < count($quantity_attribute); $i++) { 
                    $this->modelvariant->update_linking_variant_attributes($id_linking_variant[$i], $quantity_attribute[$i], $price_attribute[$i]);
                    // echo "id ( ".$id_linking_variant[$i]." )<br>";
                    // echo "số lượng ( ".$quantity_attribute[$i]." )<br>";
                    // echo "giá ( ".$price_attribute[$i]." )<br>";
                    // echo "---------------------<br>";
                }
            }
    
        }
        else{
            $idproduct = $this->modelpro->update_product($id, $idcategory,$name,$name_file,$detailed_description,$product_summary,$price,$hot,$status,$name_slug);
            move_uploaded_file($temp_file, "public/assets/images_product/$name_file");

            if(!empty($name_file_valit_son)){
                $this->modellist_p_image->remove_list_image_product($id);
                for ($i=0; $i < count($_FILES['list_image']['name']); $i++) { 
                    move_uploaded_file($name_file_son['tmp_name'][$i], "public/assets/images_product/".$name_file_son['name'][$i]);
                    $this->modellist_p_image->save_list_image_product($id, $name_file_son['name'][$i], $i, $name_file_son['size'][$i]);
                }
            }

            
            
            if(isset($_POST['quantity_attribute']) && !empty($_POST['quantity_attribute'])){
                $quantity_attribute = $_POST['quantity_attribute'];
                $id_linking_variant = $_POST['id_linking_variant'];
                $price_attribute = $_POST['price_attribute'];
                for ($i=0; $i < count($quantity_attribute); $i++) { 
                    $this->modelvariant->update_linking_variant_attributes($id_linking_variant[$i], $quantity_attribute[$i], $price_attribute[$i]);
                    // echo "id ( ".$id_linking_variant[$i]." )<br>";
                    // echo "số lượng ( ".$quantity_attribute[$i]." )<br>";
                    // echo "giá ( ".$price_attribute[$i]." )<br>";
                    // echo "---------------------<br>";
                }
            }



            $notification = true;
        }

         // var_export($id_linking_variant);
         
        
        // 
        // 
        // 
        // hiển thị gia diện
        // 
        // 
        $allCategories = $this->modelcate->all_categories();
        $detail = $this->modelpro->detail_product($id);
        $list_image = $this->modellist_p_image->show_list_image_product($id);
        $show_variant_name = $this->modelvariant->show_variant_name($id);

        if(isset($show_variant_name) && !empty($show_variant_name)){
            $show_linking_variant_attributes = $this->modelvariant->show_linking_variant_attributes($id);


            $arrvalue = [];
            $flag_lapvalue = 0;
            foreach ($show_variant_name as $i) {
                $show_variant_attribute = $this->modelvariant->show_variant_attribute($i['id']);
                foreach ($show_variant_attribute as $j) {

                    $arrvalue[$flag_lapvalue] = [$j['id'], $j['idvariantname'], $j['value_variant']];
                    // echo 'id '.$i['id'].'</br>';
                    // echo 'idvariantname '.$i['idvariantname'].'</br>';
                    // echo 'value_variant '.$i['value_variant'].'</br>';
                    // echo '-------------------------</br>';
                    $flag_lapvalue++;
                }
            }

            $arrlinking = [];
            $flag_linking = 0;
            foreach ($show_linking_variant_attributes as $i) {
                $arrplolinking = explode('-', $i['linking']);

                $arrlinking[$flag_linking] = [$i['id'], $i['idproduct'], $arrplolinking, $i['price'], $i['quantity'], $i['image']];
                // echo 'id '.$i['id'].'</br>';
                // echo 'idproduct '.$i['idproduct'].'</br>';
                // echo 'linking '.$i['linking'].'</br>';
                // echo 'price '.$i['price'].'</br>';
                // echo 'quantity '.$i['quantity'].'</br>';
                // echo 'image '.$i['image'].'</br>';
                // echo '-------------------------</br>';
                $flag_linking++;
            }
            

            for ($i=0; $i < count($arrlinking); $i++) { 
                // echo "<pre>";
                // var_export($arrlinking);
                // echo "</pre>";
                

                for ($j=0; $j < count($arrlinking[$i][2]); $j++) { 
                    // echo "<pre>";
                    // var_export($arrlinking[$i][2][$j]);
                    // echo "</pre>";

                    for ($k=0; $k < count($arrvalue); $k++) { 
                        if($arrvalue[$k][0] == $arrlinking[$i][2][$j]){
                            // thay so sánh mảng linking sao đó thêm giá trị
                            $arrlinking[$i][2][$j] = $arrlinking[$i][2][$j].'%-%'.$arrvalue[$k][2];
                            // $arrlinking[$i] = $arrvalue[$k][2];
                        }
                    }
                }
            }
        }

       
        // $link_css = Linkfile::LINKCSS[3];
        // $link_js = Linkfile::LINKJS[4]; 
        // $view_content = "view/admin/edit_product.php";
        // include_once "view/admin/layout.php";
        header("location:". ROOT_URL. "detail_product?id=".$id);


        // xử lý biến thể
        // if(isset($idproduct) && !empty($idproduct)){
        
        //     if(isset($_POST['quantity_attribute'])){
        //         for ($i=0; $i < count($_POST['name_variant']); $i++) {
        //             $idname = $this->modelvariant->save_variant_name($idproduct, $_POST['name_variant'][$i]);
        //             $arrayname[$_POST['name_variant'][$i]] = $idname;

        //             // $this->modelvariant->save_variant_attribute($idname, );
        //        }
        //        $countvariant = 0;

        //         for ($i=0; $i < count($_POST['quantity_attribute']); $i++) { 
                    
        //            if($_POST['quantity_attribute'][$i] !== ''){
        //                 $countvariant++;
        //            }
        //         }
                
        //         echo $countvariant.' có giá trị';
        //         if($countvariant > 0){
        //             $name_attribute = $_POST['name_attribute'];
        //             $value_attribute = $_POST['value_attribute'];
        //             $tinhsolanlap = $countvariant * count($arrayname);

        //             // $arrayvaluenotalike = array_unique($value_attribute);

        //             // for ($i=0; $i < $tinhsolanlap; $i++) {
        //             //     for ($j=0; $j < count($arrayvaluenotalike); $j++) { 
        //             //         if($arrayvaluenotalike[$j] == $value_attribute[$i]){
        //             //             $objectab[$arrayvaluenotalike[$j]] = 
        //             //         }
        //             //     }
        //             // }
        //             // echo '<pre>';
        //             //     var_export(array_unique($value_attribute));
        //             // echo '</pre>';

        //             // echo $tinhsolanlap.' thuộc tính cần lấy</br>';
        //             for ($i=0; $i < $tinhsolanlap; $i++) { 
        //                 foreach ($arrayname as $key => $value) {
        //                     // echo 'mảng arrayname có key = '.$key.' và giá trị = '.$value.'</br>';
        //                     if($name_attribute[$i] == $key){
        //                         $objvalue[$value_attribute[$i]] = $value;
        //                         // echo 'giá trị '.$value_attribute[$i].' có tên biến thể là '.$name_attribute[$i].' thuộc trong key ( '.$key.' ) và có id ( '.$value.' )</br>';
        //                         // $this->modelvariant->save_variant_attribute($value, $value_attribute[$i]);
        //                     }
        //                 }

        //             }

        //             // thêm giá trị bào bảng variant attribute và lấy id sau khi thêm
        //             foreach ($objvalue as $key => $value) {
        //                 $idattribute = $this->modelvariant->save_variant_attribute($value, $key);
        //                 $objattri[$key] = $idattribute;
        //             }
                    
        //             $flag_name = 0;
        //             $demarray = 0;
        //             $array_link = [];
        //             for ($i=0; $i < $tinhsolanlap; $i++) { 
                        
        //                 foreach ($objattri as $key => $value) {
        //                     if($value_attribute[$i] == $key){
        //                         $array_link[$demarray][$flag_name] = $value;
        //                         // $array_link[$demarray] += $value;
        //                     }
        //                 }
                        
                        
        //                 $flag_name++;
        //                 if($flag_name == count($arrayname)){
        //                     $flag_name = 0;
        //                     $demarray++;
        //                 }
    
        //             }

        //             $images_attribute = $_FILES['images_attribute'];
        //             $price_attribute = $_POST['price_attribute'];
        //             $quantity_attribute = $_POST['quantity_attribute'];
        //             // echo '--------------------------------------</br>';
        //             for ($i=0; $i < count($array_link); $i++) {
        //                 $linking = implode('-', $array_link[$i]);
        //                 if(isset($images_attribute['name'][$i]) && !empty($images_attribute['name'][$i])){
        //                     move_uploaded_file($images_attribute['tmp_name'][$i], "public/assets/images_variant/".$images_attribute['name'][$i]);
        //                 }
        //                 // echo 'từ mảng thành chuỗi thứ '.$i.' ( '.$linking.' )</br>';
        //                 // echo 'hình ảnh thứ '.$i.' ( '.$images_attribute['name'][$i].' )</br>';
        //                 // echo 'giá tiền thứ '.$i.' ( '.$price_attribute[$i].' )</br>';
        //                 // echo 'số lượng thứ '.$i.' ( '.$quantity_attribute[$i].' )</br>';
        //                 // echo '--------------------------------------</br>';
        //                 $this->modelvariant->save_linking_variant_attributes($idproduct, $linking, $quantity_attribute[$i], $price_attribute[$i], $images_attribute['name'][$i]);
        //             }

                    

        //             // echo "mảng đếm array link";
        //             // echo '<pre>';
        //             //     var_export($array_link);
        //             // echo '</pre>';


        //         }
        //     }
        //     // else{
        //     //     echo 'không có biến thể nào';
        //     // }

        // }
        // kết thúc xử lý

    }
    function destroy(){
        $this->checkusernot();

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
        $this->checkusernot();

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

    function checkusernot(){
        if(!isset($_SESSION['user']) || empty($_SESSION['user']) || empty($_SESSION['user']['email_verified_at'])){
            header("location:". ROOT_URL. "login");
        }
    }
}
?>