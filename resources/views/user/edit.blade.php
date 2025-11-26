@extends("layouts.master")
@section('title') BikeShop | แก้ไขผู้ใช้ @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-user-edit text-primary me-2"></i>
                แก้ไขผู้ใช้
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('user') }}" class="text-decoration-none">
                            <i class="fas fa-users me-1"></i>ข้อมูลผู้ใช้
                        </a>
                    </li>
                    <li class="breadcrumb-item active">แก้ไขผู้ใช้</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ url('/user/update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="{{ $user->id }}">
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
                            <i class="fas fa-info-circle me-2"></i>ข้อมูลผู้ใช้
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="fas fa-user me-1 text-primary"></i>ชื่อผู้ใช้
                                    <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    class="form-control form-control-lg" 
                                    placeholder="ป้อนชื่อผู้ใช้" 
                                    value="{{ old('name', $user->name) }}"
                                    required>
                                <div class="invalid-feedback">กรุณาป้อนชื่อผู้ใช้</div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-1 text-primary"></i>อีเมล
                                    <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    class="form-control form-control-lg" 
                                    placeholder="ป้อนอีเมล เช่น example@email.com" 
                                    value="{{ old('email', $user->email) }}"
                                    required>
                                <div class="invalid-feedback">กรุณาป้อนอีเมลที่ถูกต้อง</div>
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
                            <button type="button" onclick="location.href='/user'" class="btn btn-outline-secondary btn-lg">
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