<?php
require_once "model/order.php";
require_once "model/variantProduct.php";
class OrderController{
    private $modelodr = null;
    private $modelvariant = null;
    function __construct()
    {
        $this->modelodr = new order();
        $this->modelvariant = new variantProduct();
    }
    function index(){
        $this->checkusernot();

        $all_orders = $this->modelodr->show_list_order();

        $arr_orders = $all_orders->fetchAll(PDO::FETCH_OBJ);;
        // echo "<pre>";
        //     var_export($arr_orders);
        // echo "</pre>";

        $arrodr = [];
        $list = -1;
        $dem = 0;
        foreach ($arr_orders as $item) {
            // echo $item->idodr;
            if (isset($arrodr[$list]['idodr']) && $arrodr[$list]['idodr'] == $item->idodr) {

                array_push($arrodr[$list]['image'], $item->image);
                unset($arrodr[$list]['quantity']);
                unset($arrodr[$list]['price']);

                $arrodr[$list]['subprice'] += ($item->quantity * $item->price);
            } 
            else {
                $arrodr[] = [
                    'id' => $item->id,
                    'idodr' => $item->idodr,
                    'order_code' => $item->order_code,
                    'image' => [$item->image],
                    'timetooder' => $item->timetooder,
                    'payment_status' => $item->payment_status,
                    'shipping_price' => $item->shipping_price,
                    'payment_method' => $item->payment_method,
                    'order_status' => $item->order_status,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subprice' => ($item->quantity * $item->price),
                ];
                $list++;
            }
        }

        // Kết quả
        // echo "<pre>";
        // var_export($arrodr);
        // echo "</pre>";

        $datatable_js = '<script src="public/assets/js/pages/list_order.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_orders.php";
        include_once "view/admin/layout.php";
    }
    function show(){
        $this->checkusernot();

        global $params;
        $id = $params['id'];

        $deltail_information_order = $this->modelodr->deltail_information_order($id);
        $detail_product_order = $this->modelodr->detail_product_order($id);

        $allproductorder = [];
        $arrlinking = [];
        foreach ($detail_product_order as $v) {
            // echo $v['linking'];
            $chuoilinking = explode('-', $v['linking']);
            array_push($arrlinking, $chuoilinking);
            $nameattr = '';
            for($i=0; $i < count($chuoilinking); $i++) { 
                $show_value_attributes = $this->modelvariant->show_value_attributes($chuoilinking[$i]);
                $nameattr .= $show_value_attributes['value_variant'].', ';
                
                
            }

            $allproductorder[] = [
                'image' => $v['image'],
                'nameproduct' => $v['name'],
                'slugproduct' => $v['slug'],
                'inforproduct' => $nameattr,
                'quantity' => $v['quantity'],
                'price' => $v['price'],
                'totalpriceproduct' => ($v['quantity'] * $v['price'])
            ];

        }

        // echo "<pre>";
        // var_export($allproductorder);
        // echo "</pre>";
        // echo "<pre>";
        // var_export($arrlinking);
        // echo "</pre>";

        $link_css = Linkfile::LINKCSS[1];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/detail_order.php";
        include_once "view/admin/layout.php";
    }
    
    function edit(){
        $this->checkusernot();

        $idorder = $_POST['idorder'];
        $statusorder = $_POST['statusorder'];
        $this->modelodr->update_status_order($idorder, $statusorder);

        $_SESSION['notification']['destroy_list'] = 1;
        header("location:". ROOT_URL. "detail_order?id=".$idorder);
    }
    function checkusernot(){
        if(!isset($_SESSION['user']) || empty($_SESSION['user']) || empty($_SESSION['user']['email_verified_at'])){
            header("location:". ROOT_URL. "login");
        }
    }
}
?>