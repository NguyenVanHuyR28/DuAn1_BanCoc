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
                    <h1>Chi Tiết Sản Phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card p-4">
                <h4 class="mb-4 text-primary fw-bold">Thông Tin Sản Phẩm</h4>

                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Hình ảnh sản phẩm" class="img-fluid rounded border">
                    </div>
                    <div class="col-md-8">
                        <p><strong>ID:</strong> <?= $sanPham['id'] ?></p>
                        <p><strong>Danh mục:</strong> <?= $sanPham['ten_danh_muc'] ?></p>
                        <p><strong>Tên sản phẩm:</strong> <?= $sanPham['ten_san_pham'] ?></p>
                        <p><strong>Giá:</strong> <?= number_format($sanPham['gia'], 0, ',', '.') ?>₫</p>
                        <p><strong>Giá khuyến mãi:</strong>
                            <?= $sanPham['gia_khuyen_mai'] > 0 ? number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') . '₫' : '(Không có)' ?>
                        </p>
                        <p><strong>Số lượng:</strong>
                            <?= $sanPham['so_luong'] ?> -
                            <?= $sanPham['so_luong'] > 0 ? '<span class="text-success">Còn hàng</span>' : '<span class="text-danger">Hết hàng</span>' ?>
                        </p>
                        <p><strong>Mô tả:</strong> <?= $sanPham['mo_ta'] ?></p>
                        <p><strong>Ngày tạo:</strong> <?= $sanPham['ngay_tao'] ?></p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= BASE_URL_ADMIN . '?act=listSanPham' ?>" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layouts/footer.php'; ?>