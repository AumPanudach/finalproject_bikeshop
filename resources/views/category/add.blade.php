@extends('layouts.master')
@section('title') BikeShop | เพิ่มข้อมูลประเภทสินค้า @stop
@section('content')

<ul class="breadcrumb">
    <li><a href="{{ URL::to('category')}}">หน้าแรก</a></li>
    <li class="active">เพิ่มประเภทสินค้า</li>
</ul>


@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <div> {{$error}}</div>
    @endforeach
</div>
@endif
<div class="panel panel-default">
<div class="panel-heading">
    <div class="panel-title">
        <strong>เพิ่มประเภทสินค้า</strong>
    </div>
</div>

<center>
<br>
<form action="{{ url('/category/insert') }}" method="POST" enctype="multipart/form-data">
    @csrf
<table>
<tr>
            <td><label for="name">ชื่อประเภทสินค้า</label></td>
            <td><input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"></td>
</tr>
</table>
<br>
<button onclick="location.href='/product'" type="reset" class="btn btn-danger">ยกเลิก</button>
<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>บันทึก</button>
</form>
<br>
</div>

@endsection