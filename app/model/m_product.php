<?php
            namespace App\model;
            class m_product {
        private $data;

        function __construct(){
            $this->data = new m_pdo;
        }

        function product_detailbyid($MaSP){
            return $this->data->pdo_query_one("SELECT * FROM sanpham WHERE MaSP = ?",$MaSP);
        }

        function product_lienquanRanDom($MaDM){
            return $this->data->pdo_query("SELECT * FROM sanpham WHERE MaDM = ? ORDER BY rand() LIMIT 4",$MaDM);
        }

        // bình luận
        function binhuan_add($MaSP,$MaTK,$NoiDung){
            $this->data->pdo_execute("INSERT INTO binhluan (`MaSP`,`MaTK`,`NoiDung`) VALUES(?,?,?)",$MaSP,$MaTK,$NoiDung);
        }
    
        function get_byproductcomment($MaSP){
            return $this->data->pdo_query("SELECT * FROM binhluan bl INNER JOIN taikhoan tk ON bl.MaTK = tk.MaTK WHERE bl.MaSP=?",$MaSP);
        }
    }















   

    

    function product_updateLuotXem($MaSP){
        pdo_execute("UPDATE sanpham SET LuotXem = LuotXem + 1 WHERE MaSP = ?",$MaSP);
    }

    

    function product_detaillove($MaSP, $MaTK, $YeuThich){
        return pdo_query_one("SELECT * FROM yeuthich WHERE MaSP=? AND MaTK=? AND YeuThich=?", $MaSP, $MaTK, $YeuThich);
    }

    function product_addToWishlist($MaSP, $MaTK,$YeuThich){
        pdo_execute("INSERT INTO yeuthich (`MaSP`,`MaTK`,`YeuThich`) VALUES (?,?,?)",$MaSP,$MaTK,$YeuThich);
    }

    //detail
    function product_removeFromWishlist($MaSP, $MaTK, $YeuThich) {
        pdo_execute("DELETE FROM yeuthich WHERE MaSP=? AND MaTK=? AND YeuThich=?", $MaSP, $MaTK, $YeuThich);
    }

    function product_yeuthich(){
        return pdo_query("SELECT * FROM yeuthich yt INNER JOIN sanpham sp ON yt.MaSP=sp.MaSP ORDER BY MaYT DESC");
    }

    function product_Countyeuthich(){
        $countlove = pdo_query("SELECT * FROM yeuthich yt INNER JOIN sanpham sp ON yt.MaSP=sp.MaSP ORDER BY MaYT DESC");
        return count($countlove);
    }

    function product_deleteyeuthich($MaSP) {
        pdo_execute("DELETE FROM yeuthich WHERE MaSP=? ", $MaSP);
    }
//
?>