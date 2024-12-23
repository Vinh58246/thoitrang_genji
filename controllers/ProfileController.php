<?php
class ProfileController{
    function index(){
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[3]; 
        $view_content = "view/admin/profile.php";
        include_once "view/admin/layout.php";
    }

    function edit(){
        echo "xin chào";

        
        $link_css = Linkfile::LINKCSS[3];
        $link_js = Linkfile::LINKJS[3]; 
        $view_content = "view/admin/profile.php";
        include_once "view/admin/layout.php";
    }
}
?>