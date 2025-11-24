@extends("layouts.master")
@section('title') Management System | ระบบจัดการการสั่งซื้อสินค้า @stop
@section('content')

<h1>เพิ่มผู้ใช้</h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}">หน้าแรก</a></li>
    <li class="active">เพิ่มผู้ใช้ </li>
</ul>

{!! Form::open(array('action' => 'App\Http\Controllers\UserController@insert', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}

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
            <td>{{ Form::label('name', 'ชื่อผู้ใช้ ') }}</td>
            <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('email', 'email ') }}</td>
            <td>{{ Form::text('email', Request::old('email'), ['class' => 'form-control']) }}</td>
        </tr>   
        <tr>
            <td>{{ Form::label('password', 'password ') }}</td>
            <td>{{ Form::password('password', Request::old('name'), ['class' => 'form-control']) }}</td>
        </tr>
    </table>
</div>

<div class="panel-footer">
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
{!! Form::close() !!}

@endsection