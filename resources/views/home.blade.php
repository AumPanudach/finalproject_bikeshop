
@extends("layouts.master")

@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดแข่ง และอุปกรณ์ตกแต่ง @endsection

@section('content')
<!-- Hero Section -->
<div class="hero-section bg-gradient-primary text-white py-5 mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4 fade-in-up">
                    <i class="fas fa-bicycle me-3"></i>
                    ยินดีต้อนรับสู่ BikeShop
                </h1>
                <p class="lead mb-4 fade-in-up">
                    ร้านจำหน่ายอุปกรณ์จักรยาน อะไหล่ และอุปกรณ์ตกแต่งคุณภาพสูง 
                    พร้อมให้บริการด้วยใจและประสบการณ์มากกว่า 10 ปี
                </p>
                @guest
                    <div class="fade-in-up">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill me-3">
                            <i class="fas fa-user-plus me-2"></i>เริ่มต้นช็อปปิ้ง
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg rounded-pill">
                            <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                        </a>
                    </div>
                @else
                    <div class="fade-in-up">
                        <h4 class="mb-0">สวัสดีคุณ {{ Auth::user()->name }}!</h4>
                        <p class="mb-0">พร้อมช็อปปิ้งแล้วใช่มั้ย?</p>
                    </div>
                @endguest
            </div>
            <div class="col-lg-4 text-center">
                <i class="fas fa-bicycle display-1 text-white-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Products Section -->
<div class="container-fluid px-4" ng-app="app" ng-controller="ctrl">
    <div class="row">
        <!-- Sidebar Categories -->
        <div class="col-lg-3 col-md-4 mb-4" style="margin-top: 30px;">
            <div class="card shadow-custom border-0 sticky-top" style="top: 120px;">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>หมวดหมู่สินค้า
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3"
                           ng-class="{'active bg-primary text-white': category == null}" 
                           ng-click="getProductList(null)">
                            <i class="fas fa-th-large me-2"></i>ทั้งหมด
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0 py-3" 
                           ng-repeat="c in categories"
                           ng-click="getProductList(c)" 
                           ng-class="{'active bg-primary text-white': category && category.id == c.id}">
                            <i class="fas fa-tag me-2"></i>@{c.name}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 col-md-8">
            <!-- Search Bar -->
            <div class="card shadow-custom border-0 mb-4" style="margin-top: 30px;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-shopping-bag me-2 text-primary"></i>สินค้าในร้าน
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" 
                                       ng-model="query"
                                       ng-keyup="searchProduct($event)" 
                                       placeholder="ค้นหาสินค้าที่ต้องการ...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- No Products Message -->
            <div ng-if="!products.length" class="text-center py-5">
                <i class="fas fa-box-open display-1 text-muted mb-4"></i>
                <h3 class="text-muted">ไม่พบข้อมูลสินค้า</h3>
                <p class="text-muted">ลองค้นหาด้วยคำค้นอื่น หรือเลือกหมวดหมู่อื่น</p>
            </div>

            <!-- Products Grid -->
            <div class="row" ng-if="products.length">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4" ng-repeat="p in products">
                    <div class="bs-product-card d-flex flex-column h-100">
                        <div class="product-image-container">
                            <img ng-src="@{p.image_url}" class="img-fluid" alt="@{p.name}">
                        </div>
                        
                        <h5 class="product-title">@{p.name}</h5>
                        
                        <div class="product-details mb-3 flex-grow-1">
                            <div class="stock-info">
                                <i class="fas fa-box me-1 text-muted"></i>
                                <small class="text-muted">คงเหลือ: @{p.stock_qty} ชิ้น</small>
                            </div>
                            <div class="price text-success fw-bold fs-5">
                                @{p.price | number:0} บาท
                            </div>
                        </div>
                        
                        <div class="mt-auto">
                            @guest 
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-pill w-100">
                                    <i class="fas fa-sign-in-alt me-1"></i>เข้าสู่ระบบเพื่อซื้อ
                                </a>
                            @else  
                                <button class="btn btn-success rounded-pill w-100" ng-click="addToCart(p)" >
                                    <i class="fas fa-shopping-cart me-2"></i>หยิบใส่ตะกร้า
                                </button>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var app = angular.module('app', []).config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('@{').endSymbol('}');
});

app.controller('ctrl', function ($scope, productService) {
    $scope.products = [];
    $scope.category = null;
    
    $scope.getProductList = function (category) {
        $scope.category = category;
        category_id = category != null ? category.id : '';  
        productService.getProductList(category_id).then(function (res) {
            if (!res.data.ok) return;
            $scope.products = res.data.products; 
        });
    };
    $scope.getProductList();

    $scope.categories = [];
    $scope.getCategoryList = function () {
        productService.getCategoryList().then(function (res) {
            if(!res.data.ok) return;
            $scope.categories = res.data.categories;
        });
    };
    $scope.getCategoryList();

    $scope.searchProduct = function (e) {
        if (!$scope.query || $scope.query.trim() === '') {
            $scope.getProductList($scope.category);
            return;
        }
        productService.searchProduct($scope.query).then(function (res) {
            if(!res.data.ok) return;
            $scope.products = res.data.products;
        });
    };

    $scope.addToCart = function (p) {
        window.location.href = '/cart/add/' + p.id;
    };
});

app.service('productService', function($http) {
    this.getProductList = function (category_id) {
        if(category_id) {
            return $http.get('/api/product/' + category_id);
        }
        return $http.get('/api/product');
    };

    this.getCategoryList = function () {
        return $http.get('/api/category');
    };

    this.searchProduct = function (query) {
        return $http({
            url: '/api/product/search', 
            method: 'post',
            data: {'query' : query}
        });
    };
});
</script>

<style>
.hero-section {
    margin-top: -2rem;
    margin-bottom: 0 !important;
}

.product-image-container {
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
    overflow: hidden;
}

.product-image-container img {
    max-height: 100%;
    width: auto;
    transition: transform 0.3s ease;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 1rem;
    height: 3em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-details {
    text-align: left;
    margin-bottom: 1.5rem;
}

.stock-info {
    margin-bottom: 0.75rem;
}

.bs-product-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 2.5rem;
    min-height: 420px;
    text-align: center;
    position: relative;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.list-group-item {
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: rgba(0, 123, 255, 0.1);
    border-color: var(--primary-color);
}

.list-group-item.active {
    border-color: var(--primary-color) !important;
}
</style>
@endsection
