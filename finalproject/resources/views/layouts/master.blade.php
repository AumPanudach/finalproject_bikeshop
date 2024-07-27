<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BikeShop | จำหน่ายอะไหล่จักรยานออนไลน์')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
</head>

<body>
    <div class="container">

        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li> @guest
                    @else
                        <li><a href="{{ URL::to('product') }}">ข้อมูลสินค้า</a></li>
                        <li><a href="{{ URL::to('category') }}">ข้อมูลประเภทสินค้า</a></li>
                        <li><a href="{{ URL::to('user') }}">ข้อมูลผู้ใช้</a></li>
                    
                    <li><a href="{{ URL::to('order') }}">แสดงการสั่งซื้อสินค้า</a></li>
                    
                    <li><a href="#">รายงาน</a></li>
                     @endguest
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    {{-- {{ URL::to('/cart/view') }} --}}
                    
                    
                             @if (Session::has('cart_items'))
                            <li><a href="{{ URL::to('/cart/view') }}"><i class="fa fa-shopping-cart"></i> ตะกร้า 
                             <span class="label label-danger">
                             {!! count(Session::get('cart_items')) !!}
                            </span></a></li>
                            @else
                             <?php  count([])  ?>
                          @endif


                    @guest
                        <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                        <li><a href="{{ route('register') }}">ลงทะเบียน</a></li>
                    @else
                        <li><a href="{{ route('logout') }}">{{ Auth::user()->name }} </a></li>
                    <li><a href="{{ route('logout') }}">ออกจากระบบ </a></li> @endguest

                </ul>


            </div>





            </ul>
            </a>
            @yield('content')


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


            {{-- 
<script>
toastr.success("บันทึกข้อมูลสำเร็จ");
</script> --}}

            <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
