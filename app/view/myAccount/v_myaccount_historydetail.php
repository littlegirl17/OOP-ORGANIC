
<div class="back_myaccount" style="text-align: right;">
    <a href="index.php?mod=myaccount&act=history_account">Quay lại </a>
</div>
<div class="title_myacount">
    <h4>Chi tiết đơn hàng đã giao</h4>
</div>
<table class="table table-borderless ">
    <thead>
        <tr class="listproduct_title_shadow">
        <th scope="col">STT</th>
        <th scope="col">sản phẩm</th>
        <th scope="col">Giá tiền </th>
        <th scope="col">Số lượng</th>
        <th scope="col">Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $stt = 1;
            $TongTien = 0;
            foreach($viewhistorymyacc as $item):
                $TongTien = $item['SoLuong']*$item['GiaSP'];

        ?>
        <tr class="listproduct_shadow">
            <th ><?=$stt?></th>
            <td><img src="view/img/traicay/<?=$item['HinhAnh']?>" alt="" style="width:100px;"><?=$item['TenSP']?></td>
            <td><?=number_format($item['GiaSP'],"0",",",".")?></td>
            <td><?=$item['SoLuong']?></td>
            <td><?=number_format($TongTien,"0",",",".")?></td>
        </tr>
        <?php
                $stt++;
            endforeach; 
        ?>
    </tbody>
</table>
