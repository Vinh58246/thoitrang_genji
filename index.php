<?php
ob_start();
session_start();
// session_destroy();
$baseDir="/";
require_once "config.php";
spl_autoload_register(function($class)
{ 
    require "controllers/".$class.".php";
});

$router = [
    'get' => [
        '' => [new ClientHome, 'index'],
        'dashboard' => [new DashboardController, 'index'],

        // danh mục
        'categories' => [new CategoryController, 'index'],
        'add_category' => [new CategoryController, 'create'],
        'create_category' => [new CategoryController, 'create'],
        'detail_category' => [new CategoryController, 'show'],
        'destroy_category' => [new CategoryController, 'destroy'],

        // sản phẩm
        'products' => [new ProductController, 'index'],
        'add_product' => [new ProductController, 'create'],
        'create_product' => [new ProductController, 'create'],
        'detail_product' => [new ProductController, 'show'],
        'destroy_product' => [new ProductController, 'destroy'],

        // tin tức
        'news' => [new NewsController, 'index'],
        'add_news' => [new NewsController, 'create'],
        'create_news' => [new NewsController, 'create'],
        'detail_news' => [new NewsController, 'show'],
        'destroy_news' => [new NewsController, 'destroy'],

        
        // đơn hàng
        'orders' => [new OrderController, 'index'],
        'detail_order' => [new OrderController, 'show'],

        // bình luận
        'comments' => [new CommentController, 'index'],
        
        // thông tin
        'profile' => [new ProfileController, 'index'],

        // người dùng
        'users' => [new UserController, 'index'],


        
        // auth
        // đăng ký
        'register' => [new ARegister, 'index'],
        
        // đăng nhập
        'login' => [new ALogin, 'index'],
        
        // quên mật khẩu
        'recover_pw' => [new ARecoverPw, 'index'],
        
        // xác nhận email
        'confim_email' => [new AConfimMail, 'index'],
        
        // đổi mật khẩu
        'lock_screen' => [new ALockScreen, 'index'],
    ],
    'post' => [
        // danh mục
        'add_category' => [new CategoryController, 'store'],
        'edit_category' => [new CategoryController, 'edit'],
        'destroy_category' => [new CategoryController, 'destroy_list'],

        // sản phẩm
        'add_product' => [new ProductController, 'store'],
        'edit_product' => [new ProductController, 'edit'],
        'destroy_product' => [new ProductController, 'destroy_list'],

        // tin tức
        'add_news' => [new NewsController, 'store'],
        'edit_news' => [new NewsController, 'edit'],
        'destroy_news' => [new NewsController, 'destroy_list'],
        
        
        'edit_profile' => [new ProfileController, 'edit'],
        
    ]
];

$path = substr($_SERVER['REQUEST_URI'], strlen($baseDir)); // sp    id=1
$arr = explode("?", $path); // 0 => sp, 1 => id=1&loai=2
$route = strtolower($arr[0]);
if (count($arr)>=2) parse_str($arr[1], $params);// [id = 1, loai = 2]
else $params=[];
$method = strtolower($_SERVER['REQUEST_METHOD']);
if(!array_key_exists($method, $router)) die ("Method không phù hợp:". $method);
if(!array_key_exists($route, $router[$method])) die ("Router đâu có:". $route);
$action = $router[$method][$route];
call_user_func($action);