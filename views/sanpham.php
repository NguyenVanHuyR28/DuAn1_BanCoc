<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<main>
    <div class="breadcrum-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrum">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page" ><a href="<?= BASE_URL . '?act=allsanpham' ?>">shop</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Danh mục sản phẩm</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    <?php if (isset($listDanhMuc) && is_array($listDanhMuc)): ?>
                                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                                        <li><a href="<?= BASE_URL .'?act=sanphamdanhmuc&id_dm=' .$danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc']?> </a></li>
                                        

                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <p>Không có danh mục nào.</p>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            <?php foreach ($listSanPham as $sanPham): ?>
                                <div class="col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">

                                        <figure class="product-thumb">

                                            <a href="<?= BASE_URL . '?act=chitietsanpham&id_sp=' . $sanPham['id'] ?>">
                                                <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                            </a>
                                            <div class="product-badge">
                                                <?php
                                                $ngayTao = new DateTime($sanPham['ngay_tao']);
                                                $ngayHienTai = new DateTime();
                                                $tinhNgay = $ngayTao->diff($ngayHienTai);

                                                if ($tinhNgay->days <= 7) {
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

                                            <div class="cart-hover">
                                                <button class="btn btn-cart"><a style="color: darkgray;" href="<?= BASE_URL . '?act=chitietsanpham&id_san_pham=' . $sanPham['id'] ?>">Xem chi tiết</a></button>
                                            </div>

                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a href="<?= BASE_URL . '?act=chitietsanpham&id_san_pham= ' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                            </h6>
                                            <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?></span>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia']) ?></del></span>
                                                    <?php } else { ?>
                                                        <span class="price-old"><?= formatPrice($sanPham['gia']) ?></span>
                                                    <?php } ?>



                                                </div>
                                        </div>

                                    </div>
                                    <!-- product grid end -->


                                </div>
                            <?php endforeach ?>
                            <!-- product single item start -->


                        </div>
                        div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                            </ul>
                        </div>
                        </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
</main>
<?php require_once 'layout/footer.php'; ?>