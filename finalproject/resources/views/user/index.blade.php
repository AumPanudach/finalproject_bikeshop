@extends("layouts.master")
@section('title') Management System | ระบบจัดการการสั่งซื้อสินค้า @stop
@section('content')
<div class="container">

    <style>
        .bs_table {
            width: 100%;
        }

        .bs_table th {
            background-color: #f5f5f5;
            text-align: center; 
        }

        .bs_table td {
            border-bottom: 1px solid #ddd;
        }

        .bs_center {
            text-align: center;
        }
    </style>

    <h1>แสดงข้อมูลผู้ใช้</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><strong>ข้อมูลและการจัดการ</strong></div>
        </div>

        <div class="panel-body">
            <!-- search form -->
            <form action="{{ URL::to('user/search') }}" method="post" class="form-inline"> {{ csrf_field() }}
                <input type="text" name="q" class="form-control" placeholder="พิมพ์ชื่อเพื่อค้นหา">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
                <a href="{{ URL::to('user/edit') }}" class="btn btn-success pull-right">เพิ่มผู้ใช้</a>
            </form>
        </div>

        <table class="table table-bordered bs_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>วันที่สร้าง</th>
                  
                    <th>การทํางาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->created_at->format('Y-m-d') }}</td>
                    
                    <td class="bs_center">
                        <a href="{{ URL::to('user/edit/'.$p->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                        <a href="{{ URL::to('user/remove/'.$p->id) }}" class="btn btn-danger btn-delete" onclick="return confirm('คุณต้องการลบข้อมูลผู้ใช้หรือไม่?')"><i class="fa fa-trash"></i> ลบ</a>
                        {{-- <script>
                            $('.btn-delete').on('click', function() {
                                if (confirm("คุณต้องการลบข้อมูลผู้ใช้หรือไม่?")) {
                                    var url = "{{ URL::to('user/remove') }}" + '/' + $(this).attr('id-delete');
                                    window.location.href = url;
                                }
                            });
                        </script> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-footer">
            <span>แสดงข้อมูลจำนวน : {{ count($users) }}</span>
        </div>

        {{ $users->links() }}
    </div>
</div>
@endsection
