<?php
    include_once 'apps/model/m_pdo.php';

    //DASHBOARD
        function dashboard_countProduct(){
            return pdo_query_value("SELECT COUNT(*) FROM sanpham ");
        } //trả về một giá trị duy nhất

        function dashboard_countCatagory(){
            return pdo_query_value("SELECT COUNT(*) FROM danhmuc ");
        } //trả về một giá trị duy nhất

        function dashboard_countUser(){
            return pdo_query_value("SELECT COUNT(*) FROM taikhoan ");
        } //trả về một giá trị duy nhất

        function dashboard_countBlog(){
            return pdo_query_value("SELECT COUNT(*) FROM baiviet ");
        } //trả về một giá trị duy nhất

        function dashboard_countOrder(){
            return pdo_query_value("SELECT COUNT(*) FROM donhang ");
        } //trả về một giá trị duy nhất

        function dashboard_countComment(){
            return pdo_query_value("SELECT COUNT(*) FROM binhluan ");
        } //trả về một giá trị duy nhất

        function dashboard_countFeedback(){
            return pdo_query_value("SELECT COUNT(*) FROM phanhoi ");
        } //trả về một giá trị duy nhất

        function dashboard_countLove(){
            return pdo_query_value("SELECT COUNT(*) FROM yeuthich ");
        } //trả về một giá trị duy nhất


        //Thống kê
        function dashboard_googlechart(){
            return pdo_query("SELECT dm.MaDM, dm.TenDM, COUNT(sp.MaSP) AS SoLuong FROM danhmuc dm LEFT JOIN sanpham sp ON dm.MaDM = sp.MaDM GROUP BY dm.MaDM, dm.TenDM");
        }//LEFT JOIN la lấy theo bảng bên trái, nếu cd đó ko có sách thì nó sẽ để là số 0

    
    // Danh mục
        function get_catagoryadmin($keyword,$page=1){
            $BatDau = ($page - 1) * 6;
            return pdo_query("SELECT * FROM danhmuc WHERE TenDM LIKE'%$keyword%' LIMIT $BatDau,6");
        }

        function catagory_adminPhanTrang(){
            return pdo_query_value("SELECT COUNT(*) FROM danhmuc");
        }
        // Thêm
        function add_catagory($TenDM,$SoThuTu,$UuTien,$HinhAnh){
            pdo_execute("INSERT INTO danhmuc (`TenDM`,`SoThuTu`,`UuTien`,`HinhAnh`) VALUES (?,?,?,?)",$TenDM,$SoThuTu,$UuTien,$HinhAnh);
        }
        
        // Sửa
        function get_catagoryId($MaDM){
            return pdo_query_one("SELECT * FROM danhmuc WHERE MaDM = ?",$MaDM);
        }
        
        function update_catagory($MaDM,$TenDM,$SoThuTu,$UuTien,$HinhAnh,$TrangThai){
            pdo_execute("UPDATE danhmuc SET TenDM = ?,SoThuTu = ?,UuTien = ?, HinhAnh = ?, TrangThai = ? WHERE MaDM = ? ",$TenDM,$SoThuTu,$UuTien,$HinhAnh, $TrangThai,$MaDM);
        }
        // Xóa
        function delete_catagory($MaDM){
            pdo_execute("DELETE FROM danhmuc WHERE MaDM = ?",$MaDM);
        }


    // Sản phẩm
        function update_Statusproduct($MaSP, $status){
            pdo_execute("UPDATE sanpham SET status = ? WHERE MaSP = ?", $status,$MaSP);
        }
        function get_productadmin($keyword,$page=1){//Mặc định nó sẽ gọi trang 1
            
            $BatDau = ($page - 1) * 6;//tính toán vị trí bắt đầu : ví dụ bạn ở trang 2 ($page=2) //thì sản phẩm sẽ bắt đầu từ sản phẩm số 6
            return pdo_query("SELECT sp.*,dm.TenDM FROM sanpham sp INNER JOIN danhmuc dm ON sp.MaDM=dm.MaDM WHERE TenSP LIKE '%$keyword%'ORDER BY MaSP DESC LIMIT $BatDau,6 ");
            //Limit 0,4 nghĩa là bắt đầu từ 0 lấy 4 quyển sách , và trong DB thì LIMIT lấy từ số 0 đầu tiên
        }

        //phân trang
        function product_adminPage(){
            return pdo_query_value("SELECT COUNT(*) FROM sanpham");
        }
        // Thêm
        function add_product($TenSP, $GiaSP, $TieuDe, $MoTa, $HinhAnh,$MaDM,$LuotXem, $GiaGiam) {
            pdo_execute("INSERT INTO sanpham (`TenSP`, `GiaSP`, `TieuDe`, `MoTa`, `HinhAnh`,`MaDM`,`LuotXem`, `GiaGiam`) VALUES (?,?,?,?,?,?,?,?)",$TenSP, $GiaSP, $TieuDe, $MoTa, $HinhAnh,$MaDM,$LuotXem, $GiaGiam);
        }

        //Lấy về để sửa
        function get_productById($MaSP){
            return pdo_query_one("SELECT * FROM sanpham WHERE MaSP = ?",$MaSP);
        }

        // Cập nhật
        function update_product($MaSP,$TenSP, $GiaSP, $TieuDe, $MoTa, $HinhAnh, $MaDM, $GiaGiam,$StatusProduct){
            pdo_execute("UPDATE sanpham SET TenSP = ?, GiaSP = ?, TieuDe = ?, MoTa = ?, HinhAnh = ?, MaDM = ?, GiaGiam = ?, StatusProduct = ? WHERE MaSP = ?",$TenSP, $GiaSP, $TieuDe, $MoTa, $HinhAnh, $MaDM, $GiaGiam,$StatusProduct, $MaSP);
        }

        // Xóa
        function delete_product($MaSP){
            pdo_execute("DELETE FROM sanpham WHERE MaSP = ?",$MaSP);
        }

    // User
        function get_useradmin($keyword,$page=1){
            $BatDau = ($page - 1) * 6;
            return pdo_query("SELECT * FROM TaiKhoan WHERE 
                CASE
                WHEN Quyen = 0 THEN 'user'
                WHEN Quyen = 1 THEN 'admin'
                END
                LIKE '%$keyword%' OR HoTen LIKE '%$keyword%' LIMIT $BatDau,6");
        }

        //check trùng email
        function user_checkEmailadmin($Email){
            return pdo_query_one("SELECT * FROM taikhoan WHERE Email = ?", $Email);
        }

        //check trùng sdt
        function user_checksdtadmin($SoDienThoai){
            return pdo_query_one("SELECT * FROM taikhoan WHERE SoDienThoai = ?", $SoDienThoai);
        }

        function user_adminPhanTrang(){
            return pdo_query_value("SELECT COUNT(*) FROM taikhoan");
        }

        // Thêm
        function add_user($HoTen, $UserName, $Email, $MatKhau, $DiaChi, $GioiTinh, $SoDienThoai, $Quyen, $HinhAnh) {
            pdo_execute("INSERT INTO TaiKhoan (`HoTen`, `UserName`, `Email`, `MatKhau`, `DiaChi`, `GioiTinh`, `SoDienThoai`, `Quyen`, `HinhAnh`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                $HoTen, $UserName, $Email, $MatKhau, $DiaChi, $GioiTinh, $SoDienThoai, $Quyen, $HinhAnh);
        }
        
        //Lấy về để sửa
        function get_userById($MaTK){
            return pdo_query_one("SELECT * FROM TaiKhoan WHERE MaTK = ?",$MaTK);
        }

        // Cập nhật
        function update_user($MaTK,$HoTen, $UserName, $Email, $MatKhau, $DiaChi, $GioiTinh, $SoDienThoai, $Quyen,$HoatDong) {
            pdo_execute("UPDATE TaiKhoan SET HoTen = ?, UserName = ?, Email = ?, MatKhau = ?, DiaChi = ?, GioiTinh = ?, SoDienThoai = ?, Quyen = ?, HoatDong = ? WHERE MaTK = ?",$HoTen, $UserName, $Email, $MatKhau, $DiaChi, $GioiTinh, $SoDienThoai, $Quyen, $HoatDong, $MaTK);
        }
            
        // Xóa
        function delete_user($MaTK) {
            pdo_execute("DELETE FROM TaiKhoan WHERE MaTK = ?", $MaTK);
        }
    
    // Bình luận

        // Cmt 
        function get_cmtadmin($page=1){
            $BatDau = ($page - 1) * 6;
            return pdo_query("SELECT * FROM binhluan bl INNER JOIN taikhoan tk ON bl.MaTK = tk.MaTK INNER JOIN sanpham sp ON bl.MaSP = sp.MaSP LIMIT $BatDau,6");
        }
        //phân trang
        function binhluan_adminPage(){
            return pdo_query_value("SELECT COUNT(*) FROM binhluan");
        }
        // Xóa
        function delete_cmt($MaBL) {
            pdo_execute("DELETE FROM binhluan WHERE MaBL = ?", $MaBL);
        }
    
    // Đơn hang
                            
        function get_donhangadmin($keyword,$page=1){
            $BatDau = ($page - 1) * 6;//tính toán vị trí bắt đầu : ví dụ bạn ở trang 2 ($page=2) //thì sản phẩm sẽ bắt đầu từ sản phẩm số 6
            return pdo_query("SELECT * FROM donhang WHERE 
                CASE 
                    WHEN TrangThai = 0 THEN 'Đơn hàng mới'
                    WHEN TrangThai = 1 THEN 'Đang xử lý'
                    WHEN TrangThai = 2 THEN 'Đang giao hàng'
                    WHEN TrangThai = 3 THEN 'Đã giao'
                    WHEN TrangThai = 3 THEN 'Đã hủy'
                END
                LIKE '%$keyword%' OR HoTen LIKE '%$keyword%' ORDER BY MaDH DESC LIMIT $BatDau,6");
        } // CASE WHEN THEN END dùng trong tìm kiếm về trang thái đơn hàng
        
        //phân trang
        function order_adminPage(){
            return pdo_query_value("SELECT COUNT(*) FROM donhang");
        }
        //Lấy về để sửa
        function get_donhangById($MaDH){
            return pdo_query_one("SELECT * FROM donhang WHERE MaDH = ?",$MaDH);
        }

        // cap nhat
        function update_donhang($MaDH, $HoTen, $Email, $SoDienThoai, $DiaChi, $GhiChu, $TongTien, $PhuongThucTT, $TrangThai) {
            pdo_execute("UPDATE DonHang SET HoTen = ?, Email = ?, SoDienThoai = ?, DiaChi = ?, GhiChu = ?, TongTien = ?, PhuongThucTT = ?, TrangThai = ? WHERE MaDH = ?",
            $HoTen, $Email, $SoDienThoai, $DiaChi, $GhiChu, $TongTien, $PhuongThucTT, $TrangThai, $MaDH);
        }

        // chi tiết đơn hàng
        function history_adminorder($MaDH){
            return pdo_query("SELECT ctdh.*, dh.*, sp.* FROM chitietdonhang ctdh INNER JOIN donhang dh ON ctdh.MaDH = dh.MaDH INNER JOIN sanpham sp ON ctdh.MaSP = sp.MaSP  WHERE ctdh.MaDH = ? ",$MaDH);
        }

        // xoa 
        /*function delete_donhang($MaDH){
            pdo_execute("DELETE FROM donhang WHERE MaDH = ?",$MaDH);
        }*/

    // Bài viết
        function get_postadmin($keyword,$page=1){
            $BatDau = ($page - 1) * 3;
            return pdo_query("SELECT * FROM baiviet WHERE TieuDe LIKE'%$keyword%' ORDER BY MaBV DESC LIMIT $BatDau,3");
        }
        function post_adminPhanTrang(){
            return pdo_query_value("SELECT COUNT(*) FROM baiviet");
        }
        // Thêm
        function add_post($TieuDe, $HinhAnh, $HinhAnhDetail, $MoTaNgan, $MoTa, $NgayViet, $MaDM){
            pdo_execute("INSERT INTO baiviet (`TieuDe`, `HinhAnh`, `HinhAnhDetail`, `MoTaNgan`, `MoTa`,`NgayViet`, `MaDM`) VALUES (?, ?, ?, ?, ?, ?, ?) ", $TieuDe, $HinhAnh, $HinhAnhDetail, $MoTaNgan, $MoTa,$NgayViet, $MaDM);
        }
        // Sửa
        function get_postId($MaBV){
            return pdo_query_one("SELECT * FROM baiviet WHERE MaBV = ?", $MaBV);
        }

        function update_post($MaBV, $TieuDe, $HinhAnh, $HinhAnhDetail, $MoTaNgan, $MoTa, $MaDM){
            pdo_execute("UPDATE baiviet SET TieuDe = ?, HinhAnh = ?, HinhAnhDetail = ?, MoTaNgan = ?, MoTa = ?, MaDM = ? WHERE MaBV = ?",$TieuDe, $HinhAnh, $HinhAnhDetail, $MoTaNgan, $MoTa, $MaDM,$MaBV);
        }

        // Xóa
        function delete_post($MaBV){
            pdo_execute("DELETE FROM baiviet WHERE MaBV = ?", $MaBV);
        }


    // Phản hồi
        function phanhoi_getAll($page=1){
            $BatDau = ($page - 1) * 6;
            return pdo_query("SELECT * FROM phanhoi LIMIT $BatDau,6");//0-6//6-6//12-6//18-6
        }

        function phanhoi_adminPhanTrang(){
            return pdo_query_value("SELECT COUNT(*) FROM phanhoi");
        }

        function phanhoi_delete($MaPH){
            pdo_execute("DELETE FROM phanhoi WHERE MaPH = ?",$MaPH);
        }

    // Yêu thích
        function admin_yeuthich(){
            return pdo_query("SELECT * FROM yeuthich yt INNER JOIN sanpham sp ON yt.MaSP=sp.MaSP INNER JOIN taikhoan tk ON yt.MaTK=tk.MaTK ORDER BY MaYT DESC");
        }
?>