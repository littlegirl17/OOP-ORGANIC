<?php
        //namespace App\controller;


    // Là admin và có đăng nhập mới vào admin
        if(isset($_SESSION['user']) == false){
            header("location: index.php?mod=user&act=login");
            $_SESSION['canhbao'] = "Vui lòng đăng nhập!";
            exit();//thoát liền trang web
        }
    //ADMIN >= 1 mới vào admin
        if(!($_SESSION['user']['Quyen'] >=1)){
            header("location: index.php?mod=admin&act=dashboard");
        }
        
    // Phân trang
        if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
            $page = $_GET['page'];
        }else{
            $page = 1;//nếu chưa truyền thì mặc định cho ns bằng 1
        }
    // Tìm kiếm sản phẩm
        if(isset($_POST['search_product'])){
            $keyword = $_POST['keyword'];
        }else{
            $keyword = "";
        }

    if(isset($_GET['act']) && ($_GET['act']!="")){
        switch ($_GET['act']) {
            case 'dashboard':
                
                $countProduct = dashboard_countProduct();
                $countCatagory = dashboard_countCatagory();
                $countUser = dashboard_countUser();
                $countBlog = dashboard_countBlog();
                $countOrder = dashboard_countOrder();
                $countCmt = dashboard_countComment();
                //$countfeedback = dashboard_countFeedback();
                $countlove = dashboard_countLove();
                $thongkeggchart = dashboard_googlechart();
                $view_name = "admin_dashboard";
                break;
        // admin danh mục
            case 'admin_catagory':
                $SoTrang = ceil(catagory_adminPhanTrang()/6);
                $danhmucall = get_catagoryadmin($keyword,$page);
                $view_name = "admin_catagory";
                break;
            case 'admin_add_catagory':
                
                if(isset($_POST['submit']) && ($_POST['submit'])){
                    //Nếu $_POST['SoThuTu']không được đặt | hoặc không phải là số nguyên hợp lệ | nó sẽ mặc định là 0
                    $SoThuTu = isset($_POST['SoThuTu']) ? intval($_POST['SoThuTu']) : ""; //intval()để chuyển đổi giá trị $_POST['SoThuTu']thành số nguyên. 
                    $UuTien = isset($_POST['UuTien']) ? intval($_POST['UuTien']) : "";
                    add_catagory($_POST['TenDM'],$SoThuTu,$UuTien,$_FILES['HinhAnh']['name']);

                    if(isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error']==0){
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];//Dòng này lấy đường dẫn tạm thời của tệp tải lên
                        $uploadPath = "view/img/categories/".$_FILES['HinhAnh']['name'];//Dòng này xác định đường dẫn và tên tệp mục tiêu
                        move_uploaded_file($tmpFilePath,$uploadPath);//Dòng này sử dụng hàm move_uploaded_file để di chuyển tệp từ vị trí tạm thời (được lưu trong $tmpfile) vào vị trí mục tiêu (được lưu trong $upload).
                    }
                    header("location: index.php?mod=admin&act=admin_catagory");
                }
                $view_name = "admin_add_catagory";
                break;
            case 'admin_edit_catagory':
                
                $MaDM = $_GET['MaDM'];
                $getcataId = get_catagoryId($MaDM);

                if(isset($_POST['submit']) && ($_POST['submit']>0)){
                    $SoThuTu = isset($_POST['SoThuTu']) ? intval($_POST['SoThuTu']) : ""; //intval()để chuyển đổi giá trị $_POST['SoThuTu']thành số nguyên. 
                    $UuTien = isset($_POST['UuTien']) ? intval($_POST['UuTien']) : "";
                    // kiểm tra xem tệp hình ảnh có tồn tại trong $_FILESmảng hay không
                    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];//Dòng này lấy đường dẫn tạm thời của tệp tải lên
                        $uploadPath = "view/img/traicay/" . $_FILES['HinhAnh']['name'];//Dòng này xác định đường dẫn và tên tệp mục tiêu
                        move_uploaded_file($tmpFilePath, $uploadPath);//Dòng này sử dụng hàm move_uploaded_file để di chuyển tệp từ vị trí tạm thời (được lưu trong $tmpfile) vào vị trí mục tiêu (được lưu trong $upload).
                        $imageName = $_FILES['HinhAnh']['name'];
                    }else{
                        //Nếu không,lấy tên hình ảnh hiện có từ cơ sở dữ liệu cho sản phẩm đang được chỉnh sửa.
                        $imageName = $getcataId['HinhAnh'];
                    }
                    $TrangThai = isset($_POST['TrangThai']) ? intval($_POST['TrangThai']) : 0;
                    update_catagory($MaDM,$_POST['TenDM'],$SoThuTu,$UuTien, $imageName,$TrangThai);
                    
                    header("location: index.php?mod=admin&act=admin_catagory");
                }
                
                $view_name = "admin_edit_catagory";
                break;
            case 'admin_delete_catagory':
                
                $MaDM = $_GET['MaDM'];
                if(isset($_GET['MaDM']) && ($_GET['MaDM']>0)){
                    delete_catagory($MaDM);
                }
                header("location: index.php?mod=admin&act=admin_catagory");
                break;
        // admin sản phẩm
            case 'admin_product':
                
                $sanphamall = get_productadmin($keyword,$page);
                $SoTrang = ceil(product_adminPage()/6);
                $view_name = "admin_product";

                $view_name = "admin_product";
                break;
            case 'admin_add_product':

                $danhmucall = get_catagoryadmin($keyword,$page);
                if (isset($_POST['submit'])) {
                    $TenSP = isset($_POST['TenSP']) ? $_POST['TenSP'] : "";
                    $GiaSP = isset($_POST['GiaSP']) ? intval($_POST['GiaSP']) : "";
                    $TieuDe = isset($_POST['TieuDe']) ? $_POST['TieuDe'] : "";
                    $MoTa = isset($_POST['MoTa']) ? $_POST['MoTa'] : "";
                    $HinhAnh = isset($_FILES['HinhAnh']['name']) ? $_FILES['HinhAnh']['name'] : "";
                    $MaDM = isset($_POST['MaDM']) ? intval($_POST['MaDM']) : "";
                    $LuotXem = isset($_POST['LuotXem']) ? intval($_POST['LuotXem']) : "";
                    $GiaGiam = isset($_POST['GiaGiam']) ? intval($_POST['GiaGiam']) : "";
                    add_product($TenSP, $GiaSP, $TieuDe, $MoTa, $HinhAnh,$MaDM,$LuotXem, $GiaGiam);
                
                    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];
                        $uploadPath = "view/img/products/" . $_FILES['HinhAnh']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                    }
                
                    header("location: index.php?mod=admin&act=admin_product");
                }
                $view_name = "admin_add_product";
                break;
            case 'admin_edit_product':

                $danhmucall = get_catagoryadmin($keyword,$page);

                $MaSP = $_GET['MaSP'];
                $getproductId = get_productById($MaSP);
                if (isset($_POST['submit']) && ($_POST['submit'] > 0)) {
                    $GiaSP = isset($_POST['GiaSP']) ? intval($_POST['GiaSP']) : "";
                    $TieuDe = isset($_POST['TieuDe']) ? $_POST['TieuDe'] : "";
                    $MoTa = isset($_POST['MoTa']) ? $_POST['MoTa'] : "";
                    $MaDM = isset($_POST['MaDM']) ? intval($_POST['MaDM']) : "";
                    $GiaGiam = isset($_POST['GiaGiam']) ? intval($_POST['GiaGiam']) : 0;
                    $StatusProduct = isset($_POST['StatusProduct']) ? intval($_POST['StatusProduct']) : 0;
                    // kiểm tra xem tệp hình ảnh có tồn tại trong $_FILESmảng hay không
                    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];
                        $uploadPath = "view/img/traicay/" . $_FILES['HinhAnh']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                        $imageName = $_FILES['HinhAnh']['name'];
                    }else{
                        //Nếu không,lấy tên hình ảnh hiện có từ cơ sở dữ liệu cho sản phẩm đang được chỉnh sửa.
                        $imageName = $getproductId['HinhAnh'];
                    }
                    update_product($MaSP, $_POST['TenSP'],$GiaSP, $TieuDe, $MoTa, $imageName, $MaDM, $GiaGiam,$StatusProduct);
                    header("location: index.php?mod=admin&act=admin_product");
                }
                $view_name = "admin_edit_product";
                break;

            case 'admin_delete_product':

                $MaSP = $_GET['MaSP'];
                if(isset($_GET['MaSP']) && ($_GET['MaSP']>0)){
                    delete_product($MaSP);
                }
                header("location: index.php?mod=admin&act=admin_product");
                break;

        // user
            case 'admin_user':
                
                $SoTrang = ceil(user_adminPhanTrang()/6);
                $userall = get_useradmin($keyword,$page);
                $view_name = "admin_user";
                break;
            
            // add user
            case 'admin_add_user':
                
                $userall = get_useradmin($keyword,$page);
                if (isset($_POST['submit']) && ($_POST['submit'])) {
                    $checkEAdmin = user_checkEmailadmin($_POST['Email']);
                    $checkSDTAdmin = user_checksdtadmin($_POST['SoDienThoai']);

                    if($checkEAdmin == TRUE || $checkSDTAdmin  == TRUE){
                        if($checkEAdmin){
                            $_SESSION['canhbaoEmail'] = "Email đã tồn tại, vui lòng nhập email khác";
                        }
                        if($checkSDTAdmin){
                            $_SESSION['canhbaoSDT'] = "Số điện thoại đã tồn tại, vui lòng nhập Số điện thoại khác";
                        }
                    }else{
                        $HoTen = isset($_POST['HoTen']) ? $_POST['HoTen'] : "";
                        $UserName = isset($_POST['UserName']) ? $_POST['UserName'] : "";
                        $Email = isset($_POST['Email']) ? $_POST['Email'] : "";
                        $MatKhau = "123456"; 
                        $DiaChi = isset($_POST['DiaChi']) ? $_POST['DiaChi'] : "";
                        $GioiTinh = isset($_POST['GioiTinh']) ? intval($_POST['GioiTinh']) : 0;                    
                        $SoDienThoai = isset($_POST['SoDienThoai']) ? $_POST['SoDienThoai'] : "";
                        $Quyen = isset($_POST['Quyen']) ? $_POST['Quyen'] : "";
                        $HinhAnh = 'ava_user.jpeg';
                        add_user($HoTen, $UserName, $Email, $MatKhau, $DiaChi, $GioiTinh, $SoDienThoai, $Quyen,$HinhAnh);    
                        header("location: index.php?mod=admin&act=admin_user");
                    }
                
                }
                $view_name = "admin_add_user";
                break;

            // edit user 
            case 'admin_edit_user':
                
                $MaTK = $_GET['MaTK'];
                $getuserById = get_userById($MaTK);
                if (isset($_POST['submit']) && ($_POST['submit'] > 0)) {
                    $checkSDTAdmin = user_checksdtadmin($_POST['SoDienThoai']);

                    if(($checkSDTAdmin  && $checkSDTAdmin['MaTK'] != $MaTK) || ($checkEAdmin  && $checkEAdmin['MaTK'] != $MaTK)){ 
                        if($checkSDTAdmin){
                            $_SESSION['canhbaoSDT'] = "Số điện thoại đã tồn tại, vui lòng nhập Số điện thoại khác";
                        }
                    }else{
                        $HoTen = isset($_POST['HoTen']) ? $_POST['HoTen'] : "";
                        $UserName = isset($_POST['UserName']) ? $_POST['UserName'] : "";
                        $Email = isset($_POST['Email']) ? $_POST['Email'] : "";
                        $MatKhau = isset($_POST['MatKhau']) ? ($_POST['MatKhau']) : "";
                        $DiaChi = isset($_POST['DiaChi']) ? $_POST['DiaChi'] : "";
                        $GioiTinh = isset($_POST['GioiTinh']) ? $_POST['GioiTinh'] : "";
                        $SoDienThoai = isset($_POST['SoDienThoai']) ? $_POST['SoDienThoai'] : "";
                        $Quyen = isset($_POST['Quyen']) ? $_POST['Quyen'] : "";
                        $HoatDong = isset($_POST['HoatDong']) ? intval($_POST['HoatDong']) : 0;                    
                        update_user($MaTK, $HoTen, $UserName, $Email, $MatKhau, $DiaChi, $GioiTinh, $SoDienThoai, $Quyen,$HoatDong);
                        header("location: index.php?mod=admin&act=admin_user");
                    }
                    
                }
            
                $view_name = "admin_edit_user";
                break;
                
            //xoa user
            case 'admin_delete_user':
                $MaTK = $_GET['MaTK'];
                
                if(isset($MaTK) && ($MaTK > 0)){
                    delete_user($MaTK);
                }
                
                header("location: index.php?mod=admin&act=admin_user");
                break;
        // Bình luận
                // quản lý cmt user dành cho admin -- Show truy váan sql show lên : 
                case 'admin_cmt':
                    if(isset($_SESSION['user']) == false){
                        header("location: index.php?mod=user&act=login");
                        $_SESSION['canhbao'] = "Vui lòng đăng nhập!";
                        exit();//thoát liền trang web
                    }

                    if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
                        $page = $_GET['page'];
                    }else{
                        $page = 1;//nếu chưa truyền thì mặc định cho ns bằng 1
                    }
                    $SoTrang = ceil(binhluan_adminPage()/6);
                    $cmtall = get_cmtadmin($page);
                    $view_name = "admin_cmt";
                    break;
                // xóa cmt 
                case 'admin_delete_cmt':
                    $MaBL = $_GET['MaBL'];
                    
                    if(isset($MaBL) && ($MaBL > 0)){
                        delete_cmt($MaBL);
                    }
                    
                    header("location: index.php?mod=admin&act=admin_cmt");
                    break;
        // Đơn hàng 
                case 'admin_donhang':
                    
                    if(isset($_SESSION['user']) == false){
                        header("location: index.php?mod=user&act=login");
                        $_SESSION['canhbao'] = "Vui lòng đăng nhập!";
                        exit();//thoát liền trang web
                    }

                    if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
                        $page = $_GET['page'];
                    }else{
                        $page = 1;//nếu chưa truyền thì mặc định cho ns bằng 1
                    }

                    if(isset($_POST['search_product'])){
                        $keyword = $_POST['keyword'];
                    }else{
                        $keyword = "";
                    }

                    if(!($_SESSION['user']['Quyen'] >=1)){
                        header("location: index.php?mod=page&act=home");
                    }
                    $donghangall = get_donhangadmin($keyword,$page);
                    $SoTrang = ceil(order_adminPage()/6);
                    $view_name = "admin_donhang";
                    break;

            // edit update
                case 'admin_edit_donhang':
                    if(isset($_SESSION['user']) == false){
                        header("location: index.php?mod=user&act=login");
                        $_SESSION['canhbao'] = "Vui lòng đăng nhập!";
                        exit();//thoát liền trang web
                    }
                    
                    $MaDH = $_GET['MaDH'];
                    $getOrderDetails = get_donhangById($MaDH);
                    if (isset($_POST['submit']) && ($_POST['submit'] > 0)) {
                        $HoTen = isset($_POST['HoTen']) ? $_POST['HoTen'] : "";
                        $Email = isset($_POST['Email']) ? $_POST['Email'] : "";
                        $SoDienThoai = isset($_POST['SoDienThoai']) ? $_POST['SoDienThoai'] : "";
                        $DiaChi = isset($_POST['DiaChi']) ? $_POST['DiaChi'] : "";
                        $GhiChu = isset($_POST['GhiChu']) ? $_POST['GhiChu'] : "";
                        $TongTien = isset($_POST['TongTien']) ? $_POST['TongTien'] : "";
                        $PhuongThucTT = isset($_POST['PhuongThucTT']) ? $_POST['PhuongThucTT'] : "";
                        $TrangThai = isset($_POST['TrangThai']) ? $_POST['TrangThai'] : "";
                
                        update_donhang($MaDH, $HoTen, $Email, $SoDienThoai, $DiaChi, $GhiChu, $TongTien, $PhuongThucTT, $TrangThai);
                        header("location: index.php?mod=admin&act=admin_donhang");
                    }
            
                $view_name = "admin_edit_donhang";
                break;
                
                case 'donhang_detail':
                    $MaDH = $_GET['MaDH'];
                    $detaildonhangadmin = history_adminorder($MaDH);
                    $view_name = "admin_donhang_detail";
                    break;
            /*case 'delete_order':
                $MaDH = $_GET['MaDH'];
                if(isset($_GET['MaDH']) && ($_GET['MaDH']>0)){
                    delete_donhang($MaDH);
                }
                header("location: index.php?mod=admin&act=admin_donhang");
                break;*/
        // Bài viết
            case 'admin_post':
                
                $SoTrang = ceil(post_adminPhanTrang()/3);
                $danhmucall = get_catagoryadmin($keyword,$page);
                $baivietall = get_postadmin($keyword,$page);
                $view_name = "admin_post";
                break;   
            case 'admin_add_post':

                $danhmucall = get_catagoryadmin($keyword,$page);
                if (isset($_POST['submitblog']) && $_POST['submitblog']) {
                    // Kiểm tra sự tồn tại của các biến và xử lý dữ liệu nếu cần
                    $TieuDe = isset($_POST['TieuDe']) ? ($_POST['TieuDe']) : "";
                    $MoTa = isset($_POST['MoTa']) ? ($_POST['MoTa']) : "";
                    $MoTaNgan = isset($_POST['MoTaNgan']) ? ($_POST['MoTaNgan']) : "";
                    $NgayViet = isset($_POST['NgayViet']) ? date('Y-m-d H:i:s', strtotime($_POST['NgayViet'])) : null;
                    $MaDM = isset($_POST['MaDM']) ? intval($_POST['MaDM']) : "";
    
                    add_post($TieuDe,$_FILES['HinhAnh']['name'], $_FILES['HinhAnhDetail']['name'], $MoTaNgan, $MoTa,$NgayViet,$MaDM);
    
                    // Kiểm tra và di chuyển tệp đính kèm
                    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];
                        $uploadPath = "view/img/baiviet/" . $_FILES['HinhAnh']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                    }

                    if (isset($_FILES['HinhAnhDetail']) && $_FILES['HinhAnhDetail']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnhDetail']['tmp_name'];
                        $uploadPath = "view/img/baiviet/" . $_FILES['HinhAnhDetail']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                    }
    
                    header("location: index.php?mod=admin&act=admin_post");
                    exit();
                }
                $view_name = "admin_add_post";
                break;

            case 'admin_edit_post':
                
                $danhmucall = get_catagoryadmin($keyword,$page);
                $MaBV = $_GET['MaBV'];
                $getpostId = get_postId($MaBV);
                if (isset($_POST['submitupdateblog']) ) {
    
                    $TieuDe = isset($_POST['TieuDe']) ? ($_POST['TieuDe']) : "";
                    $MoTa = isset($_POST['MoTa']) ? ($_POST['MoTa']) : "";
                    $MoTaNgan = isset($_POST['MoTaNgan']) ? ($_POST['MoTaNgan']) : "";
                    //$NgayViet = isset($_POST['NgayViet']) ? intval($_POST['NgayViet']) : "";
                    $MaDM = isset($_POST['MaDM']) ? intval($_POST['MaDM']) : "";
                    // kiểm tra xem tệp hình ảnh có tồn tại trong $_FILESmảng hay không
                    if (isset($_FILES['HinhAnh']) && $_FILES['HinhAnh']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnh']['tmp_name'];
                        $uploadPath = "view/img/traicay/" . $_FILES['HinhAnh']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                        $imageName = $_FILES['HinhAnh']['name'];
                    }else{
                        //Nếu không,lấy tên hình ảnh hiện có từ cơ sở dữ liệu cho sản phẩm đang được chỉnh sửa.
                        $imageName = $getpostId['HinhAnh'];
                    }

                    if (isset($_FILES['HinhAnhDetail']) && $_FILES['HinhAnhDetail']['error'] == 0) {
                        $tmpFilePath = $_FILES['HinhAnhDetail']['tmp_name'];
                        $uploadPath = "view/img/baiviet/" . $_FILES['HinhAnhDetail']['name'];
                        move_uploaded_file($tmpFilePath, $uploadPath);
                        $imageNameDetail = $_FILES['HinhAnhDetail']['name'];
                    }else{
                        $imageNameDetail = $getpostId['HinhAnhDetail'];
                    }
                    update_post($MaBV, $TieuDe, $imageName, $imageNameDetail, $MoTaNgan, $MoTa,  $MaDM); 
                    header("location: index.php?mod=admin&act=admin_post");
                }
                $view_name = "admin_edit_post";
                break;
        
            case 'admin_delete_post':
                $MaBV = $_GET['MaBV'];
                if (isset($_GET['MaBV']) && ($_GET['MaBV'] > 0)) {
                    delete_post($MaBV);
                }
                header("location: index.php?mod=admin&act=admin_post");
                break;
            
        // Phản hồi
            case 'phanhoi':
                if(isset($_GET['page']) && ($_GET['page']>=1)){ //Nếu truyền rồi
                    $page = $_GET['page'];
                }else{
                    $page = 1;//nếu chưa truyền thì mặc định cho ns bằng 1
                }
                $SoTrang = ceil(phanhoi_adminPhanTrang()/6);
                $phanhoiAll = phanhoi_getAll($page);
                $view_name = "admin_phanhoi";
                break;

            case 'deletephanhoi':
                $MaPH = $_GET['MaPH'];
                phanhoi_delete($MaPH);
                header("location: index.php?mod=admin&act=phanhoi");
                break;

            case 'logoutadmin':
                if(isset($_SESSION['user'])){
                    unset($_SESSION['user']);
                }
                header("location: index.php?mod=user&act=login");
                break;
        // Yêu thích
            case 'adminlove':
                $admingetyeuthich = admin_yeuthich();
                $view_name = "admin_love";
                break;
            default:
                header("location:index.php?mod=admin&act=dashboard");
                break;
        
            }
        include_once 'view/admin/v_admin_layout.php';
    }else{
        header("location:index.php?mod=admin&act=dashboard");
    }
?>