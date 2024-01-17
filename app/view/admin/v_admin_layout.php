<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="view/css/admin.css">
    <script src="https://kit.fontawesome.com/8c204d0fdf.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="view/bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid main-page">
        
        <div class="app-main">
            
            <nav class="sidebar bg-green">
                <ul>
                    <?php if(isset($_SESSION['user'])): ?>
                        <div class="box_infor">
                            <div class="box_infor__img">
                                <img src="view/img/avatar/<?=$_SESSION['user']['HinhAnh']?>" alt="">
                            </div>
                            <div class="box_infor__p">
                                <div class="box_infor_p_item">
                                    <p>Admin:</p>
                                </div>
                                <div class="box_infor_p_item">
                                    <p ><?=$_SESSION['user']['HoTen']?></p>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>
                    <li>
                        <div id="change-darkmode">
                            <i class="fa-solid fa-sun"  ></i>
                            <i class="fa-solid fa-moon"  ></i>
                        </div>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=dashboard"><i class="fa-solid fa-house ico-side"></i>Dashboards</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=admin_catagory"><i class="fa-solid fa-list ico-side" style="color: #ffff;"></i></i>Quản kí danh mục</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=admin_product"><i class="fa-brands fa-product-hunt ico-side" style="color: #ffffff;"></i>Quản lí sản phẩm</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=admin_post"><i class="fa-solid fa-blog ico-side" style="color: #f7f7f7;"></i>Quản lí bài viết</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=admin_user"><i class="fa-solid fa-users ico-side" style="color: #ffffff;"></i>Quản lí thành viên</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=admin_donhang"><i class="fa-solid fa-cart-shopping ico-side" style="color: #f2f2f2;"></i>Quản lí đơn hàng</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=adminlove"><i class="fa-solid fa-heart ico-side" style="color: #f2f2f2;"></i>Sản phẩm yêu thích</a>
                    </li>
                    <li>
                        <a href="index.php?mod=admin&act=admin_cmt"><i class="fa-solid fa-comments ico-side" style="color: #ffffff;"></i>Quản lí bình luận</a>
                    </li>
                    <!-- <li>
                        <a href="index.php?mod=admin&act=phanhoi"><i class="fa-solid fa-comments ico-side" style="color: #ffffff;"></i>Phản hồi khách hàng</a>
                    </li> -->
                    <li>
                        <a href="index.php?mod=admin&act=logoutadmin"><i class="fa-solid fa-right-from-bracket ico-side" style="color: #ffffff;"></i>Thoát</a>
                    </li>
                    
                </ul>
            </nav>

            <?php
                include_once 'view/admin/v_'.$view_name.'.php';
            ?>
            
        </div>
    </div>

    
</body>
<script src="view/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</html>
<script>
    function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('#preview').html('<img src="'+event.target.result+'" width="300" height="auto"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#HinhAnh").change(function () {
    imagePreview(this);
});
    
</script>
<script>
    //
    document.querySelector('#change-darkmode').addEventListener('click',function(){
        document.querySelector('body').classList.toggle('darkmode');
        var isDarkMode = document.querySelector('body').classList.contains('darkmode'); //contain la co chua, la no co chua darkmode //kiểm tra xem darkmodelớp đó có trong danh sách lớp của body phần tử được chọn hay không.
        localStorage.setItem('darkmode', isDarkMode); //setItem được sử dụng để lưu trữ dữ liệu trong bộ nhớ cục bộ của trình duyệt web.
    })
    //Nếu giá trị là 'true', điều đó có nghĩa là người dùng đã kích hoạt chế độ tối trước đó
    if(localStorage.getItem('darkmode')=='true'){//getItem('darkmode'): Phương thức này lấy giá trị
        document.querySelector('body').classList.add('darkmode'); //add hãy thêm tên lớp CSS 'darkmode'vào <body>phần tử // thêm darkmode vào phần tử body
    }
</script>
<!-- 
    classList để quản lý các class của phần tử đó
    classList.toggle là một phương thức của classList được sử dụng để thêm hoặc xóa một class từ danh sách các class của phần tử.
    Nếu class đã tồn tại, toggle sẽ xóa nó khỏi danh sách class. Nếu class chưa tồn tại, nó sẽ được thêm vào. 

-->