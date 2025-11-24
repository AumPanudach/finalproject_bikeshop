@extends("layouts.master")
@section('title') Management System | ระบบจัดการการสั่งซื้อสินค้า @stop
@section('content')

<h1>เพิ่มผู้ใช้</h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}">หน้าแรก</a></li>
    <li class="active">เพิ่มผู้ใช้ </li>
</ul>

<form action="{{ url('/user/add') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>ใส่ข้อมูลผู้ใช้ </strong>
        </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="panel-body">
    <table>
        <tr>
            <td><label for="name">ชื่อผู้ใช้ </label></td>
            <td><input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"></td>
        </tr>
        <tr>
            <td><label for="email">email </label></td>
            <td><input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control"></td>
        </tr>   
        <tr>
            <td><label for="password">password </label></td>
            <td><input type="password" name="password" id="password" class="form-control"></td>
        </tr>
    </table>
</div>

<div class="panel-footer">
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
</form>

@endsection