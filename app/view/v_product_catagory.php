
<?php include_once 'v_header.php' ?>

    
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục Organic</h4>
                            <ul> 
                            <?php 
                                $getdanhmuc = $data['getall_danhmuc']; 
                                foreach($getdanhmuc as $dm): 
                            ?>
                                <li><a href="index.php?route=category&MaDM=<?=$dm['MaDM']?>"><?=$dm['TenDM']?></a></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <?php if(isset($_GET['MaDM']) && ($_GET['MaDM']>0)): ?>
                            <?php 
                                $danhmuc_getbyid = $data['danhmucbyId'];
                                foreach($danhmuc_getbyid as $item){
                                    $price = "";
                                    $StatusProduct = "";
                                    if($item['GiaSP'] >=1){
                                        $price = '<h5>'.number_format($item['GiaSP'],"0",",",".").' đ</h5>';
                                    }else{
                                        $price = "<h5>Đang cập nhật</h5>";
                                    }
                                    if($item['StatusProduct'] >=1){
                                        $StatusProduct = '<h5>Hết hàng</h5>';
                                    }else{
                                        $StatusProduct = "";
                                    }
                        
                                    
                                    echo '
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="featured__item">
                                                <div class="featured__item__pic set-bg" data-setbg="public/img/traicay/'.$item['HinhAnh'].'">
                                                    
                                                </div>
                                                <div class="featured__item__text">
                                                    <h6><a href="index.php?mod=product&act=detail&MaSP='.$item['MaSP'].'">'.$item['TenSP'].'</a></h6>
                                    ';
                                                if(empty($StatusProduct)){
                                                    echo $price;
                                                    echo ' 
                                                        <form action="index.php?mod=product&act=addtocart" method="post">
                                                            <input type="hidden" name="MaSP" value="'.$item['MaSP'].'">
                                                            <input type="hidden" name="HinhAnh" value="'.$item['HinhAnh'].'">
                                                            <input type="hidden" name="GiaSP" value="'.$item['GiaSP'].'">
                                                            <input type="hidden" name="TenSP" value="'.$item['TenSP'].'">
                                                            <input type="hidden" name="SoLuong" value="1">
                                                            <div class="intro">
                                                                <input type="submit" value="Thêm vào giỏ " name="submitaddtocart">
                                                            </div>
                                                        </form> 
                                                    ';
                        
                                                }else{
                                                    echo $StatusProduct;
                                                }
                        
                                    echo '
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                    
                                }

                            ?>
                                
                        <?php else: ?>
                            <?php 
                                $getdanhmucproduct = $data['getdanhmuc'];
                                foreach($getdanhmucproduct as $item){
                                    $price = "";
                                    $StatusProduct = "";
                                    if($item['GiaSP'] >=1){
                                        $price = '<h5>'.number_format($item['GiaSP'],"0",",",".").' đ</h5>';
                                    }else{
                                        $price = "<h5>Đang cập nhật</h5>";
                                    }
                                    if($item['StatusProduct'] >=1){
                                        $StatusProduct = '<h5>Hết hàng</h5>';
                                    }else{
                                        $StatusProduct = "";
                                    }
                        
                                    
                                    echo '
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="featured__item">
                                                <div class="featured__item__pic set-bg" data-setbg="public/img/traicay/'.$item['HinhAnh'].'">
                                                    
                                                </div>
                                                <div class="featured__item__text">
                                                    <h6><a href="index.php?mod=product&act=detail&MaSP='.$item['MaSP'].'">'.$item['TenSP'].'</a></h6>
                                    ';
                                                if(empty($StatusProduct)){
                                                    echo $price;
                                                    echo ' 
                                                        <form action="index.php?mod=product&act=addtocart" method="post">
                                                            <input type="hidden" name="MaSP" value="'.$item['MaSP'].'">
                                                            <input type="hidden" name="HinhAnh" value="'.$item['HinhAnh'].'">
                                                            <input type="hidden" name="GiaSP" value="'.$item['GiaSP'].'">
                                                            <input type="hidden" name="TenSP" value="'.$item['TenSP'].'">
                                                            <input type="hidden" name="SoLuong" value="1">
                                                            <div class="intro">
                                                                <input type="submit" value="Thêm vào giỏ " name="submitaddtocart">
                                                            </div>
                                                        </form> 
                                                    ';
                        
                                                }else{
                                                    echo $StatusProduct;
                                                }
                        
                                    echo '
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                    
                                }

                                
                            ?>
                        <?php endif;?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        if(isset($_GET['MaDM']) && ($_GET['MaDM']>0)):
    ?>
    <div class="admin__pagein">
        <ul class="pagination">
            <li class="page-item <?= ($page <= 1) ? "disabled" : ""?>">
            <a class="page-link" href="index.php?route=category&MaDM=<?=$MaDM?>&page=<?=$page-1?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php $SoTrang = $data['PhanTrang']; for($i=1; $i < $SoTrang ; $i++): ?>
                <li class="page-item <?= ($page==$i) ? 'active' : '' ?>">
                <a class="page-link" href="index.php?route=category&MaDM=<?=$MaDM?>&page=<?=$i?>"><?=$i?></a>
                </li>
            <?php endfor; ?>
                <li class="page-item <?=  ($page >= $SoTrang) ? "disabled" : ""?>">
                <a class="page-link" href="index.php?route=category&MaDM=<?=$MaDM?>&page=<?=$page+1?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
    <?php else: ?>
        <div class="admin__pagein">
        <ul class="pagination">
            <li class="page-item <?= ($page <= 1) ? "disabled" : ""?>">
            <a class="page-link" href="index.php?route=category&page=<?=$page-1?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php $SoTrang = $data['PhanTrang']; for($i=1; $i < $SoTrang ; $i++): ?>
                <li class="page-item <?= ($page==$i) ? 'active' : '' ?>">
                <a class="page-link" href="index.php?route=category&page=<?=$i?>"><?=$i?></a>
                </li>
            <?php endfor; ?>
                <li class="page-item <?= ($page >= $SoTrang) ? "disabled" : ""?>">
                <a class="page-link" href="index.php?route=category&page=<?=$page+1?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
    <?php
        endif;
    ?>

<?php include_once 'v_footer.php' ?>










   