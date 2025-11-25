@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow-custom-lg border-0 rounded-lg">
                <div class="card-header text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-bicycle text-primary fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-0">เข้าสู่ระบบ</h3>
                    <p class="text-muted mb-0">ยินดีต้อนรับสู่ BikeShop ระบบสำหรับจัดการร้านค้าของคุณ</p>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}" class="fade-in-up">
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
                                   required autofocus>
                            @error('name')
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
                                   required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    จำฉันไว้ในระบบ
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                            </button>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none text-muted" href="{{ route('password.request') }}">
                                    <i class="fas fa-key me-1"></i>ลืมรหัสผ่าน?
                                </a>
                            @endif
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0 text-muted">ยังไม่มีบัญชี?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm rounded-pill mt-2">
                                <i class="fas fa-user-plus me-2"></i>สมัครสมาชิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
