<!-- header  -->
<?php
include './views/layouts/header.php';
?>
<!-- end header -->
<!-- Navbar -->
<?php
include './views/layouts/navbar.php';
?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php
include './views/layouts/slidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sửa danh mục</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form </h3>
              </div>
              
              <form action="<?= BASE_URL_ADMIN . 'editDanhMuc' ?>" method="POST">
                <input type="text" name="id" value="<?= $danhMuc['id'] ?>" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" class="form-control" value="<?= $danhMuc['ten_danh_muc'] ?>" name="ten_danh_muc"  placeholder="Mời nhập tên danh mục">
                    <?php if(isset($_SESSION['error']['ten_danh_muc'])){ ?>
                        <p class="text-danger"><?= $_SESSION['error']['ten_danh_muc'] ?></p>  
                        
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="mo_ta" class="form-control" id="" placeholder="Nhập mô tả"><?= $danhMuc['mo_ta'] ?></textarea>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
<?php
include './views/layouts/footer.php';
?>
<!-- end footer  -->


</body>

</html>