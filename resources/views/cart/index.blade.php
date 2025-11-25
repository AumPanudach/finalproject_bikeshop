@extends('layouts.master')
@section('title', 'BikeShop | ตะกร้าสินค้า')

@section('content')
<div class="container-xl py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item">
                <a href="{{ URL::to('home') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>หน้าแรก
                </a>
            </li>
            <li class="breadcrumb-item active">ตะกร้าสินค้า</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="page-title">
            <i class="fas fa-shopping-cart me-3"></i>สินค้าในตะกร้า
        </h1>
    </div>

    @if(count($cart_items))
        <?php 
            // Calculate totals once
            $sum_price = 0;
            $sum_qty = 0;
            foreach($cart_items as $item) {
                $sum_price += $item['price'] * $item['qty'];
                $sum_qty += $item['qty'];
            }
        ?>
        
        <!-- Cart Items Card -->
        <div class="card app-card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <!-- Desktop Table View -->
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">รูปสินค้า</th>
                                <th style="width: 120px;">รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th style="width: 120px;" class="text-end">ราคา/ชิ้น</th>
                                <th style="width: 140px;" class="text-center">จำนวน</th>
                                <th style="width: 140px;" class="text-end">ราคารวม</th>
                                <th style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart_items as $c)
                                <?php $item_total = $c['price'] * $c['qty']; ?>
                                <tr>
                                    <td>
                                        <img src="{{ asset($c['image_url']) }}" 
                                             alt="{{ $c['name'] }}" 
                                             class="rounded" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td class="text-muted">{{ $c['code'] }}</td>
                                    <td class="fw-medium">{{ $c['name'] }}</td>
                                    <td class="text-end text-muted">฿{{ number_format($c['price'], 2) }}</td>
                                    <td>
                                        <input type="number" 
                                               class="form-control text-center" 
                                               value="{{ $c['qty'] }}" 
                                               min="1"
                                               max="999"
                                               onKeyUp="updateCart({{ $c['id'] }}, this)"
                                               onChange="updateCart({{ $c['id'] }}, this)"
                                               style="max-width: 100px; margin: 0 auto;">
                                    </td>
                                    <td class="text-end fw-bold text-primary">฿{{ number_format($item_total, 2) }}</td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('cart/delete/'.$c['id']) }}" 
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('ต้องการลบสินค้านี้ออกจากตะกร้า?')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">รวมทั้งหมด:</td>
                                <td class="text-center text-primary">{{ number_format($sum_qty, 0) }} ชิ้น</td>
                                <td class="text-end text-primary fs-5">฿{{ number_format($sum_price, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="d-lg-none p-3">
                    @foreach($cart_items as $c)
                        <?php $item_total = $c['price'] * $c['qty']; ?>
                        <div class="card mb-3 border">
                            <div class="card-body">
                                <div class="d-flex gap-3 mb-3">
                                    <img src="{{ asset($c['image_url']) }}" 
                                         alt="{{ $c['name'] }}" 
                                         class="rounded" 
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">{{ $c['name'] }}</h6>
                                        <small class="text-muted d-block">รหัส: {{ $c['code'] }}</small>
                                        <small class="text-muted d-block mb-2">฿{{ number_format($c['price'], 2) }} / ชิ้น</small>
                                        <div class="text-primary fw-bold fs-5">฿{{ number_format($item_total, 2) }}</div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="input-group" style="max-width: 140px;">
                                        <input type="number" 
                                               class="form-control form-control-sm text-center" 
                                               value="{{ $c['qty'] }}" 
                                               min="1"
                                               max="999"
                                               onKeyUp="updateCart({{ $c['id'] }}, this)"
                                               onChange="updateCart({{ $c['id'] }}, this)">
                                        <span class="input-group-text">ชิ้น</span>
                                    </div>
                                    <a href="{{ URL::to('cart/delete/'.$c['id']) }}" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('ต้องการลบสินค้านี้ออกจากตะกร้า?')">
                                        <i class="fas fa-trash-alt me-1"></i>ลบ
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Mobile Total -->
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">จำนวนสินค้า:</span>
                                <span class="fw-semibold">{{ number_format($sum_qty, 0) }} ชิ้น</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">รวมทั้งหมด:</span>
                                <span class="text-primary fw-bold fs-5">฿{{ number_format($sum_price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Card (Desktop) -->
        <div class="card app-card shadow-sm border-0 mb-4 d-none d-lg-block">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-box-open text-primary fs-3"></i>
                            <div>
                                <div class="text-muted small">จำนวนสินค้าทั้งหมด</div>
                                <div class="fw-bold fs-5">{{ number_format($sum_qty, 0) }} ชิ้น</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="text-muted small mb-1">ยอดรวมทั้งสิ้น</div>
                        <div class="text-primary fw-bold" style="font-size: 2rem;">
                            ฿{{ number_format($sum_price, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
            <a href="{{ URL::to('/home') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>ย้อนกลับ
            </a>
            <a href="{{ URL::to('cart/checkout') }}" class="btn btn-primary btn-lg px-5">
                ดำเนินการชำระเงิน<i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

    @else
        <!-- Empty Cart State -->
        <div class="card app-card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-shopping-cart text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h4 class="text-muted mb-3">ตะกร้าสินค้าว่างเปล่า</h4>
                    <p class="text-muted mb-4">คุณยังไม่มีสินค้าในตะกร้า กรุณาเลือกสินค้าจากหน้าร้าน</p>
                    <a href="{{ URL::to('/home') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-store me-2"></i>เลือกซื้อสินค้า
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
function updateCart(id, qty) {
    const value = parseInt(qty.value);
    
    // Validate input
    if (isNaN(value) || value < 1) {
        qty.value = 1;
        return;
    }
    
    if (value > 999) {
        qty.value = 999;
        return;
    }
    
    // Show loading state
    qty.disabled = true;
    
    // Update cart
    window.location.href = '/cart/update/' + id + '/' + value;
}

// Format number on input
document.addEventListener('DOMContentLoaded', function() {
    const qtyInputs = document.querySelectorAll('input[type="number"]');
    qtyInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value === '' || parseInt(this.value) < 1) {
                this.value = 1;
            }
        });
    });
});
</script>
@endpush
@endsection
