<?php
class DashboardController{
    function index(){
        $link_css = Linkfile::LINKCSS[4];
        $link_js = Linkfile::LINKJS[1];
        $view_content = "view/admin/dashboard.php";
        include_once "view/admin/layout.php";
    }
}
?>