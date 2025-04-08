<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/corano/corano/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 09:54:01 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Đăng ký</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="assets/css/vendor/pe-icon-7-stroke.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="assets/css/plugins/jqueryui.min.css">
    <!-- main style css -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- Start Header Area -->
    <?php include_once "views/layout/header.php" ?>
    <?php include_once "views/layout/menu.php" ?>
    <!-- end Header Area -->


    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="<?= BASE_URL?>"><i
                                                class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row justify-content-center">
                        <!-- Login Content Start -->
                        <div class="col-lg-7 ">
                            <div class="login-reg-form-wrap">
                                <h5>Đăng Ký</h5>
                                <form
                                    action="<?= BASE_URL.'?act=checkdangky' ?>"
                                    method="post">
                                    <div class="single-input-item">
                                        <input type="text" placeholder="Tên đăng nhập" name="ho_ten" value="<?php if (isset($_SESSION['ho_ten'])) {
                                            echo $_SESSION['ho_ten'];
                                        } ?>">
                                        <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['ho_ten'] ?>
                                        </p>
                                        <?php } ?>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="email" placeholder="email@gmail.com" name="email" value="<?php if (isset($_SESSION['email'])) {
                                            echo $_SESSION['email'];
                                        } ?>">
                                        <?php if (isset($_SESSION['error']['email'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['email'] ?>
                                        </p>
                                        <?php } ?>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="text" placeholder="Số điện thoại" name="so_dien_thoai" value="<?php if (isset($_SESSION['so_dien_thoai'])) {
                                            echo $_SESSION['so_dien_thoai'];
                                        } ?>">
                                        <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['so_dien_thoai'] ?>
                                        </p>
                                        <?php } ?>
                                    </div>
                                    <div class="single-input-item">
                                        <input type="text" placeholder="Địa chỉ nơi trốn" name="dia_chi" value="<?php if (isset($_SESSION['dia_chi'])) {
                                            echo $_SESSION['dia_chi'];
                                        } ?>">
                                        <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                                        <p class="text-danger">
                                            <?= $_SESSION['error']['dia_chi'] ?>
                                        </p>
                                        <?php } ?>
                                    </div>
                                    <div class="flex mb">
                                        <div class="col-lg-12">
                                            <div class="single-input-item">
                                                <input type="password" placeholder="Mật khẩu" name="mat_khau" value="<?php if (isset($_SESSION['mat_khau'])) {
                                                    echo $_SESSION['mat_khau'];
                                                } ?>">
                                                <?php if (isset($_SESSION['error']['mat_khau'])) { ?>
                                                <p class="text-danger">
                                                    <?= $_SESSION['error']['mat_khau'] ?>
                                                </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single-input-item">
                                                <input type="password" placeholder="Nhập lại mật khẩu" name="remat_khau"
                                                    value="<?php if (isset($_SESSION['remat_khau'])) {
                                                        echo $_SESSION['remat_khau'];
                                                    } ?>">
                                                <?php if (isset($_SESSION['error']['remat_khau'])) { ?>
                                                <p class="text-danger">
                                                    <?= $_SESSION['error']['remat_khau'] ?>
                                                </p>
                                                <?php } ?>
                                                <?php if (isset($_SESSION['error']['checkmat_khau'])) { ?>
                                                <p class="text-danger">
                                                    <?= $_SESSION['error']['checkmat_khau'] ?>
                                                </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <div
                                            class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <button type="submit" class="btn btn-sqr">Đăng ký</button>
                                            </div>
                                            <span>Bạn đã có tài khoản? <br>Mời đến trang <a style="font-size: 16px;"
                                                    href="<?=BASE_URL.'?act=dangnhap'?>"
                                                    class="forget-pwd">Đăng nhập</a> </span>


                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Content End -->

                        <!-- Register Content Start -->

                        <!-- Register Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

    <!-- footer area start -->
    <?php include_once "./views/layout/footer.php" ?>
    <!-- footer area end -->
    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- slick Slider JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- Countdown JS -->
    <script src="assets/js/plugins/countdown.min.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/plugins/nice-select.min.js"></script>
    <!-- jquery UI JS -->
    <script src="assets/js/plugins/jqueryui.min.js"></script>
    <!-- Image zoom JS -->
    <script src="assets/js/plugins/image-zoom.min.js"></script>
    <!-- Images loaded JS -->
    <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <!-- mail-chimp active js -->
    <script src="assets/js/plugins/ajaxchimp.js"></script>
    <!-- contact form dynamic js -->
    <script src="assets/js/plugins/ajax-mail.js"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
    <!-- google map active js -->
    <script src="assets/js/plugins/google-map.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>

require_once 'layout/footer.php'; ?>
<!-- Mirrored from htmldemo.net/corano/corano/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 09:54:01 GMT -->

</html>