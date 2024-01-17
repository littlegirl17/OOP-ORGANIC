<?php 
    include_once 'v_header.php';
    /*
        ?? -> toán tử hợp nhất null
        -> Nó kiểm tra nếu giá trị bên trái của nó là null (hoặc không tồn tại), thì nó sẽ trả về giá trị bên PHẢI của nó
        -> Nếu giá trị bên trái không phải là null, thì giá trị bên trái sẽ được trả về.
    
        [] đây là array trống: nếu $_SESSION['mygiohang'] là null thì $cart sẽ được thiết lập bằng 1 mảng mới
    */

    /*
        == So sánh giá trị của hai biến mà không xem xét kiểu dữ liệu
        === So sánh giá trị và kiểu dữ liệu của hai biến
    */

    //Khởi tạo giỏ hàng
        $cart = $_SESSION['mygiohang'] ?? [];
        $TongTien = 0;
        $SoLuong = 0;

    //Lấy thông tin từ URL 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $type = $_GET['type'];

            if(isset($cart[$id])){

                if($type === 'incre'){
                    $cart[$id]['SoLuong']++;// [id] Đây là chỉ số của mảng
                
                }elseif ($type === 'decre') {
                    $cart[$id]['SoLuong']--;

                    if($cart[$id]['SoLuong'] < 1){
                        unset($cart[$id]); //Loại bỏ sản phẩm trong mảng $cart có khóa là $id // ngụ ý rằng họ không muốn mua nó nữa và muốn loại bỏ nó khỏi giỏ hàng.
                    }

                }
            }
    //Cập nhật giỏ hàng trong session
        //Lưu lại tăng hoặc giảm vào session mygiohang
        $_SESSION['mygiohang'] = $cart;
    }
?>

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="view/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php?mod=page&act=home">Home</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <?php if(!empty($cart)): ?>
        <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($cart) && is_array($cart)):
                                            $id = 0;// dung de dinh vi minh se xoa no tai vi tri nao trong array
                                            $ThanhTien = 0;
                                            foreach($cart as $item):
                                                $ThanhTien = $item['SoLuong']*$item['GiaSP'];
                                                $linkdel = "index.php?mod=product&act=deleteid&del=".$id;
                                    ?>
                                        <tr>
                                            <input type="hidden" name="MaSP">
                                            <td class="shoping__cart__item">
                                                <img src="view/img/traicay/<?=$item['HinhAnh']?>" alt="">
                                                <h5><?=$item['TenSP']?></h5>
                                            </td>
                                            <td class="shoping__cart__price" id="GiaSP" >
                                                <?=number_format($item['GiaSP'],"0",",",".")?> đ
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <span class="dec qtybtn"><a href="index.php?mod=product&act=update_quantity&id=<?= $id ?>&type=decre" >-</a></span>
                                                        <input type="text" value="<?=$item['SoLuong']?>">
                                                        <span class="inc qtybtn" ><a href="index.php?mod=product&act=update_quantity&id=<?= $id ?>&type=incre" >+</a></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total" >
                                                <?=number_format($ThanhTien,"0",",",".")?> đ
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="<?=$linkdel?>">x</a>
                                            </td>
                                        </tr>
                                    <?php
                                                $id++;
                                            endforeach;
                                        endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a href="index.php?mod=page&act=home" class="primary-btn cart-btn">TIẾP TỤC MUA SẮM</a>
                            <a href="Index.php?mod=product&act=delateall" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                XÓA RỖNG GIỎ HÀNG</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Tổng tiền giỏ hàng</h5>
                                <?php
                                    if(isset($cart) && is_array($cart)){
                                    $ThanhTien = 0;
                                        foreach($cart as $cart){
                                            $ThanhTien = $cart['SoLuong']*$cart['GiaSP'];
                                            $TongTien += $ThanhTien;

                                        }
                                    }
                                ?>
                                    <ul>
                                        <li>Thành tiền <span><?=number_format($TongTien,"0",",",".")?> đ</span></li>
                                        <li>Tổng tiền <span><?=number_format($TongTien ,"0",",",".")?> đ</span></li>
                                    </ul>
                        
                            <a href="index.php?mod=product&act=checkout" class="primary-btn">TIẾN HÀNH KIỂM TRA</a>
                        </div>
                    </div>
                </div>
        </div>
        <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <img src="view/img/cartrong.png" alt="" style="width:80%;">
                </div>
                <div class="col-md-3">
                    <a href="index.php?mod=page&act=home" class="primary-btn cart-btn">Quay lại trang chủ</a>
                </div>
                
            </div>
        </div>
        <?php endif; ?>
    </section> 
    <!-- Shoping Cart Section End -->



    <script>
    /*
        function tangSL(x){
            var cha = x.parentElement;
            var slold = cha.children[1];
            var slnew = Number(slold.value) + 1;
            slold.value = slnew;
            updatetotal();
            
        }

        function giam(x){
            var cha = x.parentElement;
            var slold = cha.children[1];
            if(Number(slold.value)>1){
                var slnew = parseInt(slold.value) - 1;
                slold.value = slnew;
            }else{
                alert("Đặt hàng tối thiểu là một");
            }
            updatetotal();
        }


        function updatetotal() {
            var dssp = document.querySelectorAll('table tbody tr');
            var TongTien = 0;
            var SoLuong = 0;
            for(const sanpham of dssp) {
                var GiaSP = parseFloat(sanpham.querySelector('#GiaSP').innerText); //innerTexttruy xuất nội dung văn bản bên trong phần tử đã chọn,  trong trường hợp này là nội dung văn bản bên trong phần tử có ID "GiaSP".
                SoLuong = parseInt(sanpham.querySelector('.pro-qty input').value);
                var ThanhTien = GiaSP * SoLuong;
                sanpham.querySelector('.shoping__cart__total').innerText = ThanhTien + ' đ';

                TongTien += ThanhTien;
            }

            var thanhtienElement = document.querySelector('.shoping__checkout ul li:nth-child(1) span');
            thanhtienElement.innerText = TongTien + ' đ';

            var tongTienElement = document.querySelector('.shoping__checkout ul li:nth-child(2) span');
            tongTienElement.innerText = TongTien + ' đ';

            document.querySelector('#TongTien').value=TongTien;
            document.querySelector('#SoLuong').value=SoLuong;

        }
        updatetotal(); // Đảm bảo rằng tổng tiền được cập nhật khi trang được tải


        $("#tangSL").click(function(){
            $.post("updatecart.php",
            {
                SoLuong: "",
                MaSP: ""
            },
            function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
            });
        });
    
        */
    </script>

<?php include_once 'v_footer.php'; ?>


