<?php
include './views/layouts/header.php';
include './views/layouts/navbar.php';
include './views/layouts/slidebar.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm Sản Phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form </h3>
                        </div>

                        <form action="<?= BASE_URL_ADMIN . 'addSanPham' ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <select name="danh_muc_id" id="" class="form-control">
                                        <option value="">Chọn Danh Mục</option>
                                        <?php foreach ($listDanhMuc as $category): ?>
                                            <option value="<?= $category['id'] ?>"> <?= $category['ten_danh_muc'] ?></option>
                                        <?php endforeach; ?>
                                        <?php if (isset($_SESSION['error']['danh_muc_id'])) { ?>
                                            <p class="text-danger">
                                                <?= $_SESSION['error']['danh_muc_id'] ?>
                                            </p>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input name="ten_san_pham" class="form-control" id="" placeholder="Nhập tên sản phẩm">
                                    <?php if (isset($_SESSION['error']['ten_san_pham'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['ten_san_pham'] ?>
                                        </p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Giá</label>
                                    <input type="number" name="gia" class="form-control" id="" placeholder="Nhập giá" min="0">
                                    <?php if (isset($_SESSION['error']['gia'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['gia'] ?>
                                        </p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Số Lượng</label>
                                    <input type="number" name="so_luong" class="form-control" id="" placeholder="Nhập số lượng">
                                    <?php if (isset($_SESSION['error']['so_luong'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['so_luong'] ?>
                                        </p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Chọn hình ảnh</label>
                                    <input type="file" name="hinh_anh" class="form-control" id="">
                                    <?php if (isset($_SESSION['error']['hinh_anh'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['hinh_anh'] ?>
                                        </p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Nhập thêm mô tả</label>
                                    <textarea type="text" name="mo_ta" class="form-control" id=""> </textarea>
                                    <?php if (isset($_SESSION['error']['mo_ta'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['mo_ta'] ?>
                                        </p>
                                    <?php } ?>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<?php
include './views/layouts/footer.php';
?>

</div>