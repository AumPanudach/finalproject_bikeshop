@extends('layouts.master')
@section('title') BikeShop | แสดงการสั่งซื้อสินค้า @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-shopping-cart text-primary me-2"></i>จัดการคำสั่งซื้อ
            </h1>
            <p class="text-muted mb-0">แสดงรายการคำสั่งซื้อทั้งหมดในระบบ</p>
        </div>
    </div>

    <!-- Orders Table Card -->
    <div class="card shadow-custom border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>รายการคำสั่งซื้อ
            </h5>
            <span class="badge bg-primary rounded-pill">{{ count($order) }} รายการ</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0 align-middle">
                    <thead>
                        <tr>
                            <th style="width: 80px;">OrderID</th>
                            <th style="width: 150px;">เลขที่ใบสั่งซื้อ</th>
                            <th>ชื่อลูกค้า</th>
                            <th style="width: 180px;">วันที่สั่งซื้อสินค้า</th>
                            <th class="text-center" style="width: 120px;">รายละเอียด</th>
                            <th class="text-center" style="width: 160px;">สถานะการชำระเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $p)
                        <tr>
                            <td>
                                <code class="bg-light text-dark p-1 rounded">{{ $p->id }}</code>
                            </td>
                            <td>
                                <strong>{{ $p->serial_po }}</strong>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $p->order_name }}</div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i:s') }}
                                </small>
                            </td>
                            <td class="text-center">
                                <a href="{{ URL::to('orderdetail/'.$p->id) }}" 
                                   class="btn btn-sm btn-outline-info" 
                                   data-bs-toggle="tooltip" title="ดูรายละเอียด">
                                    <i class="fas fa-eye me-1"></i>รายละเอียด
                                </a>
                            </td>
                            <td class="text-center">
                                @if ($p->status === 0)
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="fas fa-clock me-1"></i>ยังไม่ชำระเงิน
                                    </span>
                                @elseif ($p->status === 1)
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>ชำระเงินแล้ว
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-shopping-cart fs-1 mb-3"></i>
                                    <h5>ไม่พบข้อมูลคำสั่งซื้อ</h5>
                                    <p>ยังไม่มีคำสั่งซื้อในระบบ</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if(count($order) > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">รวมทั้งหมด:</th>
                            <th colspan="2" class="text-center">
                                <span class="badge bg-primary rounded-pill">
                                    {{ count($order) }} คำสั่งซื้อ
                                </span>
                            </th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
        
        @if(method_exists($order, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div class="pagination-info">
                    <span class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        แสดงข้อมูล <strong>{{ count($order) }}</strong> รายการ
                        @if($order->total() > 0)
                            จากทั้งหมด <strong>{{ number_format($order->total()) }}</strong> รายการ
                        @endif
                    </span>
                </div>
                <div class="pagination-wrapper">
                    {{ $order->links('custom.pagination') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
</script>

@endsection
