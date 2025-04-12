<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi Tiết Sản Phẩm</title>
</head>

<body>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="post">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="img-fluid rounded" alt="Sản phẩm">
                </div>
                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                <div class="col-md-6">
                    <h2 class="fw-bold"><?= $sanPham['ten_san_pham'] ?></h2>
                    <p class="text-muted"> Thuộc Danh Mục : <?= $danhMuc['ten_danh_muc'] ?></p>
                    <h4 class="text-muted">
                        <del><?= number_format($sanPham['gia'], 0, ',', '.') ?> VNĐ</del>
                    </h4>
                    <h4 class="text-danger fw-bold">
                        <?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?> VNĐ
                    </h4>
                    <div class="availability">
                        <i class="fa fa-check-circle"></i>
                        <span>Số Lượng : <?= $sanPham['so_luong'] ?></span>
                    </div>
                    <p class="mt-3">Mô tả:<?= $sanPham['mo_ta'] ?></p>
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark">⭐ 4.5/5</span>
                        <span class="text-muted">(200 đánh giá)</span>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="number" name="so_luong" class="form-control w-25 d-inline" value="1" min="1" max="<?= $sanPham['so_luong'] ?>">
                    </div>
                    <button class="btn btn-primary">Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>
    </form>

    <?php require_once 'layout/footer.php' ?>
</body>

</html>