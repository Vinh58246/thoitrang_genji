<?php
class CommentController{
    function index(){
        $datatable_js = '<script src="public/assets/js/pages/list_comments.init.js"></script>';
        $link_css = Linkfile::LINKCSS[2];
        $link_js = Linkfile::LINKJS[2]; 
        $view_content = "view/admin/list_comments.php";
        include_once "view/admin/layout.php";
    }
    function destroy(){
        echo "xóa bình luận";
    }
}
?>