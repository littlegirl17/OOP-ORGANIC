<div class="main-content">
    <h3 class="title-page">
        Danh mục
    </h3>
    <div class="row">
        <div class="col-md-6">
            <div class="blog__sidebar__search">
                <form action="index.php?mod=admin&act=admin_catagory" method="post">
                    <input type="text" name="keyword" placeholder="Search...">
                    <button type="submit" name="search_product"><i class="fa-solid fa-magnifying-glass" style="color: #69cc05;"></i></button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a href="index.php?mod=admin&act=admin_add_catagory" class="btn btn-primary mb-2">Thêm danh mục mới</a>
            </div>
        </div>
    </div>
    
    <section class="row">
        <div class="col-sm-12 col-md-12 col xl-12">
            <div class="card chart">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã danh mục </th>
                            <th>Tên danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Uư tiên</th>
                            <th>Số thứ tự</th>
                            <th>Hành động</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $stt = 1; 
                            foreach($danhmucall as $item):
                        ?>
                        <tr>
                            <td><?=$stt?></td>
                            <td><?=$item['MaDM']?></td>
                            <td><?=$item['TenDM']?></td>
                            <td><img src="view/img/categories/<?=$item['HinhAnh']?>" alt="" style="width:80px; height:80px; object-fit:cover;"></td>
                            <td>
                                <?php
                                    switch ($item['UuTien']) {
                                        case '0':
                                            echo 'Ẩn';
                                            break;
                                        case '1':
                                            echo 'Hiện';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                ?>
                            </td>
                            <td><?=$item['SoThuTu']?></td>
                            <td>
                                <a href="index.php?mod=admin&act=admin_edit_catagory&MaDM=<?=$item['MaDM']?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                            </td>
                            <td>
                                <?php
                                    switch ($item['TrangThai']) {
                                        case '0':
                                            echo '<p class="statuscatagory_1">Hiện</p>';
                                            break;
                                        case '1':
                                            echo '<p class="statuscatagory_2">Ẩn</p>';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php 
                            $stt++; 
                            endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="admin__pagein">
        <ul class="pagination">
            <li class="page-item <?= ($page <= 1) ? "disabled" : ""?>">
                <a class="page-link" href="index.php?mod=admin&act=admin_catagory&page=<?=$page-1?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for($i=1; $i < $SoTrang ; $i++): ?>
                <li class="page-item <?= ($page==$i) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?mod=admin&act=admin_catagory&page=<?=$i?>"><?=$i?></a>
                </li>
            <?php endfor; ?>
                <li class="page-item <?= ($page >= $SoTrang) ? "disabled" : ""?>">
                <a class="page-link" href="index.php?mod=admin&act=admin_catagory&page=<?=$page+1?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</div> 

<script>
    function delete_catagory(MaDM){ //Tham so MATK nay duoc lay tu $ds['MaTk]
        var kq = confirm("Bạn có chắc chắn muốn xóa danh mục này không?"); //Form duoc hien ra , neu nguoi ta bam XOA
        if(kq){//Neu bam CHON OK la ket qua dung thif no se chuyen den cai case nay va xoa, bien MaTk duoc lay tu o tren Tham so truyen vao
            window.location = 'index.php?mod=admin&act=admin_delete_catagory&MaDM='+MaDM;
        }
        event.preventDefault();
    }
</script>
