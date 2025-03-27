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
          <h1>Trang thống kê</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->




  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= count($listDonHang30days) ?></h3>

              <p>Đơn Hàng trong 30 ngày</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?= BASE_URL_ADMIN . 'don-hang-moi' ?>" class="small-box-footer">Xem thêm<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= count($list10top) ?><sup style="font-size: 20px"></sup></h3>

              <p>Sản Phẩm có lượt xem nhiều</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= BASE_URL_ADMIN . 'top10' ?>" class="small-box-footer">Xem thêm<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= count($listDonHoan) ?> </h3>

              <p>Đơn yêu cầu hoàn</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= BASE_URL_ADMIN . 'don-hoan' ?>" class="small-box-footer">Xem thêm<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= count($listDonBom) ?></h3>

              <p>Đơn hàng bị hủy</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= BASE_URL_ADMIN . 'don-bom' ?>" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Sales
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="#revenue-chart" data-toggle="tab">Area</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#donut-chart" data-toggle="tab">Donut</a> <!-- Đổi tab này thành active -->
                  </li>
                </ul>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                  style="position: relative; height: 300px;">



                  <table id="example1" class="table table-bordered table-striped">
                    <h1>Thống kê sản phẩm theo loại</h1>
                    <thead>
                      <tr>
                        <th>Số thứ tự</th>
                        <th>tên danh mục</th>
                        <th>Số lượng</th>
                        <th>Giá cao nhất</th>
                        <th>Giá thấp nhất</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      foreach ($listThongKe as $key => $thongke) {
                        extract($thongke);
                        echo '
                    <tr>
                        <td>' . $key + 1 . '</td>
                        <td>' . $tendm . '</td>
                        <td>' . $countsp . '</td>
                        <td>' . $maxprice . '</td>
                        <td>' . $minprice . '</td>
                        
                    </tr>
                    ';
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Số thứ tự</th>
                        <th>tên danh mục</th>
                        <th>Số lượng</th>
                        <th>Giá cao nhất</th>
                        <th>Giá thấp nhất</th>

                      </tr>
                    </tfoot>
                  </table>
                </div>


                <div class="chart tab-pane active" id="donut-chart" style="position: relative; height: 400px;">
                  <div id="piechart" style="width: 100%; height: 400px;"></div>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->








          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map card -->
          <div class="card bg-gradient-primary">


            <!-- /.card-body-->
            <div class="card-footer bg-transparent">
              <div class="row">
                <div class="col-4 text-center">
                  <div id="sparkline-1"></div>
                  <div class="text-white">Quang Đông</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                  <div id="sparkline-2"></div>
                  <div class="text-white">Văn Huy</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="text-white">Đình Khương</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->


            </div>
          </div>
          <!-- /.card -->



          <!-- Calendar -->
          <div class="card bg-gradient-success">
            <div class="card-header border-0">

              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Lịch
              </h3>
              <!-- tools card -->
              <div class="card-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">


                </div>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->


  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
<?php
include './views/layouts/footer.php';
?>

<!-- Google Charts Script -->
<!-- Google Charts Script -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  // Load Google Charts
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  // Function to draw the chart
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Danh mục', 'Số lượng sản phẩm'],
      <?php
      $tongdm = count($listThongKe);
      $i = 1;
      foreach ($listThongKe as $thongke) {
        extract($thongke);
        $dauphay = ($i == $tongdm) ? "" : ",";
        echo "['" . $tendm . "', " . $countsp . "]" . $dauphay;
        $i++;
      }
      ?>
    ]);

    // Options for the pie chart
    var options = {
      title: 'Thống kê sản phẩm theo danh mục',
      pieHole: 0.4, // Tạo hiệu ứng Donut cho biểu đồ
      width: 750,
      height: 300
    };

    // Draw the chart inside the Donut tab
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
</script>

<!-- end footer  -->
<!-- Page specific script -->

<!-- Code injected by live-server -->
<!-- jQuery -->
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./assets/plugins/moment/moment.min.js"></script>
<script src="./assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./assets/dist/js/pages/dashboard.js"></script>



</body>

</html>