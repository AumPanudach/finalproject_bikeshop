@extends('layouts.master')
@section('title') BikeShop | รายการสินค้า @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-box text-primary me-2"></i>จัดการสินค้า
            </h1>
            <p class="text-muted mb-0">จัดการข้อมูลสินค้าทั้งหมดในระบบ</p>
        </div>
        <a href="{{ URL::to('product/edit') }}" class="btn btn-success rounded-pill">
            <i class="fas fa-plus me-2"></i>เพิ่มสินค้าใหม่
        </a>
    </div>

    <!-- Search Card -->
    <div class="card shadow-custom border-0 mb-4">
        <div class="card-body">
            <form action="{{ URL::to('product/search') }}" method="post" class="row align-items-end">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <label for="search" class="form-label fw-semibold">ค้นหาสินค้า</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="q" id="search" class="form-control" 
                               placeholder="ป้อนรหัสสินค้า หรือชื่อสินค้าเพื่อค้นหา...">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>ค้นหา
                    </button>
                    <a href="{{ URL::to('product') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-refresh-cw me-1"></i>รีเซ็ต
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table Card -->
    <div class="card shadow-custom border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>รายการสินค้า
            </h5>
            <span class="badge bg-primary rounded-pill">{{ count($products) }} รายการ</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">รูปภาพ</th>
                            <th style="width: 120px;">รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th style="width: 150px;">ประเภท</th>
                            <th class="text-center" style="width: 100px;">คงเหลือ</th>
                            <th class="text-end" style="width: 120px;">ราคา (บาท)</th>
                            <th class="text-center" style="width: 180px;">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $p)
                        <tr>
                            <td class="text-center">
                                <div class="product-image-thumb">
                                    <img src="{{ asset($p->image_url) }}" 
                                         alt="{{ $p->name }}" 
                                         class="img-thumbnail rounded">
                                </div>
                            </td>
                            <td>
                                <code class="bg-light text-dark p-1 rounded">{{ $p->code }}</code>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $p->name }}</div>
                            </td>
                            <td>
                                <span class="badge bg-info rounded-pill">{{ $p->category->name }}</span>
                            </td>
                            <td class="text-center">
                                @if($p->stock_qty > 10)
                                    <span class="badge bg-success rounded-pill">{{ number_format($p->stock_qty, 0) }}</span>
                                @elseif($p->stock_qty > 0)
                                    <span class="badge bg-warning rounded-pill">{{ number_format($p->stock_qty, 0) }}</span>
                                @else
                                    <span class="badge bg-danger rounded-pill">หมด</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <span class="fw-bold text-success">{{ number_format($p->price, 2) }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ URL::to('product/edit/'.$p->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       data-bs-toggle="tooltip" title="แก้ไข">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip" title="ลบ"
                                            onclick="confirmDelete('{{ $p->id }}', '{{ $p->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-box-open fs-1 mb-3"></i>
                                    <h5>ไม่พบข้อมูลสินค้า</h5>
                                    <p>ยังไม่มีสินค้าในระบบ หรือไม่พบผลการค้นหา</p>
                                    <a href="{{ URL::to('product/edit') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>เพิ่มสินค้าแรก
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if(count($products) > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="4" class="text-end">รวมทั้งหมด:</th>
                            <th class="text-center">
                                <span class="badge bg-primary rounded-pill">
                                    {{ number_format($products->sum('stock_qty'), 0) }} ชิ้น
                                </span>
                            </th>
                            <th class="text-end">
                                <span class="fw-bold text-success">
                                    {{ number_format($products->sum('price'), 2) }} บาท
                                </span>
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
        
        @if(method_exists($products, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div class="pagination-info">
                    <span class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        แสดงข้อมูล <strong>{{ count($products) }}</strong> รายการ
                        @if($products->total() > 0)
                            จากทั้งหมด <strong>{{ number_format($products->total()) }}</strong> รายการ
                        @endif
                    </span>
                </div>
                <div class="pagination-wrapper">
                    {{ $products->links('custom.pagination') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>ยืนยันการลบ
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบสินค้า <strong id="productName"></strong> หรือไม่?</p>
                <p class="text-muted mb-0">การดำเนินการนี้ไม่สามารถยกเลิกได้</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>ลบสินค้า
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.product-image-thumb {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 0.375rem;
    overflow: hidden;
}

.product-image-thumb img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border: none !important;
}

.btn-group .btn {
    margin: 0 1px;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

/* Custom Pagination Styles */
.pagination-modern {
    gap: 6px;
    justify-content: center;
}

.pagination-modern .page-link {
    border-radius: 10px !important;
    padding: 12px 16px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef !important;
    position: relative;
    overflow: hidden;
}

/* Button Styles */
.pagination-btn {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    color: #495057 !important;
    min-width: 60px;
}

.pagination-btn:hover {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    color: white !important;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.pagination-btn-disabled {
    background: #f8f9fa !important;
    color: #adb5bd !important;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Number Styles */
.pagination-number {
    background: #ffffff !important;
    color: #495057 !important;
    min-width: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination-number:hover {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    color: white !important;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
}

/* Current Page Styles */
.pagination-current {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    color: white !important;
    min-width: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    position: relative;
}

.pagination-current .page-number {
    font-size: 16px;
    font-weight: 600;
    line-height: 1;
}

.pagination-current .page-indicator {
    font-size: 4px;
    margin-top: 2px;
    opacity: 0.8;
}

.pagination-current::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.2) 50%, transparent 70%);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Dots Styles */
.pagination-dots {
    background: transparent !important;
    color: #adb5bd !important;
    border: none !important;
    box-shadow: none !important;
    padding: 12px 8px;
}

/* Info Styles */
.pagination-info-bottom {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 10px 20px;
    border-radius: 20px;
    border: 1px solid #dee2e6;
    display: inline-block;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* Enhanced Animation Effects */
.pagination-modern .page-item:not(.disabled) .page-link::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    transition: all 0.3s ease;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    z-index: 0;
}

.pagination-modern .page-item:not(.disabled) .page-link:hover::after {
    width: 100px;
    height: 100px;
}

.pagination-modern .page-item:not(.disabled) .page-link > * {
    position: relative;
    z-index: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .pagination-modern {
        gap: 4px;
        flex-wrap: wrap;
    }
    
    .pagination-modern .page-link {
        padding: 10px 12px;
        font-size: 14px;
        min-width: 40px;
    }
    
    .pagination-btn {
        min-width: 50px;
    }
    
    .pagination-current .page-number {
        font-size: 14px;
    }
    
    .card-footer .d-flex {
        flex-direction: column;
        gap: 15px;
        align-items: center !important;
    }
    
    .pagination-info {
        order: 2;
    }
    
    .pagination-wrapper {
        order: 1;
        margin-left: 0;
    }
    
    .pagination-info-bottom {
        font-size: 12px;
        padding: 8px 16px;
    }
}

@media (max-width: 480px) {
    .pagination-modern .page-link {
        padding: 8px 10px;
        font-size: 12px;
        min-width: 35px;
    }
    
    .pagination-btn {
        min-width: 45px;
    }
}

.pagination-info {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid #dee2e6;
}

.pagination-wrapper {
    margin-left: auto;
}

@media (max-width: 768px) {
    .pagination-modern .page-link {
        padding: 8px 12px;
        font-size: 14px;
    }
    
    .card-footer .d-flex {
        flex-direction: column;
        gap: 15px;
        align-items: center !important;
    }
    
    .pagination-info {
        order: 2;
    }
    
    .pagination-wrapper {
        order: 1;
        margin-left: 0;
    }
}
</style>

<script>
function confirmDelete(productId, productName) {
    document.getElementById('productName').textContent = productName;
    document.getElementById('confirmDeleteBtn').href = '{{ URL::to("product/remove") }}/' + productId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

@endsection
