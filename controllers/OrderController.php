<?php
class OrderController{
    function index(){
        $datatable_js = '<script src="public/assets/js/pages/list_order.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_orders.php";
        include_once "view/admin/layout.php";
    }
    function show(){
        $link_css = Linkfile::LINKCSS[1];
        $link_js = Linkfile::LINKJS[4]; 
        $view_content = "view/admin/detail_order.php";
        include_once "view/admin/layout.php";
    }
    function destroy(){
        echo "xóa đơn hàng";
    }
}
?>