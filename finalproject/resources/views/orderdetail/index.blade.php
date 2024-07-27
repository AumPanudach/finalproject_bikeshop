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
            background-color: rgb(0, 255, 0);
            text-align: center;
        }
    </style>

</head>
<body>
    <h1>
        แสดงการสั่งซื้อสินค้า
    </h1>
    <table class="table table-bordered bs-table">
            <tr>
                <td>เลขที่ใบสั่งซื้อ</td>
                <td>{{$orderdetail->serial_po}}</td>
                <td></td>
            </tr>

            <tr>
                <td>ชื่อลูกค้า</td>
                <td>{{$orderdetail->order_name}}</td>
                <td></td>
            </tr>

            <tr>
                <td>อีเมล</td>
                <td>{{$orderdetail->order_email}}</td>
                <td></td>
            </tr>

            <tr>
                <td>วันที่สั่งซื้อสินค้า</td>
                <td>{{$orderdetail->created_at}}</td>
                <td></td>
            </tr>

            <tr>
                <td>สถานะการชําระเงิน</td>
                <td>
                    @if ($orderdetail->status === 0)
                    <div class="ordernotcomplete">ยังไม่ชําระเงิน</div>
                    @elseif  ($orderdetail->status === 1)
                    <div class="ordercomplete">ชําระเงินเเล้ว</div>
                    @endif
                </td>
                <td>
                    <a href="{{ URL::to('orderdetail/edit1/'.$orderdetail->id)}}" class="btn btn-success"> ชําระเงินเเล้ว </a>
                    <a href="{{ URL::to('orderdetail/edit2/'.$orderdetail->id)}}" class="btn btn-danger"> ยังไม่ชําระเงิน </a>
                </td>

            </tr>    
    </table>

    </br>
    <table class="table table-bordered bs-table">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาต่อหน่วย</th>
                <th>จำนวน</th>
                <th>รวมเงิน</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; $sum_price = 0;?>

            @foreach ($orderdetail->detail as $p)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $p->product_name }}</td>
                <td class="bs-price">{{ number_format($p->price, 0) }}</td>
                <td class="bs-price">{{ $p->qty }}</td>
                <?php $sum = $p['price'] * $p['qty'] ?>
                <td class="bs-price">{{ number_format($sum,0) }}</td>
                <?php 
                    $sum_price += $sum;  
                    $i++;
                ?>
            </tr>@endforeach

            <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right;">รวมเงิน</th>
                    <th class="bs-price">{{ number_format($sum_price, 0) }} บาท</th>
                </tr>
            </tfoot>
            

        </tbody>
    </table>
            </body>
        @endsection
