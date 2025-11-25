@extends('layouts.master')
@section('title') BikeShop | ชำระเงิน @stop
@section('content')
<div class="container-xl py-4">
    <!-- Page Header -->
    <div class="page-header mb-4">
        <h1 class="mb-2">
            <i class="fas fa-credit-card text-primary me-2"></i>ชำระเงิน
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ URL::to('home') }}"><i class="fas fa-home me-1"></i>หน้าร้าน</a></li>
                <li class="breadcrumb-item"><a href="{{ URL::to('cart/view') }}">สินค้าในตะกร้า</a></li>
                <li class="breadcrumb-item active">ชำระเงิน</li>
            </ol>
        </nav>
    </div>

    <div class="row g-4">
        <!-- Order Summary -->
        <div class="col-lg-7">
            <div class="card app-card shadow-sm border-0 mb-4">
                <div class="card-header">
                    <i class="fas fa-box me-2 text-primary"></i>รายการสินค้า
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">รูปสินค้า</th>
                                    <th style="width: 120px;">รหัส</th>
                                    <th>ชื่อสินค้า</th>
                                    <th class="text-center" style="width: 100px;">จำนวน</th>
                                    <th class="text-end" style="width: 120px;">ราคา/ชิ้น</th>
                                    <th class="text-end" style="width: 140px;">รวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sum_price = 0;
                                    $sum_qty = 0;
                                    foreach($cart_items as $item) {
                                        $sum_price += $item['price'] * $item['qty'];
                                        $sum_qty += $item['qty'];
                                    }
                                ?>
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
                                        <td class="text-center">{{ number_format($c['qty'], 0) }}</td>
                                        <td class="text-end text-muted">฿{{ number_format($c['price'], 2) }}</td>
                                        <td class="text-end fw-semibold text-primary">฿{{ number_format($item_total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <th colspan="3" class="text-end">รวมทั้งหมด</th>
                                    <th class="text-center">{{ number_format($sum_qty, 0) }} ชิ้น</th>
                                    <th colspan="2" class="text-end text-primary fw-bold fs-5">
                                        ฿{{ number_format($sum_price, 2) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="col-lg-5">
            <div class="card app-card shadow-sm border-0">
                <div class="card-header">
                    <i class="fas fa-user me-2 text-primary"></i>ข้อมูลลูกค้า
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="cust_name" 
                               value="{{ Auth::user()->name }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">อีเมล</label>
                        <input type="email" class="form-control" id="cust_email" 
                               value="{{ Auth::user()->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            ที่อยู่จัดส่ง <span class="text-danger">*</span>
                        </label>
                        <div class="row g-2">
                            <div class="col-12">
                                <input type="text" class="form-control" id="cust_address_no" 
                                       placeholder="บ้านเลขที่ / อาคาร" required>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" id="cust_address_road" 
                                       placeholder="ถนน" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cust_address_subdistrict" 
                                       placeholder="ตำบล / แขวง" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cust_address_district" 
                                       placeholder="อำเภอ / เขต" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cust_address_province" 
                                       placeholder="จังหวัด" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cust_address_postcode" 
                                       placeholder="รหัสไปรษณีย์" maxlength="5" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            เบอร์โทรศัพท์ <span class="text-danger">*</span>
                        </label>
                        <input type="tel" class="form-control" id="cust_phone" 
                               placeholder="0XX-XXX-XXXX" maxlength="10" required>
                    </div>

                    <div class="alert alert-info d-flex align-items-start gap-2 mb-0">
                        <i class="fas fa-info-circle mt-1"></i>
                        <small>กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนทำการสั่งซื้อ</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex flex-column flex-md-row gap-3 justify-content-between mt-4">
        <a href="{{ URL::to('cart/view') }}" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-arrow-left me-2"></i>ย้อนกลับ
        </a>
        <div class="d-flex gap-2">
            <button onclick="complete()" class="btn btn-warning btn-lg">
                <i class="fas fa-print me-2"></i>พิมพ์ใบสั่งซื้อ
            </button>
            <button onclick="AddToOrder()" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-check me-2"></i>ยืนยันการสั่งซื้อ
            </button>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
function validateForm() {
    const addressNo = $('#cust_address_no').val().trim();
    const addressRoad = $('#cust_address_road').val().trim();
    const addressSubdistrict = $('#cust_address_subdistrict').val().trim();
    const addressDistrict = $('#cust_address_district').val().trim();
    const addressProvince = $('#cust_address_province').val().trim();
    const addressPostcode = $('#cust_address_postcode').val().trim();
    const phone = $('#cust_phone').val().trim();
    
    if (!addressNo) {
        toastr.error('กรุณากรอกบ้านเลขที่ / อาคาร');
        $('#cust_address_no').focus();
        return false;
    }
    
    if (!addressRoad) {
        toastr.error('กรุณากรอกถนน');
        $('#cust_address_road').focus();
        return false;
    }
    
    if (!addressSubdistrict) {
        toastr.error('กรุณากรอกตำบล / แขวง');
        $('#cust_address_subdistrict').focus();
        return false;
    }
    
    if (!addressDistrict) {
        toastr.error('กรุณากรอกอำเภอ / เขต');
        $('#cust_address_district').focus();
        return false;
    }
    
    if (!addressProvince) {
        toastr.error('กรุณากรอกจังหวัด');
        $('#cust_address_province').focus();
        return false;
    }
    
    if (!addressPostcode) {
        toastr.error('กรุณากรอกรหัสไปรษณีย์');
        $('#cust_address_postcode').focus();
        return false;
    }
    
    if (addressPostcode.length !== 5 || !/^\d+$/.test(addressPostcode)) {
        toastr.error('กรุณากรอกรหัสไปรษณีย์ 5 หลัก');
        $('#cust_address_postcode').focus();
        return false;
    }
    
    if (!phone) {
        toastr.error('กรุณากรอกเบอร์โทรศัพท์');
        $('#cust_phone').focus();
        return false;
    }
    
    if (phone.length < 9 || !/^\d+$/.test(phone)) {
        toastr.error('กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง (ตัวเลข 9-10 หลัก)');
        $('#cust_phone').focus();
        return false;
    }
    
    return true;
}

function complete() {
    if (!validateForm()) return;
    
    const params = new URLSearchParams({
        cust_name: $('#cust_name').val(),
        cust_email: $('#cust_email').val(),
        cust_address_no: $('#cust_address_no').val(),
        cust_address_road: $('#cust_address_road').val(),
        cust_address_subdistrict: $('#cust_address_subdistrict').val(),
        cust_address_district: $('#cust_address_district').val(),
        cust_address_province: $('#cust_address_province').val(),
        cust_address_postcode: $('#cust_address_postcode').val(),
        cust_phone: $('#cust_phone').val()
    });
    
    window.open("{{ URL::to('cart/complete') }}?" + params.toString(), "_blank");
}

function AddToOrder() {
    if (!validateForm()) return;
    
    const params = new URLSearchParams({
        cust_name: $('#cust_name').val(),
        cust_email: $('#cust_email').val(),
        cust_address_no: $('#cust_address_no').val(),
        cust_address_road: $('#cust_address_road').val(),
        cust_address_subdistrict: $('#cust_address_subdistrict').val(),
        cust_address_district: $('#cust_address_district').val(),
        cust_address_province: $('#cust_address_province').val(),
        cust_address_postcode: $('#cust_address_postcode').val(),
        cust_phone: $('#cust_phone').val()
    });
    
    window.location.href = "{{ URL::to('cart/addtoorder') }}?" + params.toString();
}
</script>
@endpush
