<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>@yield('title')  Ocean Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{ asset('restaurant/img/favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('restaurant/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('restaurant/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('restaurant/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('restaurant/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('restaurant/css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            /* MÀU SẮC ĐÃ ĐƯỢC LÀM DỊU */
            --primary: #cea064;
            /* Vàng đồng trầm, không chói */
            --primary-hover: #b58b54;
            --dark-bg: #111827;
            /* Đen xanh đen sâu thẳm */
            --text-gray: #e5e7eb;
            /* Trắng ngà, đọc không mỏi mắt */
            --glass-matte: rgba(17, 24, 39, 0.95);
            /* Kính mờ đục, ít bóng */
        }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            color: #4b5563;
        }

        h1,
        h2,
        .section-title,
        .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* 1. HIỆU ỨNG MÓN ĂN BAY BỒNG BỀNH (Thay cho xoay/nháy) */
        @keyframes floatImage {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            /* Bay lên nhẹ 20px */
            100% {
                transform: translateY(0px);
            }
        }

        .floating-dish {
            animation: floatImage 6s ease-in-out infinite;
            /* Chu kỳ 6 giây rất chậm rãi */
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.5));
            /* Đổ bóng dưới đĩa tạo độ sâu */
        }

        /* 2. THANH ADMIN BAR TINH GỌN */
        .admin-bar {
            background: #000;
            color: #9ca3af;
            padding: 6px 20px;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
        }

        .admin-bar a {
            color: #fff;
            text-decoration: none;
            margin-left: 15px;
            transition: 0.2s;
        }

        .admin-bar a:hover {
            color: var(--primary);
        }

        /* 3. NAVBAR MATTE (MỜ LÌ) - DỄ ĐỌC HƠN */
        .navbar-dark {
            background: var(--glass-matte) !important;
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .navbar-brand h1 {
            font-size: 2rem;
            color: var(--primary);
            font-weight: 700;
            text-shadow: none;
            /* Bỏ bóng chữ gây lóa */
        }

        .nav-link {
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            color: #e5e7eb !important;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary) !important;
        }

        /* 4. HERO HEADER - TỐI HƠN ĐỂ NỔI BẬT CHỮ */
        .hero-header {
            /* Tăng độ đậm của lớp phủ đen lên 0.9 để ảnh nền tối xuống */
            background: linear-gradient(rgba(10, 15, 30, 0.92), rgba(10, 15, 30, 0.92)),
            url("{{ asset('restaurant/img/bg-hero.jpg') }}");
            background-position: center;
            background-size: cover;
            margin-bottom: 0 !important;
            padding-bottom: 5rem;
        }

        /* 5. NÚT BẤM SANG TRỌNG */
        .btn-primary {
            background-color: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 4px;
            /* Bo góc nhẹ kiểu classic sang trọng */
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
            text-transform: uppercase;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: transparent;
            color: var(--primary);
            box-shadow: 0 0 15px rgba(206, 160, 100, 0.3);
        }

        .btn-outline-light {
            border-radius: 4px;
            padding: 12px 30px;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }

        /* Dropdown User */
        .dropdown-menu {
            background: #fff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="bg-white p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        @if(Auth::check() && Auth::user()->role <= 3) <div class="admin-bar">
            <div>
                <i class="fa fa-circle text-success me-2" style="font-size: 8px;"></i>
                Xin chào, <strong>{{ Auth::user()->name }}</strong>
            </div>
            <div>
                @if(Auth::user()->role == 1)
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer-alt me-1"></i> Dashboard</a>
                @elseif(Auth::user()->role == 2)
                <a href="{{ route('cashier.dashboard') }}"><i class="fa fa-cash-register me-1"></i> Thu Ngân</a>
                @elseif(Auth::user()->role == 3)
                <a href="{{ route('kitchen.dashboard') }}"><i class="fa fa-fire me-1"></i> Bếp</a>
                @endif
            </div>
    </div>
    @endif

    <div class="position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-4 px-lg-5 py-3 py-lg-0 sticky-top">
            <a href="{{ route('home') }}" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-utensils me-3"></i>Ocean Restaurant</h1>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="{{ route('home') }}"
                        class="nav-item nav-link {{ Request::routeIs('home') ? 'active' : '' }}">Trang chủ</a>
                    {{-- Mở comment khi cần --}}
                    {{-- <a href="#" class="nav-item nav-link">Thực đơn</a> --}}
                </div>

                <div class="d-flex align-items-center">
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light me-2 border-0">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Đặt bàn ngay</a>
                    @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle py-2 px-4 text-white" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=cea064&color=fff"
                                class="rounded-circle me-2" width="30" height="30">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu m-0 dropdown-menu-end">
                            @if(Auth::user()->role == 1)
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Quản trị</a>
                            @elseif(Auth::user()->role == 2)
                            <a href="{{ route('cashier.dashboard') }}" class="dropdown-item">Thu ngân</a>
                            @elseif(Auth::user()->role == 3)
                            <a href="{{ route('kitchen.dashboard') }}" class="dropdown-item">Bếp</a>
                            @else
                            <a href="{{ route('customer.dashboard') }}" class="dropdown-item">Lịch sử đơn</a>
                            @endif

                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Hồ sơ</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>

        @if(Request::routeIs('home'))
        <div class="container-fluid py-5 bg-dark hero-header mb-5">
            <div class="container my-5 py-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="display-3 text-white animated slideInLeft">Tinh Hoa <br><span
                                style="color: var(--primary);">Ẩm Thực Á - Âu</span></h1>
                        <p class="text-white animated slideInLeft mb-4 pb-2"
                            style="font-size: 1.1rem; opacity: 0.8; font-weight: 300;">
                            Đánh thức vị giác với thực đơn hơn 200 món ăn thượng hạng. Không gian sang trọng, trải
                            nghiệm đẳng cấp.
                        </p>
                        <a href="#" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Đặt bàn ngay</a>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                        <img class="img-fluid floating-dish" src="{{ asset('restaurant/img/hero.png') }}"
                            alt="Delicious Food">
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container-fluid py-5 bg-dark hero-header mb-5" style="height: 400px;">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">@yield('title')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                class="text-white-50 text-decoration-none">Trang chủ</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>
            </div>
        </div>
        @endif
    </div>


    <main>
        @yield('content')
    </main>


    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s"
        style="border-top: 3px solid var(--primary);">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Ocean Restaurant</h4>
                    <a class="btn btn-link text-white-50" href="#">Về chúng tôi</a>
                    <a class="btn btn-link text-white-50" href="#">Điều khoản</a>
                    <a class="btn btn-link text-white-50" href="#">Chính sách</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Liên hệ</h4>
                    <p class="mb-2 text-white-50"><i class="fa fa-map-marker-alt me-3"></i>Vincom Center, Hà Nội</p>
                    <p class="mb-2 text-white-50"><i class="fa fa-phone-alt me-3"></i>0987.654.321</p>
                    <p class="mb-2 text-white-50"><i class="fa fa-envelope me-3"></i>hanhsociu555@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Giờ mở cửa</h4>
                    <h5 class="text-light fw-normal">Hàng ngày</h5>
                
                    <p class="mb-2 text-white">
                        <i class="fa fa-clock-o me-2"></i><strong>Sáng:</strong> 10h - 13h30
                    </p>
                
                    <p class="mb-2 text-white">
                        <i class="fa fa-clock-o me-2"></i><strong>Chiều:</strong> 17h - 22h
                    </p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Bản tin</h4>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-secondary w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Email" style="background: transparent; color: #fff;">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Gửi</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright border-top border-secondary pt-4">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 text-white-50">
                        &copy; <a class="text-primary" href="#">Ocean Buffet</a>. All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="#" class="text-white-50">Facebook</a>
                            <a href="#" class="text-white-50">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('restaurant/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('restaurant/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('restaurant/js/main.js') }}"></script>
</body>

</html>