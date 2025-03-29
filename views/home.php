<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main>
<section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/banner/banner2.jpeg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/banner/banner3.jpeg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/banner/banner1.jpeg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
        </div>
    </section>

    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanhPham as $key => $sanPham) :?>
                                        <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="<?= BASE_URL . '?act=chitietsanpham$id=' . $sanPham['id']?>">
                                                <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product" class="pri-img">
                                                <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product" class="sec-img">
                                            </a>
                                            <div class="product-badge">
                                                <?php
                                                $ngayNhap = new DateTime($sanPham['ngay_tao']);
                                                $ngayHienTai = new DateTime();
                                                $tinhNgay = $ngayNhap->diff($ngayHienTai);

                                                if ($tinhNgay->days<= 7){
                                                    ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php  } ?>
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php  } ?>
                                                </div>
                                                <div class="btn btn-cart">
                                                    <button class="btn btn-cart"><a href="<?= BASE_URL .'?act=chitietsanpham&id='. $sanPham['id']?>">Xem chi tiết</a></button>
                                                </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a href="<?= BASE_URL  . '?act=chitietsanpham$id' . $sanPham['id'] ?>"><?=$sanPham['ten_san_pham'] ?> </a>
                                            </h6>
                                            <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?></span>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) ?></del></span>
                                                    <?php } else { ?>
                                                        <span class="price-old"><?= formatPrice($sanPham['gia_san_pham']) ?></span>
                                                    <?php } ?>
                                                </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php'; ?>