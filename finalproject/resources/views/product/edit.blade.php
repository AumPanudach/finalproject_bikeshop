
@extends("layouts.master")
@section('title') BikeShop | {{ isset($product) ? 'แก้ไขข้อมูลสินค้า' : 'เพิ่มสินค้าใหม่' }} @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-{{ isset($product) ? 'edit' : 'plus' }} text-primary me-2"></i>
                {{ isset($product) ? 'แก้ไขสินค้า' : 'เพิ่มสินค้าใหม่' }}
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('product') }}" class="text-decoration-none">
                            <i class="fas fa-box me-1"></i>จัดการสินค้า
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ isset($product) ? 'แก้ไขสินค้า' : 'เพิ่มสินค้าใหม่' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {!! Form::model($product ?? null, array(
        'action' => 'App\Http\Controllers\ProductController@update',
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'class' => 'needs-validation',
        'novalidate' => true
    )) !!}
    
    @if(isset($product))
        <input type="hidden" name="id" value="{{ $product->id }}">
    @endif

    <!-- Error Alert -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">
            <i class="fas fa-exclamation-triangle me-2"></i>พบข้อผิดพลาด!
        </h6>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card shadow-custom border-0 mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>ข้อมูลสินค้า
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label fw-semibold">
                                <i class="fas fa-barcode me-1 text-primary"></i>รหัสสินค้า
                                <span class="text-danger">*</span>
                            </label>
                            {{ Form::text('code', null, [
                                'class' => 'form-control form-control-lg',
                                'id' => 'code',
                                'placeholder' => 'ป้อนรหัสสินค้า เช่น P001',
                                'required' => true
                            ]) }}
                            <div class="invalid-feedback">กรุณาป้อนรหัสสินค้า</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label fw-semibold">
                                <i class="fas fa-tags me-1 text-primary"></i>ประเภทสินค้า
                                <span class="text-danger">*</span>
                            </label>
                            {{ Form::select('category_id', $categories, null, [
                                'class' => 'form-select form-select-lg',
                                'id' => 'category_id',
                                'required' => true,
                                'placeholder' => 'เลือกประเภทสินค้า'
                            ]) }}
                            <div class="invalid-feedback">กรุณาเลือกประเภทสินค้า</div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-tag me-1 text-primary"></i>ชื่อสินค้า
                                <span class="text-danger">*</span>
                            </label>
                            {{ Form::text('name', null, [
                                'class' => 'form-control form-control-lg',
                                'id' => 'name',
                                'placeholder' => 'ป้อนชื่อสินค้า',
                                'required' => true
                            ]) }}
                            <div class="invalid-feedback">กรุณาป้อนชื่อสินค้า</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock_qty" class="form-label fw-semibold">
                                <i class="fas fa-cubes me-1 text-primary"></i>จำนวนคงเหลือ
                                <span class="text-danger">*</span>
                            </label>
                            {{ Form::number('stock_qty', null, [
                                'class' => 'form-control form-control-lg',
                                'id' => 'stock_qty',
                                'placeholder' => '0',
                                'min' => '0',
                                'required' => true
                            ]) }}
                            <div class="invalid-feedback">กรุณาป้อนจำนวนคงเหลือ</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-semibold">
                                <i class="fas fa-dollar-sign me-1 text-primary"></i>ราคาขายต่อหน่วย (บาท)
                                <span class="text-danger">*</span>
                            </label>
                            {{ Form::number('price', null, [
                                'class' => 'form-control form-control-lg',
                                'id' => 'price',
                                'placeholder' => '0.00',
                                'step' => '0.01',
                                'min' => '0',
                                'required' => true
                            ]) }}
                            <div class="invalid-feedback">กรุณาป้อนราคาขาย</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Upload Section -->
        <div class="col-lg-4">
            <div class="card shadow-custom border-0">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-image me-2"></i>รูปภาพสินค้า
                    </h5>
                </div>
                <div class="card-body text-center">
                    @if(isset($product) && $product->image_url)
                        <div class="current-image mb-3">
                            <img src="{{ URL::to($product->image_url) }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 200px;"
                                 alt="รูปสินค้าปัจจุบัน">
                            <p class="text-muted mt-2 mb-0">รูปภาพปัจจุบัน</p>
                        </div>
                    @else
                        <div class="no-image mb-3 p-4 bg-light rounded">
                            <i class="fas fa-image fs-1 text-muted mb-2"></i>
                            <p class="text-muted mb-0">ยังไม่มีรูปภาพ</p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">
                            เลือกรูปภาพใหม่
                        </label>
                        {{ Form::file('image', [
                            'class' => 'form-control',
                            'id' => 'image',
                            'accept' => 'image/*',
                            'onchange' => 'previewImage(this)'
                        ]) }}
                        <small class="text-muted">รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 2MB</small>
                    </div>

                    <div id="preview-container" style="display: none;">
                        <img id="preview-image" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                        <p class="text-muted mt-2 mb-0">ตัวอย่างรูปภาพใหม่</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="card shadow-custom border-0 mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <button type="button" onclick="location.href='/product'" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-times me-2"></i>ยกเลิก
                </button>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-save me-2"></i>บันทึกข้อมูล
                </button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview-image');
    const container = document.getElementById('preview-container');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        container.style.display = 'none';
    }
}

// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

@endsection