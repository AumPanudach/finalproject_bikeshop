@extends('layouts.master')
@section('title') BikeShop | รายการข้อมูลประเภทสินค้า @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-tags text-primary me-2"></i>จัดการประเภทสินค้า
            </h1>
            <p class="text-muted mb-0">จัดการข้อมูลประเภทสินค้าทั้งหมดในระบบ</p>
        </div>
        <a href="{{ URL::to('category/edit') }}" class="btn btn-success rounded-pill">
            <i class="fas fa-plus me-2"></i>เพิ่มประเภทสินค้าใหม่
        </a>
    </div>

    <!-- Search Card -->
    <div class="card shadow-custom border-0 mb-4">
        <div class="card-body">
            <form action="{{ URL::to('category/search') }}" method="post" class="row align-items-end">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <label for="search" class="form-label fw-semibold">ค้นหาประเภทสินค้า</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="q" id="search" class="form-control" 
                               placeholder="ป้อนรหัสหรือชื่อประเภทสินค้าเพื่อค้นหา...">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>ค้นหา
                    </button>
                    <a href="{{ URL::to('category') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-refresh-cw me-1"></i>รีเซ็ต
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Table Card -->
    <div class="card shadow-custom border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>รายการประเภทสินค้า
            </h5>
            <span class="badge bg-primary rounded-pill">{{ count($category) }} รายการ</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 100px;">รหัส</th>
                            <th>ชื่อประเภทสินค้า</th>
                            <th class="text-center" style="width: 180px;">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($category as $c)
                        <tr>
                            <td>
                                <code class="bg-light text-dark p-1 rounded">{{ $c->id }}</code>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $c->name }}</div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ URL::to('category/edit/'.$c->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       data-bs-toggle="tooltip" title="แก้ไข">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip" title="ลบ"
                                            onclick="confirmDelete('{{ $c->id }}', '{{ $c->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-tags fs-1 mb-3"></i>
                                    <h5>ไม่พบข้อมูลประเภทสินค้า</h5>
                                    <p>ยังไม่มีประเภทสินค้าในระบบ หรือไม่พบผลการค้นหา</p>
                                    <a href="{{ URL::to('category/edit') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>เพิ่มประเภทสินค้าแรก
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if(count($category) > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="2" class="text-end">รวมทั้งหมด:</th>
                            <th class="text-center">
                                <span class="badge bg-primary rounded-pill">
                                    {{ count($category) }} ประเภท
                                </span>
                            </th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
        
        @if(method_exists($category, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div class="pagination-info">
                    <span class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        แสดงข้อมูล <strong>{{ count($category) }}</strong> รายการ
                        @if($category->total() > 0)
                            จากทั้งหมด <strong>{{ number_format($category->total()) }}</strong> รายการ
                        @endif
                    </span>
                </div>
                <div class="pagination-wrapper">
                    {{ $category->links('custom.pagination') }}
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
                <p>คุณต้องการลบประเภทสินค้า <strong id="categoryName"></strong> หรือไม่?</p>
                <p class="text-muted mb-0">การดำเนินการนี้ไม่สามารถยกเลิกได้</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>ลบประเภทสินค้า
                </a>
            </div>
        </div>
    </div>
</div>

<style>
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
.pagination-info {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid #dee2e6;
}

.pagination-info-bottom {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 10px 20px;
    border-radius: 20px;
    border: 1px solid #dee2e6;
    display: inline-block;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.pagination-wrapper {
    margin-left: auto;
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
</style>

<script>
function confirmDelete(categoryId, categoryName) {
    document.getElementById('categoryName').textContent = categoryName;
    document.getElementById('confirmDeleteBtn').href = '{{ URL::to("category/remove") }}/' + categoryId;
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