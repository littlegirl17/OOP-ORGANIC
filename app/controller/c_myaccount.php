<?php
        include_once 'config/config.php';


    //
    if(isset($_SESSION['user']) == false){
        header("location: index.php?mod=user&act=login");
        $_SESSION['canhbao'] = "Vui lòng đăng nhập!";
        exit();//thoát liền trang web
    }

    if(isset($_GET['act']) && ($_GET['act']!="")){
        switch ($_GET['act']) {
            case 'myaccount':
                
                $view_name = "myaccount_user";
                break;
            case 'update_myaccount':
                
                if(isset($_POST['submit'])){
                    update_myaccountid($_POST['MaTK'], $_FILES['HinhAnh']['name'],$_POST['HoTen'],$_POST['UserName'],$_POST['Email'],$_POST['MatKhau'],$_POST['DiaChi'],$_POST['GioiTinh'],$_POST['SoDienThoai']);
                    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];
                        $uploadPath = "view/img/avatar/" . $_FILES['HinhAnh']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                    }                    
                    $_SESSION['user']['HinhAnh'] = $_FILES['HinhAnh']['name'];
                    $_SESSION['user']['HoTen'] = $_POST['HoTen'];
                    $_SESSION['user']['UserName'] = $_POST['UserName'];
                    $_SESSION['user']['Email'] = $_POST['Email'];
                    $_SESSION['user']['MatKhau'] = $_POST['MatKhau'];
                    $_SESSION['user']['DiaChi'] = $_POST['DiaChi'];
                    $_SESSION['user']['GioiTinh'] = $_POST['GioiTinh'];
                    $_SESSION['user']['SoDienThoai'] = $_POST['SoDienThoai'];
                }
                $view_name = "myaccount_update";
                break;
            case 'forget_pasword':
                
                $ThongBao = "";
                if(isset($_POST['submit'])){
                    $kq = forget_myaccount($_POST['SoDienThoai']);
                    
                    if(is_array($kq) ){
                        $ThongBao = "Mật khẩu của bạn là: <strong style='color:red;'>".$kq['MatKhau']."</strong>";
                    }else{
                        $ThongBao = "Số điện thoại bạn nhập chưa chính xác";
                    }
                }
                $view_name = "myaccount_forget";
                break;

            case 'doi_password':
                
                $ThongBao = "";$ThongBao2 = "";
                if(isset($_POST['submit'])){
                    $MaTK = $_POST['MaTK'];
                    $SoDienThoai = $_POST['SoDienThoai'];
                    $MatKhau = $_POST['MatKhau'];
                    $MatKhauNew = $_POST['MatKhauNew'];
                    $AgainMatKhau = $_POST['AgainMatKhau'];
                    $checkpass = checkpass_myaccount($SoDienThoai,$MatKhau);

                    if($checkpass){
                        if($MatKhauNew == $AgainMatKhau){
                            update_passw_myac($MaTK,$SoDienThoai,$MatKhauNew);
                            $_SESSION['thongbao'] = "Mật khẩu mới đã thay đổi thành công";
                        }else{
                            $_SESSION['loi'] = "Mật khẩu mới và xác nhận mật khẩu không khớp";
                        }
                    }else{
                        $_SESSION['loi'] = "Số điện thoại hoặc mật khẩu bạn nhập chưa đúng";
                    }
                }
                $view_name = "myaccount_doipass";
                break;
            
            case 'order_account':
                
                if(isset($_SESSION['iddh']) && ($_SESSION['iddh']>0)){
                    if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
                        $page = $_GET['page'];
                    }else{
                        $page = 1;//nếu chưa truyền thì mặc định cho ns bằng 1
                    }
                    $viewsanphammyacc = get_productOrdermyacc($page);
                    $SoTrang = ceil(ordermyaccount_Page()/6);
                }else{
                    $viewsanphammyacc = "";
                    $SoTrang = ceil(ordermyaccount_Page()/6);
                }
                
                $view_name = "myaccount_order";
                break;
            case 'order_accountdetail':
                $MaDH = $_GET['MaDH'];
                $detailordermyacount = myaccount_detailorder($MaDH);
                $view_name = "myaccount_orderdetail";
                break;
    
            case 'calldahuy':
                if(isset($_GET['MaDH'])){
                    $orderStatus = donhang_huy($_GET['MaDH']);

                    if ($orderStatus == 5) {
                        header("location: index.php?mod=myaccount&act=orderdahuy");
                    } else {
                        header("location: index.php?mod=myaccount&act=order_account");
                    }
                }
                break;

            case 'orderdahuy':
                $MaTK = $_SESSION['user']['MaTK'];
                $canceledOrders = get_canceledOrders($MaTK);
                $view_name = "myaccount_dahuy";
                break;
            
            case 'orderdahuydetail':
                $MaDH = $_GET['MaDH'];
                $orderdahuydetail = orderdahuydetail($MaDH);
                $view_name = "myaccount_dahuydetail";
                break;

            case 'history_account':

                if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
                    $page = $_GET['page'];
                }else{
                    $page = 1;//nếu chưa truyền thì mặc định cho ns bằng 1
                }

                if(isset($_SESSION['user']['MaTK']) && ($_SESSION['user']['MaTK']>0)){
                    $viewhistoryorder = historyorder_myaccount($_SESSION['user']['MaTK'],$page);
                    $SoTrang = ceil(ordermyacc_adminPage()/6);
                }else{
                    $viewhistoryorder = historyorder_myaccount($_SESSION['user']['MaTK'],$page);
                    $SoTrang = ceil(ordermyacc_adminPage()/6);
                }
                $view_name = "myaccount_history";
                break;
                
            case 'detail_account':
                
                $MaDH = $_GET['MaDH'];
                $viewhistorymyacc = history_myaccount($MaDH);
                
                $view_name = "myaccount_historydetail";
                break;
            
            default:
                header("location:index.php?mod=page&act=home");
                break;
        }
        include_once 'view/myAccount/v_myaccount_layout.php';
    }else{
        header("location:index.php?mod=page&act=home");
    }
?>