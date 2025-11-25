@extends('layouts.master')
@section('title') BikeShop | รายละเอียดคำสั่งซื้อ@stop
@section('content')
<div class="container-fluid px-4">
    <div class="page-header">
        <h1 class="mb-2">
            <i class="fas fa-receipt text-primary me-2"></i>รายละเอียดคำสั่งซื้อ
    </h1>
        <p class="text-muted mb-0">
            หมายเลขคำสั่งซื้อ #{{ $orderdetail->serial_po }}
        </p>
    </div>

    <div class="row g-4">
        <div class="col-xl-5">
            <div class="card shadow-custom border-0 h-100">
                <div class="card-header">
                    <i class="fas fa-user me-2 text-primary"></i>ข้อมูลลูกค้า
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5 text-muted">ชื่อลูกค้า</dt>
                        <dd class="col-sm-7 fw-semibold">{{ $orderdetail->order_name }}</dd>

                        <dt class="col-sm-5 text-muted">อีเมล</dt>
                        <dd class="col-sm-7">{{ $orderdetail->order_email }}</dd>

                        <dt class="col-sm-5 text-muted">วันที่สั่งซื้อ</dt>
                        <dd class="col-sm-7">
                            {{ \Carbon\Carbon::parse($orderdetail->created_at)->format('d/m/Y H:i') }}
                        </dd>

                        <dt class="col-sm-5 text-muted">สถานะการชำระเงิน</dt>
                        <dd class="col-sm-7">
                            @if ($orderdetail->status === 1)
                                <span class="status-chip status-chip--paid">
                                    <i class="fas fa-check-circle me-1"></i>ชำระแล้ว
                                </span>
                            @else
                                <span class="status-chip status-chip--pending">
                                    <i class="fas fa-clock me-1"></i>ยังไม่ชำระเงิน
                                </span>
                    @endif
                        </dd>
                    </dl>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ URL::to('orderdetail/edit1/'.$orderdetail->id)}}" class="btn btn-success flex-fill">
                            <i class="fas fa-check me-1"></i>ยืนยันชำระเงิน
                        </a>
                        <a href="{{ URL::to('orderdetail/edit2/'.$orderdetail->id)}}" class="btn btn-outline-secondary flex-fill">
                            <i class="fas fa-rotate-left me-1"></i>ตั้งเป็นยังไม่ชำระ
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="card shadow-custom border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-box me-2 text-primary"></i>
                        รายการสินค้า
                    </div>
                    <span class="badge bg-primary rounded-pill">
                        {{ count($orderdetail->detail) }} รายการ
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
        <thead>
            <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>สินค้า</th>
                                    <th class="text-end" style="width: 140px;">ราคาต่อหน่วย</th>
                                    <th class="text-center" style="width: 100px;">จำนวน</th>
                                    <th class="text-end" style="width: 140px;">รวมเงิน</th>
            </tr>
        </thead>
        <tbody>
                                @php $sum_price = 0; @endphp
                                @foreach ($orderdetail->detail as $item)
                                    @php
                                        $line = $item->price * $item->qty;
                                        $sum_price += $line;
                                    @endphp
            <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">{{ $item->product_name }}</td>
                                        <td class="text-end">{{ number_format($item->price, 2) }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-end fw-bold">{{ number_format($line, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
            <tfoot>
                                <tr class="bg-light">
                                    <th colspan="4" class="text-end">รวมเงินทั้งหมด</th>
                                    <th class="text-end text-primary fw-bold">
                                        {{ number_format($sum_price, 2) }} บาท
                                    </th>
                </tr>
            </tfoot>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        @endsection
