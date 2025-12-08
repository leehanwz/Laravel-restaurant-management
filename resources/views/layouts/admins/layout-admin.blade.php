<!DOCTYPE html>
<html lang="vi">

<head>
  <title>@yield('title') - Quản trị hệ thống</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/css/main.css') }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>

  @yield('style')

  <style>
    :root {
      --primary-color: #009688;
      /* Màu chủ đạo */
      --sidebar-width: 250px;
    }

    body {
      font-family: 'Be Vietnam Pro', sans-serif !important;
      /* Font tiếng Việt đẹp hơn */
      background-color: #f5f7fa;
    }

    /* Header đẹp hơn */
    .app-header {
      background-color: #fff !important;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05) !important;
    }

    .app-header__logo {
      font-family: 'Be Vietnam Pro', sans-serif;
    }

    /* Sidebar hiện đại */
    .app-sidebar {
      box-shadow: 2px 0 15px rgba(0, 0, 0, 0.05);
      background: #2c3e50;
      /* Màu tối sang trọng */
    }

    .app-sidebar__user {
      border-bottom: 1px solid rgba(231, 100, 6, 0.1);
    }

    .app-menu__item {
      border-radius: 8px;
      margin: 5px 10px;
      transition: all 0.3s ease;
    }

    .app-menu__item:hover,
    .app-menu__item.active {
      background: rgba(252, 109, 6, 0.993) !important;
      border-left: 4px solid var(--primary-color) !important;
      text-decoration: none;
    }

    /* Icon menu */
    .app-menu__icon {
      font-size: 20px;
    }

    /* Nút Logout đẹp hơn */
    .btn-logout-nav {
      color: #e74c3c !important;
      font-weight: 600;
      padding: 0 15px;
      display: flex;
      align-items: center;
      height: 50px;
    }

    .btn-logout-nav:hover {
      background-color: #fff5f5;
    }

    /* Card nội dung (Dùng cho @content) */
    .tile {
      border-radius: 12px !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
      border: none !important;
    }
  </style>
</head>

<body onload="time()" class="app sidebar-mini rtl">

  <header class="app-header">
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar" style="color: #333;"></a>

    <ul class="app-nav">
      <li class="app-nav__item d-none d-md-block" style="color: #333; font-weight: 500;" id="clock"></li>

      <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <a class="app-nav__item btn-logout-nav" href="#"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class='bx bx-log-out bx-rotate-180'></i> &nbsp; Đăng xuất
        </a>
      </li>
    </ul>
  </header>

  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user">
      <img class="app-sidebar__user-avatar" src="/images/hay.jpg" width="50px"
        style="border-radius: 50%; border: 2px solid #fff;" alt="User Image">
      <div>
        <p class="app-sidebar__user-name" style="font-weight: 600;">Ocean Buffet</p>
        <p class="app-sidebar__user-designation" style="font-size: 12px; opacity: 0.8;">Quản trị viên</p>
      </div>
    </div>

    <ul class="app-menu">
      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"
          href="{{route('admin.dashboard')}}">
          <i class='app-menu__icon bx bx-grid-alt'></i> <span class="app-menu__label">Dashboard</span>
        </a>
      </li>

      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.menu.*') ? 'active' : '' }}"
          href="{{route('admin.menu.index')}}">
          <i class='app-menu__icon bx bx-category'></i>
          <span class="app-menu__label">Danh mục món</span>
        </a>
      </li>

      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.product.*') ? 'active' : '' }}"
          href="{{route('admin.product.index')}}">
          <i class='app-menu__icon bx bx-dish'></i> <span class="app-menu__label">Món ăn</span>
        </a>
      </li>

      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.drink.*') ? 'active' : '' }}"
          href="{{route('admin.drink.index')}}">
          <i class='app-menu__icon bx bx-coffee-togo'></i>
          <span class="app-menu__label">Đồ uống</span>
        </a>
      </li>

      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.combos.*') ? 'active' : '' }}"
          href="{{route('admin.combos.index')}}">
          <i class='app-menu__icon bx bx-gift'></i>
          <span class="app-menu__label">Combo</span>
        </a>
      </li>

      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.combos.items.*') ? 'active' : '' }}"
          href="{{ route('admin.combos.items.selectCombo') }}">
          <i class='app-menu__icon bx bx-list-plus'></i>
          <span class="app-menu__label">Set món Combo</span>
        </a>
      </li>

      <li>
        <a class="app-menu__item {{ Request::routeIs('admin.khu-vuc-ban-an') ? 'active' : '' }}"
          href="{{ route('admin.khu-vuc-ban-an') }}">
          <i class='app-menu__icon bx bx-map-alt'></i>
          <span class="app-menu__label">Bàn & Khu vực</span>
        </a>
      </li>
    </ul>
  </aside>

  <main class="app-content">
    <div class="app-title"
      style="background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); margin-bottom: 30px; padding: 20px;">
      <div>
        <h1><i class='bx bx-layer'></i> @yield('title', 'Trang quản trị')</h1>
        <p>Xin chào, chúc bạn một ngày làm việc hiệu quả!</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="bx bx-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
      </ul>
    </div>

    @yield('content')
  </main>

  <script src="{{ asset('admin/doc/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('admin/doc/js/popper.min.js') }}"></script>
  <script src="{{ asset('admin/doc/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/doc/js/main.js') }}"></script>
  <script src="{{ asset('admin/doc/js/plugins/pace.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('admin/doc/js/plugins/jquery.dataTables.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('admin/doc/js/plugins/dataTables.bootstrap.min.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function() {
        // Chỉ khởi tạo nếu bảng tồn tại để tránh lỗi JS
        if($('#sampleTable').length) {
            $('#sampleTable').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ dòng",
                    "zeroRecords": "Không tìm thấy dữ liệu",
                    "info": "Trang _PAGE_ / _PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng số dòng)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    }
                }
            });
        }
    });
  </script>

  <script type="text/javascript">
    function time() {
      var today = new Date();
      var weekday = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
      var day = weekday[today.getDay()];
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0');
      var yyyy = today.getFullYear();
      var h = String(today.getHours()).padStart(2, '0');
      var m = String(today.getMinutes()).padStart(2, '0');
      var s = String(today.getSeconds()).padStart(2, '0');
      
      var nowTime = h + ":" + m + ":" + s;
      var todayStr = day + ', ' + dd + '/' + mm + '/' + yyyy;
      
      // Kiểm tra xem element có tồn tại không trước khi gán
      var clockElement = document.getElementById("clock");
      if(clockElement) {
          clockElement.innerHTML = '<i class="bx bx-time-five"></i> ' + todayStr + ' - ' + nowTime;
      }
      setTimeout(time, 1000);
    }
  </script>

  @yield('script')
</body>

</html>