
<?php
    require_once 'vendor/autoload.php';
    include_once 'app/config/database.php';
    include_once 'app/config/config.php';
    use App\routing\route; //use được sử dụng trong PHP để import (kế thừa) một namespace, một lớp, hoặc một hằng số từ một file hoặc một namespace khác.
    // ROUTE HOME
    Route::add('/', 'c_home@index');
    Route::add('/index', 'c_home@index');
    // ROUTE CATAGORY
    Route::add('/catagory/product', 'c_catagory@category');
    Route::add('/catagory/product/(\d+)', 'c_catagory@category');
    // ROUTE PRODUCT
    Route::add('/product/detail/(\d+)', 'c_product@DetailProduct');
    Route::add('/product/cart', 'c_product@Product_Cart');
    Route::add('/cart/deleteId/(\d+)', 'c_product@Delete_CartId');
    Route::add('/cart/soLuongId/(\d+)/(\w+)', 'c_product@update_soluong');
    // ROUTE USER
    Route::add('/user/login', 'c_user@login');
    Route::add('/user/logout', 'c_user@logout');
    Route::add('/user/register', 'c_user@register');
    
    $uri = isset($_GET['url']) ? "/".rtrim($_GET['url'], '/') : '/index';

    Route::dispatch($uri);

    // $route = isset($_GET['route']) ? $_GET['route'] : 'home';
    
    // switch ($route) {
    //     case 'home':
    //         $homepage = new App\controller\c_home;
    //         $homepage->index();
    //         break;
    //     case 'category':
    //         $category = new App\controller\c_catagory;
    //         $category->category();
    //         break;
    //     case 'detail':
    //         $detailproductid = new App\controller\c_product;
    //         $detailproductid->DetailProduct();
    //         break;
    //     case 'addtocart':
    //         $productcart = new App\controller\c_product;
    //         $productcart->Product_Cart();
    //         break;
    //     case 'login':
    //         $userLogin = new App\controller\c_user;
    //         $userLogin->login();
    //         break;
    //     case 'register':
    //         $userRegister = new App\controller\c_user;
    //         $userRegister->register();
    //         break;
    //     case 'logout':
    //         $userLogout = new App\controller\c_user;
    //         $userLogout->logout();
    //         break;
    //     // Các route khác nếu cần
    //     default:
    //     $homepage = new App\controller\c_home;
    //     $homepage->index();
    //         break;
    // }


?>