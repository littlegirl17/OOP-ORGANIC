
<?php

    include_once 'app/config/database.php';
    require_once 'vendor/autoload.php';




    $route = isset($_GET['route']) ? $_GET['route'] : 'home';
    
    switch ($route) {
        case 'home':
            $homepage = new App\controller\c_home;
            $homepage->index();
            break;
        case 'category':
            $category = new App\controller\c_catagory;
            $category->category();
            break;
        case 'detail':
            $detailproductid = new App\controller\c_product;
            $detailproductid->DetailProduct();
            break;
        case 'addtocart':
            $productcart = new App\controller\c_product;
            $productcart->Product_Cart();
            break;
        case 'login':
            $userLogin = new App\controller\c_user;
            $userLogin->login();
            break;
        case 'register':
            $userRegister = new App\controller\c_user;
            $userRegister->register();
            break;
        case 'logout':
            $userLogout = new App\controller\c_user;
            $userLogout->logout();
            break;
        // Các route khác nếu cần
        default:
        $homepage = new App\controller\c_home;
        $homepage->index();
            break;
    }

   
    
?>