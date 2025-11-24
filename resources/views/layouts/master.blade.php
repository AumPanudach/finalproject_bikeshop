<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BikeShop | Premium Bicycle Parts & Accessories')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
    
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
</head>

<body class="app-body">
    <nav class="navbar navbar-expand-lg navbar-light app-navbar fixed-top shadow-sm">
        <div class="container-xl">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <span class="brand-icon me-2">
                    <i class="fas fa-bicycle"></i>
                </span>
                BikeShop
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

                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @if (Session::has('cart_items'))
                        <li class="nav-item">
                            <a class="nav-link cart-link" href="{{ URL::to('/cart/view') }}">
                                <i class="fas fa-shopping-cart me-1"></i>ตะกร้า
                                <span class="cart-count">
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
                                <i class="fas fa-circle-user me-2"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li>
                                    <span class="dropdown-item-text small text-muted">{{ Auth::user()->email }}</span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
                                            <i class="fas fa-arrow-right-from-bracket"></i>
                                            ออกจากระบบ
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="app-main">
        @yield('content')
    </main>


    <footer class="app-footer">
        <div class="container-xl d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div>
                <span class="fw-semibold text-dark">BikeShop</span>
                <span class="text-muted ms-2">Premium Bicycle Store</span>
            </div>
            <div class="text-muted small">
                &copy; {{ now()->year }} BikeShop. All rights reserved.
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
