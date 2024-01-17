<div class="main-content">
    <h3 class="title-page">
        Chỉnh sửa bài viết
    </h3>

    <form class="editPro" action="index.php?mod=admin&act=admin_edit_post" method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary mb-2" name="submitupdateblog" value="Lưu">
        </div>
        <div class="form-group">
            <label for="name">Tiêu đề:</label>
            <input type="text" class="form-control" name="TieuDe" value="<?= $getpostId['TieuDe'] ?>">
        </div>

        <div class="form-group">
            <label for="exampleInputFile" class="label_admin">Hình ảnh:
            <div class="custom-file">
                <input type="file" name="HinhAnh">
                <img src="view/img/baiviet/<?= $getpostId['HinhAnh'] ?>" alt=""
                    style="width:80px; height:80px; object-fit:cover;">
            </div></label>
        </div>

        <div class="form-group">
            <label for="exampleInputFile" class="label_admin">Hỉnh ảnh chi tiết
            <div class="custom-file">
                <input type="file" name="HinhAnhDetail">
                <img src="view/img/baiviet/<?= $getpostId['HinhAnhDetail'] ?>" alt=""
                    style="width:80px; height:80px; object-fit:cover;">
            </div></label>
        </div>

        <div class="form-group">
            <label for="name">Mô tả ngắn:</label>
            <textarea class="form-control" name="MoTaNgan"><?= $getpostId['MoTaNgan'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="name">Mô tả:</label>
            <input type="text" class="form-control mota" name="MoTa" value="<?= $getpostId['MoTa'] ?>">
        </div>

        <select name="MaDM" class="admin__select">
            <?php foreach ($danhmucall as $dm): ?>
                <option value="<?= $dm['MaDM'] ?>" <?= ($dm['MaDM'] == $getpostId['MaDM']) ? "selected" : "" ?>>
                    <?= $dm['TenDM'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

</div>