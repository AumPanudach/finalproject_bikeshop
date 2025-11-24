@extends("layouts.master")
@section('title') BikeShop | จัดการผู้ใช้งาน @stop
@section('content')

<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">
                <i class="fas fa-users text-primary me-2"></i>จัดการผู้ใช้งาน
            </h1>
            <p class="text-muted mb-0">จัดการข้อมูลผู้ใช้งานทั้งหมดในระบบ</p>
        </div>
        <a href="{{ URL::to('user/edit') }}" class="btn btn-success rounded-pill">
            <i class="fas fa-user-plus me-2"></i>เพิ่มผู้ใช้ใหม่
        </a>
    </div>

    <!-- Search Card -->
    <div class="card shadow-custom border-0 mb-4">
        <div class="card-body">
            <form action="{{ URL::to('user/search') }}" method="post" class="row align-items-end">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <label for="search" class="form-label fw-semibold">ค้นหาผู้ใช้งาน</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="q" id="search" class="form-control" 
                               placeholder="ป้อนชื่อผู้ใช้หรืออีเมลเพื่อค้นหา...">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>ค้นหา
                    </button>
                    <a href="{{ URL::to('user') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-refresh-cw me-1"></i>รีเซ็ต
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card shadow-custom border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>รายการผู้ใช้งาน
            </h5>
            <span class="badge bg-primary rounded-pill">{{ count($users) }} คน</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">ID</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>อีเมล</th>
                            <th class="text-center" style="width: 150px;">วันที่สร้าง</th>
                            <th class="text-center" style="width: 180px;">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-light text-dark rounded-pill">{{ $user->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $user->name }}</div>
                                        <small class="text-muted">ผู้ใช้งาน</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ $user->email }}</span>
                            </td>
                            <td class="text-center">
                                <small class="text-muted">{{ $user->created_at->format('d/m/Y') }}</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ URL::to('user/edit/'.$user->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       data-bs-toggle="tooltip" title="แก้ไข">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip" title="ลบ"
                                            onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-users fs-1 mb-3"></i>
                                    <h5>ไม่พบข้อมูลผู้ใช้งาน</h5>
                                    <p>ยังไม่มีผู้ใช้งานในระบบ หรือไม่พบผลการค้นหา</p>
                                    <a href="{{ URL::to('user/edit') }}" class="btn btn-primary">
                                        <i class="fas fa-user-plus me-2"></i>เพิ่มผู้ใช้แรก
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(method_exists($users, 'links'))
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">
                    แสดงข้อมูล {{ count($users) }} คน
                </span>
                {{ $users->links() }}
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
                <p>คุณต้องการลบผู้ใช้งาน <strong id="userName"></strong> หรือไม่?</p>
                <p class="text-muted mb-0">การดำเนินการนี้ไม่สามารถยกเลิกได้</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>ลบผู้ใช้งาน
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId, userName) {
    document.getElementById('userName').textContent = userName;
    document.getElementById('confirmDeleteBtn').href = '{{ URL::to("user/remove") }}/' + userId;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

@endsection
