@extends('layouts.master')
@section('title') BikeShop | แสดงการสั่งซื้อสินค้า@stop
@section('content')
<head>
    <style>
        .ordernotcomplete{
            color: white;
            background-color: red;
            text-align: center;
        }

        .ordercomplete{
            color: white;
            background-color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        แสดงการสั่งซื้อสินค้า

    </h1>
    <table class="table table-bordered bs-table">
        <thead>
            <tr>
                <th>OrderID</th>
                <th>เลขที่ใบสั่งซื้อ</th>
                <th>ชื่อลูกค้า</th>
                <th>วันที่สั่งซื้อสินค้า</th>
                <th>รายละเอียด</th>
                <th>สถานะการชําระเงิน</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($order as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->serial_po }}</td>
                    <td>{{ $p->order_name }}</td>
                    <td>{{ $p->created_at }}</td>
                    <td><a href="{{ URL::to('orderdetail/'.$p->id)}}">รายละเอียด</a></td> {{-- ไปเพิ่มเอาเองนะแบบกดได้แล้วไปหน้า order detail --}}
                    <td>
                        @if ($p->status === 0)
                            <div class="ordernotcomplete">ยังไม่ชําระเงิน</div>
                        @elseif  ($p->status === 1)
                        <div class="ordercomplete">ชําระเงินเเล้ว</div>
                        @endif
                </tr>
            @endforeach
            </body>
        @endsection
