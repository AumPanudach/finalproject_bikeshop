@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-custom-lg border-0 rounded-lg">
                <div class="card-header text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-user-plus text-primary fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-0">สมัครสมาชิก</h3>
                    <p class="text-muted mb-0">เริ่มต้นการช็อปปิ้งกับ BikeShop</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}" class="fade-in-up">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2 text-primary"></i>ชื่อผู้ใช้
                            </label>
                            <input id="name" type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="กรอกชื่อผู้ใช้"
                                   required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2 text-primary"></i>อีเมล
                            </label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="กรอกอีเมล"
                                   required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2 text-primary"></i>รหัสผ่าน
                            </label>
                            <input id="password" type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="กรอกรหัสผ่าน"
                                   required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="form-label">
                                <i class="fas fa-lock me-2 text-primary"></i>ยืนยันรหัสผ่าน
                            </label>
                            <input id="password-confirm" type="password" 
                                   class="form-control form-control-lg" 
                                   name="password_confirmation" 
                                   placeholder="ยืนยันรหัสผ่าน"
                                   required autocomplete="new-password">
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                <i class="fas fa-user-plus me-2"></i>สมัครสมาชิก
                            </button>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0 text-muted">มีบัญชีอยู่แล้ว?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill mt-2">
                                <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
