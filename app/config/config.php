<?php
    session_start();
    ob_start();

    

    include_once 'apps/model/m_page.php';
    include_once 'apps/model/m_catagory.php';
    include_once 'apps/model/m_product.php';
    include_once 'apps/model/m_order.php';
    include_once 'apps/model/m_user.php';
    include_once 'apps/model/m_myaccount.php';
    include_once 'apps/model/m_admin.php';
    
    if(!isset($_SESSION['mygiohang'])) {
        $_SESSION['mygiohang'] = array();
    }
    
    $controller_name = "";
    $view_name = "";




    

    

?>