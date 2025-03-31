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
                    <h1>Sửa sản phẩm</h1>
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
                            <h3 class="card-title">Form</h3>
                        </div>

                        <form action="<?= BASE_URL_ADMIN . 'editSanPham&id=' . $products['id'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Chọn Danh Mục</label>
                                    <select class="form-control" name="danh_muc_id" id="danh_muc_id">
                                        <?php foreach ($categories as $danhMuc): ?>
                                            <option <?= $danhMuc['id'] === $products['danh_muc_id'] ? 'selected' : '' ?>
                                                value="<?= $danhMuc['id'] ?>">
                                                <?= $danhMuc['ten_danh_muc'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($_SESSION['error']['danh_muc_id'])): ?>
                                        <p class="text-danger"><?= $_SESSION['error']['danh_muc_id'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Tên Sản Phẩm</label>
                                    <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($products['ten_san_pham']) ?>">
                                    <?php if (isset($_SESSION['error']['ten_san_pham'])): ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Giá</label>
                                    <input type="number" name="gia" class="form-control" placeholder="Nhập giá" min="0" value="<?= $products['gia'] ?>">
                                    <?php if (isset($_SESSION['error']['gia'])): ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Số Lượng</label>
                                    <input type="number" name="so_luong" class="form-control" placeholder="Nhập số lượng" value="<?= $products['so_luong'] ?>">
                                    <?php if (isset($_SESSION['error']['so_luong'])): ?>
                                        <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Chọn hình ảnh</label>
                                    <input type="file" name="hinh_anh" class="form-control">
                                    <br>
                                    <?php if (!empty($products['hinh_anh'])): ?>
                                        <img src="<?= BASE_URL . $products['hinh_anh']  ?>" alt="<?= htmlspecialchars($products['ten_san_pham']) ?>" width="120px">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['error']['hinh_anh'])): ?>
                                        <p class="text-danger"><?= $_SESSION['error']['hinh_anh'] ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Nhập thêm mô tả</label>
                                    <textarea name="mo_ta" class="form-control"><?= htmlspecialchars($products['mo_ta']) ?></textarea>
                                    <?php if (isset($_SESSION['error']['mo_ta'])): ?>
                                        <p class="text-danger"><?= $_SESSION['error']['mo_ta'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layouts/footer.php'; ?>