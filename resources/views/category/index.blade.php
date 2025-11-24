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
                <table class="table table-modern mb-0 align-middle">
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

<script>
function confirmDelete(categoryId, categoryName) {
    document.getElementById('categoryName').textContent = categoryName;
    document.getElementById('confirmDeleteBtn').href = '{{ URL::to("category/remove") }}/' + categoryId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

@endsection