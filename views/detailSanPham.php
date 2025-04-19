<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-details-reviews section-padding pb-0">
        <div class="container">
            <div class="row">
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
                                <!-- <div class="mb-3">
                                    <span class="badge bg-warning text-dark">⭐ 4.5/5</span>
                                    <span class="text-muted">(200 đánh giá)</span>
                                </div> -->
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Số lượng:</label>
                                    <input type="number" name="so_luong" class="form-control w-25 d-inline" value="1" min="1" max="<?= $sanPham['so_luong'] ?>">
                                </div>
                                <button type="submit" class="btn btn-cart2" id="add-to-cart-btn">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-review-info">
                        <ul class="nav review-tab">

                            <li>
                                <?php $countComment = count($listBinhLuan); ?>
                                <a class="active" data-bs-toggle="tab" href="#tab_three">Bình luận (<?= $countComment ?> )</a>
                            </li>
                        </ul>
                        <div class="tab-content reviews-tab">

                            <?php foreach ($listBinhLuan as $binhLuan): ?>
                                <div class="tab-pane fade show active" id="tab_three">


                                    <div class="total-reviews">
                                        <div class="review-box">

                                            <div class="post-author">
                                                <p><span><?= $binhLuan['ho_ten'] ?> - </span><?= $binhLuan['ngay_tao'] ?></p>
                                            </div>
                                            <p><?= $binhLuan['noi_dung'] ?></p>

                                        </div>

                                    </div>
                                <?php endforeach ?>
                                <form action="<?= BASE_URL . '?act=dang-binh-luan' ?>" class="review-form" method="post">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                            <input type="hidden" name="tai_khoan_id" value="<?= $user['id'] ?>">

                                            <label class="col-form-label"><span class="text-danger">*</span>
                                                Nội dung Bình luận</label>
                                            <textarea class="form-control" name="noi_dung" required></textarea>

                                        </div>
                                    </div>

                                    <?php
                                    if (isset($_SESSION['tai_khoan'])) { ?>

                                        <div class="buttons">
                                            <button class="btn btn-sqr" type="submit">Bình luận</button>
                                        </div>
                                    <?php  } else {  ?>
                                        <p class="text-danger">Để bình luận vui lòng đăng nhập</p>
                                    <?php } ?>

                                </form> <!-- end of review-form -->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php require_once 'layout/miniCart.php'; ?>

    <?php require_once 'layout/footer.php'; ?>