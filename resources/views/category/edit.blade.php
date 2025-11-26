
@extends("layouts.master")
@section('title') BikeShop | แก้ไขข้อมูลประเภทสินค้า @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-edit text-primary me-2"></i>
                แก้ไขข้อมูลประเภทสินค้า
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('category') }}" class="text-decoration-none">
                            <i class="fas fa-tags me-1"></i>ประเภทสินค้า
                        </a>
                    </li>
                    <li class="breadcrumb-item active">แก้ไขข้อมูลประเภทสินค้า</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ url('/category/update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="{{ $category->id }}">
        @csrf

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

        <!-- Main Form -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-custom border-0 mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>ข้อมูลประเภทสินค้า
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="fas fa-tag me-1 text-primary"></i>ชื่อประเภทสินค้า
                                    <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    class="form-control form-control-lg" 
                                    placeholder="ป้อนชื่อประเภทสินค้า" 
                                    value="{{ old('name', $category->name) }}"
                                    required>
                                <div class="invalid-feedback">กรุณาป้อนชื่อประเภทสินค้า</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-custom border-0 mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <button type="button" onclick="location.href='/category'" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>ยกเลิก
                            </button>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save me-2"></i>บันทึกข้อมูล
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
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