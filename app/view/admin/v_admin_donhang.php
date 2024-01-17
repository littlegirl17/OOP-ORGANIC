
<div class="main-content">
    <h3 class="title-page">
        Đơn hàng đã đặt
    </h3>
    <div class="row">
        <div class="col-md-6">
            <div class="blog__sidebar__search">
                <form action="index.php?mod=admin&act=admin_donhang" method="post">
                    <input type="text" name="keyword" placeholder="Search...">
                    <button type="submit" name="search_product"><i class="fa-solid fa-magnifying-glass" style="color: #69cc05;"></i></button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
    <section class="row">
        <div class="col-sm-12 col-md-12 col xl-12">
            <div class="card chart">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã ĐH</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt</th>
                            <th>PTTT</th>
                            <th>Xem</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $stt = 1; 
                            foreach($donghangall as $order):
                        ?>
                        <tr>
                            <td><?=$stt?></td>
                            <td><?=$order['MaDH']?></td>
                            <td><?=$order['HoTen']?></td>
                            <td><?=$order['Email']?></td>
                            <td><?=$order['SoDienThoai']?></td>
                            <td style="width:100px"><?=$order['DiaChi']?></td>
                            <td><?=number_format($order['TongTien'],"0",",",".")?></td>
                            <td><?=$order['NgayDat']?></td>
                            <td>
                                <?php
                                    switch ($order['PhuongThucTT']) {
                                        case '1':
                                            echo '<p style="font-weight: 500;">Trả tiền mặt khi nhận hàng</p>';
                                            break;
                                        case '2':
                                            echo '<p style="font-weight: 500;">Thanh toán bằng VNPAY</p>';
                                            break;
                                        case '3':
                                            echo '<p style="font-weight: 500;">Thanh toán ví momo</p>';
                                            break;
                                        default:

                                            break;
                                    }
                                ?>
                            </td>
                            <td><a href="index.php?mod=admin&act=donhang_detail&MaDH=<?=$order['MaDH']?>" class="a_linkdetail">Xem chi tiết</a></td>
                            <td>
                                <?php
                                    switch ($order['TrangThai']) {
                                        case '0':
                                            echo '<p style="text-align: center; color:#fff; padding:5px 5px; background-color: #F08080;">Đơn hàng mới</p>';
                                            break;
                                        case '1':
                                            echo '<p style="text-align: center; color:#fff; padding:5px 5px; background-color: #FFD700;">Đang xử lý</p>';
                                            break;
                                        case '2':
                                            echo '<p  style="text-align: center; color:#fff; padding:5px 5px; background-color: #21d2e2;">Xác nhận đơn hàng</p>';
                                            break;
                                        case '3':
                                            echo '<p  style="text-align: center; color:#fff; padding:5px 5px; background-color: #21d2e2;">Đang giao hàng</p>';
                                            break;
                                        case '4':
                                            echo '<p style="text-align: center; color:#fff; padding:5px 5px; background-color: #00982d;">Đã giao</p>';
                                            break;
                                        case '5':
                                            echo '<p style="text-align: center; color:#fff; padding:5px 5px; background-color: #e22121;">Đã hủy</p>';
                                            break;
                                        case '6':
                                            echo '<p style="text-align: center; color:#fff; padding:5px 5px; background-color: #000000;">Giao hàng thất bại</p>';
                                            break;
                                        default:
                
                                            break;
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="index.php?mod=admin&act=admin_edit_donhang&MaDH=<?=$order['MaDH']?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
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
                <a class="page-link" href="index.php?mod=admin&act=admin_donhang&page=<?=$page-1?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for($i=1; $i < $SoTrang ; $i++): ?>
                <li class="page-item <?= ($page==$i) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?mod=admin&act=admin_donhang&page=<?=$i?>"><?=$i?></a>
                </li>
            <?php endfor; ?>
                <li class="page-item <?= ($page >= $SoTrang) ? "disabled" : ""?>">
                <a class="page-link" href="index.php?mod=admin&act=admin_donhang&page=<?=$page+1?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</div>
