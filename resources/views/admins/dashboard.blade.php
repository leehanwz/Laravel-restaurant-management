@extends('layouts.admins.layout-admin')

@section('title', 'Bảng điều khiển')

@section('style')
<style>
  /* CSS Riêng cho Dashboard để đẹp hơn */
  .row-md-body {
    margin-top: 20px;
  }

  /* Style cho 4 ô thống kê phía trên */
  .widget-modern {
    display: flex;
    align-items: center;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    margin-bottom: 30px;
    transition: transform 0.3s ease;
  }

  .widget-modern:hover {
    transform: translateY(-5px);
  }

  .widget-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-right: 20px;
    flex-shrink: 0;
    /* Không bị co lại */
  }

  .widget-content h4 {
    font-size: 15px;
    color: #6c757d;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-weight: 600;
  }

  .widget-content b {
    font-size: 24px;
    color: #2c3e50;
    font-weight: 700;
  }

  .widget-content .info-sub {
    font-size: 12px;
    color: #adb5bd;
    margin-top: 5px;
    display: block;
  }

  /* Màu sắc riêng cho từng widget */
  .bg-primary-soft {
    background-color: rgba(0, 150, 136, 0.1);
    color: #009688;
  }

  .bg-info-soft {
    background-color: rgba(23, 162, 184, 0.1);
    color: #17a2b8;
  }

  .bg-warning-soft {
    background-color: rgba(255, 193, 7, 0.1);
    color: #ffc107;
  }

  .bg-danger-soft {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
  }

  /* Style cho Table đẹp hơn */
  .tile {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    padding: 25px;
    margin-bottom: 30px;
    border: none;
  }

  .tile-title {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 20px;
    border-bottom: 2px solid #f0f2f5;
    padding-bottom: 10px;
  }

  .table thead th {
    border-top: none;
    border-bottom: 2px solid #e9ecef;
    font-size: 13px;
    text-transform: uppercase;
    color: #6c757d;
    font-weight: 600;
  }

  .table td {
    vertical-align: middle;
    font-size: 14px;
    color: #495057;
  }

  /* Badge trạng thái dạng viên thuốc */
  .badge {
    padding: 8px 12px;
    border-radius: 30px;
    font-weight: 500;
    font-size: 11px;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6 col-lg-3">
    <div class="widget-modern">
      <div class="widget-icon bg-primary-soft">
        <i class='bx bxs-user-account'></i>
      </div>
      <div class="widget-content">
        <h4>Tổng khách hàng</h4>
        <b>56</b>
        <span class="info-sub">Tổng khách hàng được quản lý</span>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="widget-modern">
      <div class="widget-icon bg-info-soft">
        <i class='bx bxs-data'></i>
      </div>
      <div class="widget-content">
        <h4>Tổng sản phẩm</h4>
        <b>1850</b>
        <span class="info-sub">Tổng sản phẩm đang bán</span>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="widget-modern">
      <div class="widget-icon bg-warning-soft">
        <i class='bx bxs-shopping-bags'></i>
      </div>
      <div class="widget-content">
        <h4>Tổng đơn hàng</h4>
        <b>247</b>
        <span class="info-sub">Số hóa đơn bán trong tháng</span>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="widget-modern">
      <div class="widget-icon bg-danger-soft">
        <i class='bx bxs-error-alt'></i>
      </div>
      <div class="widget-content">
        <h4>Sắp hết hàng</h4>
        <b>4</b>
        <span class="info-sub">Sản phẩm cần nhập thêm</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-lg-12">
    <div class="tile">
      <h3 class="tile-title">Tình trạng đơn hàng gần nhất</h3>
      <div class="table-responsive">
        <table class="table table-hover table-borderless">
          <thead>
            <tr>
              <th>ID Đơn</th>
              <th>Khách hàng</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#AL3947</td>
              <td><b>Phạm Thị Ngọc</b></td>
              <td style="color: #d63031; font-weight: bold;">19.770.000 đ</td>
              <td><span class="badge bg-warning text-dark">Chờ xử lý</span></td>
            </tr>
            <tr>
              <td>#ER3835</td>
              <td><b>Nguyễn Thị Mỹ Yến</b></td>
              <td style="color: #d63031; font-weight: bold;">16.770.000 đ</td>
              <td><span class="badge bg-info text-white">Đang vận chuyển</span></td>
            </tr>
            <tr>
              <td>#MD0837</td>
              <td><b>Triệu Thanh Phú</b></td>
              <td style="color: #d63031; font-weight: bold;">9.400.000 đ</td>
              <td><span class="badge bg-success">Đã hoàn thành</span></td>
            </tr>
            <tr>
              <td>#MT9835</td>
              <td><b>Đặng Hoàng Phúc</b></td>
              <td style="color: #d63031; font-weight: bold;">40.650.000 đ</td>
              <td><span class="badge bg-danger">Đã hủy</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Khách hàng mới gia nhập</h3>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên khách hàng</th>
              <th>Ngày sinh</th>
              <th>Số điện thoại</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#183</td>
              <td>Hột vịt muối</td>
              <td>21/7/1992</td>
              <td><span class="badge bg-success">0921387221</span></td>
            </tr>
            <tr>
              <td>#219</td>
              <td>Bánh tráng trộn</td>
              <td>30/4/1975</td>
              <td><span class="badge bg-warning text-dark">0912376352</span></td>
            </tr>
            <tr>
              <td>#627</td>
              <td>Cút rang bơ</td>
              <td>12/3/1999</td>
              <td><span class="badge bg-primary">01287326654</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Dữ liệu 6 tháng đầu vào</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Thống kê doanh thu</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="text-center" style="font-size: 13px; color: #999; margin-top: 20px;">
  <p><b>Copyright © <script>
        document.write(new Date().getFullYear());
      </script> Phần mềm quản lý bán hàng | Dev By Trường</b></p>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('admin/doc/js/plugins/chart.js') }}"></script>

<script type="text/javascript">
  // Dữ liệu biểu đồ - Màu sắc đã được chỉnh lại cho dịu mắt hơn (Tone Pastel)
    var data = {
      labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
      datasets: [
        {
            label: "Dữ liệu đầu tiên",
            fillColor: "rgba(255, 212, 59, 0.2)", // Màu vàng nhạt nền
            strokeColor: "rgb(255, 212, 59)",     // Màu vàng đậm viền
            pointColor: "rgb(255, 212, 59)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgb(255, 212, 59)",
            data: [20, 59, 90, 51, 56, 100]
        },
        {
            label: "Dữ liệu kế tiếp",
            fillColor: "rgba(9, 109, 239, 0.2)",  // Màu xanh nhạt nền
            strokeColor: "rgb(9, 109, 239)",      // Màu xanh đậm viền
            pointColor: "rgb(9, 109, 239)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgb(9, 109, 239)",
            data: [48, 48, 49, 39, 86, 10]
        }
      ]
    };
    
    // Kiểm tra xem element có tồn tại không trước khi vẽ để tránh lỗi Console
    if($("#lineChartDemo").length) {
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
    }

    if($("#barChartDemo").length) {
        var ctxb = $("#barChartDemo").get(0).getContext("2d");
        var barChart = new Chart(ctxb).Bar(data);
    }
</script>
@endsection