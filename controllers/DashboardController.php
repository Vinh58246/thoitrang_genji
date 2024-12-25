<?php
require_once "model/category.php";
require_once "model/product.php";
require_once "model/news.php";
require_once "model/customer.php";
class DashboardController{
    private $modelcate = null;
    private $modelpro = null;
    private $modelnews = null;
    private $modelcus = null;
    function __construct()
    {
        $this->modelcate = new category();
        $this->modelpro = new product();
        $this->modelnews = new news();
        $this->modelcus = new customer();

    }
    function index(){
        $this->checkusernot();

        $quantitycate = $this->modelcate->count_categories();
        $quantitypro = $this->modelpro->count_products();
        $quantitynews = $this->modelnews->count_news();
        $quantitycus = $this->modelcus->count_user();

        $link_css = Linkfile::LINKCSS[4];
        $link_js = Linkfile::LINKJS[1];
        $view_content = "view/admin/dashboard.php";
        include_once "view/admin/layout.php";
    }
    function checkusernot(){
        if(!isset($_SESSION['user']) || empty($_SESSION['user']) || empty($_SESSION['user']['email_verified_at'])){
            header("location:". ROOT_URL. "login");
        }
    }
}
?>