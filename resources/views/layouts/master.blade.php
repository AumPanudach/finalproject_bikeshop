<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BikeShop | Premium Bicycle Parts & Accessories')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <i class="fas fa-bicycle text-primary me-2"></i>
                <span class="text-gradient">BikeShop</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('home') }}">
                            <i class="fas fa-home me-1"></i>หน้าแรก
                        </a>
                    </li>
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('product') }}">
                                <i class="fas fa-box me-1"></i>ข้อมูลสินค้า
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('category') }}">
                                <i class="fas fa-tags me-1"></i>ประเภทสินค้า
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('user') }}">
                                <i class="fas fa-users me-1"></i>ข้อมูลผู้ใช้
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('order') }}">
                                <i class="fas fa-shopping-cart me-1"></i>การสั่งซื้อ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-1"></i>รายงาน
                            </a>
                        </li>
                    @endguest
                </ul>

                <ul class="navbar-nav">
                    @if (Session::has('cart_items'))
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ URL::to('/cart/view') }}">
                                <i class="fas fa-shopping-cart"></i> ตะกร้า
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count(Session::get('cart_items')) }}
                                </span>
                            </a>
                        </li>
                    @endif

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>ล็อกอิน
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>ลงทะเบียน
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>โปรไฟล์</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                                </a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid px-4">
            @yield('content')
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-bicycle text-primary me-2"></i>BikeShop</h5>
                    <p class="mb-0">ร้านจำหน่ายอะไหล่และอุปกรณ์จักรยานคุณภาพสูง</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; 2025 BikeShop. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    @if (session('msg'))
        @if (session('ok'))
            <script>
                toastr.success("{{ session('msg') }}")
            </script>
        @else
            <script>
                toastr.error("{{ session('msg') }}")
            </script>
        @endif
    @endif

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
